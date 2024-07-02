<?php
session_start();

if ($_SESSION['password'] == '') {
  header("location:login.php");
}
include 'koneksi.php';
ob_start() ?>
<?php include 'topbar.php';
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
    <script type="text/javascript">
      //---------------------------------
      window.onload = function() {
        //populateInput();
        setAutoDate()
      }

      function getTodayDate() {
        const today = new Date();
        const year = today.getFullYear();
        let month = today.getMonth() + 1; // Months are zero-based
        let day = today.getDate();

        // Add leading zero if month or day is less than 10
        month = month < 10 ? '0' + month : month;
        day = day < 10 ? '0' + day : day;

        return `${year}-${month}-${day}`;
      }

      // Function to set the date input value to today's date
      function setAutoDate() {
        const tanggalInput = document.getElementById('tanggal');
        if (tanggalInput) {
          tanggalInput.value = getTodayDate();
        }
      }
      //--------------------------------
      // function update() {
      //   var Pallet = ["pallet_71", "pallet_71ht", "pallet_74", "pallet_74ht", "pallet_76bb", "pallet_95", "pallet_95ht", "pallet_104", "pallet_104ht", "pallet_107", "pallet_107ht", "pallet_100ht", "pallet_113ht", "pallet_plastik"];
      //   var FE_foam = ["FE_foam_white", "FE_foam_Blue", "FE_foam_Pink", "FE_foam_green", "FE_foam_yellow"];
      //   var Inserter = ["Inserter_650", "Inserter_700", "Inserter_865", "Inserter_900", "Inserter_950", "Inserter_1000", "Inserter_1020", "Inserter_1200"];
      //   var CardBox_Pallet = ["CardBox pallet_71", "CardBox pallet_74", "CardBox pallet_95", "CardBox pallet_104", "CardBox pallet_110", "CardBox pallet_protektor roll cass"];

      //   var Paper_Craft = ["craft_1000", "craft_1200", "craft_1200", "craft_1500", "craft_2000"];
      //   var Streach_Film = ["Streach Film", "Streach Film", "Streach Film", "null", "null"];
      //   var Tali_Strapping = ["tali_strapping", "tali_strapping", "null", "null", "null"];
      //   var PaperPE = ["Paper craft PE_1000", "Paper craft PE_1200", "Paper craft PE_2000", "null", "null"];
      //   var Double_Tape = ["double_tape", "double_tape", "double_tape", "null", "null"];

      //   var countries = document.getElementById("1");
      //   var cities = document.getElementById("2");
      //   var selected = countries.options[countries.selectedIndex].value;
      //   //---
      //   //var selectElement = document.getElementById("2");
      //   //var selectedOption = selectElement.options[selectElement.selectedIndex].value;
      //   var jumlahInput = document.getElementById("jumlah2");
      //   //---

      //   if (selected == "Pallet") {
      //     for (var i = 0; i < Pallet.length; i++) {
      //       var opt1 = document.createElement('option');
      //       opt1.innerHTML = Pallet[i];
      //       opt1.value = Pallet[i];
      //       cities.appendChild(opt1);
      //       //
      //       jumlahInput.value = "Jumlah untuk 1 SET Pallet";
      //       jumlahInput.setAttribute("readonly", "readonly");
      //       //

      //     }
      //   }

      //   else if (selected == "FE_foam") {

      //     for (var j = 0; j < FE_foam.length; j++) {
      //           var opt2 = document.createElement('option');
      //           opt2.innerHTML = FE_foam[j];
      //           opt2.value = FE_foam[j];
      //           cities.appendChild(opt2);
      //           //
      //           jumlahInput.value = "Jumlah untuk 1 Roll PE_foam";
      //       jumlahInput.setAttribute("readonly", "readonly");
      //           //

      //         }

      //   } else if (selected == "Inserter") {
      //     for (var k = 0; k < Inserter.length; k++) {
      //       var opt3 = document.createElement('option');
      //       opt3.innerHTML = Inserter[k];
      //       opt3.value = Inserter[k];
      //       cities.appendChild(opt3);
      //       //
      //       jumlahInput.value = "Jumlah 1000 pcs untuk 1  Pallet";
      //       jumlahInput.setAttribute("readonly", "readonly");
      //       //
      //     }
      //   } else if (selected == "CardBox_Pallet") {
      //     for (var l = 0; l < CardBox_Pallet.length; l++) {
      //       var opt3 = document.createElement('option');
      //       opt3.innerHTML = CardBox_Pallet[l];
      //       opt3.value = CardBox_Pallet[l];
      //       cities.appendChild(opt3);
      //       //
      //       jumlahInput.value = "Jumlah 1000 pcs untuk 1 SET Pallet";
      //       jumlahInput.setAttribute("readonly", "readonly");
      //       //
      //     }
      //   } else if (selected == "Paper_Craft") {
      //     for (var m = 0; m < Paper_Craft.length; m++) {
      //       var opt3 = document.createElement('option');
      //       opt3.innerHTML = Paper_Craft[m];
      //       opt3.value = Paper_Craft[m];
      //       cities.appendChild(opt3);
      //       //
      //       jumlahInput.value = "Jumlah untuk 1 Roll craft";
      //       jumlahInput.setAttribute("readonly", "readonly");
      //       //
      //     }
      //   } else if (selected == "Streach_Film") {
      //     for (var j = 0; j < Streach_Film.length; j++) {
      //       var opt2 = document.createElement('option');
      //       opt2.innerHTML = Streach_Film[j];
      //       opt2.value = Streach_Film[j];
      //       cities.appendChild(opt2);
      //       //
      //       jumlahInput.value = "Jumlah untuk 1 Roll film ";
      //       jumlahInput.setAttribute("readonly", "readonly");
      //       //
      //     }
      //   } else if (selected == "Tali_Strapping") {
      //     for (var o = 0; o < Tali_Strapping.length; o++) {
      //       var opt3 = document.createElement('option');
      //       opt3.innerHTML = Tali_Strapping[o];
      //       opt3.value = Tali_Strapping[o];
      //       cities.appendChild(opt3);
      //       //
      //       jumlahInput.value = "Jumlah untuk 1 Roll Tali Strap ";
      //       jumlahInput.setAttribute("readonly", "readonly");
      //       //
      //     }
      //   } else if (selected == "PaperPE") {
      //     for (var e = 0; e < PaperPE.length; e++) {
      //       var opt3 = document.createElement('option');
      //       opt3.innerHTML = PaperPE[e];
      //       opt3.value = PaperPE[e];
      //       cities.appendChild(opt3);
      //       //
      //       jumlahInput.value = "Jumlah 1000 pcs untuk 1  Pallet";
      //       jumlahInput.setAttribute("readonly", "readonly");
      //       //
      //     }
      //   } else if (selected == "Double_Tape") {
      //     for (var f = 0; f < Double_Tape.length; f++) {
      //       var opt3 = document.createElement('option');
      //       opt3.innerHTML = Double_Tape[f];
      //       opt3.value = Double_Tape[f];
      //       cities.appendChild(opt3);
      //       //
      //       jumlahInput.value = "Jumlah untuk 1 box X 60 pcs";
      //       jumlahInput.setAttribute("readonly", "readonly");
      //       //
      //     }
      //   } else
      //     var t = 0;//------------

      // }
      function updateNamaB() {
                // Get the selected value from the select element
                var selectedNoReservasi = document.getElementById('noreservasi').value;

                // Find the selected data from the JavaScript variable
                var selectedData = data.find(function(item) {
                  return item.noreservasi === selectedNoReservasi;
                });

                // Update the value of the input field with the selected data's 'nama' property
                document.getElementById('nama_b').value = selectedData ? selectedData.nama : '';
                document.getElementById('jenis').value = selectedData ? selectedData.jenis : '';
                document.getElementById('jumlah').value = selectedData ? selectedData.jumlah : '';
              }
    </script>
    <?php
    //prepare data
    $data = array(
      'noreservasi' => null,
      'nama' => null,
      'jenis' => null,
      'jumlah' => null
    );



    ?>
    <!-- Page Heading -->


    <div class="row mr-3">
      <div class="col-md-10">

      </div>
      <div class="col-md-2 mb-3">
        <a href="export_excel_stock.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
      </div>
    </div>



    <!-- Content Row -->
    <form name='kirim' method='post'>
      <div class="card shadow  ml-4 mr-4">
        <div class="card-header py-3">
          <h1 class="h3 mb-0 text-gray-800">Input Stock Packaging</h1>
        </div>
        <div class="row ml-5 mb-2">
          <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>No Reservasi :</b></p>
            <select class='form-control' name='noreservasi' id='noreservasi' onchange='updateNamaB()'>
              <?php
              //------------------------------------
              // Fetch data from the database
              $duren = mysqli_query($conn, "SELECT * FROM masuk WHERE status1=1");
              $data = array(); // Initialize an empty array to store data

              if (mysqli_num_rows($duren) > 0) {

                echo "<option value='' disabled selected>Pilih No Reservasi</option>";
                while ($ow = mysqli_fetch_array($duren)) {
                  echo "<option value='" . $ow['noreservasi'] . "'>" . $ow['noreservasi'] . "</option>";
                  // Store data in the array
                  $data[] = array(
                    'noreservasi' => $ow['noreservasi'],
                    'nama' => $ow['nama'],
                    'jenis' => $ow['jenis'],
                    'jumlah' => $ow['JumlahB']
                  );
                }
                echo "</select>";
              } else {
                echo "No rows found.";
                echo "</select>";
              }

              // Output the JavaScript containing the 'data' variable
              echo "<script>var data = " . json_encode($data) . ";</script>";

              ?>
          </div>
        
          <!-- Place the rest of your HTML code here -->
          <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>Tanggal:</b></p>
            <input class="form-control" type="date" name='tanggal' id="tanggal" required>
          </div>
          <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>Nama Barang :</b></p>
            <input class='form-control' type='text' name='nama_b' id='nama_b' required readonly>

            <!--<p><select class='form-control' name='nama_b' required id='1' required value='  $namab;  ' onchange='update()'>";
                <option value="">pilih</option>
                <option value="Pallet">Pallet</option>
                <option value="FE_foam">FE_foam</option>
                <option value="Inserter">Inserter</option>
                <option value="CardBox_Pallet">CardBox pallet</option>
                <option value="Paper_Craft">Paper Craft</option>
                <option value="Streach_Film">Streach Film</option>
                <option value="Tali_Strapping">Tali strapping</option>
                <option value="PaperPE">Paper craft PE</option>
                <option value="Double_Tape">Double Tape</option>
              </select>
            </p>-->
          </div>


          <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>Jenis Barang:</b></p>
            <input class='form-control' type='text' name='jenis' id='jenis' required readonly>
            <!-- <p><select class="form-control" name='jenis'  id="jenis">-->

            </p>
            </select>
          </div>

          <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>Jumlah Barang:</b></p>
            <input class='form-control' type='text' name='jumlah' id='jumlah' required readonly>



          </div>
        </div>
        <div class="row ml-5 mb-2">
          <div class="col-md-5 col-sm-12 col-xs-12 mt-4">
            <button type="submit" class="btn btn-primary btn-lg btn-block" name='kirim'>Kirim</button>

          </div>
        </div>
    </form>

    <?php
    if (isset($_POST['kirim'])) {
      //----prepare data------------

      $noreservasi = htmlspecialchars($_POST['noreservasi']);
      $tanggal = htmlspecialchars($_POST['tanggal']);
      $nama = htmlspecialchars($_POST['nama_b']);
      $jenis = htmlspecialchars($_POST['jenis']);
      $jumlah = htmlspecialchars($_POST['jumlah']);
      // echo "$noreservasi";echo "</br>";
      // echo "$tanggal";echo "</br>";
      // echo "$nama";echo "</br>";
      // echo "$jenis";echo "</br>";
      // echo "$jumlah";echo "</br>";
      //------------------------------
      function calculateQuantity($material)
      {
        switch ($material) {
          case 'FE_foam':
            return 300;
          case 'Inserter':
            return 1000;
          case 'CardBox_Pallet':
            return 1000;
          case 'PaperPE':
            return 2000;
          case 'Streach Film':
            return 20000;
          case 'Tali strapping':
            return 20000;
          case 'Double_Tape':
            return 60;
          case 'PaperPE':
            return 1000;
          case 'Pallet':
            return 1;
          default:
            return 0; // Default value if material type is not recognized
        }
      }

      // Example usage:
      $material = $nama;
      $jumlah = calculateQuantity($material);
      // echo "$jumlah";echo "</br>tt";
      // echo "Jumlah: $jumlah"; // Output: Jumlah: 300

      //-----------------------------------

      //---------------------------------------   
      try {
        // Attempt to execute the INSERT query
        $insert = mysqli_query($conn, "INSERT INTO stock VALUES (NULL, '$noreservasi', '$tanggal', '$nama', '$jenis', '$jumlah')");

        // Attempt to execute the UPDATE query
        $ustok = mysqli_query($conn, "UPDATE `stock_take` SET $jenis = $jenis + $jumlah WHERE `stock_take`.`id` = 1");
        $stat2 = mysqli_query($conn, "UPDATE `masuk` SET `status1` = '0' WHERE `noreservasi` = $noreservasi");
        // Check if both queries were successful
        if ($insert && $ustok && $stat2) {

          // Both queries were successful
          echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
          echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
          echo "<p><center>Menambakan Data Sukses</center></p>";
          // echo "Jumlah: $jumlah"; // Output: Jumlah: 300
          // echo "$noreservasi";
          // echo "</br";
          // echo "$tanggal";
          // echo "</br";
          // echo "$nama";
          // echo "</br";
          // echo "$jenis";
          // echo "</br";
          // echo "$jumlah";
          // echo "</br";
          echo "Error: " . mysqli_error($conn);
          echo "</div>";
          echo "</div>";
        } else {
          // At least one query failed
          throw new Exception("Failed to execute one or more queries.");
        }
      } catch (Exception $e) {
        // Handle any exceptions that occur during database operations
        echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
        echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
        echo "<p><center>Menambakan Data Gagal</center></p>";
        // echo "$noreservasi";
        // echo "</br";
        // echo "$tanggal";
        // echo "</br";
        // echo "$nama";
        // echo "</br";
        // echo "$jenis";
        // echo "</br";
        // echo "$jumlah";
        // echo "</br";
        echo "Error: " . mysqli_error($conn);
        echo "</div>";
        echo "</div>";
        // Log the error or take appropriate action
        echo "Error: " . $e->getMessage();
      }
    }

    ?>
    <?php

    $jumlah_produk = mysqli_query($conn, "SELECT COUNT(*) as id from stock");
    $row = mysqli_fetch_array($jumlah_produk);
    $jum = $row['id'];


    ?>




    <div class="row mt-5 mr-4">
      <div class="col-md-8">
        <?php

        $hmm = $jum;
        $hal = 10;
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $hal;


        ?>
      </div>

      <div class="col-md-4">

      </div>
    </div>

    <?php
    if ($jum <= 0) {
      echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
      echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
      echo "<p><center><b>Data Anda Masih Kosong</b></center></p>";
      echo   "</div>";
      echo "</div>";
    }
    ?>
    <div class="col-md-12 col-sm-12 col-xs-12  mt-5">
      <div class="table-responsive service">
        <table class="table table-bordered table-hover  mt-3 text-nowrap css-serial">
          <thead>
            <tr>

              <th scope="col">No</th>
              <th scope="col">No Reservasi</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Nama</th>
              <th scope="col">jenis</th>
              <th scope="col">Jumlah Barang</th>
              <th scope="col">Opsi</th>

            </tr>

          </thead>

          <?php

          $cek = mysqli_query($conn, "select * from stock limit $start, $hal");

          while ($isi = mysqli_fetch_array($cek)) {
          ?>

            <tbody>
              <tr>
                <th scope="row">
                  <?php echo $isi['id'] ?></th>
                <td><?php echo $isi['noreservasi'] ?></td>
                <td><?php echo $isi['tanggal'] ?></td>
                <td><?php echo $isi['nama'] ?></td>
                <td><?php echo $isi['jenis'] ?></td>
                <td><?php echo $isi['jumlah'] ?></td>
                <td><!--<a href="edit_input.php?id=<?php //echo $isi['id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a>&nbsp;--><a href="hapus_input_stock.php?id=<?php echo $isi['id']; ?>"><button type="button" class="btn btn-danger">Hapus</button></a></td>
              </tr>
            </tbody>
          <?php }  ?>
        </table>

        <div class="row">

          <div class="col-md-5">

          </div>

          <div class="col-md-5">

          </div>

          <?php

          ?>
        </div>



        <nav aria-label="Page navigation example">
          <ul class="pagination">

            <?php
            // echo "<div class='col-md-2'>";
            // echo " <a href='hapus_all_input.php'><button type='button' class='btn btn-danger'>Hapus Semua</button></a>";
            // echo "</div>";
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
    <!-- Footer -->
    <?php
    include 'fotterbar.php';
    ob_end_flush() ?>