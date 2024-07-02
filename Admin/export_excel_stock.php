<?php
session_start();

if($_SESSION['password']=='')
{
    header("location:login.php");
}

include 'koneksi.php';
ob_start()

 ?>


 <!doctype html>
 <html lang="en">
   <head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

</head>


 <table width="1000px" border="1">
   <thead>
     <tr>

             <th scope="col">No</th>
              <th scope="col">No Reservasi</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Nama</th>
              <th scope="col">jenis</th>
              <th scope="col">Jumlah Barang</th>
              




     </tr>

   </thead>

   <?php

   


   $cek=mysqli_query($conn, "select * from stock");

   while($isi=mysqli_fetch_array($cek)){
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


       </tbody>
       <?php }  ?>
 </table>


 <?php
 header("Content-type: application/vnd.ms-excel");
 header("Content-Disposition: attachment; filename= Data_UpdateStock_RH.xls");
 ?>



     <!--ini akhir content bosq-->

         <!-- Optional JavaScript -->
         <!-- Popper.js first, then Bootstrap JS -->
         <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
       </body>
     </html>
