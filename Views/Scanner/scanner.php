<?php headerHome($data);
navbar($data);
getModal('modalSentdatos',$data);
?>  
        <audio id="audio" controls>
          <source type="audio/wav" src="<?= media();?>/sonidos/Beep.wav">
        </audio>
        <div class="container">
          <div class="row">
            <div class="col-sm-7">
              <div class="div-centro">
                <div id="contenedor"></div>
                <div class="row">
                  <div class="col-sm-8">
                    <h1 id="rproducto"></h1>     
                  </div>
                  <div class="col-sm-4">
                    <div class="row">
                      <div class="col-6" align="center">
                        <h1 id="preciousd" class="preciop"></h1>                     
                        <h1 id="dispreusd" class="preciop"></h1>                     
                      </div>
                      <div class="col-6">
                        <h1 id="preciomxm" class="preciop"></h1>     
                        <h1 id="dispremxm" class="preciop"></h1>     
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-5 tbproductos" >
              <div class="div-izquierdo">
                <div class="menu_bar" align="right">
                  <a href="#" class="bt-menu"><i class="bi bi-x-diamond-fill bi-sub fs-4 text-gray-600"></i></a>
                </div>


                <h1 class="display-6 text-center">Products</h1>
                <div class="contable overflow-auto">
                  <table class="table" id="tablaproductos" >
                    <thead  class="thead">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Cant.</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
                <div class="total">
                  <div class="row">
                    <div class="col-6">
                      <h2>Total</h2>
                    </div>
                    <div class="col-6">
                      <div class="row">
                        <div class="col-12">
                          <h1 id="totalmxm" class="preciop">$0.00 MXN</h1>     
                        </div>
                        <div class="col-12">
                          <h1 id="totalusd" class="preciop">$0.00 USD</h1>     
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="div-pago">
                  <button class="btn-pago btn btn-primary" type="submit" onclick="modalinfo();">Finalizar Venta</button>
                </div>
              </div>
            </div>  

          </div>

        </div>
<?php footerHome($data); ?>
