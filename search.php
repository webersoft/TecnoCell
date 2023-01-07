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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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

  function clicka(link) {
        window.document.location = link;
  }s
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

      $ordenes = mysqli_query($conexion, "select * from nuevaorden ORDER BY orden DESC LIMIT 12");

     ?>
  </head>
  <body id="search" onload="inicio()" onkeypress="reset()" onclick="reset()" onMouseMove="reset()" class="bg-blue zoom">

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

          <div class="body">
      			<form id="formOrden" action="" id="sky-form" class="sky-form" />
      				<header>Orden de Servicio Técnico<span id="numorder"><?php echo " # ".$ordenesid["letra"].$ordenesid["orden"]; ?></span></header>

      				<fieldset>
      					<div class="row">
      						<section class="col col-6">
      							<label class="input">
      								<i class="icon-append fa-user"></i>
                      <label for="nombre" style="display:none" class="text">Nombre</label>
      								<input type="text" id="nombre" name="nombre" placeholder="Nombre" disabled value="<?php echo $ordenesid['nombre']; ?>" />
      							</label>
      						</section>
                  <section class="col col-6">
      							<label class="input">
      								<i class="icon-append fa-user-o"></i>
                      <label for="apellido" style="display:none" class="text">Apellido</label>
      								<input type="text" id="apellido" name="apellido" placeholder="Apellido" disabled value="<?php echo $ordenesid['apellido']; ?>" />
      							</label>
      						</section>

      					</div>

      					<div class="row">
                  <section class="col col-6">
      							<label class="input">
      								<i class="icon-append fa-phone"></i>
                      <label for="telefono" style="display:none" class="text">Teléfono</label>
      								<input type="tel" id="telefono" name="telefono" placeholder="Telefono" disabled value="<?php echo $ordenesid['telefono']; ?>"/>
      							</label>
      						</section>
      						<section class="col col-6">
      							<label class="input">
      								<i class="icon-append fa-envelope"></i>
                      <label for="email" style="display:none" class="text">Email</label>
      								<input type="email" id="email" name="email" placeholder="Email" disabled value="<?php echo $ordenesid['email']; ?>" />
      							</label>
      						</section>
      					</div>
      				</fieldset>
      				<fieldset>
      					<div class="row">
      						<section class="col col-6">
                    <label class="input">
      								<i class="icon-append fa-mobile-o"></i>
                      <label for="marca" style="display:none" class="text">Modelo</label>
      								<input type="text" name="marca" id="marca" placeholder="Marca" disabled value="<?php echo $ordenesid['marca']; ?>" />
      							</label>
                  </section>
                  <section class="col col-6">
      							<label class="input">
      								<i class="icon-append fa-mobile"></i>
                      <label for="modelo" style="display:none" class="text">Modelo</label>
      								<input type="text" name="modelo" id="modelo" placeholder="Modelo" disabled value="<?php echo $ordenesid['modelo']; ?>" />
      							</label>
                  </section>
                </div>
                <div class="row">
                  <section class="col col-6">
      							<label class="input">
      								<i class="icon-append fa-barcode"></i>
                      <label for="serie" style="display:none" class="text">Serie</label>
      								<input type="text" name="serie" id="serie" placeholder="Serie" disabled value="<?php echo $ordenesid['serie']; ?>" />
      							</label>
      						</section>
                  <section class="col col-6">
      							<label class="input">
      								<i class="icon-append fa-lock"></i>
                      <label for="clave" style="display:none" class="text">Clave de bloqueo</label>
      								<input type="text" name="clave" id="clave" placeholder="Clave de bloqueo" disabled value="<?php echo $ordenesid['clavebloqueo']; ?>" />
      							</label>
      						</section>
                </div>
                <div class="row">
                  <section class="col col-6">
      							<label class="toggle state-success"><input type="checkbox" name="checkbox-toggle" /><i></i>Bateria</label>
      						</section>
                  <section class="col col-6">
                    <label class="toggle state-success"><input type="checkbox" name="tapa" /><i></i>Tapa</label>
      						</section>
                  <section class="col col-6">
                    <label class="toggle state-success"><input type="checkbox" name="memoria" /><i></i>Memoria</label>
      						</section>
                  <section class="col col-6">
                    <label class="toggle state-success"><input type="checkbox" name="sim" /><i></i>SIM CARD</label>
      						</section>
                </div>
                <div class="row">
                  <section class="col col-6">
      							<label class="input">
      								<i class="icon-append fa-user-md"></i>
                      <label for="diagnostico" style="display:none" class="text">Diagnostico</label>
      								<input type="text" name="diagnostico" id="diagnostico" placeholder="Diagnostico" disabled value="<?php echo $ordenesid['diagnostico']; ?>" />
      							</label>
      						</section>
                  <section class="col col-6">
      							<label class="input">
      								<i class="icon-append fa-money"></i>
                      <label for="valor" style="display:none" class="text">Valor</label>
      								<input type="text" name="valor" id="valor" placeholder="Valor" value="<?php echo $ordenesid['valor']; ?>" />
      							</label>
      						</section>
      					</div>
      					<section>
      						<label class="textarea">
      							<i class="icon-append fa-commenting-o"></i>
                    <label for="detalle" style="display:none" class="text">Detalle</label>
      							<textarea rows="5" name="detalle" id="detalle" placeholder="Ingrese detalle de reparacion"><?php echo $ordenesid['detalle']; ?></textarea>
      						</label>
      					</section>
                <div class="row">
                  <section class="col col-3">
      							<label class="input">
      								<i class="icon-append fa-user"></i>
                      <label for="quien" style="display:none" class="text">Atendido por</label>
      								<input type="text" name="quien" id="quien" placeholder="Atendido por" value="<?php echo $ordenesid['atendidopor']; ?>"/>
      							</label>
      						</section>
                  <section class="col col-9 info" style="display:none"><br>
      							<p>Consulte el estado de su equipo en <b>www.solucel.com.ar/serviciotecnico</b>, por telefono al 011-3220-2187 o enviando un email a serviciotecnico@solucel.com.ar</p>
      							<p>Tucuman 536 local 415 y 416 Galerias Jardin</p>
      						</section>
                </div>
      				</fieldset>
      				<footer>
                <select style="width:150px" id="selectestado" class="selectestado" multiple>
                  <option value="sin revisar">Sin revisar</option>
                  <option value="en proceso">En proceso</option>
                  <option value="sin arreglo">Sin arreglo</option>
                  <option value="reparado">Reparado</option>
                  <option value="reparado">Confirmar presupuesto</option>
                </select>
                <script type="text/javascript">
                  $('.selectestado').select2({
                    placeholder: 'Estado',
                    maximumSelectionLength: 1,
                    language: "es"
                  });
                </script>
                <button type="button" onclick="printOrder();" class="button">Imprimir</button>

      					<button type="button" onclick="cambiarestado(<?php echo $_GET['id'] ?>);" class="button">Editar</button>
                <br><br><br>
                <div class="row">
                  <div id="alert" class="alertedit"><i class="fa fa-check fa-fw" aria-hidden="true"></i> ¡La orden fue editada con exito! <a href="search.php"><button style="margin-top:-10px;" type="button" class="button">Ordenes</button></a></div>
                  <?php
                    if($ordenesid['confirmado'] == 1) {
                      echo '<div class="alertedit" style="display:inline"><i class="fa fa-check fa-fw" aria-hidden="true"></i> ¡El cliente aceptó el presupuesto!</div>';
                    } elseif ($ordenesid['confirmado'] == 2) {
                      echo '<div class="alertedit" style="display:inline;background:red"><i class="fa fa-check fa-fw" aria-hidden="true"></i> El cliente NO aceptó el presupuesto</div>';
                    }
                     ?>
                </div>
                <div id="mensajeimpresion" style="display:none">
      						<h6 class="text-center">Condiciones generales</h3>
      						<ol>
      							<li>El producto se entregará únicamente con la presentación de la orden de reparación.</li>
      							<li>Las reparaciones tienen garantía por un lapso de treinta (30) días a partir de la fecha de entrega y sólo se aplica a las partes cambiadas.</li>
      							<li>Pasados los 90 (Noventa) días de la recepción, el equipo sin retirar será considerado abandonado, perdiendo todo derecho sobre el mismo. Art 2525-2526-3939 del código civil, quedando Solucell SRL facultado para disponer de dicho equipo.</li>
      							<li>Solucell SRL se declara no responsable de la mercaderia descripta, asumiendo sólo la reparación de la misma, desligándose de toda responsabilidad del origen o ingreso a plaza de dicha mercaderia.</li>
      							<li>El resguardo o Back-Up de la información es de única responsabilidad del cliente.</li>
      							<li>No se comprueba el funcionamiento total  y de ninguna de sus partes.</li>
      							<li>Pasado los 30 días de la fecha de entrega se cobrara a razon de $25 (veintcinco pesos) por día de demora en concepto de deposito y seguro del equipo.</li>
      							<li>El contenido o la eliminacion de datos del equipo entregado es exclusiva responsabilidad del cliente.</li>
      							<li>El valor expresado en la orden de trabajo es en efectivo.</li>
      							<li>El precios expresados son sin IVA.</li>
      						</ol>
      						<br>
      						<div class="row">
      							<div class="col col-4">
      								<br><br>
      								<p style="border-top: 1px solid black; text-align:center">Firma</p>
      								<br><br>
      								<p style="border-top: 1px solid black; text-align:center">Aclaración</p>
      							</div>
      							<div class="col col-4">
      								<div class="col col-4 rowpatron">
      									<div class="patron"></div>
      									<div class="patron"></div>
      									<div class="patron"></div>
      								</div>
      								<div class="col col-4 rowpatron">
      									<div class="patron"></div>
      									<div class="patron"></div>
      									<div class="patron"></div>
      								</div>
      								<div class="col col-4 rowpatron">
      									<div class="patron"></div>
      									<div class="patron"></div>
      									<div class="patron"></div>
      								</div>
      							</div>
      							<div class="col col-4">
      								<br><br>
      								<p style="border-top: 1px solid black; text-align:center">Fecha de Entrega</p>
      								<br><br>
      								<p style="border-top: 1px solid black; text-align:center">Recibí conforme</p>
      							</div>
      							</div>
      						</div>

      				</footer>
      			</form>
      		</div>
        </div>


       <?php
        } else {

       ?>
       <div class="container-fluid">
      <br>
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
              <th>Orden</th>
              <th>Fecha</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Telefono</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Serie</th>
              <th>Clave de bloqueo</th>
              <th>Diagnostico</th>
              <th>Valor</th>
              <th>Detalle</th>
              <th>Estado</th>
              <th>Visitas</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($reg = mysqli_fetch_array($ordenes)) {
                echo "<tr onclick=\"clicka('search.php?id=$reg[id]')\" data-estado='$reg[estado]' data-id='$reg[id]'>";
                echo "<td>$reg[letra]$reg[orden]</td>";
                echo "<td>$reg[fechacreacion]</td>";
                echo "<td>$reg[nombre]</td>";
                echo "<td>$reg[email]</td>";
                echo "<td>$reg[telefono]</td>";
                echo "<td>$reg[marca]</td>";
                echo "<td>$reg[modelo]</td>";
                echo "<td>$reg[serie]</td>";
                echo "<td>$reg[clavebloqueo]</td>";
                echo "<td>$reg[diagnostico]</td>";
                echo "<td>$reg[valor]</td>";
                echo "<td>$reg[detalle]</td>";
                echo "<td class='estado'>$reg[estado]</td>";
                echo "<td>$reg[visitas]</td>";
                echo "</tr>";
              }
             ?>
          </tbody>
        </table>
      </div>
        </div>
    </div>

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
