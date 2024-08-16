<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Livewire\Component;

class ExpenseCategories extends Component
{
    public $name,$type,$category,$categories,$search;
    protected $listeners = ['remove'];

    public function render()
    {
        $query=ExpenseCategory::latest();
        if($this->search!=''){
            $query->where('name','like','%'.$this->search.'%');
        }
        $this->categories = $query->get();
        return view('livewire.expense.expense-categories');
    }

    public function save()
    {
        $data=$this->validate([
            'name'=>'required',
            'type'=>'required',
        ]);

        ExpenseCategory::create($data);
        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Category Created Successfully!']);

    }

    public function resetInput(){
        $this->name=null;
        $this->type=1;
        $this->resetErrorBag();
    }

    public function edit($id){
        $this->resetErrorBag();
        $this->category=ExpenseCategory::find($id);
        $this->name=$this->category->name;
        $this->type=$this->category->type;

    }

    public function update(){
        $this->validate([
            'name'=>'required',
            'type'=>'required',
        ]);
        $this->category->name = $this->name;
        $this->category->type = $this->type;
        $this->category->save();
        $this->emit('closemodal');

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'category updated Successfully!']);
    }

    public function alertConfirm($id)
    {   
        $this->category=ExpenseCategory::find($id);
        $count=Expense::where('category_id',$id)->get()->count();
        if($count>0){
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Category removal restricted!'
            ]);
        }
        else{
            $this->dispatchBrowserEvent('swal:confirm', [
                    'type' => 'warning',  
                    'message' => 'Are you sure you want to delete category: '.$this->category->name.' ?', 
                ]);
        }

    }

    public function remove()
    {
        if($this->category){
            $this->category->delete();
            $this->category->null;
        }
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Category removed Successfully!', 
                'text' => 'It will not list on users table soon.'
            ]);
    }

    public function toggleStatus($id){
        $category= ExpenseCategory::find($id);
        if($category->is_active==1){
            $category->is_active=0;
        }else{
            $category->is_active=1;
        }
        $category->save();
    }

}