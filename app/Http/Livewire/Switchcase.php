<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Switchcase extends Component
{
    public $value,$result;

    public function render()
    {
        switch ($this->value) {
            case 1:
                $this->result='January';
                break;
            case 2:
                $this->result='February';
                break;            
            case 3:
                $this->result='March';
                break;
            case 4:
                $this->result='April';
                break;            
            case 5:
                $this->result='May';
                break;
            case 6:
                $this->result='June';
                break;            
            case 7:
                $this->result='July';
                break;
            case 8:
                $this->result='August';
                break;            
            case 9:
                $this->result='September';
                break;
            case 10:
                $this->result='October';
                break;            
            case 11:
                $this->result='November';
                break;
            case 12:
                $this->result='December';
                break; 
                            
            default:
                $this->result='Invalid input';
                break;
        }
        return view('livewire.switchcase');
    }

    public function switchcase(){
       
    }
}
