<div>

    <style>
    .icon_menu {
        display: block;
        height: 10px;
        margin: auto;
        position: relative;
        width: 16px;
    }

	.icon_menu__solid, &:before, &:after {
		background: #fff;
		display: block;
		height: 2px;
	}
	
	.icon_menu__solid {
		position: relative;
		top: 50%;
		transform: translateY(-50%);
	}
    &:before, &:after {
		content: "";
		left: 0;
		position: absolute;
		right: 0;
	}

	&:before {
		top: 0;
	}

	&:after {
		bottom: 0;
	}

   </style>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Search Here" wire:model="search">
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table wire:poll class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Customer Name</th>
                                    <th class="text-uppercase text-secondary text-xs  opacity-7">Contact</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7 ps-2">Address</th>
                                </tr>
                            </thead>
                            <tbody id="container">
                                @foreach ($customers as $data)
                                    <tr>
                                        <input type="hidden" value="{{$data->id}}" id="cust_id">
                                        <input type="hidden" value="{{$loop->index}}" id="index">
                                        <td>
                                            <p class="text-sm mb-0">
                                            @if (($data->avatar) && file_exists(public_path($data->avatar)))
                                                <img src="{{asset($data->avatar)}}" height="50" width="50" style="border-radius: 50%;">
                                            @else
                                                <img src="{{asset('assets/img/xfortech.png')}}" class="bg-dark" height="50" width="50" style="border-radius: 50%;">
                                            @endif
                                            <span style="padding-left:10px;">{{$data->name}}</span></p>
                                        </td>
                                        <td>
                                            <p class="text-sm px-3 mb-0">{{$data->mobile}}</p>
                                            <p class="text-sm px-3 mb-0">{{$data->email}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm mb-0">{{Str::limit($data->address,15)}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('assets/dragula/dragula.min.js') }}"></script>
    <script>
        "use strict";
        var drake = dragula([document.querySelector('#container')]);
        drake.on("drop", function(el,target, source, sibliing){
            console.log(el);
            // @this.sort(el.id, 1);
        });    
    </script>
    <script>
        var container = document.getElementById('container');
        var rows = container.children;
        var nodeListForEach = function(array, callback, scope){
            for(var i = 0; i < array.length; i++){
                callback.call(scope, i, array[i])
            }
        };
    </script>
        {{-- <script>
            var container = document.getElementById('container');               
            var rows = container.children;
                                                                                        
            var nodeListForEach = function(array, callback, scope) {
                for (var i = 0; i < array.length; i++) {
                    callback.call(scope, i, array[i]);
                }                                                                           
            };

            var sortableTable = dragula([document.querySelector('#container')]);                  

            sortableTable.on('dragend', function() {
                nodeListForEach(rows, function(index, row) {
                    row.lastElementChild.textContent = index + 1;                      
                    var el = row.dataset.rowPosition = index + 1;                                       
                });
            });
        </script> --}}
    @endpush

</div>
