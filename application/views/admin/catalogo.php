		<!-- Page Content -->
	    <div id="page-content-wrapper">
	        <div class="container-fluid">
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="index-box">
	            	    	<h1><i class="fa fa-file-excel-o" aria-hidden="true"></i> Actualizar Catálogo</h1>
	            		</div>
	            	</div>
	            	<div class="col-md-12 mt-50">
	            		<?php if (isset($success)): ?>
		            		<div class="alert alert-<?php echo ($success == 1) ? 'success' : 'danger'; ?> alert-dismissable">
		            		 	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		            		 	<?php echo $message; ?>
		            		</div>
	            		<?php endif; ?>
	            	</div>
	                <div class="col-md-12 mt-50">
	                	<div class="well">
		                	<?php echo form_open_multipart('admin/subirExcel');?>
		                		<fieldset>
		                			<div class="form-group">
		                				<div class="col-sm-10">
		                					<input type="file" name="userfile" size="20"/>
		                				</div>
		                			</div>
		                			<div class="clearfix"></div><br>
		                			<div class="form-group">
		                				<div class="col-sm-10">
		                					<input type="submit" value="Subir Archivo" class="btn btn-default"/>
	                					</div>
		                			</div>
	                			</fieldset>
			                </form>
	                	</div>
		            </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- /#page-content-wrapper -->
    </div>