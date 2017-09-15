		<div class="row mt-50 mb-50">
			<div class="col-xs-10 col-xs-offset-1">
				<div class="row">
	            	<div class="col-md-12">
	            		<div class="index-box">
	            	    	<h1><i class="fa fa-gift" aria-hidden="true"></i> Subastas</h1>
	            		</div>
	            	</div>
	            </div>
				<br>
				<hr>
				<?php foreach ($subastas_paginacion as $subasta): ?>
					<div class="row">
						<div class="img-subasta col col-md-3">
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
						<div class="info-subasta col col-md-6">
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
							<a href="<?php echo base_url('subasta/ofertar_subasta?id=' . $subasta->getId()); ?>" class="btn btn-info btn-subasta">Ofertar</a>
						</div>
					</div>
					<hr>
				<?php endforeach; ?>
				<div class="row text-center">
					<?php echo $pagination; ?>
				</div>
	        </div>
	    </div>
