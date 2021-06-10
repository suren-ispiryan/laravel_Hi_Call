<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    
        <style>
            .heading1{
                text-align: center;
            }
            .parent{
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh; 
            }
            .sub-parents{
                min-width: 400px;
                padding: 100px;
            }
            form{
                padding: 40px 40px 40px;
                border: 1px black solid;
                box-shadow: black 4px 4px 10px;
                text-align: center;
            }
            .buttons{
               width: 50%;
               margin-top: 15px
            }
        </style>
    </head>
    <body class="antialiased">
        
        <div class="container-fluid">
            <div class="container">
                <div class="row parent">
                    <div class="col-md-12 ">
                        @include('sign')                
                    </div>
                </div>
            </div>    
        </div>    
      
    </body>
</html>