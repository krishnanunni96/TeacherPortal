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
                <div class="col-md-12">
                    <label>Stock Report</label>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%" class="text-uppercase text-secondary text-xs opacity-7">#</th>
                            <th style="width: 30%" class="text-uppercase text-secondary text-xs opacity-7">Product</th>
                            <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Purchased Stock</th>
                            <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Stock Entries</th>
                            <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">In-Stock QTY</th>
                            <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Stock Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products_2 as $key=>$data)
                        <tr>
                            <td style="width: 5%" >
                                <p class="text-xs px-3  mb-0">{{$loop->index+1}}</p>
                            </td>
                            <td style="width: 30%" >
                                <p class="text-xs px-3 mb-0">
                                    <span class="font-weight-bold">{{$data->name}}</span>
                                </p>
                            </td>
                            
                            <td style="width: 20%" >
                                <p class="text-xs px-3 mb-0">
                                    <span class="font-weight-bold">
                                        @foreach ($products as $value)
                                            @if($data->name==$value->name)
                                                {{$value->unit}}
                                            @endif
                                        @endforeach
                                        </span>
                                    <span class="ms-1">Unit</span>
                                </p>
                            </td>
                            <td style="width: 15%" >
                                <p class="text-xs px-3 mb-0">
                                    <span class="font-weight-bold">{{$data->quantity}}</span>
                                    <span class="ms-1">Unit</span>
                                </p>
                            </td>
                            <td style="width: 15%" >
                                <p class="text-xs px-3 mb-0">
                                    <span class="font-weight-bold">        
                                        @foreach ($products as $value)                                        
                                            @if($data->name==$value->name)
                                                {{$value->unit-$data->quantity}}
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="ms-1">Unit</span>
                                </p>
                            </td>
                            <td style="width: 15%" >
                                <p class="text-xs px-3 font-weight-bold mb-0">$
                                    @foreach ($products as $value)
                                    @if ($data->name==$value->name)
                                        {{$value->unit*$value->price}}
                                    @endif
                                    @endforeach
                                </p>
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