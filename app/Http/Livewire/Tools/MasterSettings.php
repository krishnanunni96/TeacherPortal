<?php

namespace App\Http\Livewire\Tools;

use App\Models\MasterSetting;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class MasterSettings extends Component
{
    use WithFileUploads;
    public $application_name,$application_title,$app_logo,$favicon,$mobile,$email_id,$currency_symbol;
    public $tax_percentage,$payrun_period,$total_paid_leave,$country,$state,$district,$pincode,$address;
    public $master;

    public function mount(){
        $this->master=MasterSetting::first();                                     
        $this->application_name=$this->master->application_name;           
        $this->application_title=$this->master->application_title;           
        $this->app_logo=$this->master->app_logo;           
        $this->favicon=$this->master->favicon;           
        $this->mobile=$this->master->mobile;           
        $this->email_id=$this->master->email_id;           
        $this->currency_symbol=$this->master->currency_symbol;           
        $this->tax_percentage=$this->master->tax_percentage;           
        $this->payrun_period=$this->master->payrun_period;           
        $this->total_paid_leave=$this->master->total_paid_leave;           
        $this->country=$this->master->country;           
        $this->state=$this->master->state;           
        $this->district=$this->master->district;           
        $this->pincode=$this->master->pincode;           
        $this->address=$this->master->address;           
    }

    public function render()
    {
        return view('livewire.tools.master-settings');
    }

    public function update(){                       
        $this->validate([
            'application_name' => 'required',
            'application_title' => 'required',
            'app_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mobile' => 'required',
            'email_id' => 'required',
            'currency_symbol' => 'required',
            'tax_percentage' => 'required',
            'payrun_period' => 'required',
            'total_paid_leave' => 'required',
            'country' => 'required',
            'state' => 'required',
            'district' => 'required',
            'pincode' => 'required',
            'address' => 'required'
        ]);

        $this->master->application_name=$this->application_name;  
        $this->master->application_title=$this->application_title;  

        if($this->app_logo){
            $file1=$this->app_logo;
            $filename1=time().'.'.$file1->getClientOriginalExtension();
            $path='uploads/master-settings/';
            if(!file_exists($path)){
                mkdir($path,0777,true);
            }
            unlink(public_path($this->master->app_logo));
            $imageFile1=Image::make($file1->getRealPath());
            $imageFile1->save($path.$filename1);
            $this->master->app_logo=$path.$filename1;
        }

        if($this->favicon){
            $file2=$this->favicon;
            $filename2=time().'.'.$file2->getClientOriginalExtension();
            $path='uploads/master-settings/';
            if(!file_exists($path)){
                mkdir($path,0777,true);
            }
            unlink(public_path($this->master->favicon));
            $imageFile2=Image::make($file2->getRealPath());
            $imageFile2->save($path.$filename2);
            $this->master->favicon=$path.$filename2;
        }

        $this->master->mobile=$this->mobile;  
        $this->master->email_id=$this->email_id;  
        $this->master->currency_symbol=$this->currency_symbol;  
        $this->master->tax_percentage=$this->tax_percentage;  
        $this->master->payrun_period=$this->payrun_period;  
        $this->master->total_paid_leave=$this->total_paid_leave;  
        $this->master->country=$this->country;  
        $this->master->state=$this->state;  
        $this->master->district=$this->district;  
        $this->master->pincode=$this->pincode;  
        $this->master->address=$this->address;  
        $this->master->save();  

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Master settings updated successfully'
        ]);
    }
}
