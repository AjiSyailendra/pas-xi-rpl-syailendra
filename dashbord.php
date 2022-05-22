<?php
require 'functions.php';
$siswa = query("SELECT * FROM siswa");
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PAS XI RPL</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <!-- boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">

    <!-- sweet alert -->
    <script src='plugins/sweetalert2/sweetalert2.all.min.js'></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'poppins';
        }

        /* width */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: grey;
            border-radius: 10px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white position-fixed navbar-light" style="width: 100%;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary position-fixed elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link">
                <img src="dist/img/Logo SMK 6.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Welcome</span>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/pp neww.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="index.php" class="nav-link active">
                                <i class="bi bi-pie-chart nav-icon"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="create.php" class="nav-link ">
                                <i class="bi bi-person-plus nav-icon"></i>
                                <p>Tambah Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link text-danger">
                                <p>Log out</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header" style="padding-top: 70px;">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Siswa</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="card card-info  card-outline ">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="create.php" class="btn btn-success">Tambah Data <i class="fas fa-plus-square"></i> </a>
                        </div>
                    </div>
                    <div class="card-body overflow-scroll">
                        <table class="table table-bordered">
                            <tr>
                                <td style="text-align: center; font-weight: 700; width: 5%">No</td>
                                <td style="text-align: center; font-weight: 700; width: 30%">Nama</td>
                                <td style="text-align: center; font-weight: 700; width: 5%">Jenis Kelamin</td>
                                <td style="text-align: center; font-weight: 700; width: 30%">Alamat</td>
                                <td style="text-align: center; font-weight: 700">Kelas</td>
                                <td style="text-align: center; font-weight: 700">Aksi</td>
                            </tr>
                            <?php
                            $batas = 10;
                            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                            $previous = $halaman - 1;
                            $next = $halaman + 1;

                            $data = mysqli_query($conn, "select * from siswa");
                            $jumlah_data = mysqli_num_rows($data);
                            $total_halaman = ceil($jumlah_data / $batas);

                            $data_siswa = mysqli_query($conn, "select * from siswa limit $halaman_awal, $batas");
                            $nomor = $halaman_awal + 1;

                            while ($row = mysqli_fetch_array($data_siswa)) {
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?= $nomor++ ?></td>
                                    <td><?= $row["nama"]; ?></td>
                                    <td style="text-align: center;"><?= $row["jeniskelamin"]; ?></td>
                                    <td><?= $row["alamat"]; ?></td>
                                    <td style="text-align: center;"><?= $row["kelas"]; ?></td>
                                    <td style="text-align: center;">
                                        <a href="update.php?id=<?= $row["id"]; ?>">
                                            <button type="button" class="btn mb-1 mb-md-0  btn-success">
                                                Ubah
                                            </button>
                                        </a><a onclick="return confirm('Yakin hapus data?')" href="delete.php?id=<?= $row["id"]; ?>">
                                            <button type="button" class="btn btn-danger">Hapus</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($halaman > 1) {
                                            echo "href='?halaman=$previous'";
                                        } ?>>Previous</a>
            </li>
            <?php
            for ($x = 1; $x <= $total_halaman; $x++) {
            ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item">
                <a class="page-link" <?php if ($halaman < $total_halaman) {
                                            echo "href='?halaman=$next'";
                                        } ?>>Next</a>
            </li>
        </ul>

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                yaaa mau gimana ya
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 Syailendra XI RPL.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
</body>

</html>