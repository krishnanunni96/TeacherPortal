<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseDetails;
use Carbon\Carbon;
// use Livewire\WithPagination;
use Livewire\Component;

class Expenses extends Component
{
    // use WithPagination;
    public $date, $category_id, $amount, $payment_mode, $tax_included, $tax_percentage, $expense, $categories,$edit_category=[];
    public $search = '', $search_category = null, $expense_details, $expense_edit, $expense_detail, $expenses;
    protected $listeners = ['remove'];
    // protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Expense::latest();
        if ($this->search_category) {
            $query->where('category_id', $this->search_category);
        }
        if ($this->search != '') {
            $query->where('amount', 'like', $this->search . '%');
        }
        $this->expense_details = ExpenseDetails::all();
        $this->expenses = $query->get();
        return view('livewire.expense.expenses');
    }

    public function mount()
    {
        $this->date = Carbon::today()->toDateString();
        $this->tax_percentage = null;
        $this->categories = ExpenseCategory::all();
    }
    
    public function save()
    {
        $this->validate([
            'date' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $expense = new Expense();
        $expense->date = $this->date;
        $expense->amount = $this->amount;
        // $expense->category_id = $this->category_id;
        $expense->payment_mode = $this->payment_mode;
        $expense->tax_included = $this->tax_included;
        if ($this->tax_included == 0) {
            $expense->tax_percentage = 0;
        } else {
            $this->validate(['tax_percentage' => 'required|numeric']);
            $expense->tax_percentage = $this->tax_percentage;
        }
        $expense->save();

        foreach($this->category_id as $data){                             
            $expense_details = new ExpenseDetails();
            $expense_details->expense_id = $expense->id;
            $expense_details->category_id = $data;
            $expense_details->save();
        }
        $this->emit('closemodal');
        $this->resetInput();
        $this->dispatchBrowserEvent('alert', [
                'type' => 'success',  
                'message' => 'Expense Created Successfully!'
            ]);
    }

    public function resetInput()
    {
        $this->date = Carbon::today()->toDateString();
        $this->amount = null;
        $this->tax_included = null;
        $this->tax_percentage = null;
        $this->category_id = null;
        $this->payment_mode = 1;
        $this->resetErrorBag();
    }

    public function edit($id)
    {
        $this->edit_category=[];
        $this->resetErrorBag();
        $this->expense = Expense::find($id);
        $this->date = $this->expense->date;
        $this->amount = $this->expense->amount;
        $this->tax_included = $this->expense->tax_included;
        $this->tax_percentage = $this->expense->tax_percentage;
        $this->payment_mode = $this->expense->payment_mode;

        $this->expense_edit = ExpenseDetails::where('expense_id',$id)->get();
        foreach($this->expense_edit as $data){
            $this->edit_category[] = $data->category_id;                                        
        }                                                                      
        $this->emit('edit_category',$this->edit_category);                                          
    }

    public function update()
    {                                                                               
        $this->validate([
            'date' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $this->expense->date = $this->date;
        $this->expense->amount = $this->amount;
        // $this->expense->category_id = $this->category_id;
        $this->expense->payment_mode = $this->payment_mode;
        $this->expense->tax_included = $this->tax_included;
        if ($this->tax_included == 0) {
            $this->expense->tax_percentage = 0;
        } else {
            $this->validate(['tax_percentage' => 'required|numeric']);
            $this->expense->tax_percentage = $this->tax_percentage;
        }
        $this->expense->save();

        $del = ExpenseDetails::where('expense_id', $this->expense->id)->get();             
        if(count($del)){
            ExpenseDetails::where('expense_id', $this->expense->id)->delete();
        }

        foreach($this->category_id as $data){                             
            $expense_details = new ExpenseDetails();
            $expense_details->expense_id = $this->expense->id;
            $expense_details->category_id = $data;
            $expense_details->save();
        }

        $this->emit('closemodal');
        $this->resetInput();
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Expense updated Successfully!']
        );
    }

    public function alertConfirm($id)
    {
        $this->expense = Expense::find($id);
        $this->expense_detail = ExpenseDetails::where('expense_id',$id)->get();
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Are you sure you want to delete..?',
        ]);
    }

    public function remove()
    {
        if ($this->expense) {
            $this->expense->delete();
            $this->expense_detail->delete();
            $this->expense->null;
        }
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Expense removed Successfully!'
        ]);
    }

}
