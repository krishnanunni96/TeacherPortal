<?php

namespace App\Http\Livewire\Reports;

use App\Models\Purchase as ModelsPurchase;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF;

class Purchase extends Component
{
    public $date1, $date2, $purchases, $total_purchase_amount=0, $total_tax_amount=0;

    public function mount(){
        $this->date2=Carbon::today()->toDateString();
        $this->date1=Carbon::today()->subMonth()->toDateString();
    }
    
    public function render()
    {
        $query = ModelsPurchase::latest();
        if ($this->date1 != '') {
            if ($this->date2 == '') {
                $this->date2 = Carbon::today()->toDateString();
                $query->whereBetween('purchase_date', [$this->date1, $this->date2]);
            } else {
                $query->whereBetween('purchase_date', [$this->date1, $this->date2]);
            }
        }

        $this->purchases = $query->get();
        return view('livewire.reports.purchase');
    }

    public function downloadPDF()
    {
        $purchases = ModelsPurchase::whereBetween('purchase_date',[$this->date1,$this->date2])->get();
        if ($purchases) {
            $pdf = PDF::loadView('purchase_report_pdf', compact('purchases'))->output();
            return response()->streamDownload(function () use ($pdf) {
                print($pdf);
            }, "Purchase_report.pdf");
        }
    }
}
