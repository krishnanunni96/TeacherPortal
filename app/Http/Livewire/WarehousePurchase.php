<?php

namespace App\Http\Livewire;

use App\Models\Purchase;
use Livewire\Component;

class WarehousePurchase extends Component
{
    public $search,$purchases;
    public function render()
    {
        $query=Purchase::latest();
        if($this->search!=''){
            $query->where('purchase_no','like','%'.$this->search.'%');
        }
        $this->purchases=$query->get();
        return view('livewire.warehouse.warehouse-purchase');
    }
}
