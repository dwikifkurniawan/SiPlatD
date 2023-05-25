<?php
$session = session();
$user = $session->get('user');
?>
<!DOCTYPE php>
<php lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>PlatDe</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/feather/feather.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/ti-icons/css/themify-icons.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/typicons/typicons.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/simple-line-icons/css/simple-line-icons.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/js/select.dataTables.min.css') ?>">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/vertical-layout-light/style.css') ?>">
        <!-- endinject -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png') ?>" />
        <!--datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />

        <!-- Include Required Prerequisites -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.php -->
            <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                    <div class="me-3">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                            <span class="icon-menu"></span>
                        </button>
                    </div>
                    <div>
                        <a class="navbar-brand brand-logo" href="<?php echo base_url('home/index') ?>">
                            <img src="<?php echo base_url('assets/images/logo.jpeg') ?>" alt="logo" class="img-fluid" />
                        </a>
                        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url('home/index') ?>">
                            <img src="<?php echo base_url('assets/images/logo.jpeg') ?>" alt="logo" class="img-fluid" />
                        </a>
                    </div>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-top">
                    <ul class="navbar-nav">
                        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                            <h1 class="welcome-text">Hello, <span class="text-black fw-bold"><?php echo $user ?></span></h1>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="img-xs rounded-circle" src="<?php echo base_url('assets/images/faces/face8.jpg') ?>" alt="Profile image"> </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                                <div class="dropdown-header text-center">
                                    <img class="img-md rounded-circle" src="<?php echo base_url('assets/images/faces/face8.jpg') ?>" alt="Profile image">
                                    <p class="mb-1 mt-3 font-weight-semibold"><?php echo $user ?></p>
                                    <p class="fw-light text-muted mb-0">allenmoreno@gmail.com</p>
                                </div>
                                <a href="<?php echo base_url('home/login') ?>" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.php -->
                <div class="theme-setting-wrapper">
                    <div id="settings-trigger"><i class="ti-settings"></i></div>
                    <div id="theme-settings" class="settings-panel">
                        <i class="settings-close ti-close"></i>
                        <p class="settings-heading">SIDEBAR SKINS</p>
                        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                            <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                        </div>
                        <div class="sidebar-bg-options" id="sidebar-dark-theme">
                            <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                        </div>
                        <p class="settings-heading mt-2">HEADER SKINS</p>
                        <div class="color-tiles mx-0 px-4">
                            <div class="tiles success"></div>
                            <div class="tiles warning"></div>
                            <div class="tiles danger"></div>
                            <div class="tiles info"></div>
                            <div class="tiles dark"></div>
                            <div class="tiles default"></div>
                        </div>
                    </div>
                </div>
                <!-- partial -->
                <!-- partial:partials/_sidebar.php -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('home/transaction') ?>">
                                <i class="menu-icon mdi mdi-calculator"></i>
                                <span class="menu-title">Transaction</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('home/generate_trans') ?>">
                                <i class="menu-icon mdi mdi-floor-plan"></i>
                                <span class="menu-title">Transaction Data</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('home/r_transaction') ?>">
                                <i class="menu-icon mdi mdi-file-document"></i>
                                <span class="menu-title">Report Transaction</span>
                            </a>
                        </li> -->
                    </ul>
                </nav>
                <?= $this->renderSection('content'); ?>

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.php -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Kelompok Anggrek</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2022. All rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- plugins:js -->
        <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="<?php echo base_url('assets/vendors/chart.js/Chart.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/progressbar.js/progressbar.min.js') ?>"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="<?php echo base_url('assets/js/off-canvas.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/hoverable-collapse.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/template.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/settings.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/todolist.js') ?>"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="<?php echo base_url('assets/js/jquery.cookie.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/dashboard.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/Chart.roundedBarCharts.js') ?>"></script>
        <!-- End custom js for this page-->
        <!-- datatables -->
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.datatab').DataTable();
            });
        </script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <script>
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                    opens: 'right',
                    drops: 'up'
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
            });
        </script>
    </body>

</php>