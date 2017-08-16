    <div class="row mt-50 mb-50">
      <div class="col-xs-10 col-xs-offset-1">
        <h1>Crear Usuario</h1>
        <hr>
        <form id="userForm" action="<?php echo base_url('usuario/crearUsuario') ?>" method="POST">
          <h4>Formulario de Registro</h4>
          <hr class="secondary-separator">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="usuario">Usuario <span class="red">*</span></label>
              <input type="text" name="usuario" class="form-control" required placeholder="Ingrese su usuario" value="<?php echo !empty($user['user'])?$user['user']:''; ?>" />
              <?php echo form_error('usuario','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="nombre">Nombre o Razón Social <span class="red">*</span></label>
              <input type="text" name="nombre" class="form-control" required placeholder="Ingrese su nombre o razón social" value="<?php echo !empty($user['nombre'])?$user['nombre']:''; ?>"/>
              <?php echo form_error('nombre','<span class="help-block">','</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="email">Correo Electrónico <span class="red">*</span></label>
              <input type="email" name="correo" class="form-control" required aria-describedby="emailHelp" placeholder="Ingrese su correo" value="<?php echo !empty($user['email'])?$user['email']:''; ?>"/>
              <?php echo form_error('correo','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="apellido">Apellido</label>
              <input type="text" name="apellido" class="form-control" placeholder="Ingrese su Apellido" value="<?php echo !empty($user['apellido'])?$user['apellido']:''; ?>"/>
              <?php echo form_error('apellido','<span class="help-block">','</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="clave">Contraseña <span class="red">*</span></label>
              <input type="password" class="form-control" name="clave" id="clave" required placeholder="Ingrese una contraseña (min: 6 caracteres)">
              <?php echo form_error('clave','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="conf_clave">Confirmar Contraseña <span class="red">*</span></label>
              <input type="password" class="form-control" name="conf_clave" id="conf_clave" required placeholder="Confirme su contraseña">
              <?php echo form_error('conf_clave','<span class="help-block">','</span>'); ?>
            </div>
          </div>
          <h4>Información Adicional</h4>
          <hr class="secondary-separator">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="cedula">Cédula o RUC <span class="red">*</span></label>
              <input type="text" class="form-control" name="cedula" maxlength="13" required placeholder="Ingrese su Nro. de Cedula o RUC"  value="<?php echo !empty($user['cedula'])?$user['cedula']:''; ?>">
              <?php echo form_error('cedula','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="telefono">Número de Teléfono <span class="red">*</span></label>
              <input type="text" class="form-control" name="telefono" maxlength="10" required placeholder="Ingrese su número de teléfono (042123456/0981234567)" value="<?php echo !empty($user['telefono'])?$user['telefono']:''; ?>">
              <?php echo form_error('telefono','<span class="help-block">','</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="direccion">Dirección <span class="red">*</span></label>
              <input type="text" class="form-control" name="direccion" required placeholder="Ingrese su dirección" value="<?php echo !empty($user['direccion'])?$user['direccion']:''; ?>">
              <?php echo form_error('direccion','<span class="help-block">','</span>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <input class="btn btn-registrar" name="submit" type="submit" value="Registrar"/><span class="required">* Campo Requerido</span>
            </div>            
          </div>
        </form>
      </div>
    </div>
  </div>