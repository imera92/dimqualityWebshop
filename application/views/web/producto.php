		<div class="row mt-50 mb-50">
			<?php if (isset($mensaje)): ?>
					<div class="col-xs-10 col-xs-offset-1 text-center">
						<h1 class="product-name"><?php echo $mensaje ?></h1>	
					</div>
				</div>
			<?php else: ?>
					<div class="col-xs-3 col-xs-offset-1">
						<?php 
						if ($producto['imagen'] == ''){
							$imagenUrl = base_url("assets/uploads/images/productos/default.png");
						} else {
							$imagenUrl = base_url("assets/uploads/images/productos/".$producto['imagen']);
						}
						?>
						<img class="img-responsive" src="<?php echo $imagenUrl; ?>">
					</div>
					<div class="col-xs-7">
						<div class="row">
							<h1 class="product-name"><?php echo $producto['nombre']?></h1>	
						</div>
						<div class="row mt-20">
							<span class="bold-text">Disponibilidad: </span><?php echo  ($producto['stock'] > 0) ? '<span class="available">Varios en stock</span>' : '<span class="not-available">Agotado</span>' ?>
						</div>
						<div class="row mt-20 price">
							<span class="bold-text">$ </span><?php echo $producto['pvp']; ?>
						</div>
						<div class="row mt-20">
			                <?php if ($producto['stock'] > 0): ?>
								<?php echo form_open('carrito/anadirProducto' , array('id' => 'frm-anadirProducto')); ?>
									<div class="col-xs-2">
										<?php echo form_input(array(
											'type' => 'number',
											'id' => 'cantidadInput',
						                    'name' => 'cantidad',
						                    'value' => 1,
						                    'class' => 'form-control',
						                    'min' => 1
						                ));?>
									</div>
									<?php echo form_input(array(
										'type' => 'hidden',
										'id' => 'idInput',
					                    'name' => 'id',
					                    'value' => $producto['id']
					                ));?>
									<div class="col-xs-2">
										<button type="submit" class="btn btn-add">Añadir al carrito</button>
									</div>
								<?php echo form_close(); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="well product-desc">
							<?php echo $producto['descripcion']; ?>
						</div>
					</div>					
				</div>
			<?php endif; ?>
		</div>