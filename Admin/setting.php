
<?php
session_start();

if($_SESSION['password']=='')
{
    header("location:login.php");
}
  include 'koneksi.php';
  error_reporting(0);

  $nama = mysqli_query($conn, "select * from about");
  $profile = mysqli_fetch_array($nama);
//ob_start();

include "topbar.php";
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

            $t = mysqli_query($conn, "select * from about");
            $d= mysqli_fetch_array($t);
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
    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $d['nama'] ?></span>
    <img class="img-profile rounded-circle" src=" penampung/<?php echo $d['foto'] ?>" alt="Profile"  width="100px" height="100px">
  </a>
  <!-- Dropdown - User Information -->
  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <a class="dropdown-item" href="profile.php">
      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
      Profile
    </a>
    <a class="dropdown-item" href="setting.php?id=<?php echo $d['id']; ?>">
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
        <?php
        $id= ($_GET['id']);

          $tak = !$id;
          if($tak){

              echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5 mt-5'>";
                 echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                echo "<p><center>Maaf Data Ini Tidak Tersedia</center></p>";
                 echo   "</div>";
                 echo "</div>";

          }else{
          $det=mysqli_query($conn, "select * from about where id='$id'");
          $d=mysqli_fetch_array($det);

      ?>

        <div class="card shadow  ml-4 mr-4">
        <div class="card-header py-3">
        <h1 class="h3 mb-0 text-gray-800">Setting</h1>
        </div>

<form method="post" name="edit" enctype="multipart/form-data" required>
<div class="row ml-5 mb-2 mt-3">


<div class="col-md-4">
<P><b>Ganti Nama</b></p>
<input class="form-control" type="text"  value="<?php echo $d['nama'];?>" placeholder="Ganti Nama..." name="name" required>

<P><b>Ganti Foto Profile</b></p>
<input class="form-control" type="file"  value="<?php echo $d['foto'];?>"  name="pict" accept="image/jpeg, image/png, image/svg"  required>

</div>
</div>

<div class="row ml-5 mb-2 mt-3">

<div class="col-md-5">
<button type="submit" class="btn btn-info" name='edit'>Update</button>&nbsp;<input type="reset" class="btn btn-danger"  value="Reset">
</div>

</div>
</form>
</div>
<?php } ?>


 <?php
$id_brg= $_GET['id'];

 if(isset($_POST['edit'])){
	 $nama = $_POST['name'];
	 $nama_file = $_FILES['pict']['name'];
   $ukuran_file = $_FILES['pict']['size'];
	 $source = $_FILES['pict']['tmp_name'];
	 $folder = './penampung/';
   $boleh_eks = array('png', 'jpg', 'svg');
   $x = explode('.', $nama_file);
   $ekstensi = strtolower(end($x));

if(in_array($ekstensi, $boleh_eks) === true){

if($ukuran_file < 3044070){

  	 move_uploaded_file($source,$folder.$nama_file);

  	 $insert = mysqli_query($conn, "UPDATE about SET
     foto = '$nama_file',
  	 nama = '$nama'
     WHERE id = '$id_brg'
  	   ");

if($insert){

  echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5 mt-5'>";
     echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
    echo "<p><center>Update Profile Sukses</center></p>";
     echo   "</div>";
     echo "</div>";


}else{
  echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5 mt-5'>";
     echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
    echo "<p><center>Update Profile Gagal</center></p>";
     echo   "</div>";
     echo "</div>";

}



}else{

  echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5 mt-5'>";
     echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
    echo "<p><center>Ukuran File Terlalu Besar</center></p>";
     echo   "</div>";
     echo "</div>";


}


}else{
  echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5 mt-5'>";
     echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
    echo "<p><center>Hanya Boleh File Type Gambar Saja</center></p>";
     echo   "</div>";
     echo "</div>";

}




 }

 ?>

 
 </div>

 <!-- Footer -->
 <footer class="sticky-footer bg-white">
   <div class="container my-auto">
     <div class="copyright text-center my-auto">
       <span><p class="mb-1">Copyright &copy; <a href="https://github.com/Faiznurullah" style="text-decoration: none;"><b>Faiz Nurullah</b></a></p></span><br>
     </div>
   </div>
 </footer>
 </div>
 <!-- End of Content Wrapper -->

 
        <?php 
        include "fotterbar.php";
        ob_end_flush() ?>
