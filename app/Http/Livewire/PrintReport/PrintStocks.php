<?php

namespace App\Http\Livewire\PrintReport;

use App\Models\Product_2;
use App\Models\Products;
use Livewire\Component;

class PrintStocks extends Component
{
    public $search, $products_2, $purchased_stock, $total_instock, $total_stock_value;
 
    public function render()
    {
        $this->products_2=Product_2::all();                                                    
        $this->products=Products::all();
        return view('livewire.print-report.print-stocks')->layout('layouts.print');
    }
}
