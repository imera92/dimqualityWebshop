	    <div class="row mt-50 mb-50">
	        <div class="col-xs-10 col-xs-offset-1">
	            <h1>Iniciar sesión o Crear una cuenta</h1>
	            <hr>
	            <div class="row">
	            	<div class="col-xs-6">
	            		<h3>Iniciar sesión con una cuenta de usuario</h3>
	            		<hr class="secondary-separator">
	            		<p>Si usted ya tiene una cuenta con nosotros, por favor ingrese sus credenciales</p>
	            		<?php echo form_open('usuario/auth' , array('id' => 'frm-login')); ?>
	            			<fieldset>
		            			<div class="form-group">
		            			<label for="userInput">Usuario<span class="red">*</span></label>
		            				<?php echo form_input(array(
		                                'id' => 'userInput',
		                                'name' => 'user',
		                                'value' => '',
		                                'placeholder' => 'Ingrese su usuario',
		                                'class' => 'form-control',
		                            ));?>
		            			</div>
		            			<div class="form-group">
		            				<label for="passwordInput">Contraseña<span class="red">*</span></label>
		            				<?php echo form_password(array(
		            					'id' => 'passwordInput',
		                                'name' => 'password',
		                                'value' => '',
		                                'placeholder' => 'Ingrese su contraseña',
		                                'class' => 'form-control',
		                            ));?>
		            			</div>
		            			<button type="submit" class="btn btn-login">Iniciar sesión</button><span class="required">* Campo Requerido</span>
	            			</fieldset>
	            		<?php echo form_close(); ?>
	            	</div>
	            	<div class="col-xs-6">
	            		<h3>Crear una cuenta de usuario</h3>
	            		<hr class="secondary-separator">
	            		<p>Al crear una cuenta en nuestra tienda podrás comprar productos, ver y seguir el rastro de los pedidos de tu cuenta y más.</p>
	            		<a class="btn btn-login" href="<?php echo base_url('registro') ?>">Crear una cuenta</a>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>



