	</div>
	<div id="footer" class="row pt-40 pb-40">
		<div class="col-md-12">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-0 col-sm-2 col-sm-offset-1 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1">
					<span class="bold-text">¡SIGUENOS!</span>
					<div class="row">
						<div class="col-md-4">
							<a href=""><img class="img-responsive" src="http://icons.iconarchive.com/icons/limav/flat-gradient-social/256/Twitter-icon.png"></a>
						</div>
						<div class="col-md-4">
							<a href=""><img class="img-responsive" src="https://facebookbrand.com/wp-content/themes/fb-branding/prj-fb-branding/assets/images/fb-art.png"></a>
						</div>
					</div>						
				</div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 mt-xs-20">
					<span class="bold-text">INFORMACION ADICIONAL</span>
					<br>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</div>
			</div>
		</div>
	</div>

	<!-- <script src="<?php //echo base_url('public/js/jquery-3.2.1.min.js'); ?>"></script> -->
	<script  src="http://code.jquery.com/jquery-1.11.1.min.js"  integrity="sha256-VAvG3sHdS5LqTT+5A/aeq/bZGa/Uj04xKxY8KM/w9EE=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('public/js/bootstrap.min.js'); ?>"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
    <script src="<?php echo base_url('public/js/busqueda.js'); ?>"></script>
	<?php if ($this->router->method == 'crearUsuario'): ?>
		<script src="<?php echo base_url('public/js/jquery.validate.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/js/crearUsuario.js'); ?>"></script>
	<?php elseif ($this->router->method == 'actualizarUsuario'): ?>
		<script src="<?php echo base_url('public/js/jquery.validate.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/js/actualizarUsuario.js'); ?>"></script>
	<?php elseif ($this->router->method == 'comprarProductos'): ?>
		<script src="<?php echo base_url('public/js/comprarProductos.js'); ?>"></script>
	<?php elseif ($this->router->method == 'recuperarContrasena'): ?>
		<script src="<?php echo base_url('public/js/recuperar.js'); ?>"> var base_url = '<?php echo base_url(); ?>';  </script>
	<?php elseif ($this->router->method == 'ChangePassword'): ?>
		<script src="<?php echo base_url('public/js/jquery.validate.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/js/RenovarContrasena.js'); ?>">var base_url = '<?php echo base_url(); ?>';</script>
	<?php elseif ($this->router->method == 'carrito'): ?>
		<script src="<?php echo base_url('public/js/jquery.fs.stepper.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/js/carrito.js'); ?>"></script>
	<?php elseif ($this->router->method == 'ofertarsubasta'): ?>
		
		<script src="<?php echo base_url('public/js/ofertar.js'); ?>"></script>
	<?php endif; ?>
</body>
</html>
