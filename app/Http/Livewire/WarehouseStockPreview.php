<?php

namespace App\Http\Livewire;

use App\Models\Product_2;
use App\Models\Stock;
use Livewire\Component;

class WarehouseStockPreview extends Component
{
    public $stock,$product;

    public function mount($id){
        $this->stock=Stock::find($id);   
        $this->product=Product_2::where('stock_id',$id)->get();             
    }

    public function render()
    {
        return view('livewire.warehouse.warehouse-stock-preview');
    }
}
