		<div class="row mt-50 mb-50">
			<div class="col-xs-10 col-xs-offset-1">
				<h1>Carrito de Compras</h1>
				<hr>
				<div class="well mt-50">
					<div class="row">
						<div class="col-md-3 col-md-offset-3 text-center bold-text">
							Nombre del producto
						</div>
						<div class="col-md-2 text-center bold-text">
							Precio Unit.
						</div>
						<div class="col-md-2 text-center bold-text">
							Cantidad
						</div>
						<div class="col-md-2 text-center bold-text">
							Sub-total
						</div>
					</div>
					<hr class="mt-5">
					<?php foreach ($productosCarrito as $index => $producto): ?>
						<div class="row row-eq-height mt-20 mb-20">
							<div class="col-md-1 text-center">
								<a href="#" class="btn-remove"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
							</div>
							<div class="col-md-2">
								<img class="img-responsive" src="<?php echo base_url('assets/uploads/images/productos/' . $producto['imagen']); ?>">
							</div>
							<div class="col-md-3">
								<a href="<?php echo base_url('producto/getProducto/' . $producto['id']); ?>"><?php echo $producto['descripcion']; ?></a>
							</div>
							<div class="col-md-2 text-center">
								<?php echo $producto['pvp'];?>
							</div>
							<div class="col-md-2">
								<input type="number" step="1" value="<?php echo $producto['cantidad'] ?>" min="0">
							</div>
							<div class="col-md-2 text-center subtotal">
								<?php echo ($producto['cantidad'] * $producto['pvp']) ?>
							</div>
						</div>
					<?php endforeach; ?>
					<hr>
					<div class="row row-eq-height mt-20">
						<div class="col-md-2 col-md-offset-8 text-center bold-text grantotal-label">
							Subtotal
						</div>
						<div class="col-md-2 text-center grantotal">
							<?php echo $subtotal ?>
						</div>
					</div>
					<div class="row row-eq-height mt-20">
						<div class="col-md-2 col-md-offset-8 text-center bold-text grantotal-label">
							Total
						</div>
						<div class="col-md-2 text-center grantotal">
							<?php echo round($subtotal * 1.14, 2) ?>
						</div>
					</div>
				</div>
			</div>
		</div>