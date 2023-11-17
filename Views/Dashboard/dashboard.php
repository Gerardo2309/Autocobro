<?php headerAdmin($data);?>

<?php navbar_admin($data);?>


                <div id="main-content">

                    <div class="page-heading">
                        <h3>Profile Statistics</h3>
                    </div>
                    <div class="page-content">
                        <section class="row">
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <div class="col-6 col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="card-body px-3 py-4-5">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="stats-icon purple">
                                                            <i class="bi bi-cash" style="width:auto;padding-bottom: 25px;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="text-muted font-semibold">Sales Mxn</h6>
                                                        <h6 class="font-extrabold mb-0" id="salesmxn"></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="card-body px-3 py-4-5">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="stats-icon blue">
                                                            <i class="bi bi-cash" style="width:auto;padding-bottom: 25px;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="text-muted font-semibold">Sales Usd</h6>
                                                        <h6 class="font-extrabold mb-0" id="salesusd"></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="card-body px-3 py-4-5">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="stats-icon green">
                                                            <i class="bi bi-cash-stack" style="width:auto;padding-bottom: 25px;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="text-muted font-semibold">Total Sales</h6>
                                                        <h6 class="font-extrabold mb-0" id="totsales"></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="card-body px-3 py-4-5">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="stats-icon red">
                                                            <i class="iconly-boldProfile"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="text-muted font-semibold">Employees</h6>
                                                        <h6 class="font-extrabold mb-0" id="employee"></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h4>Total Sales</h4>  
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="tipograf">Options</label>
                                                            <select class="form-select" onchange="seletopt();" id="tipograf">
                                                                <option value="1">Yearly</option>
                                                                <option value="2">Monthly</option>
                                                                <option value="3">Weekly</option>
                                                            </select>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="myChart" width="auto" height="auto"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-xl-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Top Seller</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="canvas-tps"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Out Of Stock Items</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-lg" id="tablasinstock">
                                                        <thead>
                                                            <tr>
                                                                <th>Barcode</th>
                                                                <th>Name</th>
                                                                <th>Stock</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card">
                                    <div class="card-body py-4 px-5">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xl">
                                                <img src="assets/images/faces/1.jpg" alt="Face 1">
                                            </div>
                                            <div class="ms-3 name">
                                                <h5 class="font-bold"><?= $_SESSION['nombre']?></h5>
                                                <h6 class="text-muted mb-0">@<?= $_SESSION['user']?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Connected Employees</h4>
                                    </div>
                                    <div class="card-content pb-4">
                                        <div class="card-content" id="conemploy">
                                        </div>
                                        <div class="px-4">
                                            <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Start
                                                Conversation</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Sales By Badge Color</h4>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart-SBBC"></canvas>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>


<?php footerAdmin($data); ?>
