<!-- Modal -->
<div class="modal fade" id="modalSentProducts" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formSetProducts" name="formSetProducts">
              <input type="hidden" class="form-control" id="txtidform" name="txtidform">
              <div class="row" id="formExcel">
                <div class="col">
                  <div class="form-group has-icon-left">
                    <label for="txtBarcode">Barcode</label>
                    <div class="position-relative">
                      <input type="text" class="form-control" placeholder="Barcode" id="txtBarcode" name="txtBarcode">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group has-icon-left">
                    <label for="txtStock">Stock</label>
                    <div class="position-relative">
                      <input type="number" class="form-control" placeholder="Stock" min="0" id="txtStock" name="txtStock">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                   </div>
                </div>

                <div class="col-12">
                  <div class="form-group has-icon-left">
                    <label for="txtNPProd">Product Name</label>
                    <div class="position-relative">
                      <input type="text" class="form-control" placeholder="Product Name" id="txtNPProd" name="txtNPProd">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                   </div>
                </div>

                <div class="col">
                  <div class="form-group has-icon-left">
                    <label for="txtUsd">USD Price</label>
                    <div class="position-relative">
                      <input type="number" class="form-control" placeholder="Dollars" min="0" step="0.01" id="txtUsd" name="txtUsd">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                   </div>
                </div>

                <div class="col">
                  <div class="form-group has-icon-left">
                    <label for="txtMxn">MXN Price</label>
                    <div class="position-relative">
                      <input type="number" class="form-control" placeholder="Mexican Pesos" min="0" step="0.01" id="txtMxn" name="txtMxn">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                   </div>
                </div>

                <div class="col-12">
                  <div class="form-group has-icon-left">
                    <label for="txtCategory">Category</label>
                    <div class="position-relative">
                      <select class="js-example-basic-single form-control" id="txtCategory" name="txtCategory">
                        <option selected value="">Choose...</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" id="divExcel">
                <div class="col-12">
                    <div class="form-group has-icon-left">
                      <label for="docExcel">Select the Excel document</label>
                      <div class="position-relative">
                        <input type="file" class="form-control" placeholder="Select the Excel document" id="docExcel" name="docExcel">
                        <div class="form-control-icon">
                          <i class="bi bi-person"></i>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id=""  onclick="buttonExcel();" class="btn btn-success">Upload with Excel</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btnActionForm" class="btn btn-primary"><span id="btnText">Guardar</span></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>