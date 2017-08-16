	<div id="wrapper">
		<!-- Sidebar -->
		<div id="sidebar-wrapper">
		    <ul class="sidebar-nav">
		        <li class="sidebar-brand">
		            <a href="<?php echo base_url('admin') ?>">
		                <img class="img-responsive" src="<?php echo base_url('public/img/logo.jpg'); ?>">
		            </a>
		        </li>
		        <li>
		            <a href="#collapse1" data-toggle="collapse" ><i class="fa fa-cube" aria-hidden="true"></i> Productos</a>
		        </li>
	            <div id="collapse1" class="panel-collapse collapse">
	                <ul class="sidebar-subnav list-group">
	                    <li>
	                    	<a href="<?php echo base_url('admin/productos'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Crear Producto</a>
	                    </li>
	                    <li>
	                    	<a href="<?php echo base_url('admin/actualizarCatalogo'); ?>"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Actualizar Catálogo</a>
	                    </li>
	                </ul>
                </div>
				<li>
		            <a href="<?php echo base_url('subasta/subastas'); ?>"><i class="fa fa-gift" aria-hidden="true"></i> Subastas</a>
		        </li>
		        <li>
		            <a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a>
		        </li>
		    </ul>
		</div>
		<!-- /#sidebar-wrapper -->
