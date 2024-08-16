<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Select2 extends Component
{
    public $selCity = [];
    public $cities = ['Alappuzha', 'Kollam', 'Trivandrum', 'Kochi'];
     
    public function render()
    {
        return view('livewire.select2');
    }

    public function selectedCity($data){
        array_push($this->selCity,$data);
        return $this->selCity = array_unique($this->selCity);                                        
    }
}
