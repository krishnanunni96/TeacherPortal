<?php

namespace App\Http\Livewire;

use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ServiceType_2;
use Livewire\Component;

class ServiceAddComponent extends Component
{
    public $var = [], $counter = 0, $type_name = [], $price = [], $servicetypes, $name, $icon, $is_active;

    public function render()
    {
        return view('livewire.service.service-add-component');
    }

    public function mount()
    {
        $this->servicetypes = ServiceType::all();
        $this->is_active = 1;
    }

    public function add()
    {
        array_push($this->var, $this->counter);
        $this->type_name[$this->counter] = null;
        $this->price[$this->counter] = null;
        $this->counter++;
    }

    public function remove($counter)
    {
        unset($this->var[$counter]);
        unset($this->type_name[$counter]);
        unset($this->price[$counter]);
        return $counter--;
    }

    public function save()
    {                                                                       
        $this->validate([
            'price.*' => 'required|numeric',
            'name' => 'required|distinct',
        ]);

            if($this->type_name==[]){
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'error',
                    'message' => 'Service type required'
                ]);
            }
            else{
                $service = new Service();
                $service->name = $this->name;
                $service->icon = $this->icon;
                $service->is_active = $this->is_active;
                $service->save();
        
                $this->type_name[0] = ServiceType::select('type_name')->orderBy('id','asc')->first()->value('type_name');
        
                foreach ($this->var as $key => $value) {
                    $type = new ServiceType_2();
                    $type->type_name = $this->type_name[$key];                  
                    $type->price = $this->price[$key];
                    $type->service_id = $service->id;
                    $type->save();
                }
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'success',
                    'message' => 'Service added successfully'
                ]);
                return redirect('service');
            }

    }
}
