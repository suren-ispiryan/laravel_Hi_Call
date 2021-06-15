<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Dash</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
      <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
    </head>
  <body>
    
    <div class="container-fluid">
      <div class="container">
      {{--======================== user info ============================--}}       
      <div class="row m-2">
        <div class="col-md-6 user-info"  style="height: 80px">   
          <div class="row">
            
            <div class="col-md-2"> 
              @if(Auth::User()->avatar)
                <img src="{{ asset('avatars/'.Auth::User()->avatar) }}" class="avatar">  
              @endif  
            </div>
  
            <div class="col-md-10 mt-4">
              <h4 style="text-align: left"> Hi: {{ Auth::User()->name }} </h4>
            </div>

          </div>
        </div>

  
        <div class="col-md-6 btns-group">     
          <a href="{{ url('/dashboard') }}" class="btns pl-2">
            <button class="btn btn-success"><- home</button>
          </a>

          <a href="{{ url('/profile') }}" class="btns">
            <button class="btn btn-warning">change profile info</button>
          </a>

          <a href="{{ url('/leave') }}" class="btns pl-2">
            <button class="btn btn-danger">log out -></button>
          </a>
        </div>
      </div>

        <hr>
    </div>
  </div>

      @yield('content')


  </body>
</html>  