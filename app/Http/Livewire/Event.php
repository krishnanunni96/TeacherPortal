<?php

namespace App\Http\Livewire;

use App\Models\EventCalendar;
use Livewire\Component;

class Event extends Component
{
    public $title,$description,$date,$edit=false;
    protected $listeners=[
        'saveDate',
        'changeEvent',
        'eventId'
    ];

    public function render()
    {
        return view('livewire.event');
    }

    public function eventId($id)
    {
        $this->edit=true;
        $this->event=EventCalendar::find($id);
        $this->date=$this->event->date;
        $this->title=$this->event->title;
        $this->description=$this->event->description;
        $this->emit('editevent');
    }
    public function changeEvent($date,$id)
    {
        $event=EventCalendar::find($id);
        $event->date=$date;
        $event->save();
    }
    public function saveDate($date)
    {
        $this->event=null;
        $this->edit=false;
        $this->resetInput($date);
        $this->emit('addevent');
        $this->date=$date;
    }

    public function saveEvent()
    {
        $this->validate([
            'title'=>'required',
        ]);
        $event=new EventCalendar();
        $event->date=$this->date;
        $event->title=$this->title;
        $event->description=$this->description;
        $event->save();
        $this->emit('closemodal');

    }
    public function editEvent()
    {
        $this->validate([
            'title'=>'required',
        ]);
        $this->event->date=$this->date;
        $this->event->title=$this->title;
        $this->event->description=$this->description;
        $this->event->save();
        $this->emit('closemodal');
        $this->edit=false;
    }
    public function deleteEvent()
    {
        $this->event->delete();
        $this->emit('closemodal');

    }
    private function resetInput($date)
    {
        $this->date=$date;
        $this->title=null;
        $this->description=null;
    }
}
