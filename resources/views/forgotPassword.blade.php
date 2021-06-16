@extends('layout.public')

@section('content')
    <div class="container-fluid mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
      
              <div class="row">
                <div class="col-md-4"></div>
                
                <div class="col-md-4">
                    <form action="sendPassword" method="POST" class="form-forgot p-3">
                      @csrf
                     
                      @error('email')
                        <div class="alert alert-danger forgotErr">{{ $message }}</div>
                      @enderror  

                      <label for="email" class="mt-2 forgot-msg">we will send your password to email below</label>
                      <input type="email" 
                             id="email" 
                             class="form-control" 
                             name="email">
                             
                      <a href="{{ url('/') }}" class="btns pl-2">
                        <div class="btn btn-success btn-send-pass"><- back to login</div>
                      </a>
                      
                       <button class="btb btn-primary mt-4 btn-send-pass" type="submit">Send</button>
                    </form>
                </div>

                <div class="col-md-4"></div>
              </div>
    
          </div>
        </div>
      </div>
    </div>
@endsection