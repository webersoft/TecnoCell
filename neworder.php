<!DOCTYPE html>
<html>
	<head>
		<title>Nueva orden - Solucel</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

		<link rel="stylesheet" href="css/demo.css" />
		<link rel="stylesheet" href="css/sky-forms.css" />
		<link rel="stylesheet" href="css/sky-forms-blue.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/imprimir.css" media="print" />
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="css/sky-forms-ie8.css">
		<![endif]-->

		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="https://use.fontawesome.com/ef241c16b6.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="js/notify.min.js"></script>
		<script src="js/funciones.js"></script>

		<!--[if lt IE 10]>
			<script src="js/jquery.placeholder.min.js"></script>
		<![endif]-->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/sky-forms-ie8.js"></script>
		<![endif]-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script>


	function printOrder() {
  if (window.print) {
    window.print();
		location.reload();
  }
		}

	function nuevaorden() {
		var parametros = {
						"nombre" : $("#nombre").val(),
						"apellido" : $("#apellido").val(),
						"telefono" : $("#telefono").val(),
						"email" : $("#email").val(),
						"marca" : $("#marca").val(),
						"modelo" : $("#modelo").val(),
						"serie" : $("#serie").val(),
						"clave" : $("#clave").val(),
						"valor" : $("#valor").val(),
						"diagnostico" : $("#diagnostico").val(),
						"detalle" : $("#detalle").val(),
						"atendidopor" : $("#quien").val()
		};
		$.ajax({
						data:  parametros,
						url:   'api/procesarorden.php',
						type:  'post',
						success:  function (response) {
							$('.alertorder').show();
							$('.alertorder span').text(response);
							printOrder();
						}
		});
	}

	function getOrder() {
		$.post("api/getnumorder.php", {}, function(mensaje) {
			$("#numorder").text("N??"+mensaje);
			$("#numorder").show();
			$(".btnOrder").hide();
			nuevaorden();
			guardarCliente();
		});
	}
  </script>

</head>

	<body id="newOrder" class="bg-blue">
		<?php
		include "api/navbar.php"
		 ?>
		<div class="body">
			<form id="formOrden" action="" id="sky-form" class="sky-form" />
				<header>Orden de Servicio T??cnico <span id="numorder" style="display:none"></span></header>
				<fieldset>
					<div class="row">
						<section class="col col-6">
							<label class="input">
								<i class="icon-append fa-user"></i>
								<label for="nombre" style="display:none" class="text">Nombre</label>
								<input type="text" id="nombre" name="nombre" placeholder="Nombre" onfocusout="$('.tooltiptext').hide()"/><span class="tooltiptext">Proba con un segundo nombre</span>
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<i class="icon-append fa-user-o"></i>
								<label for="apellido" style="display:none" class="text">Apellido</label>
								<input type="text" id="apellido" name="apellido" placeholder="Apellido" onfocusout="searchCliente()" />
							</label>
						</section>
					</div>

					<div class="row">
						<section class="col col-6">
							<label class="input">
								<i class="icon-append fa-phone"></i>
								<label for="telefono" style="display:none" class="text">Telefono</label>
								<input type="tel" id="telefono" name="telefono" placeholder="Telefono" />
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<i class="icon-append fa-envelope"></i>
								<label for="email" style="display:none" class="text">Email</label>
								<input type="email" id="email" name="email" placeholder="Email" />
							</label>
						</section>
					</div>

					<div class="row" id="alerta_cliente">
						<div style="margin-bottom:20px" class="alertclient">
							<span id="mensaje_alert" style="display:block"></span>
							<a href="#" onclick="vaciarCliente();$('.alertclient').hide();$('#nombre').focus();$('.tooltiptext').show()" style="margin-right:30px"><span style="display:inline">Cancelar</span></a>
							<a href="#" onclick="$('.alertclient').hide();$('#marca').focus()"><span style="display:inline">Aceptar</span></a>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="row">
						<section class="col col-6">
              <label class="select">
								<label for="marca" style="display:none" class="text">Marca</label>
								<select name="marca" id="marca">
									<option value="0" selected="" disabled="" />Marca
									<option value="apple" />Apple
									<option value="samsung" />Samsung
									<option value="motorola" />Motorola
									<option value="sony" />Sony
									<option value="lg" />LG
                  <option value="huawei" />Huawei
                  <option value="nokia" />Nokia
									<option value="nokia" />HTC
									<option value="nokia" />Alcatel
									<option value="nokia" />BGH
									<option value="nokia" />BLU
								</select>
  						</label>
            </section>
            <section class="col col-6">
							<label class="input">
								<i class="icon-append fa-mobile"></i>
								<label for="modelo" style="display:none" class="text">Modelo</label>
								<input type="text" name="modelo" id="modelo" placeholder="Modelo" />
							</label>
            </section>
          </div>
          <div class="row">
            <section class="col col-6">
							<label class="input">
								<i class="icon-append fa-barcode	"></i>
								<label for="serie" style="display:none" class="text">Serie</label>
								<input type="text" name="serie" id="serie" placeholder="Serie" />
							</label>
						</section>
            <section class="col col-6">
							<label class="input">
								<i class="icon-append fa-lock"></i>
								<label for="clave" style="display:none" class="text">Clave de bloqueo</label>
								<input type="text" name="clave" id="clave" placeholder="Clave de bloqueo" />
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
						<section class="col col-6">
              <label class="toggle state-success"><input type="checkbox" name="sim" /><i></i>Lapiz optico</label>
						</section>
          </div>
          <div class="row">
            <section class="col col-6">
							<label class="input">
								<i class="icon-append fa-user-md"></i>
								<label for="diagnostico" style="display:none" class="text">Diagnostico</label>
								<input type="text" name="diagnostico" id="diagnostico" placeholder="Diagnostico" />
							</label>
						</section>
            <section class="col col-6">
							<label class="input">
								<i class="icon-append fa-money"></i>
								<label for="valor" style="display:none" class="text">Valor estimado</label>
								<input type="text" name="valor" id="valor" placeholder="Valor" />
							</label>
						</section>
					</div>
					<section>
						<label class="textarea">
							<i class="icon-append icon-comment"></i>
							<label for="detalle" style="display:none" class="text">Detalle de reparaci??n</label>
							<textarea name="detalle" id="detalle" placeholder="Ingrese detalle de reparacion" rows="3" cols="40"></textarea>
						</label>
					</section>
          <div class="row">
            <section class="col col-3">
							<label class="input">
								<i class="icon-append fa-user"></i>
								<label for="quien" style="display:none" class="text">Atendido por</label>
								<input type="text" name="quien" id="quien" placeholder="atendido por" />
							</label>
						</section>
						<section class="col col-9 info" style="display:none"><br>
							<p>Consulte el estado de su equipo en <b>www.solucel.com.ar/serviciotecnico</b>, por telefono al 011-3220-2187 o enviando un email a serviciotecnico@solucel.com.ar</p>
							<p>Tucuman 536 local 415 y 416 Galerias Jardin</p>
						</section>
        	</div>
				</fieldset>
				<footer>
					<button type="button" onclick="getOrder();" class="button">Ingresar</button>
					<div id="mensajeimpresion" style="display:none">
						<h6 class="text-center">Condiciones generales</h3>
						<ol>
							<li>El producto se entregar?? ??nicamente con la presentaci??n de la orden de reparaci??n.</li>
							<li>Las reparaciones tienen garant??a por un lapso de treinta (30) d??as a partir de la fecha de entrega y s??lo se aplica a las partes cambiadas.</li>
							<li>Pasados los 90 (Noventa) d??as de la recepci??n, el equipo sin retirar ser?? considerado abandonado, perdiendo todo derecho sobre el mismo. Art 2525-2526-3939 del c??digo civil, quedando Solucell SRL facultado para disponer de dicho equipo.</li>
							<li>Solucell SRL se declara no responsable de la mercaderia descripta, asumiendo s??lo la reparaci??n de la misma, deslig??ndose de toda responsabilidad del origen o ingreso a plaza de dicha mercaderia.</li>
							<li>El resguardo o Back-Up de la informaci??n es de ??nica responsabilidad del cliente.</li>
							<li>No se comprueba el funcionamiento total  y de ninguna de sus partes.</li>
							<li>Pasado los 30 d??as de la fecha de entrega se cobrara a razon de $25 (veintcinco pesos) por d??a de demora en concepto de deposito y seguro del equipo.</li>
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
								<p style="border-top: 1px solid black; text-align:center">Aclaraci??n</p>
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
								<p style="border-top: 1px solid black; text-align:center">Recib?? conforme</p>
							</div>
							</div>
						</div>
				</footer>
			</form>
		</div>

		<script type="text/javascript">
			$(function()
			{
				// Datepickers
				$('#start').datepicker({
					dateFormat: 'dd.mm.yy',
					prevText: '<i class="icon-chevron-left"></i>',
					nextText: '<i class="icon-chevron-right"></i>',
					onSelect: function( selectedDate )
					{
						$('#finish').datepicker('option', 'minDate', selectedDate);
					}
				});
				$('#finish').datepicker({
					dateFormat: 'dd.mm.yy',
					prevText: '<i class="icon-chevron-left"></i>',
					nextText: '<i class="icon-chevron-right"></i>',
					onSelect: function( selectedDate )
					{
						$('#start').datepicker('option', 'maxDate', selectedDate);
					}
				});

				// Validation
				$("#sky-form").validate(
				{
					// Rules for form validation
					rules:
					{
						name:
						{
							required: true
						},
						email:
						{
							required: true,
							email: true
						},
						phone:
						{
							required: true
						},
						interested:
						{
							required: true
						},
						budget:
						{
							required: true
						}
					},

					// Messages for form validation
					messages:
					{
						name:
						{
							required: 'Please enter your name'
						},
						email:
						{
							required: 'Please enter your email address',
							email: 'Please enter a VALID email address'
						},
						phone:
						{
							required: 'Please enter your phone number'
						},
						interested:
						{
							required: 'Please select interested service'
						},
						budget:
						{
							required: 'Please select your budget'
						}
					},

					// Do not change code below
					errorPlacement: function(error, element)
					{
						error.insertAfter(element.parent());
					}
				});
			});
		</script>
	</body>
</html>
