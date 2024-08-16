<div>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">Calendar Events </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body  p-3 mb-1 mt-2">
                    <div class="row g-3 align-items-center" wire:poll.alive>
                        <livewire:components.calendar before-calendar-view="before_calender" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade " id="addevent" tabindex="-1" role="dialog" aria-labelledby="addevent"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600" id="addevent">Add Event</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='saveEvent'>
                    <div class="modal-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="date" wire:model='date' class="form-control" placeholder="Enter Addon Name">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Event Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model='title' class="form-control" placeholder="Enter Event Name">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description </label>
                                <textarea class="form-control" wire:model='description'></textarea>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if($edit && $event->id)
    <div wire:ignore.self class="modal fade" id="editevent" tabindex="-1" role="dialog" aria-labelledby="editevent"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600" id="editevent">Edit Event</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='editEvent'>
                    <div class="modal-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="date" wire:model='date' class="form-control"
                                    placeholder="Enter Addon Name">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Event Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model='title' class="form-control" placeholder="Enter Event Name">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description </label>
                                <textarea class="form-control" wire:model='description'></textarea>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" wire:click='deleteEvent()' class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @push('scripts')
    @livewireCalendarScripts    
        <script>
            "use strict";
            Livewire.on('addevent', () => {
                $('#addevent').modal('show');
            })
            "use strict";
            Livewire.on('editevent', () => {
                $('#editevent').modal('show');
            })
        </script>
    @endpush
</div>
