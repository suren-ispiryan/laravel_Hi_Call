<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Dash</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
      <style> 
        .user-info{
          color: green;
          text-align: left;
        }
        .btns-group{
          text-align: right;
        }
        .blackboard{
          height: 60vh;
          width: 60vw;
          border: 3px grey solid;
          border-radius: 10px;
        }
       
      </style>
    </head>
  <body>
    <div class="container-fluid pt-3">
      <div class="container">

{{--================================== user info ======================================--}}       
        <div class="row">
          <div class="col-md-6 user-info">   
              <p>
                <h4> Hi: {{ Auth::User()->name }} </h4>
              </p>
            </div>

          <div class="col-md-6 btns-group"> 
            
            <a href="{{ url('/profile') }}" class="btns">
              <button class="btn btn-warning">change profile info</button>
            </a>

            <a href="{{ url('/leave') }}" class="btns pl-2">
              <button class="btn btn-danger">log out</button>
            </a>

          </div>
        </div>

          <hr>


{{--================================== heading ======================================--}}
          <div class="row" style="text-align: center">
            <div class="col-md-12">
              <h1>
                <span style="color: red">B l</span>
                <span style="color: orange">e a</span>
                <span style="color: yellow">c k</span>
                <span style="color: green">b o</span>
                <span style="color: blue">a r d</span>
              </h1>
            </div>
          </div>


{{--================================== bleakboard ======================================--}}
          <div class="row" style="text-align: center">
            <div class="col-md-12" style="display: flex; justify-content: center">
              
              <div class="blackboard">

              </div>
            
            </div>
          </div>


      </div>
    </div>
  </body>
</html>   