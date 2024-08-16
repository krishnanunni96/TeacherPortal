<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;

class WarehouseStock extends Component
{
    public $search,$dropdown_search,$stocks;

    public function render()
    {
        $query=Stock::latest();
        if($this->search!=''){
            $query->where('order_id','like','%'.$this->search.'%');
        }
        if($this->dropdown_search){
            $query->where('staff_id',$this->dropdown_search);
        }
        $this->stocks=$query->get();
        return view('livewire.warehouse.warehouse-stock');
    }
}
