		<div class="row mt-50 mb-50">
			<div class="col-sm-10 col-sm-offset-1 col-xs-12">
				<h1>Transacciones</h1>
				<hr>
				<?php if (!isset($transacciones)): ?>
					<?php echo $mensaje ?>
				<?php else: ?>
					<table id="tabla-transacciones" class="table table-hover">
						<thead>
							<tr>
								<td>Código</td>
								<td>Estado</td>
								<td>Total</td>
								<td>Detalle</td>
								<td>Fecha de compra</td>
								<td>Fecha de pago</td>
								<td>Fecha de entrega</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($transacciones as $transaccion): ?>
								<tr>
									<?php
										switch ($transaccion->getEstado()) {
											case 1:
												$estado = '
												<span class="pago-pendiente">Pendiente</span>
												';
												break;
											
											case 2:
												$estado = 'Pagado';
												break;
										}
									?>
									<td><?php echo $transaccion->getId(); ?></td>
									<td><?php echo $estado; ?></td>
									<td>
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-<?php echo $transaccion->getId(); ?>">
											Ver Detalle
										</button>
									</td>
									<td>$ <?php echo $transaccion->getTotal(); ?></td>
									<td><?php echo $transaccion->getFechaCompra()->format('Y-m-d'); ?></td>
									<td><?php echo ($transaccion->getFechaPago() != '') ? $transaccion->getFechaPago()->format('Y-m-d') : 'n/a'; ?></td>
									<td><?php echo ($transaccion->getFechaEntrega() != '') ? $transaccion->getFechaEntrega()->format('Y-m-d') : 'n/a'; ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>

		<?php foreach ($transacciones as $transaccion): ?>
			<div id="modal-<?php echo $transaccion->getId(); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-<?php echo $transaccion->getId(); ?>">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title bold-text">Detalle de la transacción</h4>
			      </div>
			      <div class="modal-body">
	        		<div class="container-fluid">
	        			<div class="row">
	        				<div class="col-md-6 text-center">
	        					<span class="modal-bodyLabel">Producto</span>
	        				</div>
	        				<div class="col-md-2 text-center">
	        					<span class="modal-bodyLabel">Precio</span>
	        				</div>
	        				<div class="col-md-2 text-center">
	        					<span class="modal-bodyLabel">Cantidad</span>
	        				</div>
	        				<div class="col-md-2 text-center">
	        					<span class="modal-bodyLabel">Subtotal</span>
	        				</div>
	        			</div>
	        			<hr>
				        <?php foreach ($transaccion->getItemsTransaccion() as $itemTransaccion): ?>
		        			<div class="row row-eq-height">
		        				<div class="col-md-3">
		        					<?php 
		        					if ($itemTransaccion->getProducto()->getImagen() == ''){
		        						$imagenUrl = base_url("assets/uploads/images/productos/default.png");
		        					} else {
		        						$imagenUrl = base_url("assets/uploads/images/productos/" . $itemTransaccion->getProducto()->getImagen());
		        					}
		        					?>
		        					<img class="img-responsive" src="<?php echo $imagenUrl; ?>">
		        				</div>
		        				<div class="col-md-3">
		        					<a href="<?php echo base_url('producto/getProducto/' . $itemTransaccion->getProducto()->getId()); ?>"><?php echo $itemTransaccion->getProducto()->getNombre(); ?></a>
		        				</div>
		        				<div class="col-md-2 text-center">
		        					$ <?php echo $itemTransaccion->getProducto()->getPVP(); ?>
		        				</div>
		        				<div class="col-md-2 text-center">
		        					x <?php echo $itemTransaccion->getCantidad(); ?>
		        				</div>
		        				<div class="col-md-2 text-center bold-text">
		        					$ <?php echo $itemTransaccion->getSubtotal(); ?>
		        				</div>
		        			</div>
		        			<hr>
			        	<?php endforeach; ?>
	        		</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			      </div>
			    </div>
			  </div>
			</div>
		<?php endforeach; ?>