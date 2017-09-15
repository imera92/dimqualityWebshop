        <div class="row mt-50">
            <div class="col-xs-10 col-xs-offset-1">
                <h1>Subastas</h1>
                <hr>
            </div>
        </div>
        <div class="row mb-50">
            <?php if (isset($subasta)): ?>
                <div class="producto col-xs-10 col-xs-offset-1 mt-10">
                    <div class="row">
                        <h3><?php echo $subasta->getProducto()->getNombre(); ?></h3>
                        <hr>
                        <div class="equalHeightBox col-xs-12">
                            <?php
                                $image_name = $subasta->getProducto()->getImagen();
                                if ($image_name == ''){
                                    $image_url = base_url('assets/uploads/images/productos/default.png');
                                } else {
                                    $image_url = base_url('assets/uploads/images/productos/' . $image_name);
                                }
                            ?>
                            <div id="info-box" class="row">
                                <div class="col-xs-6">
                                    <img class="img-responsive" src="<?php echo $image_url; ?>">
                                </div>
                                <div class="infodelproducto col-xs-6">
                                    <h3>Precio Base: $ <?php echo $subasta->getPrecioBase(); ?> </h3>
                                    <h2 class="oferta mt-0"> Mayor oferta: $ 
                                    <?php
                                        if (!empty($subasta->getOfertas())) {
                                            echo $subasta->get_mayor_oferta()->get_monto();
                                        } else {
                                            echo 0.00;
                                        }
                                    ?>
                                    </h2>
                                    <?php 
                                        $start_datetime = new DateTime($subasta->getFechaInicio());
                                        $finish_datetime = new DateTime($subasta->getFechaFin());
                                    ?>
                                    <p>
                                        <span class="bold-text"> Inició:</span> <?php echo $start_datetime->format('Y-m-d'); ?> a las <?php echo $start_datetime->format('H:i'); ?>
                                    </p>
                                    </p>
                                        <span class="bold-text"> Termina:</span> <?php echo $finish_datetime->format('Y-m-d'); ?> a las <?php echo $finish_datetime->format('H:i'); ?>
                                    </p>
                                    <div class="row">
                                        <div class="col-xs-8 col-sm-6">
                                            <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input id="bid-val" type="text" class="valor form-control">
                                                <input id="auc-id" type="hidden" value=" <?php echo $subasta->getId(); ?>" >
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <button type="submit" class="btn btn-success ofertar">Ofertar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-10 col-xs-offset-1 msg">
                </div>
                <div class="col-xs-10 col-xs-offset-1 mt-30">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#1">Historial</a>
                        </li>
                    </ul>
                    <div class="tab-content ">
                        <div class="tab-pane active" id="1">
                            <?php if (!empty($subasta->getOfertas())): ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Hora</th>
                                            <th class="text-center">Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach ($subasta->getOfertas() as  $oferta): ?>
                                            <tr>
                                                <?php $date_time_arr = explode(' ', $oferta->get_fecha()); ?>
                                                <td class="text-center"><?php echo $date_time_arr[0]; ?></td>
                                                <td class="text-center"><?php echo $date_time_arr[1]; ?></td>
                                                <td class="text-center"><?php echo $oferta->get_monto(); ?></td>
                                            </tr>
                                        <?php endforeach; ?>  
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="container-fluid">
                                    <div class="row mt-20">
                                        <div class="col-xs-12 text-center">
                                            <span class="no-bid">No hay ofertas para mostrar.</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>