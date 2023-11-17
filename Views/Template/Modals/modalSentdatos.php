<!-- Modal -->
<div class="modal fade" id="modalSentdatos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formSubirsScan" name="formSubirsScan">
              <div class="row">
                <div class="col-sm-12">
                  <label for="">Nombre del Cliente</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder=""aria-label="Text input with checkbox">
                  </div>
                </div>
                <div class="col">
                  <label for="intNumero">Numero de Gafete</label>
                  <div class="input-group mb-3">
                    <div class="input-group-text">@</div>
                    <input type="text" class="form-control" id="intNumero" name="intNumero" required pattern="[0-9]{3}" aria-label="Text input with checkbox">
                  </div>
                </div>
                <div class="col">
                  <label for="colores">Selecciona un color</label>
                  <div class="input-group mb-3">
                    <label class="input-group-text" for="txtColores">Colores</label>
                    <select class="form-select" id="txtColores" name="txtColores">
                      <option value="" selected>Choose...</option>
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
                    <input type="text" class="form-control" placeholder="<?= $_SESSION['nombre']?>" readonly aria-label="Text input with checkbox">
                    <input type="hidden" class="form-control" id="txtVendedor" name="txtVendedor" value="<?= $_SESSION['user']?>" readonly aria-label="Text input with checkbox">
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