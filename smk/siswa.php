<?php 
session_start();
if (!isset($_SESSION["loginsiswa"])) {
  header("Location: index.php");
}
require 'functions.php';
$id = $_SESSION["id"];
$query = "SELECT nama, guru, kelas, mapel, nilai
              FROM siswa
              INNER JOIN nilai
              ON 
              siswa.id = nilai.siswa_id
              INNER JOIN mapel
              ON
              mapel.id_mapel = nilai.mapel_id
              INNER JOIN kelas
              ON
              kelas.id = siswa.kelas_id
              WHERE siswa.id = $id";

$siswaasj = query($query)[0];
$siswaaij = query($query)[1];
$siswatlj = query($query)[2];
$siswapkk = query($query)[3];

$siswa = query("SELECT nama, kelas 
                FROM siswa 
                INNER JOIN kelas
                ON
                kelas.id = siswa.kelas_id");
$s = 1;
if (isset($_POST["cari"])) {
    $siswa = cari($_POST["keyword"]);
    // var_dump($siswa);die;
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DashBoard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html"><img src="img/logo/smk.png"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="" method="post">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari Di Data Siswa..." aria-label="Search" aria-describedby="basic-addon2" name="keyword">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit" name="cari">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->

  </nav>

  <div id="wrapper">
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link " data-toggle="modal" data-target="#logoutModal">
          <button class="btn btn-primary">Logout</button>
        </a>
      </li>
    </ul>
    <div id="content-wrapper">

      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">
            <?= $siswaasj["nama"]; ?> <?= $siswaasj["kelas"]; ?>
          </li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">Administrasi Sistem jaringan</div>
              </div>
              <span class="card-footer text-white clearfix small z-1" href="#">
                <!-- nilai asj -->
                <span class="float-left">Nama Guru : <?= $siswaasj["guru"]; ?></span>
              </span>
              <span class="card-footer text-white clearfix small z-1" href="#">
                <!-- nilai asj -->
                <span class="float-left">Nilai : <?= $siswaasj["nilai"]; ?></span>
              </span>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">Administrasi Infastruktur Jaringan</div>
              </div>
              <span class="card-footer text-white clearfix small z-1" href="#">
                <!-- nilai aij -->
                <span class="float-left">Nama Guru : <?= $siswaaij["guru"]; ?></span>
              </span>
              <span class="card-footer text-white clearfix small z-1" href="#">
                <!-- nilai aij -->
                <span class="float-left">Nilai : <?= $siswaaij["nilai"]; ?></span>
              </span>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">Teknologi Layanan jaringan</div>
              </div>
              <span class="card-footer text-white clearfix small z-1" href="#">
                <!-- nilai aij -->
                <span class="float-left">Nama Guru : <?= $siswatlj["guru"]; ?></span>
              </span>
              <span class="card-footer text-white clearfix small z-1" href="#">
                <!-- nilai tlj -->
                <span class="float-left">Nilai : <?= $siswatlj["nilai"]; ?></span>
              </span>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">Prakarya Dan Kewirausahaan</div>
              </div>
              <span class="card-footer text-white clearfix small z-1" href="#">
                <!-- nilai pkk -->
                <span class="float-left">Nama Guru : <?= $siswapkk["guru"]; ?></span>
              </span>
              <span class="card-footer text-white clearfix small z-1" href="#">
                <!-- nilai pkk -->
                <span class="float-left">Nilai : <?= $siswapkk["nilai"]; ?></span>
              </span>
            </div>
          </div>
        </div>
      <!-- /.container-fluid -->
        <!-- Tabel siswa -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Siswa
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="kucing" class="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                  </tr>
                </tfoot>
                <!-- Data siswa -->
                  <tbody>
                  <?php foreach ( $siswa as $a ) :?>
                    <tr>
                      <td><?= $s; ?></td>
                      <td><?= $a["nama"]; ?></a></td>
                      <td><?= $a["kelas"]; ?></td>
                    </tr>
                    <?php $s++; ?>
                  <?php endforeach; ?>
                  <!-- tambah siswa -->
                  <!-- akhir tambah siswa -->
                  </tbody>
                <!-- Akhir data siswa -->
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        <!-- akhir tabel siswa -->
        <p class="small text-center text-muted my-5">
          <em>Selamat datang siswa</em>
        </p>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda yakin Ingin Keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik Tombol "keluar" di bawah jika anda ingin keluar.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Gak Jadi</button>
          <a class="btn btn-primary" href="logoutsiswa.php">Keluar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Rizal Darmawan 2019</span>
          </div>
        </div>
      </footer>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
