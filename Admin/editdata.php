

<?php
session_start();

if($_SESSION['password']=='')
{
    header("location:login.php");
}
include 'koneksi.php';
error_reporting(0);

$t = mysqli_query($conn, "select * from about");
$profile = mysqli_fetch_array($t);

ob_start()

?>
<?php 
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

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>






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
        <!-- End of Topbar -->
                       
    <?php
        $id_brg= ($_GET['id']);
        $ggl = !$id_brg;
            if($ggl){

                    echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5 mt-5'>";
                    echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                    echo "<p><center>Maaf Data Ini Tidak Tersedia</center></p>";
                    echo   "</div>";
                    echo "</div>";

             }else{
                    $det=mysqli_query($conn, "select * from masuk where noreservasi='$id_brg'");
                    while($d=mysqli_fetch_array($det)){
                    //$nosc= $d['sc'];
                    ?>

        <div class="row ml-5">
        <div class="col-md-10 col-sm-12 col-xs-12">
        <h2><center>Pengeditan Data</center></h2>

            
            <form name='edit' method='post'>
             <div class="row">

            <div class="col-md-1"></div> 
     
             <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>Tanggal :</b></p>
            <input class ="form-control" type="date" id="tanggal" name="tanggal">
                </div>
            
                                
            <div class="col-md-5 col-sm-12 col-xs-12">
                    <p><b>No SC :</b></p>
                <p><input class="form-control" type="text" placeholder="No SC..." required value='<?php echo $d['sc'] ?>' name='sc' required>
                
                </p>
                </div>
            </div>
                

                <div class="row">
                <div class="col-md-1"></div> 
            
            <div class="col-md-5 col-sm-12 col-xs-12">
                    <p><b>Nama Barang :</b></p>
                <p><input class="form-control" type="text" placeholder="Nama Barang..." required value='<?php echo $d['nama'] ?>' name='nama' required>
                </p>
                </div>
                

                
            <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>Jenis Barang:</b></p>
            <input class="form-control" type="text" placeholder="Jenis..." required value='<?php echo $d['jenis'] ?>' name='jenis' required>
                <option selected = "selected" ></option>
                </p>
            </select>
            </div>
            </div>
              
           

            <div class="row">
            <div class="col-md-1">

            </div>

            <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>Suplier:</b></p>
            <input class="form-control" type="text" placeholder="Suplier..." required value='<?php echo $d['suplier'] ?>' name='suplier' required>
            </div>


            <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>No Reservasi:</b></p>
            <input class="form-control" type="text" placeholder="No Reservasi..." required value='<?php echo $d['noreservasi'] ?>' name='noreservasi' required>
            </select>
            </div>

            </div>





            <div class="row">
            <div class="col-md-1">

            </div>

             <div class="col-md-5 col-sm-12 col-xs-12">
            <p><b>Jumlah Barang:</b></p>
            <input class="form-control" type="text" placeholder="Jumlah..." required value='<?php echo $d['JumlahB'] ?>' name='jumlah' required>
            </select>
            </div>

            </div>


            <div class="row mt-3">
            <div class="col-md-1">

            </div>

            <div class="col-md-10 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-primary btn-lg btn-block" name='edit'>EDIT</button>

            </form>

                </div>
                <?php

                }
                }
                ?>
                <?php
                if(isset($_POST['edit'])){
                    $noreser = htmlspecialchars($_POST['noreservasi']);
                    $tanggal = htmlspecialchars($_POST['tanggal']);
                    $sc = htmlspecialchars($_POST['sc']);
                    $nama = htmlspecialchars($_POST['nama']);
                    $jenis = htmlspecialchars($_POST['jenis']);
                    $suplier = htmlspecialchars($_POST['suplier']);  
                    $jumlah = htmlspecialchars($_POST['jumlah']);

                //_______________________
                




                $edit = mysqli_query($conn, "UPDATE masuk SET
                noreservasi ='".$noreser."',
               tanggal ='".$tanggal."',
                sc ='".$sc."',
                nama ='".$nama."',
                jenis ='".$jenis."',
                suplier ='".$suplier."',
                JumlahB ='".$jumlah."'
                WHERE noreservasi ='".$_GET['id']."'
                ");

                   if($edit){
                                  header("location: data.php");
                                }else{
                    
                    
                                                  echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                                                     echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                                                    echo "<p><center>Mengedit Data Gagal</center></p>";
                                                     echo   "</div>";
                                                     echo "</div>";
                    
                                }
                    
                                }
                            
                 ?> 












       
      
</ul>
</nav>
</div>
<?php
 include 'fotterbar.php'; 
 ?>
<!-- <?php ob_end_flush();
?> -->
