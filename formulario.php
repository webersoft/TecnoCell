<!DOCTYPE html>
<html>
	<head>
		<title>Carga de productos TecnoCell</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

		<link rel="stylesheet" href="css/demo.css" />
		<link rel="stylesheet" href="css/sky-forms.css" />
		<link rel="stylesheet" href="css/sky-forms-blue.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="css/sky-forms-ie8.css">
		<![endif]-->

		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="js/funciones.js"></script>
		<script src="https://use.fontawesome.com/ef241c16b6.js"></script>

	<!--[if lt IE 10]>
			<script src="js/jquery.placeholder.min.js"></script>
		<![endif]-->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/sky-forms-ie8.js"></script>
		<![endif]-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
	<body id="formulario" class="bg-blue">
		<?php
		include "api/navbar.php"
		 ?>
		<div class="body" style=" background-image: url(img/baner.png); background-repeat: no-repeat; background-position: bottom; background-size: contain;">
			<form enctype="multipart/form-data" action="envio_mail.php" method="post" id="sky-form" class="sky-form" />
				<header>Carga de productos TecnoCell</header>

				<fieldset>
					<div class="row">
						<section class="col col-6">
							<label class="input">
								<i class="icon-append icon-user"></i>
								<input type="text" name="name" placeholder="Nombre de Producto" />
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<i class="icon-append icon-user"></i>
								<input type="text" name="titulo" placeholder="Titulo para mercadolibre (60 caracteres)" />
							</label>
						</section>
					</div>

					<div class="row">
						<section class="col col-6">
							<label class="input">
								<i class="icon-append icon-briefcase"></i>
								<input type="text" name="cantidad_ml" placeholder="Stock para ML" />
							</label>
						</section>

						<section class="col col-6">
							<label class="input">
								<i class="icon-append icon-envelope-alt"></i>
								<input type="text" name="cantidad_web" placeholder="Stock para Web" />
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<i class="icon-append icon-phone"></i>
								<input type="text" name="precio" placeholder="Precio Normal" />
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<i class="icon-append icon-phone"></i>
								<input type="text" name="precio_oferta" placeholder="Precio oferta" />
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<i class="icon-append icon-phone"></i>
								<input type="text" name="url" placeholder="direccion url de imagen" />
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<button type="button" class="button" data-toggle="modal" data-target="#myModal">Subir imagenes</button>
							</label>
						</section>
					</div>
				</fieldset>

				<fieldset>
					<div class="row">
						<section class="col col-6">
							<label class="select">
								<select name="garantia">
									<option value="0" selected="" disabled="" />Garantia
									<option value="3" />3 meses
									<option value="6" />6 meses
									<option value="12" />12 meses
									<option value="defectos" />por defecto de fabricacion
									<option value="10" />10 dias de cambio
								</select>
								<i></i>
							</label>
						</section>
						<section class="col col-6">
							<label class="select">
								<select name="enoferta">
									<option value="0" selected="" disabled="" />oferta
									<option value="si" />si
									<option value="no" />no
									</select>
								<i></i>
							</label>
						</section>
					</div>


					<section>
						<label class="textarea">
							<i class="icon-append icon-comment"></i>
							<textarea rows="5" name="descript" placeholder="Descripcion del producto"></textarea>
						</label>
					</section>
					<section>
						<label class="textarea">
							<i class="icon-append icon-comment"></i>
							<textarea rows="5" name="claves" placeholder="palabras clave"></textarea>
						</label>
					</section>
				</fieldset>
				<footer>
					<input type="hidden" name="linksimg" value="" id="linksimg">
					<button type="submit" class="button">Enviar</button>
				</footer>
			</form>
		</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->


	</body>
</html>
