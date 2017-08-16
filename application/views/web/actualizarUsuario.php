    <div class="row mt-50 mb-50">
      <div class="col-xs-10 col-xs-offset-1">
        <h1>Crear Usuario</h1>
        <hr>
        <form id="userForm" method="POST">
          <h4>Formulario de Registro</h4>
          <hr class="secondary-separator">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="usuario">Usuario <span class="red">*</span></label>
              <input type="text" name="usuario" class="form-control" required placeholder="Ingrese su usuario" value="<?php echo !empty($user['user'])?$user['user']:''; ?>" />
              <?php echo form_error('usuario','<label class="help-block red">','</label>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="nombre">Nombre o Razón Social <span class="red">*</span></label>
              <input type="text" name="nombre" class="form-control" required placeholder="Ingrese su nombre o razón social" value="<?php echo !empty($user['nombre'])?$user['nombre']:''; ?>"/>
              <?php echo form_error('nombre','<label class="help-block red">','</label>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="email">Correo Electrónico <span class="red">*</span></label>
              <input type="email" name="correo" class="form-control" required aria-describedby="emailHelp" placeholder="Ingrese su correo" value="<?php echo !empty($user['email'])?$user['email']:''; ?>"/>
              <?php echo form_error('correo','<label class="help-block red">','</label>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="apellido">Apellido</label>
              <input type="text" name="apellido" class="form-control" placeholder="Ingrese su Apellido" value="<?php echo !empty($user['apellido'])?$user['apellido']:''; ?>"/>
              <?php echo form_error('apellido','<label class="help-block red">','</label>'); ?>
            </div>
          </div>
          <h4>Información Adicional</h4>
          <hr class="secondary-separator">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="cedula">Cédula o RUC <span class="red">*</span></label>
              <input type="text" class="form-control" name="cedula" maxlength="13" required placeholder="Ingrese su Nro. de Cedula o RUC"  value="<?php echo !empty($user['cedula'])?$user['cedula']:''; ?>">
              <?php echo form_error('cedula','<label class="help-block red">','</label>'); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="telefono">Número de Teléfono <span class="red">*</span></label>
              <input type="text" class="form-control" name="telefono" maxlength="10" required placeholder="Ingrese su número de teléfono (042123456/0981234567)" value="<?php echo !empty($user['telefono'])?$user['telefono']:''; ?>">
              <?php echo form_error('telefono','<label class="help-block red">','</label>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="direccion">Dirección <span class="red">*</span></label>
              <input type="text" class="form-control" name="direccion" required placeholder="Ingrese su dirección" value="<?php echo !empty($user['direccion'])?$user['direccion']:''; ?>">
              <?php echo form_error('direccion','<label class="help-block red">','</label>'); ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <input class="btn btn-primary btn-registrar btn-lg" name="submit" type="submit" value="Guardar"/>
              <a href="<?php echo base_url() ?>" class ="btn btn-lg btn-danger pull-right" >Cancelar</a>
            </div>            
          </div>
        </form>
      </div>
    </div>
  </div>