@extends('layout.public')

<div class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="row">
          <div class="col-md-4"></div>
          
          <div class="col-md-4">
            <form action="" method="POST" class="reset-form">
              @csrf
              
              @error('passReset')
                <div class="alert alert-danger forgotErr">{{ $message }}</div>
              @enderror  

              <label for="passReset" class="resetLabel">New password</label>
              <input type="password" 
                     name="passReset" 
                     id="passReset" 
                     placeholder="write your password"
                     class="form-control">

              <label for="passResetConf" class="resetLabel">Repeat password</label>
              <input type="password" 
                     name="passResetConf" 
                     id="passResetConf" 
                     placeholder="Repeat your password"
                     class="form-control">       

              <button type="submit" class="form-control btn btn-primary mt-3">Reset</button> 

            </form>
          </div>
          
          <div class="col-md-4"></div>
        </div>

      </div>
    </div>
  </div>
</div>