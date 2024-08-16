<?php

namespace App\Http\Livewire;

use App\Models\Product_2;
use App\Models\Products;
use App\Models\Staff;
use App\Models\Stock;
use Livewire\Component;

class WarehouseStockEdit extends Component
{
    public $product_search, $product_search_results, $prod=[], $quantity=[], $total_qty, $staff_id;

    public function mount($id)
    {
        $this->stock = Stock::find($id);
        $this->staffs=Staff::all();
        $this->products = Products::all();
        $this->products_2 = Product_2::where('stock_id',$id)->get();

        $this->staff_id=$this->stock->staff_id;
        $this->order_no=$this->stock->order_id;
        $this->date=$this->stock->date;
        $this->total_qty=$this->stock->total_qty;

        foreach($this->products_2 as $value){
            array_push($this->prod,['name' => $value->name]);
            array_push($this->quantity,$value->quantity);
        }
    }

    public function render()
    {
        $this->calculate_quantity();
        $query = Products::latest();
        if ($this->product_search != '') {
            $query->where('name', 'like', '%' . $this->product_search . '%');
        }
        $this->product_search_results = $query->get();
        return view('livewire.warehouse.warehouse-stock-edit');
    }

    public function productSelect($id)
    {
        $this->product = Products::find($id);
        array_push($this->prod, ['id' => $id, 'name' => $this->product->name]);
        $this->product_search_results = [];
        $this->product_search = '';
        $this->quantity[] = 1;
    }

    public function updated($quantity)
    {
        $this->validateOnly($quantity, [
            'quantity.*' => 'required'
        ]);
        $this->calculate_quantity();
    }

    public function quantityAdd($i)
    {
        $this->quantity[$i]++;
        $this->calculate_quantity();
    }

    public function quantitySub($i)
    {
        if ($this->quantity[$i] == 1) {
            unset($this->prod[$i]);
            unset($this->quantity[$i]);
            $this->calculate_quantity();
        } else {
            $this->quantity[$i]--;
            $this->calculate_quantity();
        }
    }

    public function calculate_quantity()
    {
        $this->total_qty = 0;
        foreach ($this->quantity as $value) {
            $this->total_qty += $value;
        }
    }

    public function resetfn(){
        $this->prod = [];
        $this->quantity = [];
        $this->calculate_quantity();
        $this->staff_id = null;
    }

    public function save()
    {
        $this->validate([
            'staff_id' => 'required'
        ]);

        $count = Product_2::where('stock_id', $this->stock->id)->get()->count();
        if ($count) {
            Product_2::where('stock_id', $this->stock->id)->delete();
        }

        $this->stock->staff_id = $this->staff_id;
        $this->stock->date = $this->date;
        $this->stock->order_id = $this->order_no;
        $this->stock->staff_id = $this->staff_id;
        $this->stock->total_qty = $this->total_qty;
        $this->stock->save();

        foreach ($this->prod as $key => $value) {
            $product_2 = new Product_2();
            $product_2->stock_id = $this->stock->id;
            $product_2->name = $value['name'];
            $product_2->quantity = $this->quantity[$key];
            $product_2->save();
        }

        $this->resetfn();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Stock updated successfully'
        ]);
    }
}
