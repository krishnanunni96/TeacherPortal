<?php

namespace App\Http\Livewire;

use App\Models\OrderAddon;
use App\Models\OrderAddons_2;
use Livewire\Component;

class OrderAddonsComponent extends Component
{
    public $addon_name, $addon_price, $search, $is_active, $order_addons, $order_addon;

    public function render()
    {
        $query = OrderAddon::latest();
        if ($this->search != '') {
            $query->where('addon_name', 'like', '%' . $this->search . '%');
        }
        $this->order_addons = $query->get();
        return view('livewire.service.order-addons-component');
    }

    public function resetFn()
    {
        $this->resetErrorBag();
        $this->addon_name = '';
        $this->addon_price = '';
    }

    public function mount()
    {
        $this->is_active = 1;
    }

    public function save()
    {
        $this->validate([
            'addon_name' => 'required|string',
            'addon_price' => 'required|numeric',
        ]);

        $order_addon = new OrderAddon();
        $order_addon->addon_name = $this->addon_name;
        $order_addon->addon_price = $this->addon_price;
        $order_addon->is_active = $this->is_active;
        $order_addon->save();
        $this->resetFn();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Addon saved successfully'
        ]);
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $this->order_addon = OrderAddon::find($id);
        $this->addon_name = $this->order_addon->addon_name;
        $this->addon_price = $this->order_addon->addon_price;
        $this->is_active = $this->order_addon->is_active;
    }

    public function update()
    {
        $this->order_addon->addon_name = $this->addon_name;
        $this->order_addon->addon_price = $this->addon_price;
        $this->order_addon->is_active = $this->is_active;
        $this->order_addon->save();
        $this->resetFn();
        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Addon updated successfully'
        ]);
    }

    public function delete($id)
    {
        $count = OrderAddons_2::where('addon_id',$id)->get()->count();
        if($count>0){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Addon removal restricted'
            ]);
        }
        else{
            OrderAddon::find($id)->delete();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Addon removed successfully'
            ]);
        }
    }
}
