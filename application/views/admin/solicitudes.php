	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="index-box">
						<h1><i class="fa fa-calendar" aria-hidden="true"></i> Solicitudes</h1>
					</div>
					<br>
					<div class="">

					<table class="table">
						<thead>
							<th class="text-center">Id</th>
							<th class="text-center">Usuario</th>
							<th class="text-center">Fecha de Solicitud</th>
							<!-- <th class="text-center">Fecha de Cita</th> -->
							<th class="text-center">Asunto</th>
							<th class="text-center">Ubicación</th>
							<th class="text-center">Estado</th>
							<th class="text-center">Acción</th>
						</thead>
						<tbody>
							<?php foreach ($solicitudes as $solicitud): ?>
								<tr class="text-center">
									<td><?php echo $solicitud->getId(); ?></td>
									<td><?php echo $solicitud->getUsuario(); ?></td>
									<td><?php echo $solicitud->getFecha_creac(); ?></td>
									<!-- <td><?php echo $solicitud->getFecha_cita(); ?></td> -->
									<td><?php echo $solicitud->getAsunto(); ?></td>
									<td><?php echo $solicitud->getUbicacion(); ?></td>
									<td><?php echo $solicitud->getEstado(); ?></td>
									<td><button data-solicitud-id="<?php echo $solicitud->getId(); ?>" class="btn btn-info btn-modal-trigger" type="button" data-toggle="modal" data-target="#modalSolicitud">Ver detalle</button></td>
								</tr>
							<?php endforeach; ?>

						</tbody>
					</table>
					</div>
				</div>

				<!-- <div id="calendar"></div> -->


			</div>
			<br>
		</div>
	</div>

	<div class="modal fade" id="modalSolicitud" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header tituloModal">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Solicitud <span id="modal_idSolicitud"></span></h4>
				</div>
				<div class="modal-body">
					<div class="row">
	            		<div class="col-xs-12">
	            			<p>
	            				<span class="bold-text">Usuario: </span> <span id="modal_usuario"></span>
	            			</p>
							<p>
	            				<span class="bold-text">Cédula: </span> <span id="modal_cedula"></span>
	            			</p>
							<p>
	            				<span class="bold-text">Email: </span> <span id="modal_correo"></span>
	            			</p>
							<p>
	            				<span class="bold-text">Fecha de Solicitud: </span> <span id="modal_fechaSolic"></span>
	            			</p>
							<p>
	            				<span class="bold-text">Fecha de Cita: </span> <span id="modal_fechaCita"></span>
	            			</p>
							<p>
	            				<span class="bold-text">Ubicación: </span> <span id="modal_ubicacion"></span>
	            			</p>
							<p>
	            				<span class="bold-text">Estado: </span> <span id="modal_estado"></span>
	            			</p>
	            		</div>
	            	</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnCerrarModal" data-dismiss="modal" name="cerrar">Cancelar</button>
					<button data-solicitud-id="<?php echo $solicitud->getId(); ?>" class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalCita" id="btnguardar" data-dismiss="modal">Agendar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalCita" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header tituloModal">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Agendar Cita </h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<form class="form" action="index.html" method="post">
								<div class="form-group row">
									<label class="col-md-2 col-form-label" for="cita_usuario">Usuario: </label>
									<div class="col-md-10">
										<input class="form-control" type="text" id="cita_usuario" value="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label" for="cita_fecha">Fecha:</label>
									<div class="col-md-10">
										<div class="input-group date">
				                    		<input type="text" id="datetimepickerFrom" class="form-control bdate1"/>
				                    		<span class="input-group-addon "><span class="glyphicon glyphicon-calendar"></span></span>
                						</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label" for="cita_fecha">ubicación:</label>
									<div class="col-md-10">
										<input class="form-control" type="text" id="cita_ubicacion" value="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-2 col-form-label" for="cita_fecha">Descripción:</label>
									<div class="col-md-10">
										<textarea class="form-control" type="text" rows="5" id="cita_descripcion" value=""></textarea>
									</div>
								</div>
							</form>


						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnCerrarModalCita" data-dismiss="modal" name="cerrar">Cancelar</button>
					<button type="button" class="btn btn-primary">Agendar</button>
				</div>

</div>
