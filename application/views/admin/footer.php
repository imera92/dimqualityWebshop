	<!-- <script src="<?php //echo base_url('public/js/jquery-3.2.1.min.js'); ?>"></script> -->
	<script  src="http://code.jquery.com/jquery-1.11.1.min.js"  integrity="sha256-VAvG3sHdS5LqTT+5A/aeq/bZGa/Uj04xKxY8KM/w9EE=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('public/js/bootstrap.min.js'); ?>"></script>
	<?php if (isset($js_files)): ?>
			<?php foreach($js_files as $file): ?>
    			<script src="<?php echo $file; ?>"></script>
			<?php endforeach; ?>
	<?php endif; ?>
</body>
</html>