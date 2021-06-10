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
          <div class="row">
            <div class="col-md-12">

              @if(session('msg'))
                <h3 style="color: red" class="mb-5">
                  Error: {{session('msg')}}
                </h3>
              @endif

              <form action="profile" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">change Name</label>
                    <input type="text" 
                           name="name"
                           class="form-control" 
                           id="name" 
                           placeholder="Change name"
                           value="{{ Auth::User()->name }}">
                 </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">change password</label>
                    <input type="password" 
                           name="password"
                           class="form-control" 
                           id="exampleInputPassword1" 
                           placeholder="change password">
                  </div>

                  <button type="submit" class="btn btn-success">Save</button>
                </form>

            </div>
          </div>
      </div>
    </div>
  </body>
</html>   