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
  <!-- Load File jquery.min.js yang ada difolder js -->
  <script src="js/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Sembunyikan alert validasi kosong
        $("#kosong").hide();
    });
</script>
  
    <h3>Form Import Data Hasil Produksi</h3>
    


    <form method="post" action="formkeluar.php" enctype="multipart/form-data">
    <div class="col-md-5 col-sm-12 col-xs-12">
    <div class="col-md-2 mb-3">
  <a href="Format3.xlsx" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download contoh Spreeadsheet </a>
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
            echo "<form method='post' action='import_data_keluar.php'>";

            // Disini kita buat input type hidden yg isinya adalah nama file excel yg diupload
            // ini tujuannya agar ketika import, kita memilih file yang tepat (sesuai yg diupload)
            echo "<input type='hidden' name='namafile' value='" . $nama_file_baru . "'>";

            // Buat sebuah div untuk alert validasi kosong
            echo "<div id='kosong' style='color: red;margin-bottom: 10px;'>
          Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi. 
          
                </div>";
//echo"$no_doc";
            echo "<div class='col-md-12 col-sm-12 col-xs-12  mt-5'>
            <div class='table-responsive service'>
            <table class='table table-bordered table-hover  mt-3 text-nowrap css-serial'>
            <thead>
          <tr>
            <th colspan='5' class='text-center'>Preview Data</th>
          </tr>
          <tr>
            <th>Document No</th>
            <th>Material Slip</th>
            <th>Petugas </th>
            <th>SLOC</th>
            <th>MVT</th>
            <th>REASON</th>
            <th>TRACKING ID</th>
            <th>MATERIALl</th>
            <th>DESCRIPTION MATERIAL</th>
            <th>BATCH</th>
            <th>QTY</th>
            <th>Weight Net</th>
            <th>Weight Gross</th>
            <th>UEO</th>
            <th>BIN</th>
          </tr>";

            $numrow = 1;
            $kosong = 0;
            foreach ($sheet as $row) { // Lakukan perulangan dari data yang ada di excel
                // Ambil data pada excel sesuai Kolom
                //echo $row['A'];
                $no_doc = $row['A']; 
                $mat_slip = $row['B'];
                $shift = $row['C']; 
                $sloc = $row['D'];
                $mvt = $row['E']; 
                $reason =$row['F'];
                $tracking_id =$row['G'];
                $material =$row['H'];
                $desc_material =$row['I'];
                $batch =$row['J'];
                $qty =$row['K'];
                $w_net=$row['L'];
                $w_gross =$row['M'];
                $uoe =$row['N'];
                $bin =$row['O'];

                // Cek jika semua data tidak diisi
                if ($no_doc == "" && $mat_slip == "" && $shift == "" && $sloc == "" && $mvt == "" && 
                $reason =="" && $tracking_id =="" && $material =="" && $desc_material =="" && $batch =="" && $qty =="" && $w_net=="" && $w_gross =="" && $uoe =="" && $bin =="" )
                    continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if ($numrow > 1) { 
                    // Validasi apakah semua data telah diisi
                    $no_doc_td = (!empty($no_doc)) ? "" : " style='background: #E07171;'";
                    $mat_slip_td = (!empty($mat_slip)) ? "" : " style='background: #E07171;'";
                    $shift_td = (!empty($shift)) ? "" : " style='background: #E07171;'";
                    $sloc_td = (!empty($sloc)) ? "" : " style='background: #E07171;'";
                    $mvt_td = (!empty($mvt)) ? "" : " style='background: #E07171;'";
                    $reason_td = (!empty($reason)) ? "" : " style='background: #E07171;'";
                    $tracking_id_td = (!empty($tracking_id)) ? "" : " style='background: #E07171;'";
                    $material_td = (!empty($material)) ? "" : " style='background: #E07171;'";
                    $desc_material_td = (!empty($desc_material)) ? "" : " style='background: #E07171;'";
                    $batch_td = (!empty($batch)) ? "" : " style='background: #E07171;'";
                    $qty_td = (!empty($qty)) ? "" : " style='background: #E07171;'";
                    $w_net_td = (!empty($w_net)) ? "" : " style='background: #E07171;'";
                    $w_gross_td = (!empty($w_gross)) ? "" : " style='background: #E07171;'";
                    $uoe_td = (!empty($uoe)) ? "" : " style='background: #E07171;'";
                    $bin_td = (!empty($bin)) ? "" : " style='background: #E07171;'";

                    // Jika salah satu data ada yang kosong
                    if ($no_doc == "" or $mat_slip == "" or $shift == "" or $sloc == "" 
                        or $mvt == "" or $reason == "" or $tracking_id == "" or $material == "" or $desc_material == "" or $batch == ""
                        or $qty == "" or $w_net == "" or $w_gross == ""
                        or $uoe == "" or $bin == ""){
                        $kosong++; // Tambah 1 variabel $kosong
                        }

                        echo "<tr>";
                        echo "<td" . $no_doc_td . ">" . $no_doc . "</td>";
                        echo "<td" . $mat_slip_td . ">" . $mat_slip . "</td>";
                        echo "<td" . $shift_td . ">" . $shift . "</td>";
                        echo "<td" . $sloc_td . ">" . $sloc . "</td>";
                        echo "<td" . $mvt_td . ">" . $mvt . "</td>";
                        echo "<td" . $reason_td . ">" . $reason . "</td>";
                        echo "<td" . $tracking_id_td . ">" . $tracking_id . "</td>";
                        echo "<td" . $material_td . ">" . $material . "</td>";
                        echo "<td" . $desc_material_td . ">" . $desc_material . "</td>";
                        echo "<td" . $batch_td . ">" . $batch . "</td>";
                        echo "<td" . $qty_td . ">" . $qty . "</td>";
                        echo "<td" . $w_net_td . ">" . $w_net . "</td>";
                        echo "<td" . $w_gross_td . ">" . $w_gross . "</td>";
                        echo "<td" . $uoe_td . ">" . $uoe . "</td>";
                        echo "<td" . $bin_td . ">" . $bin . "</td>";

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
