		<div class="row mt-20 mb-50 mensajeBusqueda-container pt-20 pb-20">
			<div class="col-xs-12">
				<?php echo $mensaje; ?>
			</div>
		</div>
		<?php if (isset($productosEncontrados)): ?>
			<div class="row mb-50">
				<div class="col-xs-2">

					<div class="row filtro-container">
						<span class="filtro-titulo">Categoria</span>
						<ul>
							<?php $filtoUrl = ''; ?>
							<?php foreach ($parametros as $key => $value) {
								if ($key != 'categoria') {
									$filtoUrl .= $value;
								}
							} ?>
							<?php foreach ($categorias as $index => $categoria): ?>
								<li>
									<a href="<?php echo base_url('web/buscarProductos' . $filtoUrl . '&cat=' . $categoria['categoria']->getId()); ?>"><?php echo $categoria['categoria']->getNombre(); ?></a> <span class="filtro-cantidad"><?php echo "(" . $categoria['cantidad'] . ")"; ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						<span class="filtro-titulo">Marca</span>
						<ul>
							<?php $filtoUrl = ''; ?>
							<?php foreach ($parametros as $key => $value) {
								if ($key != 'marca') {
									$filtoUrl .= $value;
								}
							} ?>
							<?php foreach ($marcas as $index => $marca): ?>
								<li>	
									<a href="<?php echo base_url('web/buscarProductos' . $filtoUrl . '&m=' . $marca['marca']->getId()); ?>"><?php echo $marca['marca']->getNombre(); ?></a> <span class="filtro-cantidad"><?php echo "(" . $marca['cantidad'] . ")"; ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						<span class="filtro-titulo">Precio</span>
						<ul>
							<?php $filtoUrl = ''; ?>
							<?php foreach ($parametros as $key => $value) {
								if ($key != 'rangoPrecio') {
									$filtoUrl .= $value;
								}
							} ?>
							<?php foreach ($rangosPrecio as $index => $rangoPrecio): ?>
								<li>
									<a href="<?php echo base_url('web/buscarProductos' . $filtoUrl . '&r=' . $rangoPrecio['min'] . '-' . $rangoPrecio['max']); ?>"><?php echo '$' . $rangoPrecio['min'] . ' - ' . '$' . $rangoPrecio['max']; ?></a> <span class="filtro-cantidad"><?php echo "(" . $rangoPrecio['cantidad'] . ")"; ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="col-xs-10">
					<div class="row">
						<?php foreach ($productosEncontrados as $index => $producto): ?>
							<div class="col-xs-3 equalHeightBox">
								<div class="well">
									<div class="row">
										<?php 
										if ($producto->getImagen() == ''){
											$imagenUrl = base_url("assets/uploads/images/productos/default.png");
										} else {
											$imagenUrl = base_url("assets/uploads/images/productos/".$producto->getImagen());
										}
										?>
										<img class="img-responsive" src="<?php echo $imagenUrl; ?>">
									</div>
									<div class="row">
										<div class="col-xs-12 nombreProducto">
											<span><?php echo $producto->getNombre(); ?></span>		
										</div>
									</div>
									<div class="row mt-10">
										<div class="col-xs-12 precioProducto">
											<span>$ <?php echo $producto->getPVP(); ?></span>										
										</div>
									</div>
									<div class="row mt-10 text-center">
										<?php if ($producto->tieneStock()): ?>
											<div class="col-xs-8">
										<?php else: ?>
											<div class="col-xs-12">
										<?php endif; ?>
											<a href="<?php echo base_url('producto/' . $producto->getId()); ?>" class="btn btn-default btn-masInfo">Más Información</a>										
										</div>
										<?php if ($producto->tieneStock()): ?>
											<div class="col-xs-4">
												<?php echo form_open('carrito/anadirProducto' , array('id' => 'frm-anadirProducto')); ?>
													<?php echo form_input(array(
														'type' => 'hidden',
														'id' => 'cantidadInput',
									                    'name' => 'cantidad',
									                    'value' => 1,
									                ));?>
													<?php echo form_input(array(
														'type' => 'hidden',
														'id' => 'idInput',
									                    'name' => 'id',
									                    'value' => $producto->getId()
									                ));?>
													<button type="submit" class="btn btn-add"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
												<?php echo form_close(); ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>