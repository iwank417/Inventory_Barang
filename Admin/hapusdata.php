<?php
include 'koneksi.php';


$delete = mysqli_query($conn, "DELETE FROM masuk WHERE noreservasi = '".$_GET['id']."'");



// $query = mysqli_query($conn, "SELECT * FROM masuk ORDER BY noreservasi");
// $hasil = ($query);

// // nilai awal increment
// $no = 1;

// while ($data  = mysqli_fetch_array($hasil))
// {
//    // membaca id dari record yang tersisa dalam tabel
//    $id = $data['noreservasi'];

//    // proses updating id dengan nilai $no
//    $query2 = mysqli_query($conn, "UPDATE masuk SET noreservasi = $no WHERE noreservasi = $id");


//    // increment $no
//    $no++;
// }

// // mengubah nilai auto increment menjadi $no terakhir ditambah 1
// $query = mysqli_query($conn, "ALTER TABLE masuk  AUTO_INCREMENT = $no");



 if($delete){
	header('location: data.php');
}
else{
	echo "Gagal";
}

?>
