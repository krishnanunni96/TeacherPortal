<?php

namespace App\Http\Livewire;

use App\Models\OrderDetails;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ServiceType_2;
use Livewire\Component;

class ServiceEditComponent extends Component
{
    public $servicename, $servicetype, $servicetypes, $price = [], $var = [], $counter = 0, $type_name = [], $name, $arr = [];

    public function render()
    {
        return view('livewire.service.service-edit-component');
    }

    public function mount($id)
    {                                                                                   
        $this->servicetypes = ServiceType::all();
        $this->servicename = Service::find($id);
        $this->name = $this->servicename->name;
        $this->icon = $this->servicename->icon;
        $this->is_active = $this->servicename->is_active;
        $this->servicetype = ServiceType_2::where('service_id', $id)->get();
        foreach ($this->servicetype as $key => $data) {
            $this->var[$key] = $data->type_name;
            $this->type_name[$key] = $data->type_name;
            $this->price[$key] = $data->price;
            $this->counter = $key;
        }
        return view('livewire.service.service-edit-component');
    }

    public function add()
    {                                                                   
        $this->counter++;                                                   
        array_push($this->var, $this->counter);
        $this->type_name[$this->counter] = null;
        $this->price[$this->counter] = null;
    }

    public function remove($counter)        
    {                                                                       
        unset($this->var[$counter]);
        unset($this->type_name[$counter]);
        unset($this->price[$counter]);
        return $counter--;
    }

    public function update()
    {                                                           
        $this->validate([
            'price.*' => 'required|numeric',
            'name' => 'required|distinct'
        ]);

        $servicetype2 = ServiceType_2::where('service_id', $this->servicename->id)->get();
        foreach($servicetype2 as $value) {
            $orderdetails = OrderDetails::where('type_id', $value->id)->get();
        }
        if($orderdetails){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Service type cannot be removed'
            ]);
        }
        else{
            ServiceType_2::where('service_id', $this->servicename->id)->delete();

            $this->servicename->name = $this->name;
            $this->servicename->icon = $this->icon;
            $this->servicename->is_active = $this->is_active;
            $this->servicename->save();
            foreach ($this->var as $key => $value) {
                $type = new ServiceType_2();
                $type->type_name = $this->type_name[$key];
                $type->price = $this->price[$key];
                $type->service_id = $this->servicename->id;
                $type->save();
            }
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Service updated successfully'
            ]);
            return redirect('service');
        }

    }
}
