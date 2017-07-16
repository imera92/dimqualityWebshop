<div class="row mt-50 mb-50">
    <div class="col-xs-10 col-xs-offset-1">
        <?php if (!empty($result)): ?>
            <?php echo $result; ?>
        <?php endif; ?>
        <h1>Agendar Cita</h1>
        <hr>
        <form id="userCita" action="<?php echo base_url('usuario/agendarCita') ?>" method="POST">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="fecha">Fecha y Hora </label>
                    <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd hh:ii">
                        <input type='text' class="form-control" name="fecha" required readonly/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <input type="hidden" id="dtp_input1" value="" />
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="asunto">Asunto </label>
                    <textarea class="form-control" name="asunto" rows="5" required placeholder="Ingrese asunto de la cita"></textarea>
                </div>
            </div>

            <input class="btn btn-registrar" name="submit" type="submit" value="Registrar"/>
            <input class="btn btn-cancelar" name="cancelar" value="Cancelar"/>


        </form>
    </div>
</div>
