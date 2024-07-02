<?php

session_start();

if ($_SESSION['password'] == '') {
  header("location:login.php");
}
include 'koneksi.php';
error_reporting(0);

include 'koneksi.php';
require('library/fpdf.php');
$gg;
$gg2;
class PDF extends FPDF {
    // Page header
    function Header() {
        // Add logo to page
        $this->Image('./penampung/simas.png',10,8,10);
        
        // Set font family to Arial bold
        $this->Cell(12);
        $this->SetFont('Arial','B',10);
        $this->Cell(30,10,'UNIT RH-NCR',-1,0,'C');
        // Move to the right
        $this->SetFont('Arial','B',20);
        $this->Cell(15);
        
        // Header
        $this->Cell(100,14,'Daily Shift Report Packaging',1,0,'C');
        
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        
        // Page number
        $this->Cell(0,10,'halaman ' .
            $this->PageNo() . '/{nb}',0,0,'C');
    }
}

// Instantiation of FPDF class with landscape orientation
$pdf = new PDF('P','mm','A4');

// Define alias for number of pages
$pdf->AliasNbPages();
$pdf->AddPage();

// Define content
$pdf->SetFont('Times','B',10);
$pdf->Cell(200,10,'DATA OUTPUT PACKAGING',0,0,'C');
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;
//----------------------------------------------------------
if (isset($_POST['cari_tanggal']) && isset($_POST['cari_groupB'])) {
          
    $cari2 = mysqli_real_escape_string($conn, $_POST['cari_tanggal']);
    $cari3 = mysqli_real_escape_string($conn, $_POST['cari_groupB']);
    
    $data = mysqli_query($conn, "SELECT * FROM keluar WHERE tanggal LIKE '%$cari2%' AND groupB LIKE '%$cari3%'");
    //echo "SQL Query: " . $query;

   
    //if (mysqli_num_rows($brg) > 0) {
  //------------------------------------------
//$data = mysqli_query($conn,"SELECT * FROM keluar");
while($d = mysqli_fetch_array($data)){
    
    //$pdf->Cell(10,15,'',0,1);
    $pdf->SetFont('Times','B',8);
$pdf->Cell(6,7,'ID',1,0,'C');
$pdf->Cell(23,7,'NO DOCUMENT' ,1,0,'C');
$pdf->Cell(28,7,'TANGGAL',1,0,'C');
$pdf->Cell(20,7,'SHIFT',1,0,'C');
$pdf->Cell(11,7,'GROUP',1,0,'C');
$pdf->Cell(25,7,'NO TRACKING',1,0,'C');
$pdf->Cell(23,7,'NO MATERIAL',1,0,'C');
$pdf->Cell(43,7,'DESC MATERIAL',1,0,'C');
 $pdf->Cell(8,7,'QTY',1,1,'C');
 $pdf->SetFont('Times','B',8);
    $pdf->Cell(6,6,$d['id'],1,0);
    $pdf->Cell(23,6,$d['no_doc'],1,0);
    $pdf->Cell(28,6,$d['tanggal'],1,0);
    $pdf->Cell(20,6,$d['shift'],1,0);
    $pdf->Cell(11,6,$d['groupB'],1,0);
    $pdf->Cell(25,6,$d['tracking_id'],1,0);
    $pdf->Cell(23,6,$d['material'],1,0);
    $pdf->Cell(43,6,$d['desc_material'],1,0);
    $pdf->Cell(8,6,$d['qty'],1,1); 
    //$pdf->Cell(8,7,'QTY',1,0,'C');
    $pdf->Cell(6,7,' ',1,0,'C');
$pdf->Cell(28,7,'PE_FOAM',1,0,'C');
$pdf->Cell(20,7,'INSERTER',1,0,'C');
$pdf->Cell(30,7,'PALLET',1,0,'C');
$pdf->Cell(20,7,'ALAS',1,0,'C');
$pdf->Cell(25,7,'PROTEK ROLL',1,0,'C');
$pdf->Cell(25,7,'PLASTIK FILM',1,0,'C');
$pdf->Cell(25,7,'TALI STARP',1,1,'C');
$pdf->Cell(6,6,'',1,0);
    $pdf->Cell(28,6,$d['colorfoam'].'='.$d['pack_foam'].'M',1,0);
    //$colorfefoam = "example_colorfefoam";
    //$lenght = "example_lenght";
    $fefoam2[] = $d['colorfoam'] . ' - ' . $d['pack_foam'];
    $pdf->Cell(20,6,$d['pack_inserter'].'='.$d['qty_inserter'].'pcs',1,0);
    $inserter[]=$d['pack_inserter'] . ' - ' . $d['qty_inserter'];
    $pdf->Cell(30,6,$d['pack_pallet'].$d['jenis_pallet'].'='.$d['qty_pallet'].'set',1,0);
    $pallet[]=$d['pack_pallet'].$d['jenis_pallet'] . ' - ' . $d['qty_pallet'];
    $pdf->Cell(20,6,$d['pack_alas'].'='.$d['qty_alas'].'pcs',1,0);
    $alaspallet[]=$d['pack_alas'] . ' - ' . $d['qty_alas'];
    $pdf->Cell(25, 6, $d['qty_protektor'] . 'pcs', 1, 0);
    $totprotek[]=$d['qty_protektor'];
    $totplastik[]=$d['pack_plastik_roll'] . ' - ' . $d['pack_plastik_syspex'];
    $sum = $d['pack_plastik_roll'] + $d['pack_plastik_syspex'];    
    $pdf->Cell(25, 6, $sum . 'M', 1, 0);
    $pdf->Cell(25, 6, $d['pack_strapping'] . 'M', 1, 1);
    $tottali[]=$d['pack_strapping'];

}
//------------------------------------------------------------------
$pdf->Cell(200,10,'Total Penggunaan Packaging',0,1,'C');

//try dispay total penggunaan fefoam based color dan no tracking

//$pdf->Cell(20,10,'Var',0,1,'C');
try {
    include "calc_output_packaging.php";
    global $fefoam2;
    $pdf->Cell(40,10,'Total Penggunaan Pe foam',0,1,'C');
    displayArrayInTable($pdf, $fefoam2);
    $pdf->Cell(40,10,'Total Penggunaan Inserter',0,1,'C');
    global $insenter;
    displayArrayInTable2($pdf, $inserter);
    $pdf->Cell(40,10,'Total Penggunaan Pallet',0,1,'C');
    global $pallet;
    displayArrayInTable3($pdf, $pallet);
    $pdf->Cell(40,10,'Total Penggunaan Alas Pallet',0,1,'C');
    global $alaspallet;
    displayArrayInTable4($pdf, $alaspallet);
    $pdf->Cell(70,10,'Total Penggunaan Plastik Film MC Higspeed dan Syspex',0,1,'C');
    global $totplastik;
   displayTotalsForPlastik($pdf, $totplastik);
   $pdf->Cell(30,10,'Tali Strapping',0,1,'C');
   global $tottali;
   displayTotalForTalistrapping($pdf,$tottali);
   $pdf->Cell(30,10,'Protektor Roll',0,1,'C');
    global $totprotek;
    displayTotalForprotektor($pdf,$totprotek);

  } catch (exception $e) {
    echo "Error: " . $e->getMessage();
  }
}
//--------------------------------------------------------------
$pdf->Output();
?>
