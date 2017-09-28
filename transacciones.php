<div class="container">
        <div class="row">

            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Còdigo</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Monto</th>
                        <th>Cèdula</th>
                        <th>Estado del pago</th>
                        <th>Estado de compra</th>
                        <th>Estado de entrega</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DQ001</td>
                        <td>14/09/2017</td>
                        <td>Ivan Mera</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger" data-toggle="modal" data-target="#EP">Pendiente</button></td>
                        <td><button class="btn btn-danger" data-toggle="modal" data-target="#EC">Pendiente</button></td>
                        <td><button class="btn btn-danger" data-toggle="modal" data-target="#EE">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ002</td>
                        <td>14/09/2017</td>
                        <td>karen Borbor</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ003</td>
                        <td>14/09/2017</td>
                        <td>Lilibeth Moreira</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ004</td>
                        <td>14/09/2017</td>
                        <td>Pepito suarez</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ005</td>
                        <td>14/09/2017</td>
                        <td>Lucas</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ006</td>
                        <td>14/09/2017</td>
                        <td>Chester</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ007</td>
                        <td>14/09/2017</td>
                        <td>Ivan Mera</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ008</td>
                        <td>14/09/2017</td>
                        <td>karen Borbor</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ009</td>
                        <td>14/09/2017</td>
                        <td>Lilibeth Moreira</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ010</td>
                        <td>14/09/2017</td>
                        <td>Pepito suarez</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ011</td>
                        <td>14/09/2017</td>
                        <td>Lucas</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                    <tr>
                        <td>DQ012</td>
                        <td>20/09/2017</td>
                        <td>Chester</td>
                        <td>$100</td>
                        <td>0986512345</td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                        <td><button class="btn btn-danger">Pendiente</button></td>
                    </tr>
                </tbody>
            </table>
            <!-- Modal -->
            <div class="modal fade" id="EP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                               <span aria-hidden="true">&times;</span>
                                               <span class="sr-only">Close</span>
                                        </button>
                            <h4 class="modal-title" id="myModalLabel">
                                Estado de Pago
                            </h4>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-sm-3" for="inputEmail3">Fecha de Pago  </label>
                                    <div class="col-sm-8 input-group date prueb" id='datetimepicker1'>
                                        <input type='text' class="form-control">
                                        <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3">Tipo de pago</label>
                                    <div class="col-sm-9 dt">
                                        <select class="form-control" id="sel1">
                                                            <option>Depòsito/Transferencia</option>
                                                            <option>Efectivo/Pago en oficina</option>
                                                            <option>Cheque</option>
                                                </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Cerrar
                                        </button>
                            <button type="button" class="btn btn-success">
                                            Guardar
                                        </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="EC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                          <span aria-hidden="true">&times;</span>
                                          <span class="sr-only">Close</span>
                                   </button>
                            <h4 class="modal-title" id="myModalLabel">
                                Estado de la Compra
                            </h4>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" id="form2">
                                <div class="form-group">
                                    <label class="col-sm-3">Tipo de Entrega: </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="sel1">
                                                       <option>Oficina</option>
                                                       <option>Domicilio</option>
                                           </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3" for="inputEmail3">Direccion: </label>
                                    <div class="col-sm-8">
                                        <input name="direccion" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3" for="inputEmail3">Quien recibe: </label>
                                    <div class="col-sm-8">
                                        <input type="email" name="recibe" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3" for="inputEmail3">Cèdula: </label>
                                    <div class="col-sm-8">
                                        <input type="email" name="cedula" class="form-control">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                               Cerrar
                                   </button>
                            <button type="button" class="btn btn-success sub">
                                       Guardar
                                   </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="EE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                                             <span aria-hidden="true">&times;</span>
                                                             <span class="sr-only">Close</span>
                                                      </button>
                            <h4 class="modal-title" id="myModalLabel">
                                Estado de la Entrega
                            </h4>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-sm-3" for="inputEmail3">Fecha de Entrega  </label>
                                    <div class="col-sm-8 input-group date prueb" id='datetimepicker2'>
                                        <input type='text' class="form-control">
                                        <span class="input-group-addon">
                                                                      <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3">Estado</label>
                                    <div class="col-sm-9 dt">
                                        <select class="form-control" id="sel1">
                                                                          <option>Listo para retirar</option>
                                                                          <option>Listo para envio</option>
                                                                          <option>Entregado</option>
                                                                          <option>En ruta</option>
                                                                          <option>Entregado</option>
                                                              </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>