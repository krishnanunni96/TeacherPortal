<?php

namespace App\Http\Livewire;

use App\Models\Service;
use App\Models\ServiceType_2;
use Livewire\Component;

class ServiceComponent extends Component
{
    public $name,$icon,$is_active,$search,$services;

    public function render()
    {
        $query=Service::latest();
        if($this->search!=''){
            $query->where('name','like','%'.$this->search.'%');
        }
        $this->services=$query->get();
        $servicetypes=ServiceType_2::all();
        return view('livewire.service.service-component',compact('servicetypes'));
    }

    public function delete($id){
        $var = Service::find($id)->delete();
        if ($var) {
            ServiceType_2::where('service_id', $id)->delete();
        }
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Service removed successfully'
        ]);
    }
}
