<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seguimiento de reparacion</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../app/js/semantic.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/76ff5bbde3.js"></script>
    <script src="js/funciones.js"></script>


    <link rel="stylesheet" href="../app/css/semantic.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../app/css/demo.css" />
		<link rel="stylesheet" href="../app/css/sky-forms.css" />
		<link rel="stylesheet" href="../app/css/sky-forms-blue.css" />


  </head>
  <body class="bg-blue">
    <div class="container">
      <div style="margin-top:150px;text-align:center" class="col-md-6 col-md-offset-3">
        <form action="procesarbusqueda.php" method="post">
          <input class="form-control" type="text" name="orden" id="orden" value="" placeholder="Numero de orden">
          <br>
          <input class="form-control" type="text" name="email" id="email" value="" placeholder="Email">
          <br>
          <input class="btn btn-success" type="button" onclick="procesarbusqueda()" name="button" value="Seguir">
          <br>
          <p id="mensaje" style="display:none">Numero de orden o email incorrectos</p>
        </form>
      </div>
    </div>
  </body>
</html>
