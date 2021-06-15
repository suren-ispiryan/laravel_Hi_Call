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
        .avatar{
          height: 80px; 
          width: 80px; 
          border-radius: 50%;
          border: 2px solid;
        }
        .avatar:hover{
          z-index: 100;
          position: absolute;
          height: 120px;
          width: 120px;
          cursor: pointer;
          border: none;
          top: -20px;
          left: -20px;  
        }
    
       /* ============= blackboard =============== */
       .blackboard{
          height: 400px;
          width: 800px;   
          position: relative;
        }
        .blackboard-frame{
          height: 100%;
          width: 100%;
          border: none;
        }
      </style>
    </head>
  <body>
    <div class="container-fluid pt-3">
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
            <a href="{{ url('/profile') }}" class="btns">
              <button class="btn btn-warning">change profile info</button>
            </a>

            <a href="{{ url('/leave') }}" class="btns pl-2">
              <button class="btn btn-danger">log out -></button>
            </a>
          </div>
        </div>

          <hr>


  {{--==================== heading =======================--}}
          <div class="row" style="text-align: center">
            <div class="col-md-12">
              <h1>
                <span style="color: black">B l</span>
                <span style="color: red">e a</span>
                <span style="color: yellow">c k</span>
                <span style="color: green">b o</span>
                <span style="color: blue">a r d</span>
              </h1>
            </div>
          </div>

  {{--=================== bleakboard ======================--}}
          <div class="row" style="text-align: center">
            <div class="col-md-12" style="display: flex; justify-content: center">
              
              <div class="blackboard">
                <iframe class="blackboard-frame" src="http://127.0.0.1:8000/blackboard"></iframe>
              </div>
            
            </div>
          </div>


      </div>
    </div>

  </body>
</html>