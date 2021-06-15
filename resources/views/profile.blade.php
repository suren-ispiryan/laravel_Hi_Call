@extends('layout.dashboard')
   
@section('content')
   <div class="container-fluid pt-3">
      <div class="container">
          <div class="row">
            <div class="col-md-12">

              @if(session('msg'))
                <h3 style="color: red" class="mb-5">
                  Error: {{session('msg')}}
                </h3>
              @endif

              <form action="profile" method="POST" class="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="avatar">Avatar</label>
                  <br>
                  <input id="avatar" type="file" name="avatar">
                </div>

                <div class="form-group">
                    <label class="mt-2" for="name">change Name</label>
                    <input type="text" 
                           name="name"
                           class="form-control" 
                           id="name" 
                           placeholder="Change name"
                           value="{{ Auth::User()->name }}">
                 </div>

                  <div class="form-group">
                    <label class="mt-2" for="exampleInputPassword1">change password</label>
                    <input type="password" 
                           name="password"
                           class="form-control" 
                           id="exampleInputPassword1" 
                           placeholder="change password">
                  </div>

                  <button type="submit" class="btn btn-success mt-3">Save</button>
                </form>

            </div>
          </div>
      </div>
    </div>
@endsection