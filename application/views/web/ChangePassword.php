<div class="well contenedor col-md-6  col-md-offset-3 mt-100 mb-200 pb-20 pl-30">
     <div class="row">
       <h1 class="pl-15">Cambiar contraseña</h1>
       <form>
            <div class="form-group col-md-8"> 
                    <label>Nueva contraseña</label>
                    <input  type ="password" class="form-control" placeholder="" type="email">
            </div>
             <div class="form-group col-md-8"> 
                    <label>Confirmar nueva contraseña</label>
                    <input  type ="password" class="form-control" placeholder="" type="email">
            </div>
            <input type="hidden" name="t" value="<?php echo $token ?>">
            <input type="hidden" name="us" value="<?php echo $usuario ?>"> 
            <input>
            <div class="col-md-12">
                    <button class="btn btn-success ">Actualizar contraseña</button>
            </div>
        </form>
    </div>
</div>