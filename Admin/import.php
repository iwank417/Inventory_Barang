<?php

// Load file koneksi.php
include "koneksi.php";

// Load file autoload.php
require 'vendor/autoload.php';
session_start();

if($_SESSION['password']=='')
{
    header("location:login.php");
}
include 'koneksi.php';
error_reporting(0);

 //Include library vendor\phpoffice
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
  $nama_file_baru = $_POST['namafile'];
    $path = 'tmp/' . $nama_file_baru; // Set tempat menyimpan file tersebut dimana
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
    $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

  $numrow = 1;
  foreach($sheet as $row){
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
     if($norp == "" && $grade == "" && $pm == "" && $dom == "" && $sc == "" && $rollpp=="" && $tup=="" && $tuo=="" && $label=="" && $mad=="" && $cus=="" && $mater=="" && $rem=="" )
        
      continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

    // Cek $numrow apakah lebih dari 1
    // Artinya karena baris pertama adalah nama-nama kolom
    // Jadi dilewat saja, tidak usah diimport
    if($numrow > 1){

        // $query = "INSERT INTO `rp` (`norp`, `grade`, `pm`, `datemaking`, `sc`, `rollpallet`, `totalplan`, `totalorder`, `label`, `mad`, `customer`, `material`, `remark`)
        // VALUES (
        // '$norp',
        // '$grade',
        // '$pm',
        // '$dom',
        // '$sc',
        // '$rollpp',
        // '$tup',
        // '$tuo',
        // '$label',
        // '$mad',
        // '$cus',
        // '$mater',
        // '$rem'
        //   )";
    
    // if($query==1)
    // {
    //     echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
    //     echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
    //     echo "<p><center>Menambakan Data Sukses</center></p>";
    //     echo   "</div>";
    //     echo "</div>";

    //   }else{

    //     echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
    //        echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
    //       echo "<p><center>Menambakan Data Gagal</center></p>";
    //       //echo " $norp, $grade,$pm,$datemaking,$sc,$rollpallet,$totalplant,$totalorder,$label,$mad,$customer,$material,$remark";
    //        echo   "</div>";
    //        echo "</div>";

    //   }


      // Buat query Insert
     $query ="INSERT INTO rp VALUES('" . $norp . "','" . $grade . "','" . $pm . "','" . $dom . "','" . $sc . "','" . $rollpp . "','" . $tup . "','" . $tuo . "','" . $label . "','" . $mad . "','" . $cus . "','" . $mater . "','" . $rem . "')";

      // Eksekusi $query
      mysqli_query($conn, $query);
      echo "sukses";
    }
    else{
        echo "$rem";
        echo "gagal";
    }
    $numrow++; // Tambah 1 setiap kali looping
  }

    unlink($path); // Hapus file excel yg telah diupload, ini agar tidak terjadi penumpukan file

}

header('location: rp.php'); // Redirect ke halaman awal