<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Dash</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
      <style> 
       /* ============= blackboard =============== */
        .whiteboard {
          border: 3px grey solid;
          border-radius: 10px;
          height: 100%;
          width: 100%;
          position: absolute;
          left: 0;
          right: 0;
          bottom: 0;
          top: 0;
        }
        .colors {
          padding: 10px;
          position: fixed;
          }
        .color {
          display: inline-block;
          height: 48px;
          width: 48px;
          cursor: pointer;
        }
        .color.black { background-color: black; }
        .color.red { background-color: red; }
        .color.green { background-color: green; }
        .color.blue { background-color: blue; }
        .color.yellow { background-color: yellow; }
        
      </style>
    </head>
  <body>
  
    <canvas class="whiteboard" style="display: block">Your  browser is not supported Canvas  </canvas>

    <div class="colors">
      <div class="color black"></div>
      <div class="color red"></div>
      <div class="color yellow"></div>
      <div class="color green"></div>
      <div class="color blue"></div>
    </div>



{{-- ====================================== bleakboard script ========================================== --}}
{{-- =================================================================================================== --}}




    {{-- ================== jquery cdn ======================================= --}}
<script src="https://code.jquery.com/jquery-3.6.0.js" 
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
</script>

    {{-- ================== socket io cdn =================================== --}}
<script src="https://cdn.socket.io/4.1.2/socket.io.min.js" 
        integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" 
        crossorigin="anonymous">
</script>




    {{-- ======================== blackboard functionality ================================== --}}

<script>
 'use strict';

(function() {

  var socket = io('http://127.0.0.1:5000');
  var canvas = document.getElementsByClassName('whiteboard')[0];
  var colors = document.getElementsByClassName('color');
  var context = canvas.getContext('2d');

  var current = {
    color: 'black'
  };
  var drawing = false;

  canvas.addEventListener('mousedown', onMouseDown, false);
  canvas.addEventListener('mouseup', onMouseUp, false);
  canvas.addEventListener('mouseout', onMouseUp, false);
  canvas.addEventListener('mousemove', throttle(onMouseMove, 10), false);
  
  //Touch support for mobile devices
  canvas.addEventListener('touchstart', onMouseDown, false);
  canvas.addEventListener('touchend', onMouseUp, false);
  canvas.addEventListener('touchcancel', onMouseUp, false);
  canvas.addEventListener('touchmove', throttle(onMouseMove, 10), false);

  for (var i = 0; i < colors.length; i++){
    colors[i].addEventListener('click', onColorUpdate, false);
  }

  socket.on('drawing', onDrawingEvent);

  window.addEventListener('resize', onResize, false);
  onResize();


  function drawLine(x0, y0, x1, y1, color, emit){
    context.beginPath();
    context.moveTo(x0, y0);
    context.lineTo(x1, y1);
    context.strokeStyle = color;
    context.lineWidth = 2;
    context.stroke();
    context.closePath();
    
    if (!emit) { return; }
    var w = canvas.width;
    var h = canvas.height;

    socket.emit('drawing', {
      x0: x0 / w,
      y0: y0 / h,
      x1: x1 / w,
      y1: y1 / h,
      color: color
    });
  }

  function onMouseDown(e){
    drawing = true;
    current.x = e.clientX||e.touches[0].clientX;
    current.y = e.clientY||e.touches[0].clientY;
  }

  function onMouseUp(e){
    if (!drawing) { return; }
    drawing = false;
    drawLine(current.x, current.y, e.clientX||e.touches[0].clientX, e.clientY||e.touches[0].clientY, current.color, true);
  }

  function onMouseMove(e){
    if (!drawing) { return; }
    drawLine(current.x, current.y, e.clientX||e.touches[0].clientX, e.clientY||e.touches[0].clientY, current.color, true);
    current.x = e.clientX||e.touches[0].clientX;
    current.y = e.clientY||e.touches[0].clientY;
  }

  function onColorUpdate(e){
    current.color = e.target.className.split(' ')[1];
  }

  // limit the number of events per second
  function throttle(callback, delay) {
    var previousCall = new Date().getTime();
    return function() {
      var time = new Date().getTime();

      if ((time - previousCall) >= delay) {
        previousCall = time;
        callback.apply(null, arguments);
      }
    };
  }

  function onDrawingEvent(data){
    var w = canvas.width;
    var h = canvas.height;
    drawLine(data.x0 * w, data.y0 * h, data.x1 * w, data.y1 * h, data.color);
  }

  
  // make the canvas fill its parent
  function onResize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }




})();
</script>  



  </body>
</html>