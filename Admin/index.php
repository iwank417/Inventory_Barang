<?php
session_start();

if($_SESSION['password']=='')
{
    header("location:login.php");
}

include 'koneksi.php';
    $nama = mysqli_query($conn, "select * from about");
    $profile = mysqli_fetch_array($nama);
include 'topbar.php'; ?>
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
        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            <a class="nav-link" href="rp.php">  
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" href="rp.php">Rencana Produksi</div>
                    
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php //echo "<b> Rp.". number_format($total['total']).",-</b>"; ?></div>
                    </div>
                    <div class="col-auto">
                    <img class="" src=" penampung/rencana.png" alt="simas"  width="50px" height="50px">
                    
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>
            

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            <a class="nav-link" href="data.php">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Input</div>
                      
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php //echo "<b> Rp.". number_format($pemasukan['hargaU']).",-</b>"; ?></div>
                    </div>
                    <div class="col-auto">
                    <img class="" src=" penampung/input.ico" alt="simas"  width="50px" height="50px">
                    
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            <a class="nav-link" href="keluar.php">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Output</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php //echo "". number_format($jumlahB['jumlah'])."&nbsp; Barang"; ?></div>
                        </div>

                      </div>
                    </div>
                    <div class="col-auto">
                    <img class="" src=" penampung/output.png" alt="simas"  width="50px" height="50px">

                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            <a class="nav-link" href="stock.php">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Stock</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php //echo "$jum"."&nbsp Produk" ?></div>
                    </div>
                    <div class="col-auto">
                    <img class="" src=" penampung/stock.jpg" alt="simas"  width="50px" height="50px">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>

          <!-- Content Row -->
          <!------------conten uppender-->

<div class="row">
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

                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
       
        <!--------------------conten hs-------------->


        
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
</div>
<!----------------------------end hs conten--------->
<!-----------------conten pmx----------->



        
<div class="col-xl-3 col-md-6 mb-4"> 
<div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
        <div class="col mr-2">
        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" ><h4>Stock Packaging </br> MC Wrapper PM 10</h4></div>        
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
    <tr><td scope="col">Inserter 950mm</td>
    <td scope="col"><?php echo $row['Inserter_950'] ?> pcs</td></tr>
    <tr><td scope="col">Inserter 1000mm</td>
    <td scope="col"><?php echo $row['Inserter_1000'] ?> pcs</td></tr>
    <tr><td scope="col">Inserter 1020mm</td>
    <td scope="col"><?php echo $row['Inserter_1020'] ?> pcs</td></tr>
    <tr><td scope="col">Inserter 1200mm</td>
    <td scope="col"><?php echo $row['Inserter_1200'] ?> pcs</td></tr>
      <tr><td scope="col">Paper Craft 1000mm</td>
      <td scope="col"><?php echo $row['craft_1000'] ?> Roll</td></tr>
      <tr><td scope="col">Paper Craft 1200mm</td>
      <td scope="col"><?php echo $row['craft_1200'] ?> Roll</td></tr>
      <tr><td scope="col">Paper Craft 1500mm</td>
      <td scope="col"><?php echo $row['craft_1500'] ?> Roll</td></tr>
      <tr><td scope="col">Paper Craft PE </br>Protektor Roll 1000mm</td>
      <td scope="col"><?php echo $row['Paper craft PE_1000'] ?> pcs</td></tr>
      <tr><td scope="col">Paper Craft PE </br>Protektor Roll 1200mm</td>
      <td scope="col"><?php echo $row['Paper craft PE_1200'] ?> pcs</td></tr>
      <tr><td scope="col">Paper Craft PE </br>Protektor Roll 2000mm</td>
      <td scope="col"><?php echo $row['Paper craft PE_2000'] ?> pcs</td></tr>
      <tr><td scope="col">Lem Double Tape</td>
      <td scope="col"><?php echo $row['double_tape'] ?> Box</td></tr>
       
  </tbody>

<?php 
}
}
 ?>


</table>
<!---------------------------------------------------->


            </div>
         </div>
      </div>
     </div>
  </div>





<!-----------end conten pmx---->
        <!------------end index------------------------------------------>
     

        </div>


          <!-- Footer -->
<?php 
include 'fotterbar.php';
 ?>