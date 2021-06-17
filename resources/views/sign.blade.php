@extends('layout.public')

    {{-- display errors --}}
@section('content')
<div class="container-fluid">
  <div class="container">  
<div class="row">
  
      <div class="col-md-12">
  
        @if($errors->any())
        <h3 style="text-align: center">Errors</h3>
         
        <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li style="color: red">{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
      </div>
      
  </div>


      {{-- sign up --}}

  <div class="row">

    <div class="col-md-6 sub-parents">  
      <form action="signUp" method="POST">
        
        @if(isset($resetMsg))
          <h6 style="color: green">{{ $resetMsg }}</h6>
        @endif

        @csrf
        <h3 class="heading1 mb-5">Sign up</h3>
        <input type="text" name="name" class="form-control mb-3" placeholder="Your name">
        <input type="email" name="email" class="form-control mb-3" placeholder="Your email"> 
        <input type="password" name="password" class="form-control mb-3" placeholder="Your password">
        <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirm password">
        <input type="submit" name="submit" class="form-control btn btn-primary buttons" value="submit">
      </form>
    </div>

      {{-- sign in --}}

    <div class="col-md-6 sub-parents">  
      <form action="signIn" method="POST">
        @csrf
        <h3 class="heading1 mb-5">Sign in</h3>
        <input type="email" name="email" class="form-control mb-3" placeholder="Your email"> 
        <input type="password" name="password" class="form-control mb-3" placeholder="Your password">
        <input type="submit" name="submit" class="form-control btn btn-primary buttons" value="submit">
        <p class="pt-5 pl-2 forgot" style="text-align: left; font-size: 14px">
          <a href="forgotPassword">forgot password</a>
        </p>
      </form>
    </div>

  </div>
  </div>
  </div>
@endsection
