<div class="well contenedor col-md-6  col-md-offset-3 mt-150 mb-200">
     <div class="row">    
       <form class ="formRecuperar" action="<?php echo base_url('web/verificarCorreo'); ?>" method="post">
            <h1 class="pl-15">Recuperar tu contraseña</h1>
            <div class="form-group col-md-8"> 
                    <label>Direccion De Correo Electronico</label>
                    <input  name="email" class="form-control email" placeholder="correo electronico" type="email">
            </div>
            <div class="col-md-12">
                    <button type="button" class="btn btn-success Busqueda">Enviar</button>
            </div>
        </form>
    </div>
    <div class="row nota">
        <p><span class="bold-text">(Nota:</span>Te enviaremos un correo al mail que coloques arriba para resetear tu contraseña)</p>
    </div>
    
</div>