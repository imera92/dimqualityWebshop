
<div class='container'>
    <div class="row">
      <div class="col-md-12">
          <h1>Crear Usuario</h1>
      </div>
    </div>
    <div class="row">
      <div class="container form-group">
        <form action="registrarUsuario" method="POST">
          <div class="container">
            <h4>Formulario de Registro</h4>
            <div class="form-group col-md-6">
                <label for="usuario">Usuario </label>
                <input type="text" name="usuario" class="form-control" required placeholder="usuario" value="<?php echo !empty($user['user'])?$user['user']:''; ?>" />
                <?php echo form_error('usuario','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
                <label for="nombre">Nombre </label>
                <input type="text" name="nombre" class="form-control" required placeholder="Ingrese su Nombre" value="<?php echo !empty($user['nombre'])?$user['nombre']:''; ?>"/>
                <?php echo form_error('nombre','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Correo </label>
                <input type="email" name="correo" class="form-control" required aria-describedby="emailHelp" placeholder="Ingrese correo" value="<?php echo !empty($user['email'])?$user['email']:''; ?>"/>
                <?php echo form_error('correo','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="apellido">Apellido </label>
              <input type="text" name="apellido" class="form-control" required placeholder="Ingrese su apellido" value="<?php echo !empty($user['apellido'])?$user['apellido']:''; ?>"/>
              <?php echo form_error('apellido','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="clave">Contraseña</label>
              <input type="password" class="form-control" name="clave" required placeholder="Contraseña">
              <?php echo form_error('clave','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="conf_clave">Confirmar Contraseña</label>
              <input type="password" class="form-control" name="conf_clave" required placeholder="Confirme su contraseña">
              <?php echo form_error('conf_clave','<span class="help-block">','</span>'); ?>
            </div>
            <h4>Información Adicional</h4>
            <div class="form-group col-md-6">
              <label for="cedula">Cédula</label>
              <input type="text" class="form-control" name="cedula" required placeholder="Cedula" pattern="[0-9]{10}" value="<?php echo !empty($user['cedula'])?$user['cedula']:''; ?>">
              <?php echo form_error('cedula','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="pais">País</label>
              <input type="text" class="form-control" name="pais" required placeholder="País" value="<?php echo !empty($user['pais'])?$user['pais']:''; ?>">
              <?php echo form_error('pais','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="telefono">Número </label>
              <input type="text" class="form-control" name="telefono" required placeholder="Ingrese número de teléfono" pattern="[0-9]{9,10}" value="<?php echo !empty($user['telefono'])?$user['telefono']:''; ?>">
              <?php echo form_error('telefono','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="direccion">Dirección </label>
              <input type="text" class="form-control" name="direccion" required placeholder="Ingrese su dirección" value="<?php echo !empty($user['direccion'])?$user['direccion']:''; ?>">
              <?php echo form_error('direccion','<span class="help-block">','</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <input class="btn btn-primary" name="submit" type="submit" value="Regístrate"/>
          </div>
        </form>
      </div>

  </div>
</div>
<script type="text/javascript" src="<?php echo base_url("public/js/jQuery-3.2.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/bootstrap.js"); ?>"></script>
