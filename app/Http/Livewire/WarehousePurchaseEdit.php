<?php

namespace App\Http\Livewire;

use App\Models\Product_Purchase;
use App\Models\Products;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\Component;

class WarehousePurchaseEdit extends Component
{
    public $purchase,$product,$product_search, $product_search_results;
    public $supplier_name,$mobile,$tax_number,$address,$is_active,$supplier,$supplier_search,$supplier_search_results;
    public $purchase_date,$discount,$service_charge,$gross_total,$tax_total,$products=[];
    public $rate=[],$quantity=[],$tax_percentage=[],$tax_amount=[],$total=[],$prod=[],$sub_total=[],$sub_total_2;

    public function mount($id){
        $this->purchase=Purchase::find($id);
        $this->purchase_date=$this->purchase->purchase_date;
        $this->purchase_no=$this->purchase->purchase_no;
        $this->discount=$this->purchase->discount;
        $this->service_charge=$this->purchase->service_charge;
        $this->gross_total=$this->purchase->gross_total;
        $this->tax_total=$this->purchase->tax_total;
        $this->product=Product_Purchase::where('purchase_id',$id)->get();    
        foreach($this->product as $key=>$value){
            // $this->prod[$key]=$value->product_name;
            array_push($this->prod, ['name' => $value->product_name, 'rate' => $value->rate]);         
            $this->rate[$key]=$value->rate;
            $this->quantity[$key]=$value->quantity;
            $this->tax_percentage[$key]=$value->tax_percentage;
            $this->tax_amount[$key]=$value->tax_amount;
            $this->total[$key]=$value->total;
        }                         
        $this->supplierSelect($this->purchase->supplier_id);
    }

    public function render()
    {
        $query=Supplier::latest();
        $query2=Products::latest();
        if($this->supplier_search!=''){
            $query->where('name','like','%'.$this->supplier_search.'%');
        }
        if($this->product_search!=''){
            $query2->where('name','like','%'.$this->product_search.'%');
        }
        $this->product_search_results=$query2->get();
        $this->supplier_search_results=$query->get();
        return view('livewire.warehouse.warehouse-purchase-edit');
    }

    public function supplierSelect($id)
    {
        $this->supplier = Supplier::find($id);
        $this->supplier_search_results = [];
        $this->supplier_search = '';
    }

    public function saveSupplier(){
        $this->validate([
            'supplier_name' => 'required',
            'mobile' => 'required|numeric'
        ]);

        $supplier = new Supplier();
        $supplier->name = $this->supplier_name;
        $supplier->address = $this->address;
        $supplier->mobile = $this->mobile;
        $supplier->tax_number = $this->tax_number;
        $supplier->is_active = $this->is_active;
        $supplier->save();

        $this->supplierSelect($supplier->id);
        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Supplier added Successfully!'
        ]);
    }

    public function productSelect($id)
    {
        $this->product = Products::find($id);
        array_push($this->prod, ['name' => $this->product->name, 'rate' => $this->product->price]);
        $this->product_search_results = [];
        $this->product_search = '';
        $this->quantity[] = 1;
        $this->rate[] = $this->product->price;
        $this->tax_percentage[] = 15;
        $this->calculate_total();
    }

    public function resetfn(){
        $this->supplier_name=null;
        $this->mobile=null;
        $this->resetErrorBag();
    }

    public function clearAll(){
        $this->prod=[];
        $this->gross_total=null;
        $this->tax_total=null;
        $this->discount=null;
        $this->service_charge=null;
        $this->supplier=null;
    }

    public function updated($quantity)
    {
        $this->validateOnly($quantity, [
            'quantity.*' => 'required',
            'rate.*' => 'required',
            'discount' => 'required',
            'service_charge' => 'required'
        ]);
        $this->calculate_total();
    }

    public function quantityAdd($i)
    {
        $this->quantity[$i]++;
        $this->calculate_total();
    }

    public function quantitySub($i)
    {
        if ($this->quantity[$i] == 1) {
            unset($this->prod[$i]);
            unset($this->quantity[$i]);
            unset($this->rate[$i]);
            $this->calculate_total();
        } else {
            $this->quantity[$i]--;
            $this->calculate_total();
        }
    }

    public function calculate_total()
    {                                                                           
        $this->sub_total[] = 0;
        $this->sub_total_2=0;
        $this->gross_total = 0;
        $this->tax_total = 0;
        foreach ($this->prod as $i=>$value) {                                                   
            $this->sub_total[$i] = $this->rate[$i]*$this->quantity[$i];                                                                     
            $this->tax_amount[$i]=($this->sub_total[$i]*$this->tax_percentage[$i])/100;                                 
            // $this->total[$i]=$this->sub_total[$i]+$this->tax_amount[$i]; 
            $this->sub_total_2+=($this->sub_total[$i]);   
            $this->tax_total+=$this->tax_amount[$i];                                             
        }            
        $this->gross_total=$this->sub_total_2+$this->service_charge-$this->discount+$this->tax_total;                                                                     
    }

    public function savePurchase(){
        $this->validate([
            'discount' => 'required',
            'service_charge' => 'required'
        ]);

        $count=Product_Purchase::where('purchase_id',$this->purchase->id)->get()->count();
        if($count){
            Product_Purchase::where('purchase_id',$this->purchase->id)->delete();
        }

        $this->purchase->supplier_id=$this->supplier->id;
        $this->purchase->purchase_date=$this->purchase_date;
        $this->purchase->purchase_no=$this->purchase_no;
        $this->purchase->discount=$this->discount;
        $this->purchase->service_charge=$this->service_charge;
        $this->purchase->sub_total=$this->sub_total_2;
        $this->purchase->gross_total=$this->gross_total;
        $this->purchase->tax_total=$this->tax_total;
        $this->purchase->save();

        foreach($this->prod as $key=>$value){
            $product=new Product_Purchase();
            $product->purchase_id=$this->purchase->id;
            $product->product_name=$value['name'];
            $product->rate=$this->rate[$key];
            $product->quantity=$this->quantity[$key];
            $product->tax_percentage=$this->tax_percentage[$key];
            $product->tax_amount=$this->tax_amount[$key];
            $product->total=$this->sub_total[$key];
            $product->save();
        }

        $this->clearAll();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Purchase added Successfully!'
        ]);
    }
}
