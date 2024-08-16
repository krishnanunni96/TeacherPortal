<?php

namespace App\Http\Livewire;
use App\Models\FileUpload;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploadComponent extends Component
{
    use WithFileUploads;
    public $title,$imagename,$images,$image;

    public function render()
    {
        $this->images=FileUpload::all();
        return view('livewire.file-upload-component');
    }

    public function resetInput(){
        $this->resetErrorBag();
        $this->title=null;
        $this->imagename='';
    }

    public function save(){ 
        $data=$this->validate([
            'title' => 'required|min:4',
            'imagename' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            if($this->imagename){   
                if(!file_exists('uploads')){
                    mkdir('uploads',007,true);
                }
                $data['imagename'] = $this->imagename->store('uploads', 'public');
            }

        FileUpload::create($data);
        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'File details added Successfully!']);
    }

    public function delete($id){
        FileUpload::find($id)->delete();
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'File details removed Successfully!']);
    }
}
