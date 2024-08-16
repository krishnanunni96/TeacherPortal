<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerSort extends Component
{
    public $customers, $sort;

    public function render()
    {
        $this->customers = Customer::orderBy('sort_id')->get();

        return view('livewire.customer-sort');
    }

    public function delete($id, $target)
    {
        $customer = Customer::find($id);
        if ($target == "delete") {
            $customer->delete();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Customer removed successfully'
            ]);
        }
    }

    public function updated($sort){
        foreach($this->sort  as $key=>$value){
            $key++;
            $product=Customer::find($value);
            $product->sort_id=$key;
            $product->save();
        }
    }
}
