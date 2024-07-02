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

    <!--experimental-->
    <script type="text/javascript">
      //------------------------------------
//       function toggleForm() {
//   var table = document.getElementById("mytable");
//   if (table.style.display === "none") {
//     table.style.display = "block";
//   } else {
//     table.style.display = "none";
//   }
// }

                // --------------------------
                function populateInput() {
              var currentDate = new Date(); // Get the current date and time
              var day = currentDate.getDate().toString().padStart(2, '0'); // Get the day and pad with leading zero if needed
              var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Get the month and pad with leading zero if needed
              var year = currentDate.getFullYear(); // Get the year
              var arrayValue = [12354]; // Example array value

              var formattedValue = arrayValue.join('') + day + month + year; // Combine array value, day, month, and year

              document.getElementById("noreservasi").value = formattedValue; // Set the input field value
          }
          

          // Call populateInput() when the page loads
          window.onload = function() {
              populateInput();
              setAutoDate()
              //document.getElementById("toggleButton").addEventListener("click", toggleForm);

              //document.addEventListener('DOMContentLoaded', setAutoDate);
          };

          // Also call populateInput() when the input field value changes
          //document.getElementById("12").addEventListener("change", populateInput);
          //document.getElementById("12").addEventListener("change", populateInput);
//-------------------------
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
// Call setAutoDate() when the DOM content is loaded


// Call the function when the page is loaded
//window.onload = setAutoDate;
      //-------------------------
      function update() {
        var Pallet = ["pallet_71", "pallet_71ht", "pallet_74", "pallet_74ht", "pallet_76bb", "pallet_95", "pallet_95ht", "pallet_104", "pallet_104ht", "pallet_107", "pallet_107ht", "pallet_100ht", "pallet_113ht", "pallet_plastik"];
        var FE_foam = ["FE_foam_white", "FE_foam_Blue", "FE_foam_Pink", "FE_foam_green", "FE_foam_yellow"];
        var Inserter = ["Inserter_650", "Inserter_700", "Inserter_865", "Inserter_900", "Inserter_950", "Inserter_1000", "Inserter_1020", "Inserter_1200"];
        var CardBox_Pallet = ["CardBox pallet_71", "CardBox pallet_74", "CardBox pallet_95", "CardBox pallet_104", "CardBox pallet_110", "CardBox pallet_protektor roll cass"];

        var Paper_Craft = ["craft_1000", "craft_1200", "craft_1200", "craft_1500", "craft_2000"];
        var Streach_Film = ["Streach Film", "Streach Film", "Streach Film", "null", "null"];
        var Tali_Strapping = ["tali_strapping", "tali_strapping", "null", "null", "null"];
        var PaperPE = ["Paper craft PE_1000", "Paper craft PE_1200", "Paper craft PE_2000", "null", "null"];
        var Double_Tape = ["double_tape", "double_tape", "double_tape", "null", "null"];

        var countries = document.getElementById("1");
        var cities = document.getElementById("2");
        var selected = countries.options[countries.selectedIndex].value;
        var jumlahInput = document.getElementById("jumlah2");

        if (selected == "Pallet") {
          for (var i = 0; i < Pallet.length; i++) {
            var opt1 = document.createElement('option');
            opt1.innerHTML = Pallet[i];
            opt1.value = Pallet[i];
            cities.appendChild(opt1);
            //
            jumlahInput.value = "Jumlah untuk 1 SET Pallet";
            jumlahInput.setAttribute("readonly", "readonly");
            //
           
          }
        }
        
        else if (selected == "FE_foam") {
         
          for (var j = 0; j < FE_foam.length; j++) {
                var opt2 = document.createElement('option');
                opt2.innerHTML = FE_foam[j];
                opt2.value = FE_foam[j];
                cities.appendChild(opt2);
                //
                jumlahInput.value = "Jumlah untuk 1 Roll PE_foam";
            jumlahInput.setAttribute("readonly", "readonly");
                //
                      
              }
              
        } else if (selected == "Inserter") {
          for (var k = 0; k < Inserter.length; k++) {
            var opt3 = document.createElement('option');
            opt3.innerHTML = Inserter[k];
            opt3.value = Inserter[k];
            cities.appendChild(opt3);
            //
            jumlahInput.value = "Jumlah 1000 pcs untuk 1  Pallet";
            jumlahInput.setAttribute("readonly", "readonly");
            //
          }
        } else if (selected == "CardBox_Pallet") {
          for (var l = 0; l < CardBox_Pallet.length; l++) {
            var opt3 = document.createElement('option');
            opt3.innerHTML = CardBox_Pallet[l];
            opt3.value = CardBox_Pallet[l];
            cities.appendChild(opt3);
            //
            jumlahInput.value = "Jumlah 1000 pcs untuk 1 SET Pallet";
            jumlahInput.setAttribute("readonly", "readonly");
            //
          }
        } else if (selected == "Paper_Craft") {
          for (var m = 0; m < Paper_Craft.length; m++) {
            var opt3 = document.createElement('option');
            opt3.innerHTML = Paper_Craft[m];
            opt3.value = Paper_Craft[m];
            cities.appendChild(opt3);
            //
            jumlahInput.value = "Jumlah untuk 1 Roll craft";
            jumlahInput.setAttribute("readonly", "readonly");
            //
          }
        } else if (selected == "Streach_Film") {
          for (var j = 0; j < Streach_Film.length; j++) {
            var opt2 = document.createElement('option');
            opt2.innerHTML = Streach_Film[j];
            opt2.value = Streach_Film[j];
            cities.appendChild(opt2);
            //
            jumlahInput.value = "Jumlah untuk 1 Roll film ";
            jumlahInput.setAttribute("readonly", "readonly");
            //
          }
        } else if (selected == "Tali_Strapping") {
          for (var o = 0; o < Tali_Strapping.length; o++) {
            var opt3 = document.createElement('option');
            opt3.innerHTML = Tali_Strapping[o];
            opt3.value = Tali_Strapping[o];
            cities.appendChild(opt3);
            //
            jumlahInput.value = "Jumlah untuk 1 Roll Tali Strap ";
            jumlahInput.setAttribute("readonly", "readonly");
            //
          }
        } else if (selected == "PaperPE") {
          for (var e = 0; e < PaperPE.length; e++) {
            var opt3 = document.createElement('option');
            opt3.innerHTML = PaperPE[e];
            opt3.value = PaperPE[e];
            cities.appendChild(opt3);
            //
            jumlahInput.value = "Jumlah 1000 pcs untuk 1  Pallet";
            jumlahInput.setAttribute("readonly", "readonly");
            //
          }
        } else if (selected == "Double_Tape") {
          for (var f = 0; f < Double_Tape.length; f++) {
            var opt3 = document.createElement('option');
            opt3.innerHTML = Double_Tape[f];
            opt3.value = Double_Tape[f];
            cities.appendChild(opt3);
            //
            jumlahInput.value = "Jumlah untuk 1 box X 60 pcs";
            jumlahInput.setAttribute("readonly", "readonly");
            //
          }
        } else
          var t = 0;
      }
    </script>
    <form name='kirim' method='post'>
      <div class="row">

        <div class="col-md-1"></div>

        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>Tanggal :</b></p>
          <input class="form-control" type="date" name='tanggal' id="tanggal" >
          <!--<input class="form-control" type="date" id="tanggal" name="tanggal">-->
        </div>


        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>No SC :</b></p>
          <p><select class="form-control" name='sc' required id="" onchange="">
              <option value="none">pilih sc</option>
              <?php

              $duren = mysqli_query($conn, "select sc from rp ");
              if (mysqli_num_rows($duren)) {

                while ($ow = mysqli_fetch_array($duren)) {
              ?>
                  <option value="<?php echo $ow['sc'] ?>"><?php echo $ow['sc'] ?></option>

              <?php
                }
              }
              ?>
            </select>
          </p>
        </div>
      </div>


      <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>Nama Barang :</b></p>
          <p><select class="form-control" name='nama_b' required id="1" onchange="update()">
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
          </p>
        </div>



        <div class="col-md-5 col-sm-12 col-xs-12">
          <p><b>Jenis Barang:</b></p>
          <p><select class="form-control" name='jenis' required id="2">
              <option selected="selected"></option>
          </p>
          </select>
        </div>
      </div>
  

  <div class="row">
    <div class="col-md-1">

            </div>

    <div class="col-md-5 col-sm-12 col-xs-12">
      <p><b>Suplier:</b></p>
      <input class="form-control" type="text" placeholder="Suplier..." name='suplier' required>
    </div>


    <div class="col-md-5 col-sm-12 col-xs-12">
      <p><b>No Reservasi:</b></p>
      <input class="form-control" type="text" placeholder="No Reservasi..." name="noreservasi" id="noreservasi" onchange="populateInput()">
     <!-- <input class="form-control" type="number" placeholder="No Reservasi..." name='noreservasi' onchange="populateInput()">-->
      </select>
    </div>

  </div>





  <div class="row">
    <div class="col-md-1">

    </div>
    <div class="col-md-5 col-sm-12 col-xs-12">
      <p><b>Jumlah Barang:</b></p>
      <input class="form-control" type="number" placeholder="Jumlah Barang..." name='jumlah' required>
      <input class='form-control'  id='jumlah2' type='text' name='jumlah2' placeholder='Desc Jumlah Barang' required>
      </select>
    </div>

  </div>


  <div class="row mt-3">
    <div class="col-md-1">

    </div>

    <div class="col-md-10 col-sm-12 col-xs-12">
      <button type="submit" class="btn btn-primary btn-lg btn-block" name='kirim'>Kirim</button>

      </form>

    </div>





    <?php
    if (isset($_POST['kirim'])) {
      $noreser = htmlspecialchars($_POST['noreservasi']);
      $tanggal = htmlspecialchars($_POST['tanggal']);
      $sc = htmlspecialchars($_POST['sc']);
      $nama = htmlspecialchars($_POST['nama_b']);
      $jenis = htmlspecialchars($_POST['jenis']);
      $suplier = htmlspecialchars($_POST['suplier']);
      $jumlah = htmlspecialchars($_POST['jumlah']); {
        $stat = '1';
        
        $sql = "INSERT INTO masuk (noreservasi, tanggal, sc, nama, jenis, suplier, JumlahB, status1) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        // Prepare and bind parameters
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $noreser, $tanggal, $sc, $nama, $jenis, $suplier, $jumlah, $stat);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Insertion successful
            echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
            echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
            echo "<p><center> Menambah Data Sukses</center></p>";
            echo "</div>";
            echo "</div>";
            header('location: data.php');
        } else {
            // Insertion failed
            echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
            echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
            echo "<p><center>Menambah Data Gagal</center></p>";
            echo "</div>";
            echo "</div>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } catch (Exception $e) {
        // Echo any error that occurs
        echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
        echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
        echo "<p><center>Error: " . $e->getMessage() . "</center></p>";
        echo "</div>";
        echo "</div>";
    }
}
    }
    ?>
    <div class="col-md-1">

    </div>

  </div>
  <div class="card shadow  ml-4 mr-4">
    <div class="card-header py-3">



      <h6 class="m-0 font-weight-bold text-primary">Data Request Packaging</h6>
    </div>




    <div class="row mt-3">


      <div class="col-md-8  mt-4">
        <br>



      </div>

      <div class="col-md-4 mt-5">
        <form class="form-inline my-2 my-lg-0" action="caridata.php" method="get" name='cari'>
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
              <th scope="col">Tanggal</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Jenis</th>
              <th scope="col">Suplier</th>
              <th scope="col">No Reservasi</th>
              <th scope="col">No SC</th>
              <th scope="col">Jumlah Barang</th>
              <th scope="col">Opsi</th>

            </tr>

          </thead>
          <?php
          if (isset($_GET['cari'])) {
            $cari = mysqli_real_escape_string($conn, $_GET['cari']);
            $brg = mysqli_query($conn, "select * from masuk where id like '%" . $cari . "%' or noreservasi like '%" . $cari . "%' or tanggal like '%" . $cari . "%' ");

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
           // $brg = mysqli_query($conn, "select * from masuk limit $start, $hal");
           $brg = mysqli_query($conn, "SELECT * FROM masuk WHERE status1 = 1 LIMIT $start, $hal");


          }
          if (mysqli_num_rows($brg)) {
            while ($row = mysqli_fetch_array($brg)) {
          ?>
              <tbody>
                <tr>
                  <td><?php echo $row['tanggal'] ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo $row['jenis'] ?></td>
                  <td><?php echo $row['suplier'] ?></td>
                  <td><?php echo $row['noreservasi'] ?></td>
                  <td><?php echo $row['sc'] ?></td>
                  <td><?php echo $row['JumlahB'] ?></td>
                  <td>&nbsp;<a href="editdata.php?id=<?php echo $row['noreservasi']; ?>"><button type="button" class="btn btn-success">Edit</button></a> &nbsp; <a href="hapusdata.php?id=<?php echo $row['noreservasi']; ?>"><button type="button" class="btn btn-danger">Hapus</button></a> &nbsp; <a href="stock.php?id=<?php echo $row['noreservasi']; ?>"><button type="button" class="btn btn-info">Update Stock</button></a></td>
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
          echo "<div class='col-md-2'>";
          echo " <a href='print_request.php'><button type='button' class='btn btn-success'>Print All</button></a>";
          echo "<div class='col-md-2'>";
          echo "&nbsp;";
          echo "</div>";
          echo "</div>";
          ?>
        </div>
        <div class="row">
          <div class="col-md-5">
          </div>
          <script> function toggleTable() {
    var table = document.getElementById("mytable");
    if (table.classList.contains("hidden-row")) {
        table.classList.remove("hidden-row"); // Remove the hidden-row class
    } else {
        table.classList.add("hidden-row"); // Add the hidden-row class
    }
}
</script>

          <button type="button" class="btn btn-warning" onclick="toggleTable()">Load History Data Request Packaging</button>
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
          </div>
          
      <!--------------------------------------------------------------->
      <?php

    $hmm = $jum;
    $hal = 10;
    $page = (isset($_GET['pagew'])) ? (int)$_GET['pagew'] : 1;
    $start = ($page - 1) * $hal;


    ?>
      
      <form id="" >
      <div class="card shadow  ml-4 mr-4">
    <div class="card-header py-3">

    
    
      <h6 class="m-0 font-weight-bold text-primary">History Data Input Packaging</h6>
      <div class="col-md-4 mt-5">
      </div>
    </div>
      <div class="col-md-12 col-sm-12 col-xs-12  mt-5">
      
      <div class="table-responsive service">
     <style>
      .hidden-row {
    display: none; /* Hide initially */
}</style>
      <!--<table class="table table-bordered table-hover mt-3 text-nowrap css-serial" id="myTable">-->
      <table class="table table-bordered table-hover mt-3 text-nowrap css-serial hidden-row" id="mytable">
    <!-- Table content -->
    <thead>
            <tr>
              <th scope="col">Tanggal</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Jenis</th>
              <th scope="col">Suplier</th>
              <th scope="col">No Reservasi</th>
              <th scope="col">No SC</th>
              <th scope="col">Jumlah Barang</th>
              <th scope="col">Opsi</th>

            </tr>

          </thead>
          <?php
          
           // $brg = mysqli_query($conn, "select * from masuk limit $start, $hal");
           $brg = mysqli_query($conn, "SELECT * FROM masuk WHERE status1 = 0 LIMIT $start, $hal");


          
          if (mysqli_num_rows($brg)) {
            while ($row = mysqli_fetch_array($brg)) {
          ?>
              <tbody>
                <tr>
                  <td><?php echo $row['tanggal'] ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo $row['jenis'] ?></td>
                  <td><?php echo $row['suplier'] ?></td>
                  <td><?php echo $row['noreservasi'] ?></td>
                  <td><?php echo $row['sc'] ?></td>
                  <td><?php echo $row['JumlahB'] ?></td>
                  <td><a href="hapusdata.php?id=<?php echo $row['noreservasi']; ?>"><button type="button" class="btn btn-danger">Hapus</button></a> &nbsp;  </td>
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
              <li class="page-item"><a class="page-link" href="?pagew=<?php echo $x ?>"><?php echo $x ?></a></li>
            <?php
            }

            ?>
          </ul>
        </nav>
          </form>
      
      <!---------------------------------------------------------------->
      <?php include 'fotterbar.php'; ?>