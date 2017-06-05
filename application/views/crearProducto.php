<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<title>Crear Producto</title>
    <link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.css"); ?>" />
    <style>
        .logo{
            width:10vw;
            height:15vh;
        }
        .btn{
            margin-left:1vw;
        }
       
    </style>
<body>
    
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>

        </div>
    </nav>
<div class='container'>
    <div class="row">
        <img src='/dimqualityWebshop/imagenes/logo.png'  class="img-circle logo col-md-12" >
                <div class="col-md-12">
                    <h1>Crear Producto</h1>
                    <h4>informacion del producto </h4>
                    <form class="col-md-8 well">
                        <div class="form-group col-md-6">
                            <label>Nombre</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name='nombre'>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Codigo</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name='codigo'>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Modelo</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name='modelo'>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Precio/costo</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name='precio'>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Marca</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name='marca'>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Ruta de imagen</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name='ruta'>
                        </div>
                        <div class="form-group col-md-11">
                            <label for="exampleTextarea">Descripcion</label>
                            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea name='descripcion'>
                        </div>
            
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button class="btn btn-danger">Cancelar</button>
                        
                    </form>
                </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url("public/js/jQuery-3.2.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/bootstrap.js"); ?>"></script>
</body>
</html>
