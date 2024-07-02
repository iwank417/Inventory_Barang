<?php

use cek as GlobalCek;

session_start();

if ($_SESSION['password'] == '') {
  header("location:login.php");
}
include 'koneksi.php';
error_reporting(0);
include 'topbar.php';
?>

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
      <!--=============================CONTEN RENCANA output packaging=======================================-->
      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-2 mb-3">
          <a href="formkeluar.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Import Data From Spreeadsheet </a>
        </div>




        <div class="col-md-2 mb-3">
          <a href="report_packaging.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-upload fa-sm text-white-50"></i> Print Daily Report Packaging </a>
        </div>
      </div>


      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>No Document:</b></p>
          <input class="form-control" type="text" placeholder="..." name='no_doc' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>Tanggal :</b></p>
          <input class="form-control" type="datetime-local" id="tanggal" name="tanggal">

        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>Petugas :</b></p>
          <input class="form-control" type="text" placeholder="..." name='shift' required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>Shift :</b></p>
          <select class="form-control" name='groupB' required id="" onchange="">
            <option value="" disabled selected>Pilih</option>
            <option value="a">Shift A</option>
            <option value="b">Shift B</option>
            <option value="c">Shift C</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>Tracking ID :</b></p>
          <input class="form-control" type="text" placeholder="..." name='tracking_id' required>
        </div>
      </div>


      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>Material :</b></p>
          <input class="form-control" type="text" placeholder="..." name='material' required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>Description Material :</b></p>
          <input class="form-control" type="text" placeholder="..." name='desc_material' required>
        </div>
      </div>



      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>QTY :</b></p>
          <input class="form-control" type="text" placeholder="..." name='qty' required>
        </div>
      </div>

      <!--=========================================================================================-->

      <!-------------------------------------------------------->
      <div class="row mt-3">
        <div class="col-md-1">

        </div>

        <div class="col-md-10 col-sm-12 col-xs-12">
          <button type="submit" class="btn btn-primary btn-lg btn-block" name='kirim'>Kirim</button>

    </form>

  </div>

  <?php
  //-----------end section calc packaging-------------------------
  if (isset($_POST['kirim'])) {
    $no_doc = htmlspecialchars($_POST['no_doc']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $shift = htmlspecialchars($_POST['shift']);
    $groupB = htmlspecialchars($_POST['groupB']);
    $tracking_id = htmlspecialchars($_POST['tracking_id']);
    $material = htmlspecialchars($_POST['material']);
    $desc_material = htmlspecialchars($_POST['desc_material']);
    $qty = htmlspecialchars($_POST['qty']);
    //fungsi cek output packaging----------------
    $det = mysqli_query($conn, "select * from rp where material='$material'");
    if (mysqli_num_rows($det)) {
      while ($t = mysqli_fetch_array($det)) {
        global $data;
        $sc = $t['sc'];
        $label = $t['label'];
        $remark = $t['remark'];
        $grade = $t['grade'];
        $rollpallet = $t['rollpallet'];
      }
    }


    try {
      include "calc_output_packaging.php";
      global $data;
      $proses1 = pddroll($label, $data);
      $proses1->$data['length'];
      $proses1->$data['diaroll'];
    } catch (exception $e) {
      echo "Error: " . $e->getMessage();
    }
    try {
      $proses2 = graderoll($grade, $data);
      $proses2->$data['grade'];
      $proses2->$data['foamprotek'];
      $proses21 = ccolor($grade);
      $colorCode = $colorbp['color'];
      $proses22 = getColorFoam($colorCode);
    } catch (exception $e) {
      echo "Error: " . $e->getMessage();
    }


    if (isset($data) && isset($pallet_data) && !empty($data) && !empty($pallet_data)) {
      try { //cek pallet
        $proses3 = cekpallet($data, $pallet_data);
        $proses3->$data['pallet'];
        $proses3->$data['inserter'];
        $data['CardBox_pallet'] = $data['pallet'];
        $proses3_1 = searchISPMHT($remark, $data);
      } catch (exception $e) {
        echo "Error: " . $e->getMessage();
      }
    } else {
      //Handle case where $data or $pallet_data is missing or empty
      echo "Error: Missing or empty data.";
    }



    try {

      $proses4 = pallet1set($data['pallet']);
      $proses5 = talistrap($label, $rollpallet, $data['pallet1set'], $data);
    } catch (exception $e) {
      echo "Error: " . $e->getMessage();
    }
    try { //proses 6
      $proses6 = panjangff($remark, $data['diaroll'], $data['foamprotek'], $data['fefoamuse'], $data);
      $proses6->$data['fefoam'];
      $proses6->$data['panjangfefoam'];
      $proses6->$data['plastikfilm'];
    } catch (exception $e) {
      echo "Error: " . $e->getMessage();
    }
    try { //proses 7
      $proses7 = syspex($rollpallet, $data);
      $proses7->$data['plastikfilmsyspex'];
    } catch (exception $e) {
      echo "Error: " . $e->getMessage();
    }
    try { //proses8
      talistrap2($data['talistrapping']);
      $quantity = calculateQuantity($rollpallet, $qty);
      $standardPackageLength_m = 300; // panjang fe foam per rollpackage
      $result = calculateTotalLength($data['panjangfefoam'], $quantity, $standardPackageLength_m);
    } catch (exception $e) {
      echo "Error: " . $e->getMessage();
    }


    //----------------------------------------------
    $protekroll1 = '1'; //protektor roll if chin ta dan taiwan order
    //warna pe foam =proses 22
    // $result['totalLength_m']  panjang kebutuhan pe foam per meter X qty 
    $plastikpermeter = $data['plastikfilm'] * $quantity / 1000; //panjang kebutuhan plastik per roll X qty
    $qtyinserter = $qty * 2; //inserter X 2 pcs per roll X qty
    //$data['pallet'] ukuran pallet
    //$data['ispmht'];//jenis pallet
    $qtyalas = $qty * 2; //alas X 2 per pallet X qty
    $syspexpermeter = $data['plastikfilmsyspex'] / 1000 * $qty; //konfersi plastik syspek ke meter
    $talipermeter = $data['talistrap2'] / 1000 * $qty; //konfersi talistrap ke meter
    try {
      $query = mysqli_query($conn, "INSERT INTO `keluar` (`id`, `no_doc`, `tanggal`, `shift`, `groupB`, `tracking_id`, `material`, `desc_material`, `qty`, `colorfoam`, `pack_foam`, `pack_plastik_roll`, `pack_inserter`, `qty_inserter`, `pack_pallet`, `jenis_pallet`, `qty_pallet`, `pack_alas`, `qty_alas`, `qty_protektor`, `pack_plastik_syspex`, `pack_strapping`)
  VALUES (
    'null',
    '$no_doc',
    '$tanggal',
    '$shift',
    '$groupB',
    '$tracking_id',
    '$material',
    '$desc_material',
    '$qty',
    '" . $proses22 . "',
    '" . $result['totalLength_m'] . "',
    '" . $plastikpermeter . "',
    '" . $data['inserter'] . "',
    '" . $qtyinserter . "',
    '" . $data['pallet'] . "',
    '" . $data['ispmht'] . "',
    '" . $qty . "',
    '" . $data['pallet'] . "',
    '" . $qtyalas . "',
    '$protekroll1',
    '" . $syspexpermeter . "',
    '" . $talipermeter . "'
  )");

      if (!$query) {
        throw new Exception("Error executing query: " . mysqli_error($conn));
      }
      //--------------------------fungsi decrement stock-------------------
      echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
      echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
      echo "Record updated successfully</br>";
      ?>
      <div class="col-md-2 mb-3">
          <a href="report_packaging.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-upload fa-sm text-white-50"></i> Print Daily Report Packaging </a>
        </div>
    
      <?php
      try{//proses 9 decrement inserter packaging
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = "Inserter_" . $data['inserter'];
        $decrementValue = $qtyinserter;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        $conn->close();
      }catch(exception $e){
        echo "Error: " . $e->getMessage();
      }
      try{//proses 10 decrement pallet packaging
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = palletjen($data['pallet'],$data['ispmht']);
        $decrementValue = $qtyalas;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        $conn->close();
      }catch(exception $e){
        echo "Error: " . $e->getMessage();
      }
      try{//proses 11 decrement alas pallet packaging
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = alaspallet($data['pallet']);
        $decrementValue = $qty*2;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        $conn->close();
      }catch(exception $e){
        echo "Error: " . $e->getMessage();
      }
      try{//proses 12 decrement protektor roll
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = "CardBox pallet_protektor roll cass";
        $decrementValue = $protekroll1;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        $conn->close();
      }catch(exception $e){
        echo "Error: " . $e->getMessage();
      }
      try{//proses 13 decrement pe foam
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = pefoamccc($proses22);
        $decrementValue = $result['totalLength_m'];
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        $conn->close();
      }catch(exception $e){
        echo "Error: " . $e->getMessage();
      }
      try{//proses 14 decrement plastik film mc hs dan syspex
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = "Sterach Film";
        $decrementValue = $plastikpermeter+$syspexpermeter;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        $conn->close();
      }catch(exception $e){
        echo "Error: " . $e->getMessage();
      }
      try{//proses 15 decrement talistrapping
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = "tali_strapping";
        $decrementValue = $talipermeter;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        $conn->close();
      }catch(exception $e){
        echo "Error: " . $e->getMessage();
      }
      echo   "</div>";
      echo "</div>";
      //------------------------------------------------------------------
      echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
      echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
      echo "<p><center>Menambakan Data Sukses</center></p>";
      //echo "Record inserted successfully";
      echo   "</div>";
      echo "</div>";
    } catch (Exception $e) {
      echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
      echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
      echo "Error: " . $e->getMessage();
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
      <form class="form-inline my-2 my-lg-0" action="" method="get" name='cari'>
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
        if (isset($_GET['cari'])) {
          $cari = mysqli_real_escape_string($conn, $_GET['cari']);
          //$brg = mysqli_query($conn, "select * from keluar where id like '%" . $cari . "%' or no_doc like '%" . $cari . "%' or shift like '%" . $cari . "%' ");
          $brg = mysqli_query($conn, "SELECT * FROM `keluar` WHERE `no_doc` LIKE '%" . $cari . "%'");
          
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


                <td>&nbsp;<!--<a href="edit.php?id=<?php //echo $row['id']; ?>"><button type="button" class="btn btn-success">Edit</button></a>--> &nbsp; <a href="hapus.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">Hapus</button></a> &nbsp; <!--<a href="detail.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-info">Detail</button></a>--></td>

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
        // $cep = mysqli_query($conn, "select * from rp");
        // $tesd = mysqli_num_rows($cep);


        // if ($tesd > 0) {
        //   echo "<div class='col-md-2'>";
        //   echo " <a href='hapus_all_modal.php'><button type='button' class='btn btn-danger'>Hapus Semua</button></a>";
        //   echo "</div>";
        // } else {
        // } ?>

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

  <?php
  include 'fotterbar.php';
  ?>