		<!-- Page Content -->
		<div id="page-content-wrapper">
		    <div class="container-fluid">
		        <div class="row mt-10">
		            <div class="col-md-12">
		                <div class="box-inner">
		                    <?php if ( isset($output) ): ?>
		                        <div class="box-header well" data-original-title="">
		                            <h2>
		                                <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?php echo $titleCRUD; ?>
		                            </h2>
		                        </div>
		                        <div class="box-content pl-0">
		                            <?php echo $output; ?>
		                        </div>
		                    <?php else: ?>
		                        <div class="box-header well" data-original-title="">
		                            <h2>
		                                <i class="glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;Atención
		                            </h2>
		                        </div>
		                        <div class="box-content text-center">
		                            <h3>No se encontró contenido</h3>
		                        </div>
		                    <?php endif ?>
		                </div>
		            </div>
		        </div><!--/row-->
		    </div>
		    <!-- /.container-fluid -->
		</div>
		<!-- /#page-content-wrapper -->