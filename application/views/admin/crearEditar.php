<div id="page-content-wrapper">
    <div class="container-fluid">	            
        <div class="row">
            <div class="col-md-12">
                <div class="index-box">
                    <h1>SUBASTAS</h1>
                </div>
            </div>
            <div class="col-md-8 mt-50 col-md-offset-2 msg">
                <div class="well">
                    <h2 class="pl-10 pb-20"> <?php echo $Accion;?> Subastas</h2>
                    <?php if (isset($subasta)): ?>
                    <form class="subastaForm"  action="<?php echo base_url('subasta/ActualizarSubasta') ?>" method="POST">
                    <?php else: ?>
                        <form class="subastaForm"  action="<?php echo base_url('subasta/Guardar') ?>" method="POST">
                    <?php endif; ?>    
                        <div class="form-group ">
                            <label for="fehca/hora" class="col-md-4">Fecha y hora de inicio: </label>
                            <div class="col-md-8 pb-15">
                                <div class="input-group date datetimepicker1 dt1"  id="box1">
                                        <?php if (isset($subasta)): ?>
                                                <input name="fhi" class ="form-control fh-i" required id="datetimepickerFrom" type="text" value="<?= htmlspecialchars($subasta->getFechaInicio()); ?>"/>
                                        <?php else: ?>
                                                <input name="fhi" required  class="form-control fh-i">              
                                        <?php endif; ?>    
                                        <span class="input-group-addon bdate1">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                                <label for="pwd" class="col-md-4 ">Fecha y hora de fin: </label>
                                <div class="col-md-8 pb-15 ">
                                    <div class=" input-group date datetimepicker1 dt2">
                            
                                        <?php if (isset($subasta)): ?>
                                                <input name="fhf" class ="form-control fh-f" required id="datetimepickerFrom" type="text" value="<?= htmlspecialchars($subasta->getFechaFin()); ?>"/>
                                            <?php else: ?>
                                                <input name="fhf" required class="form-control fh-f">
                                            <?php endif; ?>
                                        <span class="input-group-addon bdate2">
                                                <span  class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                            
                                    </div>
                                </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-md-4">Producto: </label>
                            
                                <div class="col-md-8 pb-15 pl-15 ml-0">
                                    <div class="box col-md-4 pl-0 ml-0">
                                        <strong>Categoria: </strong>
                                        <select class="form-control categoria col-md-2">
                                                <?php if (isset($subasta)): ?>
                                                    <option value="<?php echo $producto->getCategoria()->getId(); ?>"><?php echo $producto->getCategoria()->getNombre();?></option>
                                                    <?php foreach ($categorias as  $categoria): ?>
                                                        <option value="<?php echo $categoria->getId(); ?>"><?php echo $categoria->getNombre();?></option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <?php foreach ($categorias as  $categoria): ?>
                                                        <option value="<?php echo $categoria->getId(); ?>"><?php echo $categoria->getNombre();?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            
                                        </select>
                                    </div>
                                    <div class=" box col-md-4 pl-0 ml-0">
                                        <strong>Marca: </strong>
                                        <select class="form-control marca">
                                            <?php if (isset($subasta)): ?>
                                                <option class="marca-op" value="<?php echo $producto->getMarca()->getId();?>"><?php echo $producto->getMarca()->getNombre();?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="box  col-md-4 pl-0 ml-0 box3">
                                        <strong>Producto: </strong>
                                        <select name="myselect" class="form-control producto">
                                            <?php if (isset($subasta)): ?>
                                                <option class="product-op"><?php echo $producto->getNombre();?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            
                        </div>
                        <div class="form-group">
                                <label for="pwd "class="col-md-4">Precio base: </label>
                                <div class="col-md-8 pl-15" >
                                    <?php if ( isset($subasta)):?>
                                            <input name="preb"  required class="form-control pb" value="<?php echo $subasta->getPrecioBase();?>">
                                            
                                    <?php else: ?>
                                            <input name ="preb"  required class="form-control pb">
                                            
                                    <?php endif; ?>   
                                </div>
                        </div>
                        <?php if ( isset($subasta)):?>
                                <button type="submit" class="btn btn-primary ml-15 mt-20 actualizar">Actualizar</button>
                                <input type="hidden" name="t" class="id" value="<?php echo $subasta->getId() ?>">
                        <?php else: ?>
                                <button type="submit" class="btn btn-primary ml-15 mt-20 obtener">Guardar</button>
                        <?php endif; ?>                  
                        
                        <button type="button" class="btn btn-danger mt-20" data-toggle="modal" data-target="#myModal">Volver a la lista</button>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Volver a la lista</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Esta seguro que desea cancelar esta operación?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success btn-lg cancelar" data-dismiss="modal">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if (isset($mensaje)): ?>
							<div class=" alert   alert-success  alert-dismissable">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<strong><?php echo $mensaje; ?><strong>
							</div>
			    <?php endif; ?>
            </div>
        </div>
    </div>
</div>