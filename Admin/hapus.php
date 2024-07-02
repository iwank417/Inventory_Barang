<?php
include 'koneksi.php';


$delete = mysqli_query($conn, "DELETE FROM rp WHERE sc = '".$_GET['id']."'");



$query = mysqli_query($conn, "SELECT * FROM rp ORDER BY sc");
$hasil = ($query);

// nilai awal increment
$no = 1;

while ($data  = mysqli_fetch_array($hasil))
{
   // membaca id dari record yang tersisa dalam tabel
   $id = $data['sc'];

   // proses updating id dengan nilai $no
   $query2 = mysqli_query($conn, "UPDATE rp SET sc = $no WHERE sc = $id");


   // increment $no
   $no++;
}

// mengubah nilai auto increment menjadi $no terakhir ditambah 1
$query = mysqli_query($conn, "ALTER TABLE rp  AUTO_INCREMENT = $no");



 if($delete){
	header('location: rp.php');
}
else{
	echo "Gagal";
}

?>
