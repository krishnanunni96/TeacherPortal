<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Expense Report</title>
        <style type="text/css">
table { 
	width: 700px; 
	border-collapse: collapse; 
	margin:50px auto;
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #4c4fa2; 
	color: white; 
	font-weight: bold; 
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 18px;
	}

        </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
<body>

<div class="container">

	<br/>
    
    <div class="card mb-4">
        <div class="card-header p-4">
            <div class="row">
                <div class="col-md-4">
                    <label>Tax Report of @if($filter==1) Sales @elseif($filter==2) Expense @else Purchase @endif</label>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%" class="text-uppercase text-secondary text-xs opacity-7">#</th>
                            <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                            <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Particulars #</th>
                            <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Before Tax</th>
                            <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Tax Amount</th>
                            <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $data)
                        <tr>
                            <td style="width: 5%" >
                                <p class="text-xs px-3  mb-0">{{$loop->index+1}}</p>
                            </td>
                            <td style="width: 15%" >
                                @if($filter==1)
                                <p class="text-xs px-3  mb-0">{{$data->date_of_order}}</p>
                                @elseif($filter==3)
                                <p class="text-xs px-3  mb-0">{{$data->purchase_date}}</p>
                                @else
                                <p class="text-xs px-3  mb-0">{{$data->date}}</p>
                                @endif
                            </td>
                            <td style="width: 20%" >
                                <p class="text-xs px-3 mb-0">
                                    @if($filter==1)
                                    <span class="font-weight-bold">{{$data->order_no}}</span>
                                    @elseif($filter==3)
                                    <span class="font-weight-bold">{{$data->purchase_no}}</span>
                                    @else
                                    <span class="font-weight-bold">{{$data->id}}</span>
                                    @endif
                                </p>
                            </td>
                            <td style="width: 20%" >
                                <p class="text-xs px-3 font-weight-bold mb-0">${{$data->sub_total}}</p>
                                @if($filter==2)
                                <p class="text-xs px-3 font-weight-bold mb-0"></p>
                                @endif
                            </td>
                            <td style="width: 20%" >
                                @if($filter==1)
                                <p class="text-xs px-3 font-weight-bold mb-0">${{$data->tax_amount}}</p>
                                @elseif($filter==3)
                                <p class="text-xs px-3 font-weight-bold mb-0">${{$data->tax_total}}</p>
                                @else
                                    @if($data->tax_included==0)
                                    <p class="text-xs px-3 font-weight-bold mb-0">${{$data->tax_total}}</p>
                                    @else
                                    -
                                    @endif
                                @endif
                            </td>
                            <td style="width: 20%" >
                                @if($filter==1)
                                <p class="text-xs px-3 font-weight-bold mb-0">${{$data->order_amount}}</p>
                                @elseif($filter==3)
                                <p class="text-xs px-3 font-weight-bold mb-0">${{$data->gross_total}}</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        
        </div>

    </body>
</html>