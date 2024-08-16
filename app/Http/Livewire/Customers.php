<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\Customer;
use Livewire\Component;
use Intervention\Image\Facades\Image;

class Customers extends Component
{
    use WithFileUploads;
    public $name, $mark, $email, $address, $batch, $subject, $avatar, $is_active, $mobile, $customers, $customer, $search;
    protected $listeners = ['remove'];

    public function render()
    {
        $query = Customer::latest();
        if ($this->search != '') {
            $query->where('name', 'like', '%' . $this->search . '%');
            $query->orWhere('batch', 'like', '%' . $this->search . '%');
        }
        $this->customers = $query->get();
        return view('livewire.customers');
    }

    public function save()
    {
        // Validate input
        $this->validate([
            'name' => 'required|min:4',
            'mark' => 'required|numeric',
            'subject' => 'required',
            'batch' => 'required',
        ]);

        // Check if a customer with the same name, subject, and batch exists
        $customer = Customer::where('name', $this->name)
            ->where('subject', $this->subject)
            ->where('batch', $this->batch)
            ->first();

        // If a customer record is found, update it
        if ($customer) {
            $customer->mark = $this->mark;
            $customer->mobile = $this->mobile;
            $customer->subject = $this->subject;
            $customer->batch = $this->batch;
            $customer->email = $this->email;
            $customer->address = $this->address;
            $customer->is_active = $this->is_active;

            // Handle avatar upload
            if ($this->avatar) {
                $file = $this->avatar;
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/customer/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $imagefile = Image::make($file->getRealPath());
                $imagefile->save($path . $filename);

                // Remove old avatar if it exists
                if (file_exists(public_path($customer->avatar)) && $customer->avatar) {
                    unlink(public_path($customer->avatar));
                }

                $customer->avatar = $path . $filename;
            }

            $customer->save();

            // Notify the user and close the modal
            $this->emit('closemodal');
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success', 'message' => 'Student updated successfully!']
            );
        } else {
            // Create a new customer record if no existing record is found
            $customer = new Customer();
            $customer->name = $this->name;
            $customer->mark = $this->mark;
            $customer->mobile = $this->mobile;
            $customer->subject = $this->subject;
            $customer->batch = $this->batch;
            $customer->email = $this->email;
            $customer->address = $this->address;
            $customer->is_active = $this->is_active;

            // Handle avatar upload
            if ($this->avatar) {
                $file = $this->avatar;
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/customer/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $imagefile = Image::make($file->getRealPath());
                $imagefile->save($path . $filename);
                $customer->avatar = $path . $filename;
            }

            $customer->save();

            // Notify the user and close the modal
            $this->emit('notify', $customer);
            $this->emit('closemodal');
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success', 'message' => 'Student added successfully!']
            );
        }
    }

    public function toggleStatus($id)
    {
        $customer = Customer::find($id);
        if ($customer->is_active == 1) {
            $customer->is_active = 0;
        } else {
            $customer->is_active = 1;
        }
        $customer->save();
    }

    public function resetInput()
    {
        $this->name = null;
        $this->mobile = null;
        $this->email = null;
        $this->subject = null;
        $this->mark = null;
        $this->batch = null;
        $this->address = null;
        $this->avatar = null;
        $this->is_active = 1;
        $this->resetErrorBag();
    }

    public function view($id)
    {
        $this->resetErrorBag();
        $this->customer = Customer::find($id);
        $this->name = $this->customer->name;
        $this->mobile = $this->customer->mobile;
        $this->email = $this->customer->email;
        $this->subject = $this->customer->subject;
        $this->mark = $this->customer->mark;
        $this->batch = $this->customer->batch;
        $this->address = $this->customer->address;
        $this->is_active = $this->customer->is_active;
        $this->avatar = $this->customer->avatar;
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $this->customer = Customer::find($id);
        $this->name = $this->customer->name;
        $this->mobile = $this->customer->mobile;
        $this->email = $this->customer->email;
        $this->subject = $this->customer->subject;
        $this->mark = $this->customer->mark;
        $this->batch = $this->customer->batch;
        $this->address = $this->customer->address;
        $this->avatar = $this->customer->avatar;
        $this->is_active = $this->customer->is_active;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:4',
            'mark' => 'required|numeric',
            'subject' => 'required',
            'batch' => 'required',
        ]);

        $this->customer->name = $this->name;
        $this->customer->mark = $this->mark;
        $this->customer->mobile = $this->mobile;
        $this->customer->subject = $this->subject;
        $this->customer->batch = $this->batch;
        $this->customer->email = $this->email;
        $this->customer->address = $this->address;
        $this->customer->is_active = $this->is_active;
        if ($this->avatar) {
            $file = $this->avatar;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/customer/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $imagefile = Image::make($file->getRealPath());
            $imagefile->save($path . $filename);
            if ($this->avatar && file_exists(public_path($this->customer->avatar)) && $this->customer->avatar) {
                unlink(public_path($this->customer->avatar));
            }
            $this->customer->avatar = $path . $filename;
        }
        $this->customer->save();

        $this->emit('closemodal');
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Student updated Successfully!']
        );
    }

    public function alertConfirm($id)
    {
        $this->customer = Customer::find($id);
        $count = Customer::find($id)->get()->count();
        if ($count > 0) {
            $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'message' => 'Are you sure you want to delete student ' . $this->customer->name . ' ?',
            ]);
        }
    }

    public function remove()
    {
        if ($this->customer) {
            $this->customer->delete();
            $this->customer->null;
        }
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Student removed successfully!',
            'text' => 'It will not list on users table soon.'
        ]);
    }
}
