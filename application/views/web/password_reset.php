<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="HandheldFriendly" content="true">
        <link href="<?php echo base_url('public/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('public/css/custom-bootstrap-margin-padding.css'); ?>" rel="stylesheet" type="text/css">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo $titlePage; ?></title>
    </head>
    <body>
        <div class="container">
          <div class="row">
                <div class="col-md-offset-3 ">     
                    <div class="col-sm-12 col-md-3 ml-50">
                        <img class="pl-40"src="<?php echo base_url('public/img/logo2.png'); ?>" class="img-responsive">
                    </div>
                    <div class="col-md-12 mt-40 ml-50">
                        <div class="well col-md-5" style=" box-shadow: 2px 2px 5px #999;">
                            <div class="mb-30" >
                                <h1>Cambio contraseña</h1>
                                <p><?php echo $msg; ?></p>
                            </div>
                            <button class="btn btn-success "><a href="<?php echo base_url('login'); ?>">Iniciar sesion</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>