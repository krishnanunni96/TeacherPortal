<div>
  
  <div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="scrum-board-container">
                <div class="flex">
                    <div class="scrum-board pending">
                        <h5 class="text-uppercase text-secondary">Pending</h5>
                        <div class="scrum-board-column" ondrop="drop(event)" ondragover="dragover(event)" id="pending">
                          @foreach ($pending as $item)
                            <div class="{{status($item->status)}} overflow" draggable="true" ondragstart="dragstart(event)" id="{{$item->id}}">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <span class="fw-600 ms-2 text-sm text-dark">{{$item->customer->name}}</span>
                                        <div class="ms-2 mb-0">
                                            <span class="text-xs">Delivery Date:</span>
                                            <span class="text-xs fw-600 ms-2">{{dateHelper($item->date_of_delivery)}}</span>
                                        </div>
                                    </div>
                                    <div><span class="fw-600 text-dark text-sm me-2">{{$item->order_no}}</span></div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>

                    <div class="scrum-board-processing processing">
                        <h5 class="text-uppercase text-warning">Processing</h5>
                        <div class="scrum-board-column" ondrop="drop(event)" ondragover="dragover(event)" id="processing">
                          @foreach ($processing as $item)
                            <div class="{{status($item->status)}} overflow" draggable="true" ondragstart="dragstart(event)" id="{{$item->id}}">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <span class="fw-600 text-sm ms-2 text-dark">{{$item->customer->name}}</span>
                                        <div class="ms-2 mb-0">
                                            <span class="text-xs">Delivery Date:</span>
                                            <span class="text-xs fw-600 ms-2">{{dateHelper($item->date_of_delivery)}}</span>
                                        </div>
                                    </div>
                                    <div><span class="fw-600 text-sm text-dark me-2">{{$item->order_no}}</span></div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>

                    <div class="scrum-board ready">
                        <h5 class="text-uppercase text-success">Ready to Deliver</h5>
                        <div class="scrum-board-column" ondrop="drop(event)" ondragover="dragover(event)" id="ready">
                          @foreach ($ready_to_deliver as $item)
                            <div class="{{status($item->status)}} overflow" draggable="true" ondragstart="dragstart(event)" id="{{$item->id}}">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <span class="fw-600 ms-2 text-sm text-dark">{{$item->customer->name}}</span>
                                        <div class="ms-2 mb-0">
                                            <span class="text-xs">Delivery Date:</span>
                                            <span class="text-xs fw-600 ms-2">{{dateHelper($item->date_of_delivery)}}</span>
                                        </div>
                                    </div>
                                    <div><span class="fw-600 text-sm text-dark me-2">{{$item->order_no}}</span></div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  <script>
    function dragover(ev) {
        ev.preventDefault();
        ev.dataTransfer.dropEffect = "move";
    }

    function dragLeave(e) {}

    function dragstart(ev) {
        ev.dataTransfer.setData("text/plain", ev.target.id);
        ev.dataTransfer.effectAllowed = "move";
    }

    function drop(ev) {                             
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.closest('.scrum-board-column').appendChild(document.getElementById(data));
        @this.statusChange(data, ev.target.id);
    }
  </script>

</div>