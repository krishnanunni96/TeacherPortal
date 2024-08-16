    <div>

        <div class="container">

            <br />

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered align-items-center mb-0" style="border-color:dark;">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 17%" class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                                <th style="width: 18%" class="text-uppercase text-secondary text-xs opacity-7">Name</th>
                                <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Subject
                                </th>
                                <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Mark</th>
                                <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Batch
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($customers as $data)
                                <tr>
                                    <td style="width: 10%">
                                        <p class="text-xs px-3  mb-0">{{ dateHelper2($data->created_at) }}</p>
                                    </td>
                                    <td style="width: 25%">
                                        <p class="text-xs px-3 mb-0">
                                            <span class="font-weight-bold">{{ $data->name }}</span>
                                        </p>
                                    </td>
                                    <td style="width: 25%">
                                        <p class="text-xs px-3 font-weight-bold mb-0">{{ $data->subject }}</p>
                                    </td>
                                    <td style="width: 20%">
                                        <p class="text-xs px-3 font-weight-bold mb-0">{{ $data->mark }}</p>
                                    <td style="width: 20%">
                                        <p class="text-xs px-3 text-uppercase mb-0">{{ $data->batch }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
