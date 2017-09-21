<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="HandheldFriendly" content="true">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?php echo $titlePage; ?></title>
	<link href="<?php echo base_url('public/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('public/css/custom-bootstrap-margin-padding.css'); ?>" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
	<link href="<?php echo base_url('public/css/lat-menu.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('public/css/admin-index.css'); ?>" rel="stylesheet" type="text/css">
	<?php if($this->router->method == "login"): ?>
		<link href="<?php echo base_url('public/css/login.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif($this->router->method == "index" || $this->router->method=="product" || $this->router->method=="CrearEditar"): ?>
		<link href="<?php echo base_url('public/css/lat-menu.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('public/css/admin-index.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif($this->router->method == "administrar_subastas"): ?>
		<link href="<?php echo base_url('public/css/lat-menu.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('public/css/subastas-admin.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif($this->router->method == "citas"): ?>
		<link href="<?php echo base_url('assets/fullcalendar/fullcalendar.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/fullcalendar/fullcalendar.print.min.css'); ?>" rel='stylesheet' media='print' />
		<link href="<?php echo base_url('public/css/citas.css'); ?>" rel="stylesheet" type="text/css">
	<?php elseif($this->router->method == "solicitudes"): ?>
		<link href="<?php echo base_url('public/css/solicitudes.css'); ?>" rel="stylesheet" type="text/css">
	<?php endif; ?>
	<!-- <link href="<?php //echo base_url('public/css/misc.css'); ?>" rel="stylesheet" type="text/css"> -->
	<?php if (isset($css_files)): ?>
	    <!-- grocerycrud -->
	    <?php foreach($css_files as $file): ?>
	        <link rel="stylesheet" type="text/css" href="<?php echo $file; ?>" />
	    <?php endforeach; ?>
	<?php endif; ?>
	<?php if($this->router->method == "transacciones"): ?>
		<link href="<?php echo base_url('public/css/admin-transacciones.css'); ?>" rel="stylesheet" type="text/css">
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
<!-- <div id="wrapper"> -->
