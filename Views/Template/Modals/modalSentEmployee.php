<!-- Modal -->
<div class="modal fade" id="modalSentEmployee" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formSetEmployee" name="formSetEmployee">
              <input type="hidden" class="form-control" id="txtidform" name="txtidform">
              <input type="hidden" class="form-control" id="txtolduser" name="txtolduser">
              <div class="row">
                <div class="col">
                  <div class="form-group has-icon-left">
                    <label for="txtusername">User Name</label>
                    <div class="position-relative">
                      <input type="text" class="form-control" placeholder="User Name" id="txtusername" name="txtusername">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                   </div>
                </div>

                <div class="col">
                  <div class="form-group has-icon-left">
                    <label for="txtRol">Role Type</label>
                    <div class="position-relative">
                      <select class="form-control" id="txtRol" name="txtRol">
                        <option selected value="">Choose...</option>
                        <option value="1">Administrator</option>
                        <option value="2">Seller</option>
                        <option value="3">Cashier</option>
                        <option value="4">Waiter</option>
                      </select>
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group has-icon-left">
                    <label for="txtNames">First Name</label>
                    <div class="position-relative">
                      <input type="text" class="form-control" placeholder="First Name" id="txtNames" name="txtNames">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                   </div>
                </div>

                <div class="col-12">
                  <div class="form-group has-icon-left">
                    <label for="txtLNames">Last Name</label>
                    <div class="position-relative">
                      <input type="text" class="form-control" placeholder="Last Name" id="txtLNames" name="txtLNames">
                      <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                      </div>
                    </div>
                   </div>
                </div>

                <div class="col-12">
                  <div class="form-group has-icon-left">
                    <label for="txtPass">Password</label>
                    <div class="position-relative">
                      <input type="password" class="form-control" placeholder="Password" id="txtPass" name="txtPass">
                      <div class="form-control-icon">
                        <i class="bi bi-lock"></i>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group has-icon-left">
                    <label for="txtPass">Confirm Password</label>
                    <div class="position-relative">
                      <input type="password" class="form-control" placeholder="Confirm Password" onkeyup="Confirmpass(this.value)" id="txtConPass">
                      <div class="form-control-icon">
                        <i class="bi bi-lock"></i>
                      </div>
                    </div>
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