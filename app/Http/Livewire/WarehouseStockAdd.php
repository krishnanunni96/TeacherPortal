<?php

namespace App\Http\Livewire;

use App\Models\Product_2;
use App\Models\Products;
use App\Models\Staff;
use App\Models\Stock;
use Carbon\Carbon;
use Livewire\Component;

class WarehouseStockAdd extends Component
{
    public $date, $staffs, $staff_id, $products, $product, $product_search, $product_search_results, $order_no = "STK-1";
    public $prod = [], $quantity = [], $total_qty = 0;

    public function mount()
    {
        $this->staffs = Staff::all();
        $this->products = Products::all();
        $this->date = Carbon::today()->toDateString();
        $stock = Stock::latest()->value('id');
        $this->order_no = "STK-" . ($stock + 1);
    }

    public function render()
    {
        $this->calculate_quantity();
        $query = Products::latest();
        if ($this->product_search != '') {
            $query->where('name', 'like', '%' . $this->product_search . '%');
        }
        $this->product_search_results = $query->get();
        return view('livewire.warehouse.warehouse-stock-add');
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
  
        if($this->prod==[]){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Product required'
            ]);
        }
        else{

            $stock = new Stock();
            $stock->staff_id = $this->staff_id;
            $stock->date = $this->date;
            $stock->order_id = $this->order_no;
            $stock->staff_id = $this->staff_id;
            $stock->total_qty = $this->total_qty;
            $stock->save();

            foreach ($this->prod as $key => $value) {
                $product_2 = new Product_2();
                $product_2->stock_id = $stock->id;
                $product_2->name = $value['name'];
                $product_2->quantity = $this->quantity[$key];
                $product_2->save();
            }
            $this->resetfn();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Stock entered successfully'
            ]);
        }
    }
}
