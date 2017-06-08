
<div class='container'>
    <div class="row">
      <div class="col-md-12">
          <h1>Crear Usuario</h1>
      </div>
    </div>
    <div class="row">
      <div class="container form-group">
        <form action="registrarUsuario.php" method="POST">
          <div class="container">
            <h4>Formulario de Registro</h4>
            <div class="form-group col-md-6">
                <label for="usuario">Usuario </label>
                <input type="text" name="usuario" class="form-control" required placeholder="usuario"/>
            </div>
            <div class="form-group col-md-6">
                <label for="nombre">Nombre </label>
                <input type="text" name="nombre" class="form-control" required placeholder="Ingrese su Nombre"/>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Correo </label>
                <input type="email" name="correo" class="form-control" required aria-describedby="emailHelp" placeholder="Ingrese correo"/>
            </div>
            <div class="form-group col-md-6">
              <label for="apellido">Apellido </label>
              <input type="text" name="apellido" class="form-control" required placeholder="Ingrese su apellido"/>
            </div>
            <div class="form-group col-md-6">
              <label for="clave">Contraseña</label>
              <input type="password" class="form-control" name="clave" required placeholder="Contraseña">
            </div>
            <div class="form-group col-md-6">
              <label for="clave">Confirmar Contraseña</label>
              <input type="password" class="form-control" name="clave" required placeholder="Confirme su contraseña">
            </div>
            <h4>Información Adicional</h4>
            <div class="form-group col-md-6">
              <label for="cedula">Cédula</label>
              <input type="number" class="form-control" name="cedula" required placeholder="Cedula">
            </div>
            <div class="form-group col-md-6">
              <label for="pais">País</label>
              <input type="text" class="form-control" name="país" required placeholder="País">
            </div>
            <div class="form-group col-md-6">
              <label for="telefono">Número </label>
              <input type="number" class="form-control" name="telefono" required placeholder="Ingrese número de teléfono">
            </div>
            <div class="form-group col-md-6">
              <label for="direccion">Dirección </label>
              <input type="text" class="form-control" name="direccion" required placeholder="Ingrese su dirección">
            </div>
          </div>
          <div class="form-group">
            <input class="btn btn-primary" name="submit" type="submit" value="Regístrate" />
          </div>
        </form>
      </div>

  </div>
</div>
<script type="text/javascript" src="<?php echo base_url("public/js/jQuery-3.2.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/bootstrap.js"); ?>"></script>
