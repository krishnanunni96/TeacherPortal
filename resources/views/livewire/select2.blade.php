<div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1>Livewire Select2</h1>
                    <strong>Selected Cities: 
                        @foreach ($selCity as $value)
                            {{$value}}
                        @endforeach</strong>
                </div>
                <div class="card-body">
                    <div wire:ignore>
                        <select class="form-control" id="select2">
                            <option value="">-- Select City --</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#select2').select2();
                $('#select2').on('change', function(e) {
                    var data = $('#select2').select2("val");                        
                    @this.selectedCity(data);
                });
            });
        </script>
    @endpush

</div>
