<?php 
headerAdmin($data);
getModal('modalSentProducts',$data);
navbar_admin($data);
?>
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
                                    <div class="col-12 order-md-3">
                                        <button  class="btn btn-primary" onclick="openModalPdts();">
                                            <i class="bi bi-person-plus"></i>
                                            <span> New Product</span>
                                        </button>
                                        <!--button  class="btn btn-primary" onclick="">
                                            <i class="bi bi-person-plus"></i>
                                            <span> New Category</span>
                                        </button-->
                                        <br>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <section class="section">
                                <div class="card">
                                    <div class="card-header">
                                        Simple Datatable
                                    </div>
                                    <div class="card-body">
                                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                            <div class="dataTable-container">
                                                <table class="display responsive nowrap" style="width:100%" id="tableProducts">
                                                  <thead>
                                                   <tr>
                                                   <th><h6>ID</h6></th>
                                                   <th><h6>NAME</h6></th>
                                                   <th><h6>CATEGORY</h6></th>
                                                   <th><h6>PRICE</h6></th>
                                                   <th><h6>Stock</h6></th>
                                                   <th><h6>ACTION</h6></th>
                                                  </tr>
                                                </thead>
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                    </div>
    


<?php footerAdmin($data); ?>