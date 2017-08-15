	</div><!-- fin #wrapper -->
	
	<!-- <script src="<?php //echo base_url('public/js/jquery-3.2.1.min.js'); ?>"></script> -->
	
	<?php if (isset($js_files)): ?>
			<?php foreach($js_files as $file): ?>
    			<script src="<?php echo $file; ?>"></script>
			<?php endforeach; ?>
	<?php elseif ($this->router->method =='crear'): ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url('public/js/jquery.validate.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/js/Subasta.js'); ?>"></script>
	<?php elseif ($this->router->method =='Actualizar'): ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url('public/js/actualizar.js'); ?>"></script>
	<?php endif; ?>

</body>
</html>