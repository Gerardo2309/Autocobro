            <div id="sidebar" class="active">
                <div class="sidebar-wrapper active">
                    <div class="sidebar-header">
                        <div class="d-flex justify-content-between">
                            <div class="logo">
                                <a href="<?= base_url();?>"><img src="assets/images/logo/logo.png" alt="Logo" style="width: 150px; height: 150px;"></a>
                            </div>
                            <div class="toggler">
                                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-menu">
                        <ul class="menu">
                            <li class="sidebar-title">Menu</li>

                            <li class="sidebar-item active ">
                                <a href="<?= base_url();?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="<?= base_url();?>Scanner" class='sidebar-link'>
                                    <i class="bi bi-upc-scan"></i>
                                    <span>Scanner</span>
                                </a>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="<?= base_url();?>Caja" class='sidebar-link'>
                                    <i class="bi bi-cash-stack"></i>
                                    <span>Caja</span>
                                </a>
                            </li>

                            <li class="sidebar-title">Sales</li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-clipboard-data"></i>
                                    <span>Sales Report</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="form-element-input.html">Weekly Report</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-element-input-group.html">Monthly Report</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-element-select.html">Annual Report</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-element-radio.html">Overview Report</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-title">Raise Support</li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-gear-wide-connected"></i>
                                    <span>Settings</span>
                                </a>
                              <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="<?= base_url();?>Products">Products</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="<?= base_url();?>Employees">Employees</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="<?= base_url();?>Banks">Banks</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="<?= base_url();?>Discounts">Store Discounts</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  ">
                                <button  onclick="Cerrarsesion(this);" id="<?= $_SESSION['user']?>" class='sidebar-link btn icon icon-left'>
                                    <i class="bi bi-box-arrow-in-left"></i>
                                    <span>Logout</span>
                                </button>
                            </li>       
                        </ul>
                    </div>
                    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
                </div>
            </div>


            <div id="main" class="layout-navbar">
                <header class="mb-3">
                    <nav class="navbar navbar-expand navbar-light ">
                        <div class="container-fluid">
                            <a href="#" class="burger-btn d-block">
                                <i class="bi bi-justify fs-3"></i>
                            </a>

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <li class="nav-item dropdown me-1">
                                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <!--i class="bi bi-envelope bi-sub fs-4 text-gray-600"></i-->
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <h6 class="dropdown-header">Mail</h6>
                                            </li>
                                            <li><a class="dropdown-item" href="#">No new mail</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown me-3">
                                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <!--i class="bi bi-bell bi-sub fs-4 text-gray-600"></i-->
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <h6 class="dropdown-header">Notifications</h6>
                                            </li>
                                            <li><a class="dropdown-item">No notification available</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="user-menu d-flex">
                                            <div class="user-name text-end me-3">
                                                <h6 class="mb-0 text-gray-600"><?= $_SESSION['nomcompleto']?></h6>
                                                <p class="mb-0 text-sm text-gray-600"><?= $_SESSION['nomrol']?></p>
                                            </div>
                                            <div class="user-img d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    <img src="assets/images/faces/1.jpg">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Hello, <?= $_SESSION['nombre']?>!</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                                Profile</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                                Settings</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                          <button onclick="Cerrarsesion(this);" id="<?= $_SESSION['user']?>" class="dropdown-item">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                          </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </header>