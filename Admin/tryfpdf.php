<?php 
include 'koneksi.php';
require('library/fpdf.php'); 

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
        
		$this->Cell(90,10,'Reservasi Packaging Card',1,0,'C'); 
		
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

// Instantiation of FPDF class 
$pdf=new FPDF('P','mm','A4');
$pdf = new PDF(); 

// Define alias for number of pages 
$pdf->AliasNbPages(); 
$pdf->AddPage();
//____________________ 
// intance object dan memberikan pengaturan halaman PDF 
$pdf->SetFont('Times','B',14);
$pdf->Cell(200,10,'DATA BARANG',0,0,'C');
 
$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(25,7,'NO RESERVASI',1,0,'C');
$pdf->Cell(20,7,'TANGGAL' ,1,0,'C');
$pdf->Cell(40,7,'SC',1,0,'C');
$pdf->Cell(20,7,'NAMA',1,0,'C');
$pdf->Cell(30,7,'JENIS',1,0,'C');
$pdf->Cell(25,7,'SUPPLIER',1,0,'C');
$pdf->Cell(20,7,'JUMLAH',1,0,'C');
 
 
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;

$data = mysqli_query($conn,"SELECT  * FROM masuk");
while($d = mysqli_fetch_array($data)){
  //$pdf->Cell(10,6, $no++,1,0,'C');
  $pdf->Cell(25,6, $d['noreservasi'],1,0);
  $pdf->Cell(20,6, $d['tanggal'],1,0);  
  $pdf->Cell(40,6, $d['sc'],1,0);
  $pdf->Cell(20,6, $d['nama'],1,0);
  $pdf->Cell(30,6, $d['jenis'],1,0);
  $pdf->Cell(25,6, $d['suplier'],1,0);
  $pdf->Cell(20,6, $d['JumlahB'],1,1);
}
 
$pdf->Output();
?>
