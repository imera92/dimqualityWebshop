	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-4 col-md-offset-4">
		        <div class="login-panel">
		            <div class="panel-heading text-center">
		                <img class="img-responsive" src="<?php echo base_url('public/img/logo.jpg'); ?>">
		                <br>
		                <h4 class="panel-title">Por favor ingrese su usuario y contraseña:</h4>
		                <br>
		            </div>
		            <div class="panel-body">
		                <?php echo form_open('admin/auth' , array('class' => 'form-horizontal', 'id' => 'frm-login')); ?>  
		                    <fieldset>
		                        <div class="input-group">
		                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		                            <?php echo form_input(array(
		                                'name' => 'user',
		                                'value' => '',
		                                'placeholder' => 'Usuario',
		                                'class' => 'form-control',
		                            ));?>
		                        </div>
		                        <div class="clearfix"></div><br>
		                        <div class="input-group">
		                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		                            <?php echo form_password(array(
		                                'name' => 'password',
		                                'value' => '',
		                                'placeholder' => 'contraseña',
		                                'class' => 'form-control',
		                            ));?>
		                        </div>
		                        <div class="clearfix"></div><br>
		                        <div class="input-group">
		                            <button type="submit" class="btn btn-login">Iniciar sesión</button>
		                        </div>
		                    </fieldset>
		                <?php echo form_close(); ?>
		            </div>
		        </div>
		    </div>
		</div>
	</div>