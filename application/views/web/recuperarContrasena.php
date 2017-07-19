<div class="well contenedor col-md-6  col-md-offset-3 mt-150 mb-200">
     <div class="row">    
       <form>
            <h1 class="pl-15">Recuperar tu contraseña</h1>
            <div class="form-group col-md-8"> 
                    <label>Direccion De Correo Electronico</label>
                    <input  class="form-control" placeholder="correo electronico" type="email">
            </div>
            <div class="col-md-12">
                    <button class="btn btn-success"><a  href="<?php echo base_url('web/passwordReset'); ?>"> Enviar </a></button>
            </div>
        </form>
    </div>
    <div class="row nota">
        <p><span class="bold-text">(Nota:</span>Te enviaremos un correo al mail que coloques arriba para resetear tu contraseña)</p>
    </div>
    
</div>