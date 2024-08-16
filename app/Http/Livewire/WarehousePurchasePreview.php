<?php

namespace App\Http\Livewire;

use App\Models\Product_Purchase;
use App\Models\Purchase;
use Livewire\Component;

class WarehousePurchasePreview extends Component
{
    public $purchase,$products;
    
    public function mount($id){
        $this->purchase=Purchase::find($id);
        $this->products=Product_Purchase::where('purchase_id',$id)->get();
    }

    public function render()
    {
        return view('livewire.warehouse.warehouse-purchase-preview');
    }
}
