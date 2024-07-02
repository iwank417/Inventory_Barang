<?php
 //Load file autoload.php
require 'vendor/autoload.php';

//Include library PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

session_start();

if($_SESSION['password']=='')
{
    header("location:login.php");
}
include 'koneksi.php';
error_reporting(0);
include 'topbar.php'; ?>

  <!-- Load File jquery.min.js yang ada difolder js -->
    <script src="js/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Sembunyikan alert validasi kosong
            $("#kosong").hide();
        });
    </script>
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
                <img class="img-profile rounded-circle" src=" penampung/<?php echo$profile['foto'] ?>" alt="Profile"  width="100px" height="100px">
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

        <div class ="row">
        <div class="col-md-1">
  </div>
  <div class="col-md-5 col-sm-12 col-xs-12">
  
    <h3>Form Import Data Rencana Produksi</h3>
    


    <form method="post" action="form.php" enctype="multipart/form-data">
    <div class="col-md-5 col-sm-12 col-xs-12">
    <div class="col-md-2 mb-3">
  <a href="Format.xlsx" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download contoh Spreeadsheet </a>
  </div>

        
        <!--<a href="rp.php">Kembali</a>-->
        
        <div class="col-md-2 mb-3">
        
        <input type="file" name="file">
        </div>
        <div class="col-md-2 mb-3">
        
        <button type="submit" name="preview" >Preview</button>
        </div>
    </div>
    </form>
    <hr>
        </div>
      </div>
      </div>
    <?php
    // Jika user telah mengklik tombol Preview
    if (isset($_POST['preview'])) {
        $tgl_sekarang = date('YmdHis'); // Ini akan mengambil waktu sekarang dengan format yyyymmddHHiiss
        $nama_file_baru = 'data' . $tgl_sekarang . '.xlsx';

        // Cek apakah terdapat file data.xlsx pada folder tmp
        if (is_file('tmp/' . $nama_file_baru)) // Jika file tersebut ada
            unlink('tmp/' . $nama_file_baru); // Hapus file tersebut

        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
        $tmp_file = $_FILES['file']['tmp_name'];

        // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
        if ($ext == "xlsx") {
            // Upload file yang dipilih ke folder tmp
            // dan rename file tersebut menjadi data{tglsekarang}.xlsx
            // {tglsekarang} diganti jadi tanggal sekarang dengan format yyyymmddHHiiss
            // Contoh nama file setelah di rename : data20210814192500.xlsx
            move_uploaded_file($tmp_file, 'tmp/' . $nama_file_baru);

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load('tmp/' . $nama_file_baru); // Load file yang tadi diupload ke folder tmp
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            // Buat sebuah tag form untuk proses import data ke database
            echo "<form method='post' action='import.php'>";

            // Disini kita buat input type hidden yg isinya adalah nama file excel yg diupload
            // ini tujuannya agar ketika import, kita memilih file yang tepat (sesuai yg diupload)
            echo "<input type='hidden' name='namafile' value='" . $nama_file_baru . "'>";

            // Buat sebuah div untuk alert validasi kosong
            echo "<div id='kosong' style='color: red;margin-bottom: 10px;'>
          Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                </div>";

            echo "<div class='col-md-12 col-sm-12 col-xs-12  mt-5'>
            <div class='table-responsive service'>
            <table class='table table-bordered table-hover  mt-3 text-nowrap css-serial'>
            <thead>
          <tr>
            <th colspan='5' class='text-center'>Preview Data</th>
          </tr>
          <tr>
            <th>No RP</th>
            <th>Grade</th>
            <th>PM</th>
            <th>Date of Making</th>
            <th>SC</th>
            <th>Roll / Pallet</th>
            <th>Total Unit Plan</th>
            <th>Total Unit Order</th>
            <th>Label</th>
            <th>MAD</th>
            <th>Country / Customer</th>
            <th>Material</th>
            <th>Remark</th>
          </tr>";

            $numrow = 1;
            $kosong = 0;
            foreach ($sheet as $row) { // Lakukan perulangan dari data yang ada di excel
                // Ambil data pada excel sesuai Kolom
                $norp = $row['A']; 
                $grade = $row['B'];
                $pm = $row['C']; 
                $dom = $row['D'];
                $sc = $row['E']; 
                $rollpp =$row['F'];
                $tup =$row['G'];
                $tuo =$row['H'];
                $label =$row['I'];
                $mad =$row['J'];
                $cus =$row['K'];
                $mater=$row['L'];
                $rem =$row['M'];

                // Cek jika semua data tidak diisi
                if ($norp == "" && $grade == "" && $pm == "" && $dom == "" && $sc == "" && 
                    $rollpp=="" && $tup=="" && $tuo=="" && $label=="" && $mad=="" && $cus=="" && $mater=="" && $rem=="" )
                    continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if ($numrow > 1) {
                    // Validasi apakah semua data telah diisi
                    $norp_td = (!empty($norp)) ? "" : " style='background: #E07171;'";
                    $grade_td = (!empty($grade)) ? "" : " style='background: #E07171;'";
                    $pm_td = (!empty($pm)) ? "" : " style='background: #E07171;'";
                    $dom_td = (!empty($dom)) ? "" : " style='background: #E07171;'";
                    $sc_td = (!empty($sc)) ? "" : " style='background: #E07171;'";
                    $rollpp_td = (!empty($rollpp)) ? "" : " style='background: #E07171;'";
                    $tup_td = (!empty($tup)) ? "" : " style='background: #E07171;'";
                    $tuo_td = (!empty($tuo)) ? "" : " style='background: #E07171;'";
                    $label_td = (!empty($label)) ? "" : " style='background: #E07171;'";
                    $mad_td = (!empty($mad)) ? "" : " style='background: #E07171;'";
                    $cus_td = (!empty($cus)) ? "" : " style='background: #E07171;'";
                    $mater_td = (!empty($mater)) ? "" : " style='background: #E07171;'";
                    $rem_td = (!empty($rem)) ? "" : " style='background: #E07171;'";


                    // Jika salah satu data ada yang kosong
                    if ($norp == "" or $grade == "" or $pm == "" or $dom == "" 
                        or $sc == "" or $rollpp == "" or $tup == "" or $tuo == "" or $label == "" or $mad == ""
                        or $cus == "" or $mater == "" or $rem == ""
                    
                        ) {
                        $kosong++; // Tambah 1 variabel $kosong
                      }

                        echo "<tr>";
                        echo "<td" . $norp_td . ">" . $norp . "</td>";
                        echo "<td" . $grade_td . ">" . $grade . "</td>";
                        echo "<td" . $pm_td . ">" . $pm . "</td>";
                        echo "<td" . $dom_td . ">" . $dom . "</td>";
                        echo "<td" . $sc_td . ">" . $sc . "</td>";
                        echo "<td" . $rollpp_td . ">" . $rollpp . "</td>";
                        echo "<td" . $tup_td . ">" . $tup . "</td>";
                        echo "<td" . $tuo_td . ">" . $tuo . "</td>";
                        echo "<td" . $label_td . ">" . $label . "</td>";
                        echo "<td" . $mad_td . ">" . $mad . "</td>";
                        echo "<td" . $cus_td . ">" . $cus . "</td>";
                        echo "<td" . $mater_td . ">" . $mater . "</td>";
                        echo "<td" . $rem_td . ">" . $rem . "</td>";

                        echo "</tr>";
                      }

                        $numrow++; // Tambah 1 setiap kali looping
                      }

                       

            // Cek apakah variabel kosong lebih dari 0
            // Jika lebih dari 0, berarti ada data yang masih kosong
            if ($kosong > 0) {
    ?>
                <script>
                    $(document).ready(function() {
                        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                        $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                        $("#kosong").show(); // Munculkan alert validasi kosong
                    });
                </script>
    <?php
            } else { // Jika semua data sudah diisi
                echo "<hr>";

                // Buat sebuah tombol untuk mengimport data ke database
                echo "<button type='submit' name='import'>Import</button>";
            }
            echo "</thead></table>";
            echo "</form>";
        } else { // Jika file yang diupload bukan File Excel 2007 (.xlsx)
            // Munculkan pesan validasi
            echo "<div style='color: red;margin-bottom: 10px;'>
          Hanya File Excel 2007 (.xlsx) yang diperbolehkan
                </div>";
        }
    }

     
    include 'fotterbar.php';
     
?>
