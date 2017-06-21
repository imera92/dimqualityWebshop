	<div class="row">
		<h1 class="text-center">COMPRAR PRODUCTOS</h1>
	</div>
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1 well">
					<div class="row">
						<div class="col-lg-2">
							<img class="img-responsive" src="http://via.placeholder.com/600x600">
						</div>
						<div class="col-lg-5">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quam augue, malesuada quis eros ac, aliquam pellentesque arcu. Pellentesque convallis commodo ante a placerat. Sed euismod ligula eu aliquam tempor. Sed arcu ex, vestibulum nec metus vitae, pharetra imperdiet massa. Curabitur nec tempus ligula, et blandit odio.
							</p>
						</div>
						<div class="col-lg-2">
							<div class="row">
								<div class="col-lg-12">
									PRECIO
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									$ 100
								</div>
							</div>
						</div>
						<div class="col-lg-2 text-center">
							<div class="row">
								<div class="col-lg-12">
									CANTIDAD
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label>1</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>		
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1 well">
					<div class="row">
						<div class="col-lg-2">
							<img class="img-responsive" src="http://via.placeholder.com/600x600">
						</div>
						<div class="col-lg-5">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quam augue, malesuada quis eros ac, aliquam pellentesque arcu. Pellentesque convallis commodo ante a placerat. Sed euismod ligula eu aliquam tempor. Sed arcu ex, vestibulum nec metus vitae, pharetra imperdiet massa. Curabitur nec tempus ligula, et blandit odio.
							</p>
						</div>
						<div class="col-lg-2">
							<div class="row">
								<div class="col-lg-12">
									PRECIO
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									$ 100
								</div>
							</div>
						</div>
						<div class="col-lg-2 text-center">
							<div class="row">
								<div class="col-lg-12">
									CANTIDAD
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label>1</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 panel">
				<h2 class="text-center">Total: $ 200.00</h2>
			<div class="panel-body">			
				<form>
					<div class="form-group">
						<label for="formaPago">Forma de pago</label>
						<fieldset id="formaPago">
							<input type="radio" value="" name="formaPago" required>
							Depósito<br>
							<input type="radio" value="" name="formaPago">
							Transferencia<br>
						</fieldset>
					</div>
					<div class="form-group">
						<label for="datosEntrega">Datos de la entrega</label>
						<fieldset id="datosEntrega">
							<input type="radio" value="" name="datosEntrega" required>
							Retiro en local<br>
							<input type="radio" value="" name="datosEntrega" id="radioDom">
							Entrega a domicilio<br>
						</fieldset>
					</div>
					<div id="billingAddress" class="panel">
							<h3 class="panel-title">Dirección de Facturación</h3>
						<div class="panel-body form-group">
							<div class="form-group">
								<label for="nombre">Nombre:</label>
								<input type="text" name="nombre" class="form-control" value="Nombre Apellido" required>
							</div>
							<div class="form-group">
								<label for="cedula">Cedula:</label>
								<input type="text" name="cedula" class="form-control" value="0987654321" required>
							</div>
							<div class="form-group">
								<label for="direccion">Direccion:</label>
								<input type="text" name="direccion" class="form-control" value="Dirección del Usuario" required>
								<div id="sameAddress" style="display: none;">
									<input type="checkbox" name="sameAddress" checked id="sameCheck">Dirección de Entrega igual a Facturación
								</div>
							</div>
						</div>
					</div>
					<div class="panel" id="deliveryAddress" style="display: none;">					
							<h3 class="panel-title">Dirección de Entrega</h3>					
						<div class="panel-body">
							<div  class="form-group">
								<label for="nombre">Nombre:</label>
								<input type="text" name="nombreEntrega" class="form-control" value="Nombre Apellido" required>
							</div>
							<div class="form-group">
								<label for="direccion">Dirección:</label>
								<input type="text" name="direccionEntrega" class="form-control" value="Dirección del Usuario" required>
							</div>
						</div>					
					</div>
					<div class="form-group">
						
					</div>
					<input type="submit" name="" value="COMPRAR">
				</form>			
			</div>
		</div>
	</div>
</div>
<script  src="http://code.jquery.com/jquery-1.11.1.min.js"  integrity="sha256-VAvG3sHdS5LqTT+5A/aeq/bZGa/Uj04xKxY8KM/w9EE=" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?php echo base_url('public/js/comprarProductos.js'); ?>"></script>

