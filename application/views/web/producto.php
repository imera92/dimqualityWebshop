		<div class="row mt-50 mb-50">
			<div class="col-xs-3 col-xs-offset-1">
				<img class="img-responsive" src="<?php echo base_url('assets/uploads/images/productos/'.$producto['imagen']); ?>">
			</div>
			<div class="col-xs-7">
				<div class="row">
					<h1 class="product-name"><?php echo $producto['descripcion']?></h1>	
				</div>
				<div class="row mt-20">
					<span class="bold-text">Disponibilidad: </span><?php echo  ($producto['stock'] > 0) ? '<span class="available">Varios en stock</span>' : '<span class="not-available">Agotado</span>' ?>
				</div>
				<div class="row mt-20 price">
					<span class="bold-text">$ </span><?php echo $producto['pvp']; ?>
				</div>
				<div class="row mt-20">
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
				</div>
			</div>
		</div>