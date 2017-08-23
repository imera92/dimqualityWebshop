<div class=" row msg col-md-6  col-md-offset-3 mt-100 mb-200 pb-20 pl-30">
        <div class="well contenedor">
                <div class="row">
                        <h1 class="pl-15">Cambiar contraseña</h1>
                        <form action="<?php echo base_url('web/ActualizarContrasena'); ?>" method="post" id='formCheckPassword'>
                                <div class="form-group col-md-8 c1"> 
                                        <label>Nueva contraseña</label>
                                        <input  name="contrasena"type ="password" class="form-control c" placeholder="" type="email">
                                </div>
                                <div class="form-group col-md-8 c2"> 
                                        <label>Confirmar nueva contraseña</label>
                                        <input  name="vContraseña" type ="password" class="form-control vc" placeholder="" type="email">
                                </div>
                                <input type="hidden" name="t" class="t" value="<?php echo $token ?>">
                                <input type="hidden" name="us" class="us" value="<?php echo $id ?>"> 
                                <div class="col-md-12">
                                        <button type ="button" class="btn btn-success Busqueda">Actualizar contraseña</button>
                                </div>
                        </form>
                </div>
        </div>
</div>