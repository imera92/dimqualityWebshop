	</div><!-- fin #wrapper -->
  
    <?php if (isset($js_files)): ?>
    
        <!-- grocerycrud -->
        <?php foreach($js_files as $file): ?>
            <script type="text/javascript" src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
        <!-- grocerycrud -->

        <?php if (isset($js_files_dd)): ?>
            <!-- Dependent Dropdown -->
            <?php echo $js_files_dd; ?>
            <!-- Dependent Dropdown -->            
        <?php endif ?>
    <?php else: ?>
      
    <?php endif ?>
    <script src="<?php echo base_url('public/js/bootstrap.min.js'); ?>"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script type="text/javascript" src= "<?php echo base_url('public/js/validacion.js'); ?>"></script> 
    </body>
</html>