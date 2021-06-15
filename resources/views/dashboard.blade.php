@extends('layout.dashboard')


@section('content')
    <div class="container-fluid pt-3">
      <div class="container">

  

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
@endsection
