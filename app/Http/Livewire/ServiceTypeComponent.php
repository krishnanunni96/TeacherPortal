<?php

namespace App\Http\Livewire;

use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ServiceType_2;
use Livewire\Component;

class ServiceTypeComponent extends Component
{
    public $type_name,$is_active,$types,$type,$search;

    public function render()
    {
        $query=ServiceType::latest();
        if($this->search!=''){
            $query->where('type_name','like','%'.$this->search.'%');
        }
        $this->types=$query->get();
        return view('livewire.service.service-type-component');
    }

    public function clear(){
        $this->resetErrorBag();
        $this->type_name=null;
        $this->is_active=1;
    }

    public function save(){     
        $this->validate([
            'type_name' => 'required|distinct'
        ]);
        $servicetype=new ServiceType();
        $servicetype->type_name=$this->type_name;
        $servicetype->is_active=$this->is_active;
        $servicetype->save();   
        $this->emit('closemodal');                            
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',
            'message' => 'Service type added successfully'
        ]);
    }

    public function edit($id){
        $this->resetErrorBag();
        $this->type=ServiceType::find($id);
        $this->type_name=$this->type->type_name;
        $this->is_active=$this->type->is_active;
    } 

    public function update(){
        $this->validate([
            'type_name' => 'required|distinct'
        ]);
        $this->type->type_name=$this->type_name;
        $this->type->is_active=$this->is_active;
        $this->type->save();
        $this->emit('closemodal');                            
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',
            'message' => 'Service type updated successfully'
        ]);
    }

    public function delete($id){           
        $servicetype=ServiceType::find($id);
        $count=ServiceType_2::where('type_name',$servicetype->type_name)->get()->count();           
        if($count){   
            ServiceType_2::where('type_name',$servicetype->type_name)->delete();

            // $servicetype_2=ServiceType_2::select('service_id')->where('type_name',$servicetype->type_name)->get();  
            //     foreach($servicetype_2 as $key => $value){          
            //         //Service::where('id',$servicetype_2[$key]->service_id)->delete();
            //         ServiceType_2::where('type_name',$servicetype->type_name)->delete();
            //     }      
        }
        $servicetype->delete();
        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',
            'message' => 'Service type removed successfully'
        ]);
    }
}