<!-- Modal -->
<div class="modal fade" id="modalSentBank" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formSetBanks" name="formSetBanks">
              <div class="row">
                <div class="col">
                  <label for="txtNBank">Bank Code</label>
                  <div class="input-group mb-3">
                    <div class="input-group-text">Code</div>
                    <input type="text" class="form-control" id="txtNBank" name="txtNBank" minlength="8" maxlength="8" aria-label="Text input with checkbox">
                  </div>
                </div>
                <div class="col">
                  <label for="colores">Select A Type Of Currency</label>
                  <div class="input-group mb-3">
                    <label class="input-group-text" for="txtDivisa">Currency</label>
                    <select class="form-select" id="txtDivisa" name="txtDivisa">
                      <option value="" selected>Choose...</option>
                      <option value="MXN">MXN</option>
                      <option value="USD">USD</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <label for="txtNameB">Name Of The Bank</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" class="form-control" id="txtNameB" name="txtNameB" aria-label="Text input with checkbox">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
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