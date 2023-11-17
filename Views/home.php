<?php headerHome($data); ?>
<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-8">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img
                src="https://w0.peakpx.com/wallpaper/277/719/HD-wallpaper-aesthetic-cielo-cloud-clouds-estrellas-fondo-aesthetic-fondo-de-pantalla-luna-noche.jpg"
                alt="login form" 
                class="img-fluid" style="border-radius: 1rem 0 0 1rem; width:auto;height:auto;"
              />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form id="formLogin" method="post">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">México Mágico</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <input type="text" id="txtuser" maxlength="10" name="txtuser" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">User</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="txtpassword" maxlength="16" name="txtpassword"class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
					<input type="submit" name="submit" class="btn btn-dark btn-lg btn-block" value="Enviar" id="submit_data" />
                  </div>

                  <!--a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!" style="color: #393f81;">Register here</a></p-->
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?=media();?>/js/script_login.js"></script>

<?php footerHome($data); ?>
