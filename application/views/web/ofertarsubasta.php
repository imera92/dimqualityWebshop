        <div class="row mt-50 mb-50">
            <div class="col-xs-10 col-xs-offset-1">
                <h1>Subastas</h1>
                <hr>
            </div>
            <div class="row">
                <?php if (isset($subasta)): ?>
                    <div class="producto col-xs-10 col-xs-offset-1 mt-30">
                        <div class="row">
                            <h3><?php echo $producto->getNombre();?></h3>
                            <hr>
                            <div class="equalHeightBox col-xs-12">
                                <?php 
                                if ($producto->getImagen() == ''){
                                    $imagenUrl = base_url("assets/uploads/images/productos/default.png");
                                } else {
                                    $imagenUrl = base_url("assets/uploads/images/productos/" . $producto->getImagen());
                                }
                                ?>
                                <div id="info-box" class="row">
                                    <div class="col-xs-6">
                                        <img class="img-responsive" src="<?php echo $imagenUrl; ?>">
                                    </div>
                                    <div class="infodelproducto col-xs-6">
                                        <h3>Precio Base:  $<?php echo $subasta->getPrecioBase();?> </h3>
                                        <h2 class="oferta"> Mayor oferta: <?php echo $mayor->monto;?></h2>
                                        <p><strong> Inicia: </strong>  <?php echo $subasta->getFechaInicio();?></p>
                                        </p><strong> Termina:</strong>  <?php echo $subasta->getFechaFin();?></p>
                                        <input type="text" class="valor">
                                        <input type="hidden" class="si" value=" <?php echo $subasta->getId();?>" >
                                        <button type="submit" class="btn btn-success ofertar">Ofertar</button>
                                    </div>
                                    <!-- <div id="no-data-alert" class="row mt-20">
                                        <div class="col-xs-12">
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span>
                                                </button>Es necesario que ingrese un valor.
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-10 col-xs-offset-1 msg">
                    </div>
                    <div class="col-xs-10 col-xs-offset-1 mt-30">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#1">Historial</a></li>
                            <!-- <li><a href="#2">Historial</a></li> -->
                        </ul>
                        <div class="tab-content ">
                            <div class="tab-pane active" id="1">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach ($ofertas as  $oferta): ?>
                                            <tr>
                                                <td><?php  $FechaHora = explode(" ", $oferta->fecha); echo $FechaHora[0] ;?></td>
                                                <td><?php  $FechaHora = explode(" ", $oferta->fecha); echo $FechaHora[1] ;?></td>
                                                <td><?php echo  $oferta->monto;?></td>
                                            </tr>
                                        <?php endforeach; ?>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>