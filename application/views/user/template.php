<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title;?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/')?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">




</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('home')?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-building"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PT Taniya</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('home')?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php if($title == 'Site Plan'){echo 'active';}?>">
                <a class="nav-link" href="<?= base_url('siteplan')?>">
                    <i class="fas fa-fw fa-map"></i>
                    <span>Site Plan</span>
                </a>
            </li>
            <li class="nav-item <?php if($title == 'Data Rumah'){echo 'active';}?>">
                <a class="nav-link" href="<?= base_url('rumah')?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Data Rumah</span>
                </a>
            </li>
            <li class="nav-item <?php if($title == 'Data Anggaran'){echo 'active';}?>">
                <a class="nav-link" href="<?= base_url('anggaran')?>">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Data Anggaran</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Transaksi
            </div>
            <li class="nav-item <?php if($title == 'Pembayaran'){echo 'active';}?>">
                <a class="nav-link" href="<?= base_url('transaksi')?>">
                    <i class="fas fa-fw fa-money-check"></i>
                    <span>Pembayaran</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                   

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                   
                    <?= $contents ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!-- <script src="<?= base_url('assets/')?>vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/')?>js/sb-admin-2.min.js"></script>

    <!-- Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js">
    </script>

    <script>
    $(document).ready(function() {
        let id = 0;
        $("#btnAdd").click(function() {
            id++;
            $(".inputAdd").append(
                '<div class="input-group mb-3" id="unit-' + id +
                '"><input type="text" class="form-control" name="unit[]"><div class="input-group-append"><button class="btn btn-primary" onclick="adel(' +
                id + ')" type="button"><i class="fa fa-minus" id="adel"></i></button></div></div>'
            );
        });
    });

    function adel(id) {
        $("#unit-" + id).remove();
    }
    </script>
    <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
    </script>


</body>

</html>