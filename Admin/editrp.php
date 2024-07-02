

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
        $det=mysqli_query($conn, "select * from rp where sc='$id_brg'");
        while($d=mysqli_fetch_array($det)){
           $nosc= $d['sc'];
        ?>

        <div class="row ml-5">
          <div class="col-md-10 col-sm-12 col-xs-12">
            <h2><center>Pengeditan Data</center></h2>

            
            <form name='edit' method='post'>
                <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>No.RP:</b></p>
                <input class="form-control" type="text" placeholder="No RP..." name='norp' required value='<?php echo $d['norp'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>GRADE :</b></p>
                <input class="form-control" type="text" placeholder="grade..." name='grade' required value='<?php echo $d['grade'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>PM :</b></p>
                <input class="form-control" type="text" placeholder="PM..." name='pm' required value='<?php echo $d['pm'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>DATE OF MAKING :</b></p>
                <input class ="form-control" type="date" id="datemaking" placeholder="dd-mm-yyyy" name="datemaking" value='<?php echo $d['datemaking'] ?>'>

                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>SC :</b></p>
                <input class="form-control" type="text" placeholder="NO SC..." name='sc' required value='<?php echo $d['sc'] ?>'>
                </div>
                </div>


                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>ROLL/PALLET :</b></p>
                <input class="form-control" type="text" placeholder="R/P..." name='rollpallet' required value='<?php echo $d['rollpallet'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>TOTAL PLANT UNIT :</b></p>
                <input class="form-control" type="text" placeholder="TPU..." name='totalplant' requiredvalue='<?php echo $d['totalplan'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>TOTAL ORDER UNIT :</b></p>
                <input class="form-control" type="text" placeholder="TOU..." name='totalorder' required value='<?php echo $d['totalorder'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>LABEL :</b></p>
                <input class="form-control" type="text" placeholder="LABEL..." name='label' required value='<?php echo $d['label'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>MAD :</b></p>
                    <input class ="form-control" type="date" id="mad" placeholder="dd-mm-yyyy" name="mad" value='<?php echo $d['mad'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>COUNTRY / CUSTOMER :</b></p>
                <input class="form-control" type="text" placeholder="CUSTOMER..." name='customer' required value='<?php echo $d['customer'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>MATERIAL :</b></p>
                <input class="form-control" type="text" placeholder="MATERIAL..." name='material' required value='<?php echo $d['material'] ?>'>
                </div>
                </div>

                <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                <p><b>REMARK :</b></p>
                <input class="form-control" type="text" placeholder="REMARK..." name='remark' required value='<?php echo $d['remark'] ?>'>
                </div>
                </div>
                <div class="row mt-3">
                <div class="col-md-1">

                </div>

                <div class="col-md-10 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary btn-lg btn-block" name='edit'>Edit</button>

                </form>

                </div>
                <?php

}
}
?>
                <?php
                if(isset($_POST['edit'])){
                $norp = htmlspecialchars($_POST['norp']);
                $grade = htmlspecialchars($_POST['grade']);
                $pm = htmlspecialchars($_POST['pm']);
                $datemaking = $_POST['datemaking'];
                $sc = htmlspecialchars($_POST['sc']);
                $rollpallet = htmlspecialchars($_POST['rollpallet']);
                $totalplant = htmlspecialchars($_POST['totalplant']);
                $totalorder = htmlspecialchars($_POST['totalorder']);
                $label = htmlspecialchars($_POST['label']);
                $mad = $_POST['mad'];
                $customer = htmlspecialchars($_POST['customer']);
                $material = htmlspecialchars($_POST['material']);
                $remark = htmlspecialchars($_POST['remark']);

                //_______________________
                




                    $edit = mysqli_query($conn, "UPDATE rp SET
                   norp ='".$norp."',
                  grade ='".$grade."',
                   pm ='".$pm."',
                   datemaking ='".$datemaking."',
                   sc ='".$sc."',
                   rollpallet='".$rollpallet."',
                   totalplan ='".$totalplant."',
                   totalorder ='".$totalorder."',
                   label ='".$label."',
                   mad ='".$mad."',
                   customer ='".$customer."',
                   material='".$material."',
                   remark ='".$remark."' WHERE sc ='".$_GET['id']."'
                   ");

                   if($edit){
                                  header("location: rp.php");
                                }else{
                    
                    
                                                  echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                                                     echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                                                    echo "<p><center>Mengedit Data Gagal</center></p>";
                                                     echo   "</div>";
                                                     echo "</div>";
                    
                                }
                    
                                }
                            
                //________________________
                    
                //     $query = mysqli_query($conn,"UPDATE rp SET`rp` (`norp`, `grade`, `pm`, `datemaking`, `sc`, `rollpallet`, `totalplan`, `totalorder`, `label`, `mad`, `customer`, `material`, `remark`)
                //     VALUES (
                //         '$norp',
                //     '$grade',
                //     '$pm',
                //     '$datemaking',
                //     '$sc',
                //     '$rollpallet',
                //     '$totalplant',
                //     '$totalorder',
                //     '$label',
                //     '$mad',
                //     '$customer',
                //     '$material',
                //     '$remark'
                //         )");
                    
                //     if($query==1)
                //     {
                //         echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                //         echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
                //         echo "<p><center>Edit Data Sukses</center></p>";
                //         echo   "</div>";
                //         echo "</div>";

                //     }else{

                //         echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                //         echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                //         echo "<p><center>Edit Data Gagal</center></p>";
                //         echo " $norp, $grade,$pm,$datemaking,$sc,$rollpallet,$totalplant,$totalorder,$label,$mad,$customer,$material,$remark";
                //         echo   "</div>";
                //         echo "</div>";

                //     }
                //     }
                    
                
                
                
                











                

// <!-- <?php

// }
// }
// 
//</div>


//           <?php

//             if(isset($_POST['edit'])){




//            $edit = mysqli_query($conn, "UPDATE masuk SET
//           nama ='".$_POST['nama']."',
//          jenis ='".$_POST['jenis']."',
//           suplier ='".$_POST['suplier']."',
//           hargaU ='".$_POST['hargaU']."',
//           hargaJ ='".$_POST['hargaJ']."',
//           JumlahB ='".$_POST['JumlahB']."'
//           WHERE id ='".$_GET['id']."'
//               ");

//             if($edit){
//               header("location: Data.php");
//             }else{


//                               echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
//                                  echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
//                                 echo "<p><center>Mengedit Data Gagal</center></p>";
//                                  echo   "</div>";
//                                  echo "</div>";

//             }

//             }



// ?> 












       
      
</ul>
</nav>
</div>
<?php
 include 'fotterbar.php'; 
 ?>
<!-- <?php ob_end_flush();
?> -->
