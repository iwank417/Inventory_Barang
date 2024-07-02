<?php
session_start();

if ($_SESSION['password'] == '') {
  header("location:login.php");
}
include 'koneksi.php';
error_reporting(0);

include 'topbar.php'; ?>
<!-- Topbar Navbar -->
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
    
      
  </div>
  <?php
  //--------------------------------------------------------------------------------
  function searchKeluar($conn, $tanggal, $groupB)
  {
    $query = "SELECT * FROM keluar WHERE tanggal = ? AND groupB = ?";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $tanggal, $groupB);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the results
    $result = mysqli_stmt_get_result($stmt);

    // Fetch data if any
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }

    // Free result and close statement
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);

    return $data;
  }
?>
  

    <form method="get" name='cari'>
    
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
      <p><b>Tanggal :</b></p>
      <input class="form-control" type="date" id="tanggal" name="cari_tanggal" >

      </div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
      <p><b>Shift :</b></p>
      <select class="form-control" name='cari_groupB' required id="" onchange="" >
        <option value="" disabled selected>Pilih</option>
        <option value="a">Shift A</option>
        <option value="b">Shift B</option>
        <option value="c">Shift C</option>
      </select>
      </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-1">

        </div>

        <div class="col-md-10 col-sm-12 col-xs-12">
   
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="search">Search</br></button>
      </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-1">

        </div>
      </div>
  </form>
  

  <div class="card shadow  ml-4 mr-4">
<div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">Daily Shift Report Packaging </h3>
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


    <div class="col-md-1">

    </div>


  <div class="col-md-12 col-sm-14 col-xs-12  mt-7">
    <div class="table-responsive service">
      <table class="table table-bordered table-hover  mt-5 text-nowrap css-serial">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">No Document</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Petugas</th>
            <th scope="col">Shift</th>
            <th scope="col">TRACKING ID</th>
            <th scope="col">MATERIAL</th>
            <th scope="col">DESCRIPTION OF MATERIAL</th>
            <th scope="col">QTY</th>
            <th scope="col">ACTION</th>

          </tr>

        </thead>
        <?php
        if (isset($_GET['cari_tanggal']) && isset($_GET['cari_groupB'])) {
          
          $cari2 = mysqli_real_escape_string($conn, $_GET['cari_tanggal']);
          $cari3 = mysqli_real_escape_string($conn, $_GET['cari_groupB']);
          
          $brg = mysqli_query($conn, "SELECT * FROM keluar WHERE tanggal LIKE '%$cari2%' AND groupB LIKE '%$cari3%'");
          echo "SQL Query: " . $query;
   
         
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
          $brg = mysqli_query($conn, "select * from keluar limit $start, $hal");
        }

        if (mysqli_num_rows($brg)) {

          while ($row = mysqli_fetch_array($brg)) {
        ?>
            <tbody>
              <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['no_doc'] ?></td>
                <td><?php echo $row['tanggal'] ?></td>
                <td><?php echo $row['shift'] ?></td>
                <td><?php echo $row['groupB'] ?></td>
                <td><?php echo $row['tracking_id'] ?></td>
                <td><?php echo $row['material'] ?></td>
                <td><?php echo $row['desc_material'] ?></td>
                <td><?php echo $row['qty'] ?></td>


                <td>&nbsp;<a href="edit.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-success">Edit</button></a> &nbsp; <a href="hapus.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">Hapus</button></a> &nbsp; <a href="detail.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-info">Detail</button></a></td>

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
          <?php
          //$cep = mysqli_query($conn, "select * from masuk");
          //$tesd = mysqli_num_rows($cep);


          //if ($tesd > 0) {
            echo "<div class='col-md-2'>";
         
           
            echo "<form id='printForm' action='print_output_pack.php' method='POST' target='_blank'>";
            echo "<input type='hidden' name='cari_tanggal' value='" . $cari2 . "'>";
            echo "<input type='hidden' name='cari_groupB' value='" . $cari3 . "'>";
            echo "<button type='submit' class='btn btn-success'>Print All</button>";
            echo "</form>";



            echo "<div class='col-md-2'>";
            echo "&nbsp;";
            echo "</div>";

            
            echo "</div>";
          //} else {
          //} ?>

<div class="row">
          <div class="col-md-5">

          </div>
          <div class='col-md-10 col-sm-12 col-xs-12 ml-5'>



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
  </div>


    <?php include 'fotterbar.php'; ?>