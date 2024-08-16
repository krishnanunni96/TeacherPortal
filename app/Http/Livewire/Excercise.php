<?php

namespace App\Http\Livewire;
use App\Models\Test;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Excercise extends Component
{
    use WithFileUploads;
    public $name,$email,$phone,$is_active,$avatar,$address,$tests,$test,$search;

    public function render()
    {
        $query=Test::latest();
        if($this->search!=''){
            $query->where('name','like','%'.$this->search.'%');
            $query->orWhere('phone','like','%'.$this->search.'%');
        }
        $this->tests=$query->get();
        return view('livewire.excercise');
    }

    public function mount(){
        $this->is_active=1;
    }
    public function toggleStatus($id){
        $test=Test::find($id);
        if($test->is_active==1){
            $test->is_active=0;   
        }else{
            $test->is_active=1;
        }
        $test->save();
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Status bit updated successfully!']);
    }

    public function save(){
        $this->validate([
            'name'=>'required|min:4',
            'phone'=>'required|numeric',
        ]);
        $test=new Test();
        $test->name=$this->name;
        $test->phone=$this->phone;
        $test->email=$this->email;
        $test->is_active=$this->is_active;

        if($this->avatar){   
         $file=$this->avatar;
            $filename=time().'.'.$file->getClientOriginalExtension();
            $path='uploads/user/';
            if(!file_exists($path)){
                mkdir($path,0777,true);
            }
             $imageFile=Image::make($this->avatar->getRealPath());
             $imageFile->save($path.$filename);
            
            $test->avatar=$path.$filename;
        }
        $test->address=$this->address;
        $test->save();

        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'User created successfully!']);
    }

    public function resetInput(){
        $this->name=null;
        $this->phone=null;
        $this->email=null;
        $this->avatar=null;
        $this->address=null;
        $this->resetErrorBag();
    }

    public function edit($id){
        $this->test=Test::find($id);
        $this->name=$this->test->name;
        $this->phone=$this->test->phone;
        $this->email=$this->test->email;
        $this->is_active=$this->test->is_active;
        $this->avatar=$this->test->avatar;
        $this->address=$this->test->address;
    }

    public function update(){
        $this->validate([
            'name'=>'required|min:4',
            'phone'=>'required|numeric',
        ]);

        $this->test->name=$this->name;
        $this->test->phone=$this->phone;
        $this->test->email=$this->email;
        $this->test->is_active=$this->is_active;
        if($this->avatar){   
            $file=$this->avatar;
               $filename=time().'.'.$file->getClientOriginalExtension();
               $path='uploads/user/';
               if(!file_exists($path)){
                   mkdir($path,0777,true);
               }
                $imageFile=Image::make($this->avatar->getRealPath());
                $imageFile->save($path.$filename);
               
               $this->test->avatar=$path.$filename;
           }
        $this->test->address=$this->address;
        $this->test->save();

        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'User updated successfully!']);
    }

    public function delete($id){
        $test=Test::find($id);
        unlink(public_path($test->avatar));
        $test->delete();
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'User removed successfully!']);
    }
}