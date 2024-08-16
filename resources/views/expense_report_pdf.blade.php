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
                    <table class="table table-bordered align-items-center mb-0" style="border-color:dark;">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 17%" class="text-uppercase text-secondary text-xs opacity-7">Date</th>
                                <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Towards</th>
                                <th style="width: 13%" class="text-uppercase text-secondary text-xs opacity-7">Expense Amount</th>
                                <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Tax%</th>
                                <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Tax Amount</th>
                                <th style="width: 15%" class="text-uppercase text-secondary text-xs opacity-7">Payment Mode</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($expense as $data)
                            <tr>
                                <td style="width: 10%" >
                                    <p class="text-xs px-3  mb-0">{{$data->date}}</p>
                                </td>
                                <td style="width: 25%" >
                                    <p class="text-xs px-3 mb-0">
                                        <span class="font-weight-bold">{{$data->category->name}}</span>
                                    </p>
                                </td>
                                <td style="width: 20%" >
                                    <p class="text-xs px-3 font-weight-bold mb-0">{{$data->amount}}</p>
                                </td>
                                <td style="width: 15%" >
                                    <p class="text-xs px-3 font-weight-bold mb-0">                                            
                                        @php
                                        if($data->tax_included){
                                            echo $data->tax_percentage;
                                        }    
                                        else{
                                            echo "-";
                                        }
                                        @endphp
                                    </p>
                                </td>
                                    @php
                                        if($data->tax_included){
                                            $tax_amount=($data->amount*$data->tax_percentage)/100;
                                        }else{
                                            $tax_amount=0;
                                        }
                                    @endphp
                                <td style="width: 15%" >
                                    <p class="text-xs px-3 font-weight-bold mb-0">                                            
                                        @php
                                        if($tax_amount){
                                            echo $tax_amount;
                                        }else{
                                            echo "-";
                                        }
                                        @endphp
                                    </p>   
                                </td>
                                <td style="width: 15%" >
                                    <p class="text-xs px-3 text-uppercase mb-0">{{getPaymentMode($data->payment_mode)}}</p>
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