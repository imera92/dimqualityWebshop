
        <div class="categorias row mb-40 ">
            <div class="collapse navbar-collapse navbar-ex1-collapse ">  
                <ul class="nav navbar-nav ">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Desktops</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-inner">
                                <ul class="list-unstyled">
                                    <li><a href="#">PC (0)</a></li>
                                    <li><a href="#">Mac (1)</a></li>
                                </ul>
                            </div>
                            <a href="#" class="see-all">See All Desktops</a> 
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Laptops &amp; Notebooks</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-inner">
                                <ul class="list-unstyled">
                                    <li><a href="#">Macs (0)</a></li>
                                    <li><a href="#">Windows (0)</a></li>
                                </ul>
                            </div>
                        <a href="#" class="see-all">See All Laptops &amp; Notebooks</a> </div>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Components</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-inner">
                                <ul class="list-unstyled">
                                    <li><a href="#">Mice and Trackballs (0)</a></li>
                                    <li><a href="#">Monitors (2)</a></li>
                                    <li><a href="#">Printers (0)</a></li>
                                    <li><a href="#">Scanners (0)</a></li>
                                    <li><a href="#">Web Cameras (0)</a></li>
                                </ul>
                            </div>
                        <a href="#" class="see-all">See All Components</a> </div>
                    </li>
                    <li><a href="#">Tablets</a></li>
                    <li><a href="#">Software</a></li>
                    <li><a href="#">Phones &amp; PDAs</a></li>
                    <li><a href="#">Cameras</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">MP3 Players</a>
                        <div class="dropdown-menu" style="margin-left: -203.625px;">
                            <div class="dropdown-inner">
                                <ul class="list-unstyled">
                                    <li><a href="#">test 11 (0)</a></li>
                                    <li><a href="#">test 12 (0)</a></li>
                                    <li><a href="#">test 15 (0)</a></li>
                                    <li><a href="#">test 16 (0)</a></li>
                                    <li><a href="#">test 17 (0)</a></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li><a href="#">test 18 (0)</a></li>
                                    <li><a href="#">test 19 (0)</a></li>
                                    <li><a href="#">test 20 (0)</a></li>
                                    <li><a href="#">test 21 (0)</a></li>
                                    <li><a href="#">test 22 (0)</a></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li><a href="#">test 23 (0)</a></li>
                                    <li><a href="#">test 24 (0)</a></li>
                                    <li><a href="#">test 4 (0)</a></li>
                                    <li><a href="#">test 5 (0)</a></li>
                                    <li><a href="#">test 6 (0)</a></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li><a href="#">test 7 (0)</a></li>
                                    <li><a href="#">test 8 (0)</a></li>
                                    <li><a href="#">test 9 (0)</a></li>
                                </ul>
                            </div>
                            <a href="#" class="see-all">See All MP3 Players</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row mb-40">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo base_url('public/img/propaganda2.jpg'); ?>" class="img-responsive ">
                    </div>
                    <div class="item">
                        <img src="<?php echo base_url('public/img/promocion1.jpg'); ?>" class="img-responsive col-md-12 ">
                    </div>    
                    <div class="item">
                        <img src="<?php echo base_url('public/img/propaganda1.jpg'); ?>" class="img-responsive col-md-12">
                    </div>
                    <div class="item">
                        <img src="<?php echo base_url('public/img/propaganda3.png'); ?>" alt="Chicago" class="img-responsive col-md-12">
                    </div>


                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="row mb-40">
            <div class="productos_destacados">
                <div class="section-title center">
                    <h2>Productos <strong>Destacados</strong></h2>
                    <div class="line">
                     <hr>
                    </div>
                </div>
                <?php foreach($productosDestacados as $index => $producto): ?>
                        <div class="col-xs-12 col-sm-6 col-md-3 equalHeightBox">
                            <div class="well">
                                <div class="row">
                                    <?php 
                                    if ($producto->getImagen() == ''){
                                        $imagenUrl = base_url("assets/uploads/images/productos/default.png");
                                    } else {
                                        $imagenUrl = base_url("assets/uploads/images/productos/".$producto->getImagen());
                                    }
                                    ?>
                                    <img class="img-responsive" src="<?php echo $imagenUrl; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 nombreProducto">
                                        <span><?php echo $producto->getNombre(); ?></span>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-12 precioProducto">
                                        <span>$ <?php echo $producto->getPVP(); ?></span>
                                    </div>
                                </div>
                                <div class="row mt-10 text-center">
                                    <div class="col-xs-8">
                                        <a href="<?php echo base_url('producto/' . $producto->getId()); ?>" class="btn btn-default btn-masInfo">Más Información</a>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo form_open('carrito/anadirProducto' , array('id' => 'frm-anadirProducto')); ?>
                                            <?php echo form_input(array(
                                                'type' => 'hidden',
                                                'id' => 'cantidadInput',
                                                'name' => 'cantidad',
                                                'value' => 1,
                                            ));?>
                                            <?php echo form_input(array(
                                                'type' => 'hidden',
                                                'id' => 'idInput',
                                                'name' => 'id',
                                                'value' => $producto->getId()
                                            ));?>
                                            <button type="submit" class="btn btn-add"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>   
        <div class="row mb-40">
            <div class="productos_Nuevos">
                <div class="section-title center">
                    <h2>Productos <strong>Nuevos</strong></h2>
                    <div class="line">
                     <hr>
                    </div>
                </div>
                <?php foreach($productosRecientes as $index => $producto): ?>
                        <div class="col-xs-12 col-sm-6 col-md-3 equalHeightBox">
                            <div class="well">
                                <div class="row">
                                    <?php 
                                    if ($producto->getImagen() == ''){
                                        $imagenUrl = base_url("assets/uploads/images/productos/default.png");
                                    } else {
                                        $imagenUrl = base_url("assets/uploads/images/productos/".$producto->getImagen());
                                    }
                                    ?>
                                    <img class="img-responsive" src="<?php echo $imagenUrl; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 nombreProducto">
                                        <span><?php echo $producto->getNombre(); ?></span>
                                    </div>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-xs-12 precioProducto">
                                        <span>$ <?php echo $producto->getPVP(); ?></span>
                                    </div>
                                </div>
                                <div class="row mt-10 text-center">
                                    <div class="col-xs-8">
                                        <a href="<?php echo base_url('producto/' . $producto->getId()); ?>" class="btn btn-default btn-masInfo">Más Información</a>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo form_open('carrito/anadirProducto' , array('id' => 'frm-anadirProducto')); ?>
                                            <?php echo form_input(array(
                                                'type' => 'hidden',
                                                'id' => 'cantidadInput',
                                                'name' => 'cantidad',
                                                'value' => 1,
                                            ));?>
                                            <?php echo form_input(array(
                                                'type' => 'hidden',
                                                'id' => 'idInput',
                                                'name' => 'id',
                                                'value' => $producto->getId()
                                            ));?>
                                            <button type="submit" class="btn btn-add"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>   
            </div>
        </div>
    </div>