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
	<link href="<?php echo base_url('public/css/header.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('public/css/footer.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('public/css/misc.css'); ?>" rel="stylesheet" type="text/css">
	<?php if ($this->router->method == 'login'): ?>
		<link href="<?php echo base_url('public/css/login.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif ($this->router->method == 'crearUsuario'): ?>
		<link href="<?php echo base_url('public/css/crearUsuario.css'); ?>" rel="stylesheet" type="text/css">
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
		<div id="header">
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
									<li><a href="#">INICIO</a></li>
									<li><a href="#">SERVICIO TECNICO</a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>CUENTA<span class="caret"</span></a>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				  							<li><a href="#">Registrarte</a></li>
				 							<li><a href="#">Iniciar Sesion</a></li>
										</ul>
									</li>
									<li><a href="#"><span  class="glyphicon glyphicon-shopping-cart"></span> CARRITO</a></li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>