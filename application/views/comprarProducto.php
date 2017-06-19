<!DOCTYPE html> 
<html>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script type="text/javascript" src="<?php echo base_url("public/js/jQuery-3.2.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/bootstrap.js"); ?>"></script>
<head>
	<meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
  		.pos {float:left;}
	</style>
</head>
<body>
	<div class='container'>
    <div class="row">
      <div class="col-md-12">
          <h1>Carrito de compras-----------------------------------------------------</h1>
      </div>
    </div>
    <div class="row">
      <div class>
	  <div class="pos" id="imagen1">
		<img src="https://s3.amazonaws.com/poderpda/2016/09/Xperia-XZ_forestBlue.png" WIDTH=320 HEIGHT=240> 
	  </div class="pos"
          <div class="pos">
            <h4>Xperia XZ</h4>
            <div class="pos">
                <label for="precio">Precio 
			<input name="precio" placeholder="$600" readonly="readonly"/>
		</label><br></br>
                <label for="stock">Stock 
			<input name="stock" placeholder="103" readonly="readonly"/>
		</label><br></br>
                <label for="caracteristicas">Caracteristicas </label><br></br>		
                <input type="caracteristica1" name="caracteristica1" placeholder="Pantalla 5.5 Pulgadas 4K Resolucion 3840 x 2160 pixels" size="50" readonly="readonly"/><br></br>
		<input type="caracteristica2" name="caracteristica2" placeholder="Android 7.0 Nougat" size="50" readonly="readonly"/><br></br>
		<b><a href="url"> Mas informacion </a></b> 
		</div class="pos">
		<div class="pos">
		
          </div>
	<div align="center">
		<label for="cantidad">Cantidad 
			<input name="cantidad" placeholder="1" readonly="readonly" size="2"/>
		</label>
		<button class="eliminar"><i class="material-icons">delete</i></button>

	</div>
  </div>
</div>
<div><br><br>
	<h2> Total </h2> <input type="total" name="total" placeholder="$600" size="5" readonly="readonly"/>
	</div>
<div><br><br>
	<h3> Datos de la entrega </h2>
	<input type="radio" name="local" value="1">Retiro en Local </input>
	<input type="radio" name="domicilio" value="1">Entrega a Domicilio </input>

</div>

<div><br><br>
	<h3> Forma de Pago </h2>
	<input type="radio" name="deposito" value="1">Deposito </input>
	<input type="radio" name="transferencia" value="1">Transferencia </input>
</div>

<div> <br><br>
	<b> Posterior a la compra, nos pondremos en contacto con usted para concretar la transacción.
Deberá enviar pruebas (foto o captura de pantalla del comprobante) que respalden el pago realizado para efectuar la compra </b>
<div>

<br><input class="btn btn-primary" type="submit" name="proceder" value="Proceder" /> </input class="pos"> 

</body>
</html>
