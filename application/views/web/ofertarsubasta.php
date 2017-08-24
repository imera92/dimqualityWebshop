<div class=" row ">
        <div class="contenedor">
                <div class="row">
                        <div class="col-md-12 mt-20">
                            <div class="index-box">
                                <h2>SUBASTAS</h2>
                            </div>
                        </div>  
                        <?php if (isset($subasta)): ?>
                            <div class="producto col-md-12 mt-30">
                                <h1><?php echo $producto->nombre;?></h1>
                                <hr>
                                <div class="equalHeightBox">
                                        <img class="img-responsive col-md-6" src="<?php echo base_url('assets/uploads/images/productos/'.$producto->imagen ); ?>">   
                                        <div class="infodelproducto col-md-6">
                                            <h3>Precio Base:  $<?php echo $subasta->precioBase;?> </h3>
                                            <h2 class="oferta"> Mayor oferta: <?php echo $mayor->monto;?></h2>
                                            <p><strong> Inicia: </strong>  <?php echo $subasta->fechaInicio;?></p>
                                            </p><strong> Termina:</strong>  <?php echo $subasta->fechaFin;?></p>
                                            <input type="text" class="valor">
                                            <input type="hidden" class="si" value=" <?php echo $subasta->id;?>" >
                                            <button type="submit" class="btn btn-success ofertar">Ofertar</button>        
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-12 msg">
                            </div>
                            <div class="col-md-12 mt-30">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#1">Descripcion</a></li>
                                    <li><a href="#2">Historial</a></li>
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
                                    <div class="tab-pane" id="2">
                                        <h3>Holi camaron con coli</h3>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                </div>
        </div>
</div>