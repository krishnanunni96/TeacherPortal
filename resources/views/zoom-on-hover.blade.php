
<!DOCTYPE html> 
<html lang="en">   
<head> 
    <meta charset="utf-8" />         
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.js"></script>   
    <style> 
        body { 
            margin: 20px; 
            border: 1px solid grey;
        } 
        h1 { 
            color: #26a69a;             
        } 
        .container { 
            display: block; 
            padding: 0px; 
        }           
        .contain { 
            position: fixed; 
            right: 40%; 
            top: 5%; 
            width: 500px; 
            height: 500px;
            margin-top: 20px;
        }           
        img { 
            width: 250px; 
            height: 250px;
            margin: 20px;
        }
        b{
          margin-left: 20px; 
        }
    </style> 
</head>  
<body> 
    <div class="card">
        <div class="card-header">
            <nav class="navbar navbar-dark bg-primary">
                <div class="container">
                    <h2>Flipkart</h2>
                  <a class="navbar-brand bg-dark" href="#">
                    {{-- <img src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24">     --}}
                  </a>
                </div>
              </nav>
        </div>
        <div class="card-body">
            <div class="container-fluid"> 
                <b>Product Image</b> 
                <div class="parent"> 
                    <img src="https://websolutionstuff.com/adminTheme/global_assets/images/favicon.png">
                </div>   
                <span class="contain"></span> 
            </div>   
        </div>
    </div>
    
    <script> 
        $(document).ready(function() { 
            $('.parent').css('width', $('img').width());
            $('img').parent().zoom({ 
                magnify: 2, 
                target: $('.contain').get(0) 
            }); 
        }); 
    </script> 
</body>   
</html>