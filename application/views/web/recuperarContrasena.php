<div class=" row msg col-md-6  col-md-offset-3 mt-60 mb-100">

    <div class="well contenedor ">
        <div class="row">    
            <form class ="formRecuperar" action="<?php echo base_url('web/verificarCorreo'); ?>" method="post">
                    <h1 class="pl-15">Recuperar contraseña</h1>
                    <div class="form-group col-md-8"> 
                            <label>Direccion De Correo Electronico</label>
                            <input  name="email" class="form-control email" placeholder="correo electronico" type="email">
                    </div>
                    <div class="col-md-12">
                            <button type="button" class="btn btn-success Busqueda">Enviar</button>
                    </div>
            </form>
            <div class="col-md-12 nota pl-15">
                <p><span class="bold-text">(Nota:</span> Por favor, proporciona la dirección de correo que usaste para tu cuenta.Te enviaremos un correo al mail que coloques arriba para resetear tu contraseña)</p>
            </div>
        </div>        
    </div>
</div>




 