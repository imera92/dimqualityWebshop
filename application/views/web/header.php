<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="HandheldFriendly" content="true">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?php echo $titlePage; ?></title>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="<?php echo base_url('public/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('public/css/custom-bootstrap-margin-padding.css'); ?>" rel="stylesheet" type="text/css">
	<?php if ($this->router->method == 'compraExitosa'): ?>
		<link href="<?php echo base_url('public/css/footer-bottom.css'); ?>" rel="stylesheet" type="text/css">
	<?php else: ?>
		<link href="<?php echo base_url('public/css/footer.css'); ?>" rel="stylesheet" type="text/css">
	<?php endif; ?>
	<link href="<?php echo base_url('public/css/header.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('public/css/misc.css'); ?>" rel="stylesheet" type="text/css">
	<?php if ($this->router->method == 'index'): ?>
		<link href="<?php echo base_url('public/css/index.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'login'): ?>
		<link href="<?php echo base_url('public/css/login.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'actualizarUsuario'): ?>
		<link href="<?php echo base_url('public/css/actualizarUsuario.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'comprarProductos'): ?>
		<link href="<?php echo base_url('public/css/comprarProductos.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'compraExitosa'): ?>
		<link href="<?php echo base_url('public/css/compraExitosa.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'crearUsuario'): ?>
		<link href="<?php echo base_url('public/css/crearUsuario.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'carrito'): ?>
		<link href="<?php echo base_url('public/css/jquery.fs.stepper.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('public/css/carrito.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'getProducto'): ?>
		<link href="<?php echo base_url('public/css/producto.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'buscarProductos'): ?>
		<link href="<?php echo base_url('public/css/busqueda.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'recuperarContrasena'): ?>
		<link href="<?php echo base_url('public/css/recuperarContasena.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'ChangePassword'): ?>
		<link href="<?php echo base_url('public/css/changePassword.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'verEstadoTransacciones'): ?>
		<link href="<?php echo base_url('public/css/verEstadoTransacciones.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'subastas'): ?>
		<link href="<?php echo base_url('public/css/subastas.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'ofertarsubasta'): ?>
		<link href="<?php echo base_url('public/css/subasta.css'); ?>" rel="stylesheet" type="text/css">
	<?php endif; ?>
	<script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';

        var js_site_url = function( urlText ){
            var urlTmp = "<?php echo site_url('" + urlText + "'); ?>";
            return urlTmp;
        }

        var js_base_url = function( urlText ){
            var urlTmp = "<?php echo base_url('" + urlText + "'); ?>";
            return urlTmp;
        }
    </script>

</head>
<body>
	<div class="container-fluid">
		<div id="navbar" class="row">
			<div class="col-xs-12 pl-0 pr-0">
				<nav class="navbar navbar-default mb-0">
					<div class="container-fluid">
						<div class="navbar-header">
					      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menubar-collapse" aria-expanded="false">
					        	<span class="sr-only">Toggle navigation</span>
					        	<span class="icon-bar"></span>
					        	<span class="icon-bar"></span>
					        	<span class="icon-bar"></span>
					    	</button>
					    </div>
						<div class="collapse navbar-collapse" id="menubar-collapse">
							<ul class="nav navbar-nav">
								<li><a href="<?php echo base_url(); ?>">INICIO</a></li>
								<li><a href="#">SERVICIO TECNICO</a></li>
								<li class="dropdown">
									<?php if (!is_null($this->session->user)): ?>
										<a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span><?php echo $this->session->user; ?><span class="caret"></span></a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											<li><a href="<?php echo base_url('actualizar'); ?>">Actualizar Datos</a></li>
											<li><a href="<?php echo base_url('transacciones'); ?>">Transacciones</a></li>
				 							<li><a href="<?php echo base_url('logout'); ?>">Cerrar Sesión</a></li>
										</ul>
									<?php else: ?>
										<a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>CUENTA<span class="caret"></span></a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				  							<li><a href="<?php echo base_url('registro') ?>">Registrarte</a></li>
				 							<li><a href="<?php echo base_url('login'); ?>">Iniciar Sesión</a></li>
										</ul>
									<?php endif; ?>
								</li>
								<li><a href="<?php echo base_url('usuario/subastas'); ?>"><span  class="glyphicon glyphicon-gift"></span> SUBASTAS</a></li>

								<li><a href="<?php echo base_url('carrito'); ?>"><span  class="glyphicon glyphicon-shopping-cart"></span> CARRITO</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
		<div class="container">
			<div id="header" class="row mt-40">
				<div class="col-sm-4 col-md-2">
					<img src="<?php echo base_url('public/img/logo2.png'); ?>" class="img-responsive">
				</div>
				<div class="col-sm-4 col-md-5 col-md-offset-1">
					<form id="formBusqueda" action="<?php echo base_url('web/buscarProductos'); ?>" method="GET">
						<div class="input-group">
							<input type="text" id="terminoBusqueda" name="t" value="" placeholder="Buscar un producto..." class="form-control input-lg">
							<span class="input-group-btn">
								<button id="botonBusqueda" type="button" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					</form>
				</div>
				<div class="col-sm-4 col-md-3 col-md-offset-1">
					<div class="row">
						<div class="col-sm-1 col-md-3">
							<img src="<?php echo base_url('public/img/phone.png'); ?>" class="img-responsive">
						</div>
						<div class="col-md-5">
							<h4>CONTACTENOS: 04)292-2763</h4>
						</div>
					</div>
				</div>
			</div>
