		<div class="row mt-50 mb-50">
			<div class="row">
				<div class="col-xs-12">
					<h1>Confirme su Compra</h1>
					<hr>				
						<div class="col-xs-9 well mt-50">							
							<div class="row">
								<div class="col-md-3 col-md-offset-2 text-center bold-text">
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
									<div class="col-md-2">
										<img class="img-responsive" src="<?php echo base_url('assets/uploads/images/productos/' . $producto['imagen']); ?>">
									</div>
									<div class="col-md-3">
										<a href="<?php echo base_url('producto/getProducto/' . $producto['id']); ?>"><?php echo $producto['nombre']; ?></a>
									</div>
									<div class="col-md-2 text-center">
										<?php echo $producto['pvp'];?>
									</div>
									<div class="col-md-2 text-center">
										<span class="bold-text grantotal">
											<?php echo $producto['cantidad'] ?>
										</span>
									</div>								
									<div class="col-md-2 text-center subtotal">
										<?php echo ($producto['cantidad'] * $producto['pvp']) ?>
									</div>
								</div>
							<?php endforeach; ?>
							<hr>
							<div class="row row-eq-height mt-20">
								<div class="col-md-2 col-md-offset-7 text-center bold-text grantotal-label">
									Total
								</div>
								<div class="col-md-2 text-center grantotal">
									<?php echo $subtotal ?>
								</div>
							</div>
						</div>
						<div class="col-xs-3 mt-50">		
							<div class="panel panel-default">
								<div class="text-center">
									<h3 class=" ">Datos de Compra</h3>
								</div>		
								<form action="<?php echo base_url('comprar') ?>"method="POST" class="panel-body">
									<div class="form-group">
										<label for="formaPago">Forma de pago<span class="red">*</span></label>
										<fieldset id="formaPago">
											<input type="radio" value="0" name="formaPago" required>
											Depósito<br>
											<input type="radio" value="1" name="formaPago">
											Transferencia<br>
										</fieldset>
									</div>
									<div class="form-group">
										<label for="datosEntrega">Datos de la entrega<span class="red">*</span></label>
										<fieldset id="datosEntrega">
											<input type="radio" value="0" name="datosEntrega" required>
											<span>Retiro en local</span><br>
											<input type="radio" value="1" name="datosEntrega" id="radioDom">
											<span>Entrega a domicilio</span><br>
										</fieldset>
									</div>
									<div id="billingAddress">
										<h4 class="">Dirección de Facturación</h4>
										<div class="form-group">
											<label for="nombre">Nombre:<span class="red">*</span></label>
											<input type="text" name="nombre" class="form-control" value="<?php echo $user['nombre'] ?> <?php echo $user['apellido'] ?>" required>
										</div>
										<div class="form-group">
											<label for="cedula">Cedula:<span class="red">*</span></label>
											<input type="text" name="cedula" class="form-control" value="<?php echo $user['cedula'] ?>" required>
										</div>
										<div class="form-group">
											<label for="direccion">Direccion:<span class="red">*</span></label>
											<input type="text" name="direccion" class="form-control" value="<?php echo $user['direccion'] ?>" required>
											<div id="sameAddress" style="display: none;">
												<input type="checkbox" name="sameAddress" checked id="sameCheck">Dirección de Entrega igual a Facturación
											</div>
										</div>
									</div>
									<div class="panel" id="deliveryAddress" style="display: none;">
											<h4 class=" ">Dirección de Entrega</h4>
										<div  class="form-group">
											<label for="nombreEntrega">Nombre:<span class="red">*</span></label>
											<input type="text" name="nombreEntrega" class="form-control" value="<?php echo $user['nombre'] ?> <?php echo $user['apellido'] ?>" required>
										</div>
										<div class="form-group">
											<label for="º">Dirección:<span class="red">*</span></label>
											<input type="text" name="direccionEntrega" class="form-control" value="<?php echo $user['direccion'] ?>" required>
										</div>
									</div>
									<input type="submit" name="submit" class="btn btn-primary btn-default btn-lg btn-comprar" value="Comprar">
									<a href="<?php echo base_url("carrito") ?>" class ="btn btn-lg btn-danger" >Regresar</a>
								</form>	
							</div>						
						</div>
					</div>				
				</div>
			</div>
		</div>