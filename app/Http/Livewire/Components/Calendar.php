<?php

namespace App\Http\Livewire\Components;

use Carbon\Carbon;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;
use App\Models\EventCalendar;

class Calendar extends LivewireCalendar
{

    public function events(): Collection
    {
        
        return EventCalendar::query()
            ->whereDate('date', '>=', $this->gridStartsAt)
            ->whereDate('date', '<=', $this->gridEndsAt)
            ->get()
            ->map(function (EventCalendar $event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'date' => $event->date,
                ];
            });
    }

    public function unscheduledEvents() : Collection
    {
        return EventCalendar::query()
            ->whereNull('date')
            ->get();
    }

    public function onDayClick($year, $month, $day)
    {
        $date=$day.'-'.$month.'-'.$year;
        $date=Carbon::parse($date)->format('Y-m-d');
        $this->emit('saveDate',$date);
        $this->events();
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        $date=$day.'-'.$month.'-'.$year;
        $date=Carbon::parse($date)->format('Y-m-d');
        $this->emit('changeEvent',$date,$eventId);
        $this->events();
    }

    

    public function onEventClick($eventId)
    {
        if($eventId)
        {
            $this->emit('eventId',$eventId);

        }
        $this->events();
       
    }

    public function unscheduleAppointment()
    {
       
        $this->selectedAppointment = null;
    }

    public function closeAppointmentDetailsModal()
    {
        $this->selectedAppointment = null;
    }

    public function deleteEvent($eventId)
    {
        
    }

    public function render()
    {
        return parent::render()->with([
            'unscheduledEvents' => $this->unscheduledEvents()
        ]);
        $unscheduledEvents=EventCalendar::whereNull('date')->get();
    }

}
