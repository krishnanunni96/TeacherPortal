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
                        <th style="width: 10%" class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                        <th style="width: 10%" class="text-uppercase text-secondary text-xs opacity-7">Purchase #</th>
                        <th style="width: 20%" class="text-uppercase text-secondary text-xs opacity-7">Supplier</th>
                        <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Sub Total</th>
                        <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Discount</th>
                        <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Tax Amount</th>
                        <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Gross Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $item)
                    <tr>
                        <td style="width: 10%" >
                            <p class="text-xs px-3  mb-0">{{dateHelper($item->purchase_date)}}</p>
                        </td>
                        <td style="width: 10%" >
                            <p class="text-xs px-3 mb-0">
                                <span class="font-weight-bold">{{$item->purchase_no}}</span>
                            </p>
                        </td>
                        <td style="width: 20%" >
                            <p class="text-xs px-3 font-weight-bold mb-0">{{$item->supplier->name}}</p>
                        </td>
                        <td style="width: 15%" >
                            <p class="text-xs px-3 font-weight-bold mb-0">${{$item->sub_total}}</p>
                        </td>
                        <td style="width: 15%" >
                            <p class="text-xs px-3 font-weight-bold mb-0">${{$item->discount}}</p>
                        </td>
                        <td style="width: 15%" >
                            <p class="text-xs px-3 font-weight-bold mb-0">${{$item->tax_total}}</p>
                        </td>
                        <td style="width: 15%" >
                            <p class="text-xs px-3 font-weight-bold mb-0">${{$item->gross_total}}</p>
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