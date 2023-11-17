<?php headerAdmin($data);
//getModal('modalSentEmployee',$data);
?>
<?php navbar_admin($data);?>

                <div id="main-content">
                    <div class="page-heading">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3><?=$data['page_title']?></h3>
                                    <p class="text-subtitle text-muted"><?=$data['page_content']?></p>
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first">
                                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url();?>">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page"><?=$data['page_tag']?></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <section class="section">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-content">
                                            <img class="card-img-top img-fluid" src="assets/images/discount/discounts.png" alt="image of mexican handicrafts" style="height: 20rem">
                                            <div class="card-body ">
                                                <h4 class="card-title" id="titledisconut"></h4>
                                                <button type="submit" class="btn btn-primary rounded-pill  block" onclick="viewmodalupdis()">Update now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 ocultarmodal" id="divupdis">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h4 class="card-title">Discount Upgrade</h4>
                                                <small class="text-muted">The user can modify the percentage of the discount.</small>
                                                <form id="formSetDiscount" name="formSetDiscount">
                                                    <input type="hidden" class="form-control" id="txtidform" name="txtidform">
                                                    <input type="hidden" class="form-control" id="txtuser" name="txtuser" value="<?= $_SESSION['user']?>">
                                                    <div class="row">
                                                        <div class="col">
                                                          <div class="form-group has-icon-left">
                                                            <label for="txtDiscount">Discount</label>
                                                            <div class="position-relative">
                                                              <input type="Number" min="0" max="100" class="form-control" placeholder="Discount" id="txtDiscount" name="txtDiscount">
                                                              <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                              </div>
                                                            </div>
                                                           </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <br>
                                                            <button type="submit" id="btnActionForm" class="btn btn-primary"><span id="btnText">Save</span></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <img class="card-img-bottom img-fluid" src="assets/images/discount/discounts1.png" alt="Card image cap" style="height: 20rem; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

<?php footerAdmin($data); ?>
