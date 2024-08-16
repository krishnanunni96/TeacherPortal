<?php

namespace App\Http\Livewire;

use App\Models\Product_Purchase;
use App\Models\Products;
use App\Models\Purchase;
use App\Models\Supplier;
use Carbon\Carbon;
use Livewire\Component;

class WarehousePurchaseAdd extends Component
{
    public $supplier_name,$mobile,$tax_number,$address,$is_active,$supplier,$supplier_search,$supplier_search_results;
    public $purchase_date,$purchase_no="P-1",$discount,$service_charge,$gross_total,$tax_total;
    public $rate=[],$quantity=[],$tax_percentage=[],$tax_amount=[],$total=[],$prod=[],$sub_total=[],$sub_total_2;
    public $product, $product_search, $product_search_results;

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
        return view('livewire.warehouse.warehouse-purchase-add');
    }

    public function mount(){
        $this->is_active = 1;
        $this->purchase_date=Carbon::today()->toDateString();
        $purchase=Purchase::latest()->value('id');
        $this->purchase_no="P-".($purchase+1);
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
        $this->sub_total_2 = 0;
        $this->gross_total = 0;
        $this->tax_total = 0;
        foreach ($this->prod as $i=>$value) {                                                   
            $this->sub_total[$i] = $this->rate[$i]*$this->quantity[$i];                                                                     
            $this->tax_amount[$i]=($this->sub_total[$i]*$this->tax_percentage[$i])/100;                                 
            $this->sub_total_2+=($this->sub_total[$i]);   
            $this->tax_total+=$this->tax_amount[$i];                                             
        }            
        $this->gross_total=$this->sub_total_2+$this->service_charge-$this->discount+$this->tax_total;                                                                    
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

    public function savePurchase(){                              
        $this->validate([
            'discount' => 'required',
            'service_charge' => 'required'
        ]);

        if($this->supplier==null){
            $this->addError('supplier_search','Supplier name required');
        }

        if($this->prod==[]){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Product required'
            ]);
        }
        else{
            $purchase=new Purchase();
            $purchase->supplier_id=$this->supplier->id;
            $purchase->purchase_date=$this->purchase_date;
            $purchase->purchase_no=$this->purchase_no;
            $purchase->discount=$this->discount;
            $purchase->service_charge=$this->service_charge;
            $purchase->sub_total=$this->sub_total_2;
            $purchase->gross_total=$this->gross_total;
            $purchase->tax_total=$this->tax_total;
            $purchase->save();
    
            foreach($this->prod as $key=>$value){
                $product=new Product_Purchase();
                $product->purchase_id=$purchase->id;
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
}
