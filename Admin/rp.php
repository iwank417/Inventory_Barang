<?php
session_start();

if ($_SESSION['password'] == '') {
  header("location:login.php");
}
include 'koneksi.php';
error_reporting(0);
include 'topbar.php'; ?>

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



      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">


        <?php
        $nama = mysqli_query($conn, "select * from about");
        $profile = mysqli_fetch_array($nama);
        ?>



        <div class="topbar-divider d-none d-sm-block"></div>

        <?php
        $sss = mysqli_query($conn, "select * from admin");
        $rrr = mysqli_fetch_array($sss);


        ?>

        <!-- Nav Item - User Information -->
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $profile['nama'] ?></span>
            <img class="img-profile rounded-circle" src=" penampung/<?php echo $profile['foto'] ?>" alt="Profile" width="100px" height="100px">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="setting.php?id=<?php echo $profile['id']; ?>">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <a class="dropdown-item" href="change.php?id=<?php echo $rrr['id']; ?>">
              <i class="fas fa-ruler-horizontal fa-sm fa-fw mr-2 text-gray-400"></i>
              Ganti Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>

    </nav>
    <!-- End of Topbar -->


    <!--ini bagian konten-->

    <form name='kirim' method='post'>

      <!--=============================CONTEN RENCANA PRODKSI=======================================-->
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>
              <h3> Rencana Produksi </h3>
            </b></p>

        </div>
      </div>

      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>No.RP:</b></p>
          <input class="form-control" type="text" placeholder="No RP..." name='norp' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>GRADE :</b></p>
          <input class="form-control" type="text" placeholder="grade..." name='grade' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>PM :</b></p>
          <input class="form-control" type="text" placeholder="PM..." name='pm' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>DATE OF MAKING :</b></p>
          <input class="form-control" type="date" id="datemaking" name="datemaking">

        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>SC :</b></p>
          <input class="form-control" type="text" placeholder="NO SC..." name='sc' required>
        </div>
      </div>


      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>ROLL/PALLET :</b></p>
          <input class="form-control" type="text" placeholder="R/P..." name='rollpallet' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>TOTAL PLANT UNIT :</b></p>
          <input class="form-control" type="text" placeholder="TPU..." name='totalplant' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>TOTAL ORDER UNIT :</b></p>
          <input class="form-control" type="text" placeholder="TOU..." name='totalorder' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>LABEL :</b></p>
          <input class="form-control" type="text" placeholder="LABEL..." name='label' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>MAD :</b></p>
          <input class="form-control" type="date" id="mad" name="mad">
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>COUNTRY / CUSTOMER :</b></p>
          <input class="form-control" type="text" placeholder="CUSTOMER..." name='customer' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>MATERIAL :</b></p>
          <input class="form-control" type="text" placeholder="MATERIAL..." name='material' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>REMARK :</b></p>
          <input class="form-control" type="text" placeholder="REMARK..." name='remark' required>
        </div>
      </div>












      <!--=========================================================================================-->

      <!-------------------------------------------------------->
      <div class="row mt-3">
        <div class="col-md-1">

        </div>


        <div class="col-md-10 col-sm-12 col-xs-12">
          <button type="submit" class="btn btn-primary btn-lg btn-block" name='kirim'>Kirim</button>

          <div class="row mt-3">
            <div class="col-md-2 mb-3">
              <a href="form.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Import from Spreeadsheet </a>
            </div>
          </div>


    </form>

  </div>

  <?php
  if (isset($_POST['kirim'])) {
    $norp = htmlspecialchars($_POST['norp']);
    $grade = htmlspecialchars($_POST['grade']);
    $pm = htmlspecialchars($_POST['pm']);
    $datemaking = htmlspecialchars($_POST['datemaking']);
    $sc = htmlspecialchars($_POST['sc']);
    $rollpallet = htmlspecialchars($_POST['rollpallet']);
    $totalplant = htmlspecialchars($_POST['totalplant']);
    $totalorder = htmlspecialchars($_POST['totalorder']);
    $label = htmlspecialchars($_POST['label']);
    $mad = htmlspecialchars($_POST['mad']);
    $customer = htmlspecialchars($_POST['customer']);
    $material = htmlspecialchars($_POST['material']);
    $remark = htmlspecialchars($_POST['remark']);

    $query = mysqli_query($conn, "INSERT INTO `rp` (`norp`, `grade`, `pm`, `datemaking`, `sc`, `rollpallet`, `totalplan`, `totalorder`, `label`, `mad`, `customer`, `material`, `remark`)
       VALUES (
        '$norp',
       '$grade',
       '$pm',
       '$datemaking',
       '$sc',
       '$rollpallet',
       '$totalplant',
       '$totalorder',
       '$label',
       '$mad',
       '$customer',
       '$material',
       '$remark'
         )");

    if ($query == 1) {
      echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
      echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
      echo "<p><center>Menambakan Data Sukses</center></p>";
      echo   "</div>";
      echo "</div>";
    } else {

      echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
      echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
      echo "<p><center>Menambakan Data Gagal</center></p>";
      echo " $norp, $grade,$pm,$datemaking,$sc,$rollpallet,$totalplant,$totalorder,$label,$mad,$customer,$material,$remark";
      echo   "</div>";
      echo "</div>";
    }
  }

  ?>

  <div class="col-md-1">

  </div>

</div>
<div class="card shadow  ml-4 mr-4">
  <div class="card-header py-3">



    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
  </div>




  <div class="row mt-3">


    <div class="col-md-8  mt-4">
      <br>



    </div>

    <div class="col-md-4 mt-5">
      <form class="form-inline my-2 my-lg-0" action="cari.php" method="get" name='cari'>
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='cari' required>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>

  </div>

  <div class="row">
    <div class="col-md-8  mt-4">

    </div>
  </div>
  <?php

  $hmm = $jum;
  $hal = 10;
  $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
  $start = ($page - 1) * $hal;


  ?>


  <div class="col-md-12 col-sm-12 col-xs-12  mt-5">
    <div class="table-responsive service">
      <table class="table table-bordered table-hover  mt-3 text-nowrap css-serial">
        <thead>
          <tr>
            <th scope="col">OPSI</th>
            <th scope="col">No RP</th>
            <th scope="col">GRADE</th>
            <th scope="col">PM</th>
            <th scope="col">DATE OF MAKING</th>
            <th scope="col">SC</th>
            <th scope="col">ROLL / PALLET</th>
            <th scope="col">TOTAL UNIT PLAN</th>
            <th scope="col">TOTAL UNIT ORDER</th>
            <th scope="col">LABEL</th>
            <th scope="col">MAD</th>
            <th scope="col">COUNTRY / CUSTOMER</th>
            <th scope="col">MATERIAL</th>
            <th scope="col">REMARK</th>
            <th scope="col">ACTION</th>

          </tr>

        </thead>
        <?php
        if (isset($_GET['cari'])) {
          $cari = mysqli_real_escape_string($conn, $_GET['cari']);
          $brg = mysqli_query($conn, "select * from masuk where id like '%" . $cari . "%' or nama like '%" . $cari . "%' or jenis like '%" . $cari . "%' ");

          if (mysqli_num_rows($brg) > 0) {
            echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
            echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
            echo "<p><center>Data Yang Anda Cari  Ditemukan</center></p>";
            echo   "</div>";
            echo "</div>";
          } else {

            echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
            echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
            echo "<p><center>$cari Yang Anda Cari Tidak Ditemukan</center></p>";
            echo   "</div>";
            echo "</div>";
          }
        } else {
          $brg = mysqli_query($conn, "select * from rp limit $start, $hal");
        }

        if (mysqli_num_rows($brg)) {

          while ($row = mysqli_fetch_array($brg)) {
        ?>
            <tbody>
              <tr>
                <td>&nbsp;<a href="data.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-success">Create Request Packaging </button></a>&nbsp; <a href="detailrp.php?id=<?php echo $row['sc']; ?>"><button type="button" class="btn btn-info">Detail</button></a></td>
                <td><?php echo $row['norp'] ?></td>
                <td><?php echo $row['grade'] ?></td>
                <td><?php echo $row['pm'] ?></td>
                <td><?php echo $row['datemaking'] ?></td>
                <td><?php echo $row['sc'] ?></td>
                <td><?php echo $row['rollpallet'] ?></td>
                <td><?php echo $row['totalplan'] ?></td>
                <td><?php echo $row['totalorder'] ?></td>
                <td><?php echo $row['label'] ?></td>
                <td><?php echo $row['mad'] ?></td>
                <td><?php echo $row['customer'] ?></td>
                <td><?php echo $row['material'] ?></td>
                <td><?php echo $row['remark'] ?></td>
                <td>&nbsp;<a href="editrp.php?id=<?php echo $row['sc']; ?>"><button type="button" class="btn btn-success">Edit</button></a> &nbsp; <a href="hapus.php?id=<?php echo $row['sc']; ?>"><button type="button" class="btn btn-danger">Hapus</button></td>


              </tr>

            </tbody>

        <?php }
        } elseif (mysqli_num_rows($brg) <= 0 and !$cari) {


          echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
          echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
          echo "<p><center>Data Anda Masih Kosong</center></p>";
          echo "</div>";
          echo "</div>";
        } ?>


      </table>

      <div class="row">
        <div class="col-md-5">

        </div>

        <div class="col-md-5">

        </div>




      </div>


      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php
          for ($x = 1; $x <= $hal; $x++) {
          ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
          <?php
          }

          ?>

        </ul>
      </nav>
    </div>
  </div>


  <!-- End of Content Wrapper -->
  <?php
  include 'fotterbar.php';
  ?>

  <!-- Footer -->