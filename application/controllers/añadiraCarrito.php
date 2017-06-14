<!DOCTYPE html>
<html>
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
          <h1>Catalogo</h1>
      </div>
    </div>
    <div class="row">
      <div class>
	  <div class="pos" id="imagen1">
		<img src="https://s3.amazonaws.com/poderpda/2016/09/Xperia-XZ_forestBlue.png" WIDTH=640 HEIGHT=480> 
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
		<input type="caracteristica3" name="caracteristica3" placeholder="Procesador Qualcomm MSM8998 Snapdragon 835" size="50" readonly="readonly"/><br></br>
		<input type="caracteristica4" name="caracteristica4" placeholder="3GB de Ram & 64 GB memoria interna" size="50" readonly="readonly"/><br></br>
	     </div class="pos">
		<div class="pos">
            	<input class="btn btn-primary" name="anadir" type="submit" value="Anadir a Carrito de compras" /> </div class="pos">
          </div>
  </div>
</div>


	<div class='container'>
    <div class="row">
    
    </div>
    <div class="row">
      <div class>
	  <div class="pos" id="imagen1">
		<img src="http://s7d2.scene7.com/is/image/SamsungUS/Pdpkeyfeature-sm-g935pzdaspr-600x600-C1-062016?$product-details-jpg$" WIDTH=640 HEIGHT=480> 
	  </div class="pos"
          <div class="pos">
            <h4>Samsung S7 Edge</h4>
            <div class="pos">
                <label for="precio">Precio 
			<input name="precio" placeholder="$450" readonly="readonly"/>
		</label><br></br>
                <label for="stock">Stock 
			<input name="stock" placeholder="45" readonly="readonly"/>
		</label><br></br>
                <label for="caracteristicas">Caracteristicas </label><br></br>		
                <input type="caracteristica1" name="caracteristica1" placeholder="Pantalla 5.5 Pulgadas 2K Resolucion 2440 x 1860 pixels" size="50" readonly="readonly"/><br></br>
		<input type="caracteristica2" name="caracteristica2" placeholder="Android 7.0 Nougat" size="50" readonly="readonly"/><br></br>
		<input type="caracteristica3" name="caracteristica3" placeholder="Procesador Exynos 8890 Octa 2.3GHz" size="50" readonly="readonly"/><br></br>
		<input type="caracteristica4" name="caracteristica4" placeholder="3GB de Ram & 32 GB memoria interna" size="50" readonly="readonly"/><br></br>
	     </div class="pos">
		<div class="pos">
            	<input class="btn btn-primary" name="anadir" type="submit" value="Anadir a Carrito de compras" /> </div class="pos">
          </div>
  </div>
</div>

</body>
</html>
