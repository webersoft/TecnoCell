<?php
  session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Tecnocell Servicio Tecnico</title>

		<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/app.css" />
		<link rel="stylesheet" href="css/sky-forms-blue.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/76ff5bbde3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <style>

    @media (max-width: 900px) {
      #Date {
        font-size:15px !important;
      }

      ul li {
        font-size:2em !important;
        }
    }

        .clock {
          margin-left:auto;
          margin-right:auto;
          width:95%;
          margin-top: 30px;
          color:#F18412;
          }

        #Date {
          font-family: Arial, Helvetica, sans-serif;
          font-size:25px;
          text-align:center;
          text-shadow:0 0 5px #F1AC12C7;
          }

        ul {
          width:95%;
          margin:0 auto;
          padding:0px;
          list-style:none;
          text-align:center;
          }

        ul li {
          display:inline;
          font-size:4em;
          text-align:center;
          font-family:Arial, Helvetica, sans-serif;
          text-shadow:0 0 5px #F1AC12C7;
          }

        #point {
          position:relative;
          -moz-animation:mymove 1s ease infinite;
          -webkit-animation:mymove 1s ease infinite;
          padding-left:10px; padding-right:10px;
          }

        @-webkit-keyframes mymove
          {
          0% {opacity:1.0; text-shadow:0 0 20px #00c6ff;}
          50% {opacity:0; text-shadow:none; }
          100% {opacity:1.0; text-shadow:0 0 20px #00c6ff; }
          }

        @-moz-keyframes mymove
          {
          0% {opacity:1.0; text-shadow:0 0 20px #00c6ff;}
          50% {opacity:0; text-shadow:none; }
          100% {opacity:1.0; text-shadow:0 0 20px #00c6ff; }
          }
    </style>

    <script>
    $(document).ready(function() {
// Create two variables with names of months and days of the week in the array
var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];
var dayNames= ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"]

// Create an object newDate()
var newDate = new Date();
// Retrieve the current date from the Date object
newDate.setDate(newDate.getDate());
// At the output of the day, date, month and year
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
  // Create an object newDate () and extract the second of the current time
  var seconds = new Date().getSeconds();
  // Add a leading zero to the value of seconds
  $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
  },1000);

setInterval( function() {
  // Create an object newDate () and extract the minutes of the current time
  var minutes = new Date().getMinutes();
  // Add a leading zero to the minutes
  $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
  },1000);

setInterval( function() {
  // Create an object newDate () and extract the clock from the current time
  var hours = new Date().getHours();
  // Add a leading zero to the value of hours
  $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
  }, 1000);

});
    </script>

  <body class="bg-blue">
    <div class="container" style=" background-image: url(img/baner.png); background-repeat: no-repeat; background-position: bottom; background-size: contain;">

      <?php

        if(isset($_SESSION['logged'])) { ?>

          <div class="clock">
              <div id="Date"></div>
              <ul>
                  <li id="hours"></li>
                  <li id="point">:</li>
                  <li id="min"></li>
                  <li id="point">:</li>
                  <li id="sec"></li>
              </ul>
          </div>

          <div class="contenedor">
            <img class="img-responsive" src="img/bannersup.png"/>
            <br>
            <hr class="style14">

            <div class="row">
              <a href="neworder.php">
                <div class="col-xs-6 col-sm-6 col-md-6 botonera">
                  <div class="icon">
                    <i class="fa fa-mobile fa-3x" aria-hidden="true"></i>
                    <p>Nueva orden de servicio</p>
                  </div>
                </div>
              </a>

              <a href="search.php">
                <div class="col-xs-6 col-sm-6 col-md-6 botonera">
                  <div class="icon">
                    <i class="fa fa-search fa-3x" aria-hidden="true"></i>
                    <p>Buscar orden</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="row">
              <a href="formulario.php">
                <div class="col-xs-6 col-sm-6 col-md-6 botonera">
                  <div class="icon icon-padd">
                    <i class="fa fa-cart-plus fa-3x" aria-hidden="true"></i>
                    <p>Carga de productos E-Commerce</p>
                  </div>
                </div>
              </a>
              <a href="recibos.php">
                <div class="col-xs-6 col-sm-6 col-md-6 botonera">
                  <div class="icon icon-padd">
                    <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
                    <p>Recibos</p>
                  </div>
                </div>
              </a>
            </div>

              <div class="row" >
                <a href="panel.php">
                  <div class="col-xs-6 col-sm-6 col-md-6 botonera">
                    <div class="icon icon-padd">
                      <i class="fa fa-th fa-3x" aria-hidden="true"></i>
                      <p>Panel de Control</p>
                    </div>
                  </div>
                </a>
              <a target="_blank" href="Tecnocell">
                <div class="col-xs-6 col-sm-6 col-md-6 botonera">
                  <div class="icon icon-padd">
                    <i class="fa fa-question-circle fa-3x" aria-hidden="true"></i>
                    <p>Soporte</p>
                  </div>
                </div>
              </a>
            </div>


          </div>

        <?php
      } else {
       ?>

      <script>
        location.href="login.html";
      </script>

    <?php
      }
     ?>

    </div>


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <script src="https://use.fontawesome.com/76ff5bbde3.js"></script>
   <script src="js/funciones.js"></script>
   <script src="js/jquery.bootstrap.js" type="text/javascript"></script>
   <script src="js/material-bootstrap-wizard.js"></script>
   <script src="js/jquery.validate.min.js"></script>
   <script src="js/material-kit.js"></script>
   <script src="js/material.min.js"></script>
   <script src="js/bootstrap-datepicker.js"></script>

   <script type="text/javascript">
   $(function() {

 $('#dropzone').on('dragover', function() {
   $(this).addClass('hover');
 });

 $('#dropzone').on('dragleave', function() {
   $(this).removeClass('hover');
 });

 $('#dropzone input').on('change', function(e) {
   var file = this.files[0];

   $('#dropzone').removeClass('hover');


   $('#dropzone').addClass('dropped');
   $('#dropzone img').remove();

   if ((/^image\/(gif|png|jpeg)$/i).test(file.type)) {
     var reader = new FileReader(file);

     reader.readAsDataURL(file);

     reader.onload = function(e) {
       var data = e.target.result,
           $img = $('<img />').attr('src', data).fadeIn();

       $('#dropzone div').html($img);
     };
   } else {
     var ext = file.name.split('.').pop();

     $('#dropzone div').html(ext);
   }
 });
});
   </script>

  </body>
</html>
