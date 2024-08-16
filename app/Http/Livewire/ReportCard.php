<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF;

class ReportCard extends Component
{
    public $date1 = '', $date2 = '', $customers;

    public function mount(){
        $this->date2=Carbon::today()->toDateString();
        $this->date1=Carbon::today()->subMonth()->toDateString();
    }

    public function render()
    {
        $query = Customer::latest();
        if ($this->date1 != '') {
            // $this->date1 = Carbon::parse($this->date1)->toDateString();         
            if ($this->date2 == '') {
                $this->date2 = Carbon::today()->toDateString();
                $query->whereBetween('created_at', [$this->date1, $this->date2]);
            } else {
                $this->date2 = Carbon::parse($this->date2)->toDateString();
                $query->whereBetween('created_at', [$this->date1, $this->date2]);
            }
        }
        $this->customers = $query->get();
        return view('livewire.report-card');
    }

    public function downloadPDF()
    {
        $customer = Customer::whereBetween('created_at',[$this->date1,$this->date2])->get();
        if ($customer->count() > 0) {
            $pdf = PDF::loadView('marksheet_report_pdf', compact('customer'))->output();
            return response()->streamDownload(function () use ($pdf) {
                print($pdf);
            }, "Report_Card_".Carbon::today()->toDateString().".pdf");
        }else{
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'error',  'message' => 'No reports available!']); 
        }
    }
}
