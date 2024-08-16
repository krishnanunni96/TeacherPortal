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
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                            <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Order ID</th>
                            <th style="width: 30%" class="text-uppercase text-secondary text-xs  opacity-7">Customer</th>
                            <th style="width: 20%" class="text-uppercase text-secondary text-xs  opacity-7">Order Amount</th>
                            <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table-responsive mb-4 table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered align-items-center mb-0 ">
                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td style="width: 15%" >
                                <p class="text-xs px-3 mb-0">{{dateHelper($item->date_of_order)}}</p>
                            </td>
                            <td style="width: 15%" >
                                <p class="text-xs px-3 mb-0">
                                    <span class="font-weight-bold">{{$item->order_no}}</span>
                                </p>
                            </td>
                            <td style="width: 30%" >
                                <p class="text-xs px-3 font-weight-bold mb-0">{{$item->customer->name}}</p>
                            </td>
                            <td style="width: 21.3%" >
                                <p class="text-xs px-3 font-weight-bold mb-0">${{$item->order_amount}}</p>
                            </td>
                            <td style="width: 20%" >
                                <a type="button" class="badge badge-sm bg-secondary text-uppercase">{{getOrderStatus($item->status)}}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        </div>

    </body>
</html>