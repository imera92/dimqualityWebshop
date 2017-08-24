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
                                        <div class="info del producto col-md-6">
                                            <h3>Precio Base:  $<?php echo $subasta->precioBase;?> </h3>
                                            <h2 class="oferta"> Mayor oferta:</h2>
                                            <p><strong> Inicia: </strong>  <?php echo $subasta->fechaInicio;?></p>
                                            </p><strong> Termina:</strong>  <?php echo $subasta->fechaFin;?></p>
                                            <input type="text">
                                            <button type="submit" class="btn btn-success ">Ofertar</button>        
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-30">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#1">Descripcion</a></li>
                                    <li><a href="#2">Historial</a></li>
                                </ul>
                                <div class="tab-content ">
                                    <div class="tab-pane active" id="1">
                                        <h3>Standard tab panel created on bootstrap using nav-tabs</h3>
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