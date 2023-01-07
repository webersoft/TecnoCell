<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Ver ordenes - TecnoCell</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

    <link rel="stylesheet" href="css/demo.css" />
		<link rel="stylesheet" href="css/sky-forms.css" />
		<link rel="stylesheet" href="css/sky-forms-blue.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/imprimir.css" media="print" />

    <script src="js/semantic.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/select2.full.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="https://use.fontawesome.com/ef241c16b6.js"></script>


	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script>

    var time;
    function inicio() {
    time = setTimeout(function() {
    $(document).ready(function(e) {
    location.reload()
    });
  },60000);//fin timeout
    }//fin inicio

    function reset() {
    clearTimeout(time);
    inicio();
    }


    var count = 0;

    function dobuscar() {
      var textoBusqueda = $("#busqueda").val();
      count++;
      setTimeout("buscar('"+textoBusqueda+"',"+count+")",200);
    }

    function buscar(busqueda, cnt) {

      var textoBusqueda = busqueda;

      if (count == cnt) {

      if(textoBusqueda.length >= 3) {
          $.post("api/buscarorden.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
            colores();
            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });
          });
      } else if (textoBusqueda.length < 3) {
        $("#resultadoBusqueda").html("<center><h2>La busqueda debe contener al menos 3 palabras.</h2></center>");
      } else {
        $.post("api/buscarorden.php", {valorBusqueda: 'vacio'}, function(mensaje) {
          $("#resultadoBusqueda").html(mensaje);
          colores();
          $(".clickable-row").click(function() {
              window.document.location = $(this).data("href");
          });
        });
      }

    }

    }

    function cambiarestado(id) {
      $.post("api/cambiarestado.php", {estado: $(".selectestado option:selected" ).text(), valor: $("#valor").val(), id: id, email: $("#email").val() }, function(mensaje) {
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        $(".alertedit").show();
      });
    }

    function colores() {
      $(".estado").each(function(){
        if ($(this).text() == "Sin revisar") {
          $(this).parent().addClass("estado_sinrevisar");
        }
        else if ($(this).text() == "Sin arreglo") {
          $(this).parent().addClass("estado_sinarreglo");
        }
        else if ($(this).text() == "Reparado") {
          $(this).parent().addClass("estado_reparado");
        }
        else if ($(this).text() == "En proceso") {
          $(this).parent().addClass("estado_enproceso");
        }
        else if ($(this).text() == "Confirmar presupuesto") {
          $(this).parent().addClass("estado_presupuesto");
        }
      })
    }


    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });

    colores();

  });

  function printOrder() {
  if (window.print) {
    window.print();
  }
		}

  function filtrar() {
      $.post("api/filtros.php", {estado: $("#filtro_estado").val(), cantidad: $("#filtro_cantidad").val()}, function(mensaje) {
        $("#resultadoBusqueda").html(mensaje);
        colores();
      });
  }
    </script>

    <style>
    @import url(http://fonts.googleapis.com/css?family=Open+Sans:300,400,700);

    input.search {
      font-family: FontAwesome;
      font-style: normal;
      font-weight: normal;
      text-decoration: inherit;
      border:2px solid dodgerblue;
      }

      tr:hover {
        background:lightgray;
        cursor:pointer;
      }

      .alertedit {
        padding: 20px;
        background-color: #6abc6e;
        color: white;
        margin-top:40px;
        display:none;
        font-size:18px;
      }
      a:link{
        text-decoration: none !important;
      }
    </style>

    <?php


      include 'api/conexion.php';

      $recibos = mysqli_query($conexion, "select * from recibos ORDER BY id DESC");

     ?>
  </head>
  <body id="recibos" onload="inicio()" onkeypress="reset()" onclick="reset()" onMouseMove="reset()" class="bg-blue zoom">

    <?php if(isset($_SESSION['logged'])) { ?>

    <?php
    include "api/navbar.php"
     ?>




    <div class="container">

      <?php

        if(isset($_GET['id'])) {

          $ordenesid = mysqli_query($conexion, "select * from nuevaorden where id = '$_GET[id]'");

          $ordenesid = mysqli_fetch_array($ordenesid);

           ?>



       <?php
        } else {

       ?>
      <br>
      <center><button class="btn btn-primary" type="button" name="button" data-toggle="modal" data-target="#modal_recibo">Nuevo recibo</button></center>
      <div class="header_tabla">
            <input style="width:300px;display:inline;margin:10px;" class="form-control search" placeholder="&#xF002;" type="text" name="busqueda" id="busqueda" value="" onKeyUp="dobuscar();">
        <select class="filtro" id="filtro_estado" name="">
          <option value="Sin filtro">Estado</option>
          <option value="Sin revisar">Sin revisar</option>
          <option value="Confirmar presupuesto">Confirmar presupuesto</option>
          <option value="En proceso">En proceso</option>
          <option value="Sin arreglo">Sin arreglo</option>
          <option value="Reparado">Reparado</option>
        </select>
        <select class="filtro" id="filtro_cantidad" name="">
          <option value="Sin filtro">Mostrar..</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="40">40</option>
          <option value="80">80</option>
          <option value="100">100</option>
        </select>
        <button class="btn btn-primary" onclick="filtrar()" name="button">Filtrar</button>
      </div>
      <div id="resultadoBusqueda">
      <div class="table-responsive">
        <table style="color:black;font-family:'Open Sans'" class="ui unstackable red table">
          <thead>
            <tr>
              <th>Nº Recibo</th>
              <th>Fecha</th>
              <th>Cliente/Proveedor</th>
              <th>Total</th>
              <th>Forma de pago</th>.
            </tr>
          </thead>
          <tbody>
            <?php
              while($reg = mysqli_fetch_array($recibos)) {
                echo "<tr class='clickable-row' data-href='ver_recibo.php?id=$reg[id]' data-id='$reg[id]'>";
                echo "<td>$reg[numero]</td>";
                echo "<td>$reg[fecha]</td>";
                echo "<td>$reg[razon_social]</td>";
                echo "<td>$reg[total]</td>";
                echo "<td>$reg[formapago]</td>";
                echo "</tr>";
              }
             ?>
          </tbody>
        </table>
      </div>
        </div>
    </div>

<div class="modal fade" id="modal_recibo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <form id="form_recibo" action="" id="sky-form" class="sky-form" />
  				<header>Orden de Servicio Técnico <span id="numorder" style="display:none"></span></header>
  				<fieldset>
  					<div class="row">
  						<section class="col col-6">
  							<label class="input">
  								<i class="icon-append fa-user"></i>
  								<label for="nombre" style="display:none" class="text">Razon Social</label>
  								<input type="text" id="razonsocial" name="razonsocial" placeholder="Razon Social"/><span class="tooltiptext">Proba con un segundo nombre</span>
  							</label>
  						</section>
  						<section class="col col-6">
  							<label class="input">
  								<i class="icon-append fa-user-o"></i>
  								<label for="apellido" style="display:none" class="text">CUIT</label>
  								<input type="text" id="cuit" name="cuit" placeholder="CUIT" />
  							</label>
  						</section>
  					</div>

  					<div class="row">
  						<section class="col col-6">
  							<label class="input">
  								<i class="icon-append fa-phone"></i>
  								<label for="telefono" style="display:none" class="text">Direccion</label>
  								<input type="text" id="direccion" name="direccion" placeholder="Direccion" />
  							</label>
  						</section>
              <section class="col col-6">
  							<label class="input">
  								<i class="icon-append fa-phone"></i>
  								<label for="telefono" style="display:none" class="text">Fecha</label>
  								<input type="text" id="fecha" name="fecha" placeholder="Fecha" />
  							</label>
  						</section>
  					</div>
  				</fieldset>
  				<fieldset>
          <div class="wrapper_input">
            <div class="row">
              <section class="col col-5">
  							<label class="input">
  								<i class="icon-append fa-barcode	"></i>
  								<label for="serie" style="display:none" class="text">Concepto</label>
  								<input type="text" name="concepto[]" id="concepto" placeholder="Concepto" />
  							</label>
  						</section>
              <section class="col col-5">
  							<label class="input">
  								<i class="icon-append fa-lock"></i>
  								<label for="clave" style="display:none" class="text">Valor</label>
  								<input type="text" name="valor[]" id="valor" placeholder="Valor" />
  							</label>
  						</section>
              <section class="col col-2">
                <i style="margin-top:10px;cursor:pointer" class="fa fa-plus add_input fa-2x" aria-hidden="true"></i>
              </section>
            </div>
          </div>
            <div class="row">
              <section class="col col-6">
                <label class="select">
  								<label for="forma_pago" style="display:none" class="text">Forma de pago</label>
  								<select name="forma_pago" id="forma_pago">
  									<option value="0" selected="" disabled="" />Forma de pago
  									<option value="apple" />Efectivo
  									<option value="samsung" />Cheque
  									<option value="motorola" />Deposito bancario
  								</select>
    						</label>
  						</section>
            </div>
  					<div style="margin-bottom:20px" class="alertorder">
  						<span></span>
  					</div>
  				</fieldset>
  				<footer>
  					<button type="button" class="button submit">Ingresar</button>
  				</footer>
  			</form>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$(document).ready(function() {
  var max_fields      = 10; //maximum input boxes allowed
  var wrapper         = $(".wrapper_input"); //Fields wrapper
  var add_button      = $(".add_input"); //Add button ID

  var x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div class="row"><section class="col col-5"><label class="input"><input type="text" name="concepto[]" placeholder="Concepto"/></label></section><section class="col col-5"><label class="input"><input type="text" name="valor[]" placeholder="Valor"/></label></section><i style="margin-top:5px;margin-left:15px" class="fa fa-times fa-2x remove_field" aria-hidden="true"></i></div>'); //add input box
      }
  });

  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent('div').remove(); x--;
  })
});

$(function() {
       $('.submit').click(function() {
          $.ajax({
                  data:  $("#form_recibo").serialize(),
                  url:   'api/insertar_recibo.php',
                  type:  'post',
                  success:  function (response) {
                           alert(response);
                  }
          });
       });


   });
</script>

    <?php
      }
     ?>

     <?php
   } else {
    ?>

   <script>
     location.href="login.html";
   </script>

 <?php
   }
  ?>

  </body>
</html>
