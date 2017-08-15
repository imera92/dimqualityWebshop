<div id="page-content-wrapper">
    <div class="container-fluid">	            
        <div class="row">
            <div class="col-md-12">
                <div class="index-box">
                    <h1>SUBASTAS</h1>
                </div>
            </div>
            <div class="col-md-8 mt-50 col-md-offset-2 msg">
                <h2 class="pl-10"> <?php echo $Accion;?> Subastas</h2>
                <form id="SubastaForm">
                    <div class="form-group ">
                        <label for="fehca/hora" class="col-md-4">Fecha y hora de inicio: </label>
                        <div class="col-md-8 pb-15 input-group date datetimepicker1 dt1">
                            <?php if (isset($subasta)): ?>
                                        <input  class ="form-control fh-i" id="datetimepickerFrom" type="text" value="<?= htmlspecialchars($subasta->fechaInicio) ?>"/>
                                     <?php else: ?>
                                        <input name="fhi"  class="form-control fh-i"> 
                                    <?php endif; ?>
                            <span class="input-group-addon bdate1">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="pwd" class="col-md-4 ">Fecha y hora de fin: </label>
                            <div class="col-md-8 pb-15 input-group date datetimepicker1 dt2">
                    
                                   <?php if (isset($subasta)): ?>
                                        <input  class ="form-control fh-f" id="datetimepickerFrom" type="text" value="<?= htmlspecialchars($subasta->fechaFin) ?>"/>
                                     <?php else: ?>
                                        <input name="fhf" class="form-control fh-f"> 
                                    <?php endif; ?>
                                   <span class="input-group-addon bdate2">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                              
                            </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-md-4">Producto: </label>
                        <div class="col-md-8 pb-15 pl-0 ml-0">
                            <div class="box col-md-3 pl-0 ml-0">
                                <strong>Categoria: </strong>
                                <select class="form-control categoria col-md-2">
                                        <?php if (isset($subasta)): ?>
                                            <option><?php echo $producto->categoria;?></option>
                                            <?php foreach ($categorias as  $categoria): ?>
                                                <?php if ($producto->categoria!=$categoria->nombre): ?>
                                                    <option><?php echo $categoria->nombre;?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <?php foreach ($categorias as  $categoria): ?>
                                                <option><?php echo $categoria->nombre;?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    
                                </select>
                            </div>
                            <div class=" box  col-md-3">
                                <strong>Marca: </strong>
                                <select class="form-control marca">
                                    <?php if (isset($subasta)): ?>
                                        <option class="marca-op" ><?php echo $producto->marca;?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="box  col-md-3">
                                <strong>Producto: </strong>
                                <select class="form-control producto">
                                    <?php if (isset($subasta)): ?>
                                        <option class="product-op"><?php echo $producto->nombre;?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="pwd "class="col-md-4">Precio base: </label>
                            <div class="col-md-8 pl-0 " >
                                <?php if ( isset($subasta)):?>
                                        <input  class="form-control pb" value="<?php echo $subasta->precioBase;?>">
                                <?php else: ?>
                                         <input name ="preb" class="form-control pb">
                                <?php endif; ?>   
                                
                            </div>
                    </div>
                    <?php if ( isset($subasta)):?>
                            <button type="button" class="btn btn-primary ml-15 mt-20 actualizar">Actualizar</button>
                            <input type="hidden" name="t" class="id" value="<?php echo $subasta->id ?>">
                    <?php else: ?>
                            <button type="button" class="btn btn-primary ml-15 mt-20 obtener">Guardar</button>
                    <?php endif; ?>                  
                    
                    <button type="button" class="btn btn-danger mt-20" data-toggle="modal" data-target="#myModal">Cancelar</button>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Cancelar Subasta</h4>
                                </div>
                                <div class="modal-body">
                                    <p>¿Esta seguro que desea cancelar esta subasta?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success btn-lg cancelar" data-dismiss="modal">Ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>