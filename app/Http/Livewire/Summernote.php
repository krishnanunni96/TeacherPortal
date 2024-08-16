<?php

namespace App\Http\Livewire;

use App\Models\PrivacyPolicy;
use Livewire\Component;

class Summernote extends Component
{
    public $is_active,$policy_note,$policy,$counter,$policy_id;

    public function render()
    {
        return view('livewire.summernote');
    }

    public function mount(){
        $policy = PrivacyPolicy::find(5);  
        $this->policy_id = $policy->id;
        $this->policy_note = $policy->policy_note;
        $this->is_active = $policy->is_active;
    }

    public function save(){ 

        $this->policy = PrivacyPolicy::updateOrCreate(
            ['id' => $this->policy_id], 
            ['policy_note' =>$this->policy_note]);
            
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Policy updated Successfully!']);
    }



    public function toggleStatus($id){
        $policy= PrivacyPolicy::find($id);
        if($policy->is_active==1){
            $policy->is_active=0;
        }else{
            $policy->is_active=1;
        }
        $policy->save();
    }
}
