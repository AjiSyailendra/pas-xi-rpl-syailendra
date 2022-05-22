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

    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- sweet alert -->
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'poppins';
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <?php
    require 'functions.php';
    $id = $_GET["id"];
    $siswa = query("SELECT * FROM siswa WHERE id = $id")[0];

    if (isset($_POST["submit"])) {
        // cek apakah data berhasil di tambahkan atau tidak
        if (update($_POST) > 0) {
            echo "
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Data berhasil di update!',
                text: 'Klik kembali untuk ke halaman beranda!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Kembali',
               }).then((result) => {
                  if (result.isConfirmed) {
                      document.location.href = 'dashbord.php';
                  }
              })
           </script>
            ";
        } else {
            echo "
            <script>
                 Swal.fire({
                     icon: 'error',
                     title: 'Data gagal di update!',
                     text: 'Klik kembali untuk ke halaman beranda!',
                     confirmButtonColor: '#d33',
                     confirmButtonText: 'Kembali',
                    }).then((result) => {
                       if (result.isConfirmed) {
                           document.location.href = 'dashbord.php';
                       }
                   })
                </script>";
        }
    }
    ?>

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
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
                        <a href="#" class="d-block">Syailendra</a>
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
            <div class="content-header">
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
                <div class="card card-info card-outline">
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $siswa["id"]; ?>">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $siswa["nama"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="jeniskelamin">Jenis Kelamin</label>
                                <select name="jeniskelamin" class="form-select" id="jeniskelamin" placeholder="Jenis Kelamin">
                                    <option <?php if ($siswa['jeniskelamin'] == 'L') {
                                                echo "selected";
                                            } ?> value="L">Laki-laki</option>
                                    <option <?php if ($siswa['jeniskelamin'] == 'P') {
                                                echo "selected";
                                            } ?> value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" required value="<?= $siswa["alamat"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" class="form-select" id="kelas">
                                    <option <?php if ($siswa['kelas'] == 'X') {
                                                echo "selected";
                                            } ?> value="X">X</option>
                                    <option <?php if ($siswa['kelas'] == 'XI') {
                                                echo "selected";
                                            } ?> value="XI">XI</option>
                                    <option <?php if ($siswa['kelas'] == 'XII') {
                                                echo "selected";
                                            } ?> value="XII">XII</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success">Simpan Data</button>
                                <a href="dashbord.php" class="btn btn-danger">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

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