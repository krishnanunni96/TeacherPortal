<?php

namespace App\Http\Livewire\Reports;

use App\Models\Product_2;
use App\Models\Products;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF;

class Stock extends Component
{
    public $search, $products_2, $purchased_stock, $total_instock, $total_stock_value;
    
    public function render()
    {
        $query=Product_2::latest();
        if($this->search!=''){
            $query->where('name','like','%'.$this->search.'%');
        }
        $this->products_2=$query->get();                                                    
        $this->products=Products::all();

        return view('livewire.reports.stock');
    }

    public function downloadPDF()
    {
        $products = Products::all();
        $products_2 = Product_2::all();
        if ($products_2) {
            $pdf = PDF::loadView('stock_report_pdf', compact('products_2','products'))->output();
            return response()->streamDownload(function () use ($pdf) {
                print($pdf);
            }, "Stock_report.pdf");
        }
    }
}
