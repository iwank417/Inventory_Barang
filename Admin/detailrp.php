<?php

use PhpParser\Node\Stmt\TryCatch;

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

        }  else{
          $det=mysqli_query($conn, "select * from rp where sc='$id_brg'");
          while($d=mysqli_fetch_array($det)){
            ?>

<?php
 //$modal = $d['hargaU'] * $d['JumlahB'];
 ?>


<div class="row ml-5">
  <div class="col-md-10 col-sm-12 col-xs-12">
    <h2><center>Info Detail Produk</center></h2>
	<table class="table">



    <tr>
      <td>No RP</td>
      <td><?php echo $d['norp']; ?></td>
    </tr>

    <tr>
      <td>GRADE</td>
      <td><?php echo $d['grade']; ?></td>
    </tr>

    <tr>
      <td>DATE OF MAKE</td>
      <td><?php echo $d['datemaking']; ?></td>
    </tr>


    <tr>
      <td>NO SC</td>
      <td><?php echo $d['sc']; ?></td>
    </tr>

    <tr>
      <td>JUMLAH ROLL PER PALLET</td>
      <td><?php echo $d['rollpallet']; ?></td>
    </tr>

    <tr>
      <td>TOTAL PLAN PRODUKSI</td>
      <td><?php echo $d['totalplan']; ?></td>
    </tr>

    <tr>
      <td>TOTAL ORDER</td>
      <td><?php echo $d['totalorder']; ?></td>
    </tr>

    <tr>
      <td>LABEL PRODUKSI</td>
      <td><?php echo $d['label']; ?></td>
    </tr>

    <tr>
      <td>MAD</td>
      <td><?php echo $d['mad']; ?></td>
    </tr>

    <tr>
      <td>CUSTOMER</td>
      <td><?php echo $d['customer']; ?></td>
    </tr>

    <tr>
      <td>NO MATERIAL</td>
      <td><?php echo $d['material']; ?></td>
    </tr>

    <tr>
      <td>KETERANGAN</td>
      <td><?php echo $d['remark']; ?></td>
    </tr>
    <?php

//------------------------------call all function calc outpu packaging--------------------------
try{
  $sc=$d['sc'];
  $remark=$d['remark'];
  $label=$d['label'];
  $grade=$d['grade'];
  $rollpallet=$d['rollpallet'];
  $qty=$d['totalorder'];
  include "calc_output_packaging.php";
  global $data;
  
  //$ov=new vkdroll();
  //---------- proses 1
  $proses1=pddroll($label,$data);
  $proses1->$data['length'];
  $proses1->$data['diaroll'];
  //$data['length'] = $proses1->length;
  //$data['diaroll'] = $proses1->diaroll;
}catch(exception $e){
  echo "Error: " . $e->getMessage();
}
try{
  //include 'calc_output_packaging';
  $proses2=graderoll($grade,$data);
  $proses2->$data['grade'];
  $proses2->$data['foamprotek'];
  $proses21=ccolor($grade);
  $colorCode = $colorbp['color'];
  $proses22 = getColorFoam($colorCode);
}catch(exception $e){
  echo "Error: " . $e->getMessage();
}
//include 'calc_output_packaging';
//global $data;
if (isset($data) && isset($pallet_data) && !empty($data) && !empty($pallet_data)) {
    try{//cek pallet
      $proses3=cekpallet($data, $pallet_data);
        $proses3->$data['pallet'];
        $proses3->$data['inserter'];
        $data['CardBox_pallet']=$data['pallet'];
        $proses3_1=searchISPMHT($remark,$data);
        //$proses3_1->$data['ispmht'];
      }catch(exception $e){
        echo "Error: " . $e->getMessage();
      }
       } else {
          //Handle case where $data or $pallet_data is missing or empty
         echo "Error: Missing or empty data.";
     }
     try{
      //include 'calc_output_packaging';
      $proses4=pallet1set($data['pallet']);
      $proses5=talistrap($label,$rollpallet,$data['pallet1set'],$data);
    }catch(exception $e){
      echo "Error: " . $e->getMessage();
    }
    try{//proses 6
      //include 'calc_output_packaging';
      //global $data;
       $proses6=panjangff($remark, $data['diaroll'], $data['foamprotek'], $data['fefoamuse'],$data);
       $proses6->$data['fefoam']; 
       $proses6->$data['panjangfefoam'];
       $proses6->$data['plastikfilm'];
    }catch(exception $e){
      echo "Error: " . $e->getMessage();
    } 
    try{//proses 7
      //include 'calc_output_packaging';
    $proses7=syspex($rollpallet,$data);
    $proses7->$data['plastikfilmsyspex'];
    }catch(exception $e){
      echo "Error: " . $e->getMessage();
    }
    try{//proses8
      
    talistrap2($data['talistrapping']);
    $quantity = calculateQuantity($rollpallet, $qty);
    $standardPackageLength_m = 300; // panjang fe foam per rollpackage
    $result=calculateTotalLength($data['panjangfefoam'], $quantity, $standardPackageLength_m);
    }catch(exception $e){
      echo "Error: " . $e->getMessage();
    }


///-------------------------------------------------------------------------------
 ?>
<!------------------------ CONTEN CALCULATE USE PACKAGING ------------------->


<tr>
  <!--------------------data from calculate--------------------------->
  
  <th><td align="center"><h3>KAKULASI PENGGUNAAN PACKAGING</h3></td></th></tr>
  <tr>
      <td>Lenght Roll</td>
      <td><?php echo $data['length']; ?> Meter</td>
    </tr>
    <tr>
      <td>Keterangan Inserter</td>
      <td><?php echo $data['inserter']; ?> Cm</td>
    </tr>
    <tr>
      <td>Keterangan Pallet</td>
      <td><?php echo $data['pallet'] ,  $data['ispmht']; ?> Cm</td>
    </tr>
   <tr>
      <td>Keterangan Penggunaan Pefoam</td>
      <td><?php echo $data['fefoam']; ?>=By PPIC Remark</td>
    </tr>
    <tr>
           <td>Keterangan Grade Roll</td>
      <td><?php echo $data['grade']; ?></td>
    </tr>
    <tr>
      <td>Warna Pe Foam</td>
      <td><?php echo $proses22; ?></td>
    </tr>
    <tr>
      <td>Keterangan Panjang Pe foam Per Roll</td>
      <td><?php echo $data['panjangfefoam']/1000; ?>  Meter</td>
    </tr>
    <tr>
      <td>Total Kebutuhan Pe Foam</td>
      <td><?php echo $result['totalLength_m']; ?> Meter  (Total Pe foam Needed In Roll By Qty Order)</td>
    </tr>
    <tr>
      <td>Total Kebutuhan Pe foam packages </td>
      <td><?php echo $result['numStandardPackages']; ?> Roll Pe foam(300meter/roll)</td>
    </tr>
    <tr>
      <td>Keterangan Panjang Plastik Per Roll</td>
      <td><?php echo $data['plastikfilm']/1000; ?>  Meter</td>
    </tr>
    <tr>
      <td>keterangan Lebar Pe foam by width Roll</td>
      <td><?php echo $data['fefoamuse']; ?> Layer Pe foam Per Roll</td>
    </tr>
    <tr>
      <td>Keterangan Panjang Tali Strapping Per Pallet</td>
      <td><?php echo $data['talistrap2']/1000; ?> Meter</td>
    </tr>
    <tr>
      <td>Keterangan Panjang Plastik Film Syspex</td>
      <td><?php echo $data['plastikfilmsyspex']/1000; ?>  Meter</td>
    </tr>
    <tr>
      <td>Total Roll Quantity</td>
      <td><?php echo $quantity; ?>  Roll</td>
    </tr>
      
      <?php
    }
    }
    ?>
  <!-------------------compare table stock dan kebutuhan by qty------------------------------->
  </td>
    </tr>    
  </table>
  <!------------------------------------------------------------------------------------------>
  
  <div class="row">
<div class="col-xl-6 col-md-12 mb-8"> 
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
        <div class="col mr-2">
        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" ><h4>Kebutuhan Material <?php echo $sc; ?></h4></div>        
        <div class="h8 mb-0 font-weight-bold text-gray-800">
<!--------------------------------------------------->
<div class="table-responsive service">
  <table class="table table-bordered table-hover  ">
  <thead>
    
    <tr>
      <th scope="col">Nama Barang</th>
      <th scope="col">Jenis Packaging</th>
      <th scope="col">Jumlah Per Pcs</th>
      <th scope="col">Total=<?php echo $qty ?> pallet</th>
    </tr>

  </thead>
  
	  <tbody>
    <tr><td scope="col">MC High Speed</td></tr>
    <tr><td scope="col">Inserter</td>
    <td scope="col"><?php echo $data['inserter'] ?></td>
    <td scope="col">2 per roll</td>
    <td scope="col"><?php echo $quantity*2 ?> pcs</td>
    </tr>
      <tr><td scope="col">Pe Foam</td>
      <td scope="col"><?php echo $proses22 ?> </td>
      <td scope="col"><?php echo $data['panjangfefoam'] /1000 ?> meter per roll</td>
      <td scope="col"><?php echo $result['totalLength_m']?> meter</td>
    </tr>
      <tr><td scope="col">Plastik Film</td>
      <td scope="col">plastik film per roll</td>
      <td scope="col"><?php echo $data['plastikfilm']/1000 ?> meter</td>
      <td scope="col"><?php echo $data['plastikfilm']*$quantity/1000 ?> meter</td>
    </tr>
    <tr><td scope="col">MC Uppender</td></tr>
      <tr><td scope="col">Pallet</td>
      <td scope="col"><?php echo $data['pallet'] ,  $data['ispmht'] ?></td>
      <td scope="col">1 Set</td>
      <td scope="col"><?php echo $qty ?> Pallet</td>
      
    </tr>
      <tr><td scope="col">Alas Card Box</td>
      <td scope="col"><?php echo $data['pallet'] ?> cm</td>
      <td scope="col">2 Pcs</td>
      <td scope="col"><?php echo $qty*2 ?> Pcs</td>
    </tr>
      <tr><td scope="col">Protektor Sisi roll</td>
      <td scope="col">null</td>
      <td scope="col">null</td>
      <td scope="col">null</td>
    </tr>
      <tr><td scope="col">Plastik Syspex</td>
      <td scope="col">Per Pallet 1X1X2 Turn Set </td>
      <td scope="col"><?php echo $data['plastikfilmsyspex']/1000 ?> Meter</td>
      <td scope="col"><?php echo $data['plastikfilmsyspex']/1000*$qty ?> Meter</td>
    </tr>
      <tr><td scope="col">Tali Strapping</td>
      <td scope="col">2 X Per Pallet</td>
      <td scope="col"><?php echo $data['talistrap2']/1000 ?> Meter Per Pallet</td>
      <td scope="col"><?php echo $data['talistrap2']/1000*$qty ?> Meter</td>
    </tr>
      
    
  </tbody>

</table>
<!-----------------------------end uppender conten----------------------->
        

               
        
                  </div></div>
                </div>
              </div>
            </div>
  </div></div>
          
  
  <!-------------------------------------------------------------------------------------->
  
<div class="col-xl-3 col-md-6 mb-4"> 
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
        <div class="col mr-2">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" ><h4>Stock Packaging MC Uppender</h4></div>        
        <div class="h8 mb-0 font-weight-bold text-gray-800">
<!--------------------------------------------------->
<div class="table-responsive service">
  <table class="table table-bordered table-hover  mt-3  css-serial">
  <thead>
    
    <tr>
      <th scope="col">Nama Barang</th>
      <th scope="col">Stock</th>
      
    </tr>

  </thead>
  
	<?php
		$brg=mysqli_query($conn, "select * from stock_take ");
	

  if(mysqli_num_rows($brg)){

     while($row = mysqli_fetch_array($brg)){
     ?>
  <tbody>
    <tr><td scope="col">Pallet 71cm</td>
    <td scope="col"><?php echo $row['pallet_71'] ?> set</td></tr>
      <tr><td scope="col">Pallet 71cm(HT-DB)</td>
      <td scope="col"><?php echo $row['pallet_71ht'] ?> set</td></tr>
      <tr><td scope="col">Pallet 71cm(HT-DB-BB)</td>
      <td scope="col"><?php echo $row['pallet_71bb'] ?> set</td></tr>
      <tr><td scope="col">Pallet 74cm</td>
      <td scope="col"><?php echo $row['pallet_74'] ?> set</td></tr>
      <tr><td scope="col">Pallet 74cm(HT-DB)</td>
      <td scope="col"><?php echo $row['pallet_74ht'] ?> set</td></tr>
      <tr><td scope="col">Pallet 74cm(HT-DB-BB)</td>
      <td scope="col"><?php echo $row['pallet_74bb'] ?> set</td></tr>
      <tr><td scope="col">Pallet 76cm(HT-DB-BB)</td>
      <td scope="col"><?php echo $row['pallet_76bb'] ?> set</td></tr>
      <tr><td scope="col">Pallet 95cm</td>
      <td scope="col"><?php echo $row['pallet_95'] ?> set</td></tr>
      <tr><td scope="col">Pallet 95cm(HT-DB)</td>
      <td scope="col"><?php echo $row['pallet_95ht'] ?> set</td></tr>
      <tr><td scope="col">Pallet 98cm</td>
      <td scope="col"><?php echo $row['pallet_98'] ?> set</td></tr>
      <tr><td scope="col">Pallet 98cm(HT-DB)</td>
      <td scope="col"><?php echo $row['pallet_98ht'] ?> set</td></tr>
      <tr><td scope="col">Pallet 100cm(HT-DB)_PM X</td>
      <td scope="col"><?php echo $row['pallet_100ht'] ?> set</td></tr>
      <tr><td scope="col">Pallet 104cm</td>
      <td scope="col"><?php echo $row['pallet_104'] ?> set</td></tr>
      <tr><td scope="col">Pallet 104cm(HT-DB)</td>
      <td scope="col"><?php echo $row['pallet_104ht'] ?> set</td></tr>
      <tr><td scope="col">Pallet 107cm</td>
      <td scope="col"><?php echo $row['pallet_107'] ?> set</td></tr>
      <tr><td scope="col">Pallet 107cm(HT-DB)</td>
      <td scope="col"><?php echo $row['pallet_107ht'] ?> set</td></tr>
      <tr><td scope="col">Pallet 113cm(HT-DB)</td>
      <td scope="col"><?php echo $row['pallet_113ht'] ?> set</td></tr>
      <tr><td scope="col">Pallet Plastik</td>
      <td scope="col"><?php echo $row['pallet_plastik'] ?> set</td></tr>
      <tr><td scope="col">Alas Cardbox 71cm</td>
      <td scope="col"><?php echo $row['CardBox pallet_71'] ?> pcs</td></tr>
      <tr><td scope="col">Alas Cardbox 74cm</td>
      <td scope="col"><?php echo $row['CardBox pallet_74'] ?> pcs</td></tr>
      <tr><td scope="col">Alas Cardbox 95cm</td>
      <td scope="col"><?php echo $row['CardBox pallet_95'] ?> pcs</td></tr>
      <tr><td scope="col">Alas Cardbox 104cm</td>
      <td scope="col"><?php echo $row['CardBox pallet_104'] ?> pcs</td></tr>
      <tr><td scope="col">Alas Cardbox 110cm</td>
      <td scope="col"><?php echo $row['CardBox pallet_113'] ?> pcs</td></tr>
      <tr><td scope="col">Protektor roll CAS order</td>
      <td scope="col"><?php echo $row['CardBox pallet_protektor roll cass'] ?> pcs</td></tr>
      <tr><td scope="col">Tali Strapping</td>
      <td scope="col"><?php echo $row['tali_strapping'] ?> pcs</td></tr>
    
  </tbody>

</table>
<!-----------------------------end uppender conten----------------------->
        

               
        
                  </div></div>
                </div>
              </div>
            </div>
            </div>
</div>
       
    <!--------------------------------------------------------------------------------------->
    <div class="col-xl-3 col-md-6 mb-4"> 
<div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
        <div class="col mr-2">
        <div class="text-xs font-weight-bold text-success text-uppercase mb-1" ><h4>Stock Packaging MC High Speed</h4></div>        
        <div class="h8 mb-0 font-weight-bold text-gray-800">
<!--------------------------------------------------->
<div class="table-responsive service">
  <table class="table table-bordered table-hover  mt-3  css-serial">
  <thead>
    
    <tr>
      <th scope="col">Nama Barang</th>
      <th scope="col">Stock</th>
      
    </tr>

  </thead>
  
	<tbody>
    <tr><td scope="col">FE Foam White </br> utk MC HS & Intermediate</td>
    <td scope="col"><?php echo $row['FE_foam_white'] ?> pcs</td></tr>
      <tr><td scope="col">FE Foam Yellow</td>
      <td scope="col"><?php echo $row['FE_foam_yellow'] ?> pcs</td></tr>
      <tr><td scope="col">FE Foam Pink</td>
      <td scope="col"><?php echo $row['FE_foam_pink'] ?> pcs</td></tr>
      <tr><td scope="col">FE Foam Blue</td>
      <td scope="col"><?php echo $row['FE_foam_blue'] ?> pcs</td></tr>
      <tr><td scope="col">FE Foam Green</td>
      <td scope="col"><?php echo $row['FE_foam_green'] ?> pcs</td></tr>
      <tr><td scope="col">Inserter 650mm</td>
      <td scope="col"><?php echo $row['Inserter_650'] ?> pcs</td></tr>
      <tr><td scope="col">Inserter 700mm</td>
      <td scope="col"><?php echo $row['Inserter_700'] ?> pcs</td></tr>
      <tr><td scope="col">Inserter 865mm</td>
      <td scope="col"><?php echo $row['Inserter_865'] ?> pcs</td></tr>
      <tr><td scope="col">Inserter 900mm</td>
      <td scope="col"><?php echo $row['Inserter_900'] ?> pcs</td></tr>
      <tr><td scope="col">Inserter 950mm utk </br> MC Pmx & HS</td>
      <td scope="col"><?php echo $row['Inserter_950'] ?> pcs</td></tr>
      <tr><td scope="col">Inserter 1000mm </br>utk MC Pmx & HS</td>
      <td scope="col"><?php echo $row['Inserter_1000'] ?> pcs</td></tr>
      <tr><td scope="col">Plastik Film </br>utk MC HS,Uppender,</br>Intermediate & Pmx</td>
      <td scope="col"><?php echo $row['Sterach Film'] ?> pcs</td></tr>
   
  </tbody>

</table>
<!---------------------------------------------------->

              

            </div>
         </div>
      </div>
     </div>
  </div>
</div>
         
      
     

<?php } }?>
<!----------------------------end hs conten--------->

       
      
      
      
      
   
      
<!--------------------------------------------------------------------------->
</div></div>
</div>  </div>
<div class="row">
<div class="col-md-9">

</div>
<div class="col-md-3">
<a href="rp.php"><button type="button" class="btn btn-info">Kembali Lagi</button></a>
</div>






</div>
</div>


      <!-- End of Content Wrapper -->
      <?php 
include 'fotterbar.php';
 ?>