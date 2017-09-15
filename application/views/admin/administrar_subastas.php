		<!-- Page Content -->
	    <div id="page-content-wrapper">
	        <div class="container-fluid">
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="index-box">
	            	    	<h1><i class="fa fa-gift" aria-hidden="true"></i> Subastas</h1>
	            		</div>
	            	</div>

	            </div>
				<br>
				<div class="row">
					<div class="col-xs-12">
						<a href="<?php echo base_url('subasta/create_subasta'); ?>" class="btn btn-crear">Crear Subasta</a>
					</div>
				</div>
				<hr>
					<?php foreach ($subastas_paginacion as $subasta): ?>
						<div class="row subasta">
							<div class="img-subasta col col-md-2">
								<?php
									$image_name = $subasta->getProducto()->getImagen();
									if ($image_name == ''){
										$image_url = base_url("assets/uploads/images/productos/default.png");
									} else {
										$image_url = base_url("assets/uploads/images/productos/" . $image_name);
									}
								?>
								<img class="img-responsive" src="<?php echo $image_url; ?>">
							</div>
							<div class="info-subasta col col-md-7">
								<p><span class="bold-text">Nombre del Producto:</span> <?php echo $subasta->getProducto()->getNombre(); ?></p>
								<p><span class="bold-text">Código:</span> <?php echo $subasta->getProducto()->getCodigo(); ?></p>
								<p><span class="bold-text">Precio base:</span> <?php echo $subasta->getPrecioBase(); ?></p>
								<?php $ofertas_num = count($subasta->getOfertas()); ?>
								<p><span class="bold-text">Ofertas realizadas:</span> <?php echo $ofertas_num; ?></p>
								<p><span class="bold-text">Estado:</span>
								<?php if ($subasta->getEstado() == 1): ?>
									<span class="disponible"> Disponible</span></p>
								<?php else: ?>
									<span class="no-disponible"> No disponible</span></p>
								<?php endif; ?>
							</div>
							<div class="botones-subasta col col-md-3">
								<button data-subasta-id="<?php echo $subasta->getId(); ?>" class="btn btn-info btn-subasta btn-modal-trigger" type="button" data-toggle="modal" data-target="#read_subasta_modal">Ver detalle</button>
								<br>
								<a href="<?php echo base_url('subasta/update_subasta?id=' . $subasta->getId()); ?>" class="btn btn-info btn-subasta" type="button" name="editar">Editar</a>
								<br>
								<button name="<?php echo $subasta->getId(); ?>" class="btn btn-danger btn-subasta" type="button" name="eliminar">Eliminar</button>
							</div>
						</div>
						<hr>
					<?php endforeach; ?>
				<div class="row text-center">
					<?php echo $pagination ?>
				</div>
	        </div>
	    </div>

	    <!-- Modal para el detalle de las subastas -->
	    <div class="modal fade" id="read_subasta_modal" tabindex="-1" role="dialog" aria-labelledby="read_subasta_modal_label">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Subasta del producto: <span id="read_subasta_modal_label"></span></h4>
	          </div>
	          <div class="modal-body">
	            <div class="container-fluid">
	            	<div class="row">
	            		<div class="col-xs-12">
	            			<p>
	            				<span class="bold-text">Fecha de Inicio: </span> <span id="read_subasta_modal_fecha_inicio"></span>
	            			</p>
	            			<p>
	            				<span class="bold-text">Fecha de Fin: </span> <span id="read_subasta_modal_fecha_fin"></span>
	            			</p>
	            			<p>
	            				<span class="bold-text">Mayor oferta: </span> <span id="read_subasta_modal_oferta_mayor"></span>
	            			</p>
	            			<p>
	            				<span class="bold-text">Ganador: </span> <span id="read_subasta_modal_ganador"></span>
	            			</p>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-xs-12">
	            		    <ul class="nav nav-tabs">
	            		        <li class="active">
	            		            <a href="#1">Historial</a>
	            		        </li>
	            		    </ul>
	            		    <div id="read_subasta_modal_table" class="tab-content">
	            		        <div class="tab-pane active" id="1">
            		                <table id="read_subasta_modal_ofertas" class="table table-striped">
            		                    <thead>
            		                        <tr>
            		                            <th class="text-center">Fecha</th>
            		                            <th class="text-center">Hora</th>
            		                            <th class="text-center">Cantidad</th>
            		                            <th class="text-center">Nombre</th>
            		                            <th class="text-center">Cedula</th>
            		                        </tr>
            		                    </thead>
            		                    <tbody>
            		                    </tbody>
            		                </table>
	            		        </div>
	            		    </div>
	            		    <div id="read_subasta_modal_ofertas_label" class="container-fluid">
	            		        <div class="row mt-20">
	            		            <div class="col-xs-12 text-center">
	            		                <span class="no-bid">No hay ofertas para mostrar.</span>
	            		            </div>
	            		        </div>
	            		    </div>
	            		</div>
	            	</div>
	            </div>
	          </div>
	          <div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	          </div>
	        </div>
	      </div>
	    </div>

	    <!-- /#page-content-wrapper -->
    </div>
