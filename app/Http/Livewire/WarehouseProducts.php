<?php

namespace App\Http\Livewire;

use App\Models\Product_2;
use App\Models\Product_Purchase;
use App\Models\Products;
use Livewire\Component;

class WarehouseProducts extends Component
{
    public $name, $price, $unit, $tax_percentage, $is_active, $search, $products, $product;

    public function render()
    {
        $query = Products::latest();
        if ($this->search != '') {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        $this->products = $query->get();
        return view('livewire.warehouse.warehouse-products');
    }

    public function mount()
    {
        $this->is_active = 1;
        $this->unit = 1;
    }

    public function resetfn()
    {
        $this->resetErrorBag();
        $this->name = null;
        $this->price = null;
        $this->unit=1;
        $this->tax_percentage = null;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'tax_percentage' => 'required',
        ]);

        $product = new Products();
        $product->name = $this->name;
        $product->price = $this->price;
        $product->unit = $this->unit;
        $product->tax_percentage = $this->tax_percentage;
        $product->is_active = $this->is_active;
        $product->save();

        $this->resetfn();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Product added successfully'
        ]);
    }

    public function edit($id)
    {
        $this->product = Products::find($id);
        $this->name=$this->product->name;
        $this->price=$this->product->price;
        $this->unit=$this->product->unit;
        $this->tax_percentage=$this->product->tax_percentage;
        $this->is_active=$this->product->is_active;
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'tax_percentage' => 'required',
        ]);

        $this->product->name=$this->name;
        $this->product->price=$this->price;
        $this->product->unit=$this->unit;
        $this->product->tax_percentage=$this->tax_percentage;
        $this->product->is_active=$this->is_active;
        $this->product->save();

        $this->resetfn();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Product updated successfully'
        ]);
    }

    public function delete($id){
        $product = Products::find($id);                                                 
        $count1 = Product_2::where('name',$product->name)->get()->count();
        $count2 = Product_Purchase::where('product_name',$product->name)->get()->count();
        if(($count1>0) && ($count2>0)){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Product removed restricted!'
            ]);
        }
        else{
            $product->delete();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Product removed successfully'
            ]);
        }
    }
}
