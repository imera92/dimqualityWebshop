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
						<a href="<?php echo base_url('subasta/crear'); ?>" class="btn btn-crear">Crear Subasta</a>
					</div>
				</div>
				<hr>


				<?php
					foreach ($consulta as $fila) {
				?>
					<div class="row subasta">
						<div class="img-subasta col col-md-2">
							<?php
							if ($actuales[$fila->producto]['imagen'] == ''){
								$imagenUrl = base_url("assets/uploads/images/productos/default.png");
							} else {
								$imagenUrl = base_url("assets/uploads/images/productos/".$actuales[$fila->producto]['imagen']);
							}
							?>
							<img class="img-responsive" src="<?php echo $imagenUrl; ?>">
						</div>
						<div class="info-subasta col col-md-7">
							<p><strong>Nombre del Producto:</strong> <?= $actuales[$fila->producto]['nombre'] ?></p>
							<p><strong>Código:</strong> <?= $actuales[$fila->producto]['codigo'] ?></p>
							<p><strong>Precio base: </strong><?= $fila->precioBase ?></p>
							<p><strong>Ofertas realizadas:</strong> <?= $actuales[$fila->producto]['ofertas'] ?></p>
							<?php if ($fila->estado == 1) {?>
								<p><strong>Estado:</strong><span class="disponible"> Disponible</span></p>
							<?php }else{ ?>
								<p><strong>Estado:</strong><span class="no-disponible"> No disponible</span></p>
							<?php } ?>
							<p>

						</div>
						<div class="botones-subasta col col-md-3">
							<button name="<?php echo $fila->id; ?>" class="btn btn-info btn-subasta" type="button" name="ver">Ver detalle</button>
							<br>
							<a href="<?php echo base_url('subasta/actualizar?id=' . $fila->id); ?>" class="btn btn-info btn-subasta" type="button" name="editar">Editar</a>
							<br>
							<button name="<?php echo $fila->id; ?>" class="btn btn-danger btn-subasta" type="button" name="eliminar">Eliminar</button>
						</div>
					</div>
					<hr>
				<?php
					}
				 ?>
				<div class="row text-center">
					<?php echo $pagination ?>
				</div>
	        </div>
	    </div>

	    <!-- /#page-content-wrapper -->
    </div>
