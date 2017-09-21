</div><!-- fin #wrapper -->

	<!-- <script src="<?php //echo base_url('public/js/jquery-3.2.1.min.js'); ?>"></script> -->
	<script  src="http://code.jquery.com/jquery-1.11.1.min.js"  integrity="sha256-VAvG3sHdS5LqTT+5A/aeq/bZGa/Uj04xKxY8KM/w9EE=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('public/js/bootstrap.min.js'); ?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
	<?php if (isset($js_files)): ?>
			<?php foreach($js_files as $file): ?>
    			<script src="<?php echo $file; ?>"></script>
			<?php endforeach; ?>
	<?php elseif ($this->router->method =='create_subasta'): ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url('public/js/jquery.validate.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/js/create_subasta.js'); ?>"></script>
	<?php elseif ($this->router->method =='update_subasta'): ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/
		bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url('public/js/jquery.validate.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/js/update_subasta.js'); ?>"></script>
	<?php endif; ?>
	<?php if($this->router->method == 'administrar_subastas'): ?>
		<script src="<?php echo base_url('public/js/administrar_subastas.js'); ?>"></script>
	<?php endif; ?>
	<?php if($this->router->method == "citas"): ?>
		<script src="<?php echo base_url('public/js/jquery-3.2.1.min.js'); ?>"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
		<script src="<?php echo base_url('assets/fullcalendar/fullcalendar.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/js/citas.js'); ?>"></script>
	<?php endif; ?>
	<?php if($this->router->method == "solicitudes"): ?>
		<script src="<?php echo base_url('public/js/jquery-3.2.1.min.js'); ?>"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/
		bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url('public/js/solicitudes.js'); ?>"></script>
	<?php endif; ?>

</body>
</html>
