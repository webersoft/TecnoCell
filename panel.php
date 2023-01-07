<!DOCTYPE html>
<html>
	<head>
		<title>Panel de control - Solucel</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

		<link rel="stylesheet" href="css/demo.css" />
		<link rel="stylesheet" href="css/sky-forms.css" />
		<link rel="stylesheet" href="css/sky-forms-blue.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="css/semantic.min.css">
		<link rel="stylesheet" type="text/css" href="css/imprimir.css" media="print" />
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="css/sky-forms-ie8.css">
		<![endif]-->

		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="https://use.fontawesome.com/ef241c16b6.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="js/funciones.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="https://use.fontawesome.com/ef241c16b6.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!--[if lt IE 10]>
			<script src="js/jquery.placeholder.min.js"></script>
		<![endif]-->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/sky-forms-ie8.js"></script>
		<![endif]-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script>
		function elegirUsuario() {
			var tipo_usuario = $("#tipo_usuario").val();

			if(tipo_usuario == "solucel") {
				$("#user_solucel").show();
				$("#btn_solucel").show();
				$("#user_otro").hide();
				$("#btn_otro").hide();
			} else {
				$("#user_otro").show();
				$("#btn_otro").show();
				$("#user_solucel").hide();
				$("#btn_solucel").hide();
			}
		}

		function insertarUsuario(tipo) {
			if(tipo == "solucel") {
				var form = $('#form_solucel')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);
			} else {
				var form = $('#form_otro')[0]; // You need to use standard javascript object here
				var formData = new FormData(form);
			}

					$.ajax({
		    url: 'api/insertar_usuario.php',
		    data: formData,
		    type: 'POST',
		    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
		    processData: false, // NEEDED, DON'T OMIT THIS
				success:  function (response) {
								alert("Usuario ingresado");
								location.reload();
				}
			});
		}

  </script>

	<?php

		include 'api/conexion.php';

		$usuarios = mysqli_query($conexion, "SELECT * FROM usuarios");

	 ?>

</head>

	<body id="panel" class="bg-blue">
		<?php
		 include "api/navbar.php"
		 ?>
		<div class="body">
			<form id="form_solucel" class="sky-form">
				<header>Panel de usuarios</header>
		<div class="body">
				<fieldset>
					<div class="row">
						<section class="col col-6">
              <label class="select">
								<label for="marca"class="text">Nuevo usuario</label>
								<select onchange="elegirUsuario();" id="tipo_usuario">
                  <option value="0" selected="" disabled="" />Seleccionar
									<option value="solucel"/>Usuario de solucel
									<option value="otro"/>Usuario franquiciado
								</select>
  						</label>
						</section>
					</div>
				</fieldset>
				<fieldset>
					<div style="display:none" class="row" id="user_solucel">

						<section class="col col-6">
              <label class="input">
								<i class="icon-append fa-mobile"></i>
								<input type="text" name="usuario_solucel" id="usuario_solucel" placeholder="Usuario" />
								<input type="hidden" name="type_user" id="type_user" value="solucel">
							</label>
						 </section>
            <section class="col col-6">
							<label class="input">
								<i class="icon-append fa-mobile"></i>
								<input type="text" name="password_solucel" id="password_solucel" placeholder="Password" />
							</label>
            </section>
					</form>
					</div>
          <div style="display:none" id="user_otro">
						<form id="form_otro">
          <div class="row">
            <section class="col col-6">
							<label class="input">
								<i class="icon-append fa-barcode	"></i>
								<input type="text" name="usuario_otro" id="usuario_otro" placeholder="Usuario" />
								<input type="hidden" name="type_user" id="type_user" value="otro">
							</label>
						</section>
            <section class="col col-6">
							<label class="input">
								<input type="text" name="password_otro" id="password_otro" placeholder="Password" />
							</label>
						</section>
          </div>
          <div class="row">
            <section class="col col-6">
							<label class="input">
								<input type="text" name="email_otro" id="email_otro" placeholder="Email" />
							</label>
						</section>
            <section class="col col-6">
							<label class="input">
								<i class="icon-append fa-money"></i>
								<input type="text" name="tel_otro" id="tel_otro" placeholder="Telefono" />
							</label>
						</section>
					</div>
					<div class="row">
            <section class="col col-6">
							<label class="input">
								<i class="icon-append fa-user-md"></i>
								<input type="text" name="direccion_otro" id="direccion_otro" placeholder="Direccion" />
							</label>
						</section>
					</div>
					<div class="row">
						<section class="col col-6">
							<div id="dropzone">
                <div>Haga click aqui para cargar un logo o arrastrelo.</div>
                <input type="file" name="myimage" id="myimage" accept="image/png, image/jpg, image/jpeg, application/pdf" />
              </div>
						</section>
					</div>
				</form>
					 </div>
				</fieldset>
				<footer>
					<button type="button" style="display:none" id="btn_solucel" onclick="insertarUsuario('solucel');" class="button">Ingresar</button>
					<button type="button" style="display:none" id="btn_otro" onclick="insertarUsuario('otro');" class="button">Ingresar</button>
				</footer>

				<div style="margin-top:100px" class="table-responsive">
	        <table style="color:black;font-family:'Open Sans'" class="ui unstackable red table">
	          <thead>
	            <tr>
	              <th>Usuario</th>
	              <th>Telefono</th>
	              <th>Email</th>
	              <th>Direccion</th>
	            </tr>
	          </thead>
	          <tbody>
	            <?php
	              while($reg = mysqli_fetch_array($usuarios)) {
	                echo "<tr>";
	                echo "<td>$reg[usuario]</td>";
	                echo "<td>$reg[telefono]</td>";
	                echo "<td>$reg[email]</td>";
	                echo "<td>$reg[direccion]</td>";
	                echo "</tr>";
	              }
	             ?>
	          </tbody>
	        </table>
	      </div>
			</div>
		</div>

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
