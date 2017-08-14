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
                <form>
                    <div class="form-group ">
                        <label for="fehca/hora" class="col-md-4">Fecha y hora de inicio: </label>
                        <div class="col-md-8 pb-15 input-group date datetimepicker1 dt1">
                            <?php if (isset($subasta)): ?>
                                        <input  class ="form-control" id="datetimepickerFrom" type="text" value="<?= htmlspecialchars($subasta->fechaInicio) ?>"/>
                                     <?php else: ?>
                                        <input  class="form-control fh-i"> 
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
                                        <input  class ="form-control" id="datetimepickerFrom" type="text" value="<?= htmlspecialchars($subasta->fechaFin) ?>"/>
                                     <?php else: ?>
                                        <input  class="form-control fh-f"> 
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
                                        <?php foreach ($categorias as  $categoria): ?>
                                            <option class=><?php echo $categoria->nombre;?></option>
                                        <?php endforeach; ?>
                                    
                                </select>
                            </div>
                            <div class=" box  col-md-3">
                                <strong>Marca: </strong>
                                <select class="form-control marca">
                                </select>
                            </div>
                            <div class="box  col-md-3">
                                <strong>Producto: </strong>
                                <select class="form-control producto">
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
                                         <input  class="form-control pb">
                                <?php endif; ?>   
                                
                            </div>
                    </div>                 
                    <button type="button" class="btn btn-primary ml-15 mt-20 obtener">Guardar</button>
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