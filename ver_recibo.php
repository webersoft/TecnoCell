<html lang="es">
<head>
	<link rel="stylesheet" href="css/recibo.css">
</head>

<body>

  <?php

    include 'api/conexion.php';

    $recibo = mysqli_query($conexion, "select * from recibos where id = '$_GET[id]'");
    $recibo = mysqli_fetch_array($recibo);

    $conceptos = mysqli_query($conexion, "SELECT * FROM contenido_recibos WHERE id_recibo = '$_GET[id]'");

   ?>
	<div id="botonera">
		<button onClick="javascript:window.print();">Imprimir</button>
	</div>

	<div id="page1">

		<div class="bordeRecibo">
			<header>

				<!-- Lado Izquierdo -->
				<div class="column left">
					<div class="container">
						<div class="row text-left">
							<img src="img/tecno.png" alt="logo" style="height:45px; whidth:208px; margin-top: 20px;margin-bottom : 15px">
						</div>

						<div class="row text-left negrita h3">TencoCell Servicio Tecnico</div>
						<div class="row text-left h3">Direccion</div>
						<div class="row text-left h3">Telefono</div>
					</div>
				</div>

				<!-- Lado Central -->
				<div class="column center text-center"> <span id="tipoComprobante">X</span>
					<br>
					<span id="leyendaTipoComprobante" class="preimpreso">DOCUMENTO<br>NO VALIDO<br>COMO<br>FACTURA</span>
				</div>

				<!-- Lado Derecho -->
				<div class="column right">
					<div class="container">
						<div id="lblComprobante" class="row text-center negrita h1">RECIBO</div>
						<div id="lblNroCmp" class="row text-center negrita h2"><span class="preimpreso">Nro</span> <?php echo $recibo['numero']; ?></div>
						<div class="row text-center h3">ORIGINAL</div>
						<div class="row text-center h3">&nbsp;</div>
						<div class="row text-left h3">FECHA <span class="pull-right"><?php echo $recibo['fecha']; ?></span></div>
						<div class="row text-left h3">CUIT <span class="pull-right">22-22222222-2</span></div>
					</div>
				</div>
			</header>

			<section><?php echo $recibo['fecha']; ?>
				<br>
				<br>
				<span class="preimpreso">Recibimos de </span> <?php echo $recibo['razon_social']; ?> <span class="preimpreso">CUIT </span> <?php echo $recibo['cuit']; ?>
				<br>
				<span class="preimpreso">la cantidad de </span><span id="importeEnLetras">QUINIENTOS CUARENTA Y CINTO MIL PESOS</span>
			</section>

			<section id="sectionMedioPago">
				<span class="preimpreso">Mediante</span>
				<div class="row">
					<span><?php echo $recibo['formapago']; ?></span>
					<span class="pull-right negrita importeEnPesos"><?php echo $recibo['total']; ?></span>
				</div>
			</section>

			<section>
				<span class="preimpreso">En concepto de</span>
        <?php while($reg = mysqli_fetch_array($conceptos)) {
            $string = mysqli_query($conexion, "SELECT * FROM conceptos WHERE id = '$reg[id_concepto]'");
            $string = mysqli_fetch_array($string);
        ?>
				<div class="row">
					<span><?php echo $string['concepto']; ?></span>
					<span name="a" class="pull-right negrita importeEnPesos"><?php echo $reg['valor']; ?></span>
				</div>
        <?php } ?>
			</section>

			<footer>

				<section id="son"> <span class="preimpreso">TOTAL:</span>
					<output id="totalRecibo" class="negrita importeEnPesos"><?php echo $recibo['total']; ?></output>
				</section>

				<section id="firma">
					<div id="hr" class="pull-right">&nbsp;</div>
					<p class="text-right">Mi Empresa</p>
				</section>

			</footer>
		</div><!-- bordeRecibo -->
	</div><!-- Page1 -->
	<script src="js/jquery-1.9.1.min.js" charset="utf-8"></script>
	<script src="js/angular.min.js" charset="utf-8"></script>
	<script src="js/numerosaletras.js" charset="utf-8"></script>
<script>
$(document).ready(function($) {
  $("#importeEnLetras").text(NumeroALetras(<?php echo $recibo['total']; ?>))
});
</script>
</body>
</html>
