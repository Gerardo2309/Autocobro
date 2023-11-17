<!-- Modal -->
<div class="modal fade modal-dialog-scrollable " id="modalSentventa" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formSentventa" name="formSentventa">
              <fieldset id="fiel1">
                <div class="row">
                  <div class="col">
                    <label for="intNumero">Numero de Gafete</label>
                    <div class="input-group mb-3">
                      <div class="input-group-text">@</div>
                      <input type="number" class="form-control" id="intNumero" name="intNumero" readonly aria-label="Text input with checkbox">
                    </div>
                  </div>
                  <div class="col">
                    <label for="colores">Selecciona un color</label>
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="txtColores">Colores</label>
                      <select class="form-select" id="txtColores" name="txtColores">
                        <option selected>Choose...</option>
                        <option value="Amarillo">Amarillo</option>
                        <option value="Rojo">Rojo</option>
                        <option value="Verde">Verde</option>
                        <option value="Negro">Negro</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <label for="txtVendedor">Nombre del vendedor</label>
                    <div class="input-group mb-3">
                      <div class="input-group-text">@</div>
                      <input type="text" class="form-control" id="txtVendedor" name="txtVendedor" value="" readonly aria-label="Text input with checkbox">
                      <input type="hidden" class="form-control" id="txtCajero" name="txtCajero" value="<?= $_SESSION['user']?>" readonly aria-label="Text input with checkbox">
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="next btn btn-info" onclick="next('fiel'); banco();" value="">Siguiente</button>
              </fieldset>
              <fieldset id="fiel2">
                <div class="row">
                  <div class="col-sm-8">
                    <div id="contenedor"></div>
                  </div>
                  <div class="col-sm-4">
                    <h5>Banco</h5>
                    <p id="scbank"></p>
                    <h5>Moneda</h5>
                    <p id="scmoneda"></p>
                  </div>
                </div>
                <input type="button" name="previous" class="previous btn btn-secondary" onclick="prev('fiel');offbanco();" value="Previo" />
                <button type="button" class="next btn btn-info" onclick="next('fiel'); offbanco();" value="">Siguiente</button>
              </fieldset>
              <fieldset id="fiel3">
                <div class="row">
                  <div class="col-sm-12">


                    <div id="app" class="col-sm-12">  
                        <div class="row">
                          <div class="col-8">
                            <h5>Mexico Magico</h5>
                            <p>Blvd. Kukulcan km 7,5, Kukulcan Boulevard, Zona Hotelera, 77500 Cancún, Q.R.</p>
                          </div>
                          <div class="col-4">
                            <img src="<?= media();?>/images/logo/logo.png" style="width:100%; height: 100px;" />
                          </div>
                        </div>
                        <hr />
                        <div class="row">
                          <div class="col-4">
                            <h5>No.Gafete</h5>
                            <p id="fngft"></p>
                          </div>
                          <div class="col-4">
                            <h5>N° de factura</h5>
                            <h5 id="nufa"></h5>
                          </div>
                          <div class="col-4">
                            <h5>Fecha</h5>
                            <p id="ffech"></p>
                          </div>
                          <div class="col-12">
                            <h5>Cliente</h5>
                            <p> Juan Escobedo </p>
                          </div>
                        </div>
                      
                        <div class="row">
                          <table class="table" id="tablafactura">
                            <thead>
                              <tr>
                                <th>Cant.</th>
                                <th>Descrip.</th>
                                <th>P/U</th>
                                <th>Importe</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th></th>
                                <th></th>
                                <th>Total Venta</th>
                                <th id="totfact">$15,000.00</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      
                        <div class="row">
                          <div class="col-12">
                            <h5>Forma de pago</h5>
                            <div class="row">
                              <div class="col-6">
                                <p id="fban">Nombre del Banco</p>
                              </div>
                              <div class="col-6">
                                <p id="fmon">Moneda: </p>
                              </div>
                              <div class="col-12">
                                <p id="fntran">Transaccion: </p>
                              </div>
                              <div class="col-7">
                              <input class="form-check-input" type="radio" value=""id="checkbox-1"/>
                              <label class="form-check-label" for="checkbox-1">Imprimir</label>
                              <input class="form-check-input" type="radio" value=""id="checkbox-1"/>
                              <label class="form-check-label" for="checkbox-1">Enviar por Correo</label>
                              </div>
                              <div class="col-5">
                                <label>Correo electronico</label>
                                <input type="text" class="form-control" id="" name="" aria-label="Text input with checkbox">
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>



                  </div>
                </div>
                <input type="button" name="previous" class="previous btn btn-secondary" onclick="prev('fiel');" value="Previo" />
                <button type="submit" id="btnActionForm" class="btn btn-primary"><span id="btnText">Guardar</span></button>
              </fieldset>
            </form>
            <div id="spincarga" class="menu_bar">
              <img src="assets/vendors/svg-loaders/grid.svg" class="me-4 spincargaimg"  alt="audio">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

