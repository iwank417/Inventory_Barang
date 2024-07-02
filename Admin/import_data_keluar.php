<?php

// Load file koneksi.php
include "koneksi.php";

// Load file autoload.php
require 'vendor/autoload.php';
session_start();

if($_SESSION['password']=='')
{
    header("location:login.php");
}
include 'koneksi.php';
error_reporting(0);

 //Include library vendor\phpoffice
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
  $nama_file_baru = $_POST['namafile'];
    $path = 'tmp/' . $nama_file_baru; // Set tempat menyimpan file tersebut dimana
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
    $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    //-------------------------------------------
    
     
    
    include 'koneksi.php';
    //<!-----------------fungsi kalkulasi packaging---------->
    
    // fungsi cek data di table rp / output packaging
    // function cekpackaging($s){
    //   include 'koneksi.php';
    //   $det=mysqli_query($conn, "select * from rp where sc='$s'");
    //   while($t=mysqli_fetch_array($det)){
    //       $sc=$t['sc'];
    //       $label=$t['label'];
    //       $remark=$t['remark'];
    //       $grade=$t['grade'];
    //       $pm=$t['pm'];
    //       $rollpallet=$t['rollpallet'];
    //       $totalplan=$t['totalplan'];
    //       $totalorder=$t['totalorder'];
    //   }
    // }
    // global variable ---
    class vkdroll{
        public static $lr; //lenght roll
        public static $dr; //diameter roll
        public static $graderoll; //grade roll
        public static $foamprotek;  //jumlah proteksi foam ke roll
        
        public static $pallet; //cek penggunaan pallet
        public static $inserter; //cek penggunaan protek sisi roll /inserter
        
    }
    $vkd=[
      'lenghtroll'=>null,
      'diaroll'=>null,
      'graderoll'=>null,
      'foamprotek'=>null,
      'pallet'=>null,
      'inserter'=>null
    ];
    
    global $data;
    $data = [
      
      //output proses1
      'length' => null,  // Replace with actual length value
      'grade' => null,   // Replace with actual grade value
      //output proses2
      'diaroll'=>null,
      'foamprotek'=>null,
      //output proses3
      'pallet'=>null,
      'inserter'=>null,
      'CardBox pallet'=>null,
      //output proses4
      'pallet1set'=>null,
      //output proses5
      'talistrapping'=>null, //panjang tali strapping
      'widhtroll'=>null,  //lebar roll
      'fefoamuse'=>null,
      'tallroll'=>null,
      //output proses6
      'plastikfilm'=>null,
      'fefoam'=>null, //cek penggunaan fe foam by rp
      'panjangfefoam'=>null,
      //output proses7
      'plastikfilmsyspex'=>null,
      //output proses8
      'talistrap2'=>null,
      'ispmht'=>null
    ];
    $pallet_data = array( // data inserter dan pallet
      "4000-cb" => array("inserter" => 700, "pallet" => 74),
      "6000-cb" => array("inserter" => 700, "pallet" => 74),
      "10500-cb" => array("inserter" => 900, "pallet" => 98),
      "11950-cb" => array("inserter" => 950, "pallet" => 107),
      "12000-cb" => array("inserter" => 950, "pallet" => 107),
      "15000-cb" => array("inserter" => 1020, "pallet" => 1113),
      "4000-cf" => array("inserter" => 650, "pallet" => 71),
      "6000-cf" => array("inserter" => 650, "pallet" => 71),
      "10500-cf" => array("inserter" => 865, "pallet" => 95),
      "11950-cf" => array("inserter" => 900, "pallet" => 104),
      "12000-cf" => array("inserter" => 900, "pallet" => 104),
      "15000-cf" => array("inserter" => 950, "pallet" => 1113),
      "6000-cfb" => array("inserter" => 650, "pallet" => 71),
      "10500-cfb" => array("inserter" => 865, "pallet" => 95),
      "11950-cfb" => array("inserter" => 900, "pallet" => 104),
      "12000-cfb" => array("inserter" => 900, "pallet" => 104),
      "15000-cfb" => array("inserter" => 950, "pallet" => 1113)
      
    );
    
    //-----------------------
    //-----------fungsi  calc packaging--------------
    //fungsi cek panjang keliling roll dan diameter roll---
    function pddroll($c,$data) {
          //$c=parameter
          //ov->lr & ov->dr = public value dari lenghtroll & diameter di class vkdroll
        global $data;
        if (stristr($c,'4000')==true){
             $data['length'] ="4000";
             $data['diaroll'] ='700';
          }else if(stristr($c,'6000')==true){
            $data['length'] = "6000";
            $data['diaroll']='730';
        }else if(stristr($c,'10500')==true){
          $data['length']='10500';
          $data['diaroll']='940';
          }else if(stristr($c,'11950')==true){
            $data['length']='11950';
            $data['diaroll']='1030';
          }else if(stristr($c,'12000')==true){
            $data['length']='12000';
            $data['diaroll']='1030';
          }else if(stristr($c,'15000')==true){
            $data['length']='15000';
            $data['diaroll']='1120';
          }else if(stristr($c,'18000')==true){
            $data['length']='18000';
            $data['diaroll']='17900';
          }
        return $data;
        
        
    }
    //--------------------------------
    //--fungsi cek grade roll--
    function graderoll($f,$data) {
        //$f = parameter
                                             //graderoll
         global $data;                       //foamprotec
        if (stristr($f,'cfb')==true){
            $data['grade']='cfb';
            $data['foamprotek']='2';
          }
          else if(stristr($f,'cf')==true){
            $data['grade']='cf';
            $data['foamprotek']='1';
         }
         else if (stristr($f,'cb')==true){
          $data['grade']='cb';
          $data['foamprotek']='1';
         }
         return $data;
    }
    //------------------------
    //---fungsi cek penggunaa pallet dan inserter
    
    function cekpallet($data, $pallet_data) {  // Pass $pallet_data as an argument
      global $data;
      
      $key = $data['length'] . '-' . $data['grade'];
    
      if (array_key_exists($key, $pallet_data)) {
          
          $data['inserter'] = $pallet_data[$key]['inserter'];
          $data['pallet'] = $pallet_data[$key]['pallet'];
          return $data;
      } else {
           //Throw an exception for a clearer indication of a non-matching scenario
          throw new Exception("No matching pallet data found for length {$data['length']} and grade {$data['grade']}");
      }
    }
    //------calc tali 1 set pallet--
    function pallet1set($a){//$a parameter $pallet dari data['pallet']
      global $data;
      $a=$data['pallet1set']=10+ $a *2;
      return $data['pallet1set'];
    }
    
    //-----------------------------
    //// fungsi cek panjang tali strapping -----
    function talistrap($label,$rollpallet,$pallet1set,$data){ //$gemini parameter label roll dari db rp 
      global $data; // Assuming $data is a global array
      $pallet1set=$data['pallet1set'];         //$nan nilai return fungsi pallet1set
    
      if (stristr($label,'210')==true){
        $data['fefoamuse'] ='1';
        $data['talistrapping']= 210*$rollpallet+$pallet1set;
        $data['tallroll']=210*$rollpallet;
      }else if(stristr($label,'229')==true){
        $data['fefoamuse'] ='1';
        $data['talistrapping']= 229*$rollpallet+$pallet1set;
        $data['tallroll']=229*$rollpallet;
      }else if(stristr($label,'241')==true){
        $data['fefoamuse'] ='1';
        $data['talistrapping']= 241*$rollpallet+$pallet1set;
        $data['tallroll']=241*$rollpallet;
      }else if(stristr($label,'250')==true){
        $data['fefoamuse'] ='1';
        $data['talistrapping']= 250*$rollpallet+$pallet1set;
        $data['tallroll']=250*$rollpallet;
      }else if(stristr($label,'260')==true){
        $data['fefoamuse'] ='1';
        $data['talistrapping']= 260*$rollpallet+$pallet1set;
        $data['tallroll']=260*$rollpallet;
      }else if(stristr($label,'279')==true){
        $data['fefoamuse'] ='1';
        $data['talistrapping']= 279*$rollpallet+$pallet1set;
        $data['tallroll']=279*$rollpallet;
      }else if(stristr($label,'300')==true){
        $data['fefoamuse'] ='1';
        $data['talistrapping']= 300*$rollpallet+$pallet1set;
        $data['tallroll']=300*$rollpallet;
      }else if(stristr($label,'305')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 305*$rollpallet+$pallet1set;
        $data['tallroll']=305*$rollpallet;
      }else if(stristr($label,'320')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 320*$rollpallet+$pallet1set;
        $data['tallroll']=320*$rollpallet;
      }else if(stristr($label,'330')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 330*$rollpallet+$pallet1set;
        $data['tallroll']=330*$rollpallet;
      }else if(stristr($label,'340')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 340*$rollpallet+$pallet1set;
        $data['tallroll']=340*$rollpallet;
      }else if(stristr($label,'345')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 345*$rollpallet+$pallet1set;
        $data['tallroll']=345*$rollpallet;
      }else if(stristr($label,'360')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 360*$rollpallet+$pallet1set;
        $data['tallroll']=360*$rollpallet;
      }else if(stristr($label,'370')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 370*$rollpallet+$pallet1set;
        $data['tallroll']=370*$rollpallet;
      }else if(stristr($label,'380')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 380*$rollpallet+$pallet1set;
        $data['tallroll']=380*$rollpallet;
      }else if(stristr($label,'389')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 389*$rollpallet+$pallet1set;
        $data['tallroll']=389*$rollpallet;
      }else if(stristr($label,'400')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 400*$rollpallet+$pallet1set;
        $data['tallroll']=400*$rollpallet;
      }else if(stristr($label,'420')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 420*$rollpallet+$pallet1set;
        $data['tallroll']=420*$rollpallet;
      }else if(stristr($label,'430')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 430*$rollpallet+$pallet1set;
        $data['tallroll']=430*$rollpallet;
      }else if(stristr($label,'440')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 440*$rollpallet+$pallet1set;
        $data['tallroll']=440*$rollpallet;
      }else if(stristr($label,'458')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 458*$rollpallet+$pallet1set;
        $data['tallroll']=458*$rollpallet;
      }else if(stristr($label,'460')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 460*$rollpallet+$pallet1set;
        $data['tallroll']=460*$rollpallet;
      }else if(stristr($label,'470')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 470*$rollpallet+$pallet1set;
        $data['tallroll']=470*$rollpallet;
      }else if(stristr($label,'480')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 480*$rollpallet+$pallet1set;
        $data['tallroll']=480*$rollpallet;
      }else if(stristr($label,'498')==true){
        $data['fefoamuse'] ='2';
        $data['talistrapping']= 498*$rollpallet+$pallet1set;
        $data['tallroll']=498*$rollpallet;
      }else if(stristr($label,'500')==true){
        $data['fefoamuse'] ='3';
        $data['talistrapping']= 500*$rollpallet+$pallet1set;
        $data['tallroll']=500*$rollpallet;
      }else if(stristr($label,'520')==true){
        $data['fefoamuse'] ='3';
        $data['talistrapping']= 520*$rollpallet+$pallet1set;
        $data['tallroll']=520*$rollpallet;
      }else if(stristr($label,'540')==true){
        $data['fefoamuse'] ='3';
        $data['talistrapping']= 540*$rollpallet+$pallet1set;
        $data['tallroll']=540*$rollpallet;
      }else if(stristr($label,'560')==true){
        $data['fefoamuse'] ='3';
        $data['talistrapping']= 560*$rollpallet+$pallet1set;
        $data['tallroll']=560*$rollpallet;
      }else if(stristr($label,'570')==true){
        $data['fefoamuse'] ='3';
        $data['talistrapping']= 570*$rollpallet+$pallet1set;
        $data['tallroll']=570*$rollpallet;
      }else if(stristr($label,'678')==true){
        $data['fefoamuse'] ='4';
        $data['talistrapping']= 678*$rollpallet+$pallet1set;
        $data['tallroll']=678*$rollpallet;
      }else if(stristr($label,'720')==true){
        $data['fefoamuse'] ='4';
        $data['talistrapping']= 720*$rollpallet+$pallet1set;
        $data['tallroll']=720*$rollpallet;
      }else if(stristr($label,'740')==true){
        $data['fefoamuse'] ='4';
        $data['talistrapping']= 740*$rollpallet+$pallet1set;
        $data['tallroll']=740*$rollpallet;
      }else if(stristr($label,'750')==true){
        $data['fefoamuse'] ='4';
        $data['talistrapping']= 750*$rollpallet+$pallet1set;
        $data['tallroll']=750*$rollpallet;
      }else if(stristr($label,'770')==true){
        $data['fefoamuse'] ='4';
        $data['talistrapping']= 770*$rollpallet+$pallet1set;
        $data['tallroll']=770*$rollpallet;
      }else if(stristr($label,'810')==true){
        $data['fefoamuse'] ='4';
        $data['talistrapping']= 810*$rollpallet+$pallet1set;
        $data['tallroll']=810*$rollpallet;
      }else if(stristr($label,'820')==true){
        $data['fefoamuse'] ='4';
        $data['talistrapping']= 820*$rollpallet+$pallet1set;
        $data['tallroll']=820*$rollpallet;
      }else if(stristr($label,'800')==true){
        $data['fefoamuse'] ='4';
        $data['talistrapping']= 800*$rollpallet+$pallet1set;
        $data['tallroll']=800*$rollpallet;
      }else if(stristr($label,'900')==true){
        $data['fefoamuse'] ='5';
        $data['talistrapping']= 900*$rollpallet+$pallet1set;
        $data['tallroll']=900*$rollpallet;
      }else if(stristr($label,'920')==true){
        $data['fefoamuse'] ='5';
        $data['talistrapping']= 920*$rollpallet+$pallet1set;
        $data['tallroll']=920*$rollpallet;
      }else if(stristr($label,'940')==true){
        $data['fefoamuse'] ='5';
        $data['talistrapping']= 940*$rollpallet+$pallet1set;
        $data['tallroll']=940*$rollpallet;
      }else if(stristr($label,'990')==true){
        $data['fefoamuse'] ='5';
        $data['talistrapping']= 990*$rollpallet+$pallet1set;
        $data['tallroll']=990*$rollpallet;
      }else if(stristr($label,'1000')==true){
        $data['fefoamuse'] ='5';
        $data['talistrapping']= 1000*$rollpallet+$pallet1set;
        $data['tallroll']=1000*$rollpallet;
      }
      return $data;
    
    }
    //----fungsi derement stock
    
    function updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue) {
      include 'koneksi.php';
    
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    
      // Build the SQL query
      $sql = "UPDATE $tableName SET `$decrementColumn` = `$decrementColumn` - $decrementValue WHERE $idColumnName = '$id'";
    
      // Execute the query
      if ($conn->query($sql) === TRUE) {
          //echo "Record updated successfully";
          //echo "$decrementColumn` = `$decrementColumn` - $decrementValue ";
      } else {
          echo "Error updating record: " . $conn->error;
          
          
      }
     // $conn->close();
      $tableName = null;
      $idColumnName = null;
      $id = null;
      $decrementColumn = null;
      $decrementValue = null;
      // Close the connection
      
      //return $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
    }
    
    //---------------------------
    
    function palletjen($pallet, $ispmht) {
      $palletPrefix = "pallet_" . $pallet;
      if (strtolower($ispmht) === "ispmht") {
          return $palletPrefix . "ht";
      } else {
          return $palletPrefix;
      }
    }
    //-----------------------------------------------
    function alaspallet($pallet) {
      switch ($pallet) {
          case 71:
              return "CardBox pallet_71";
          case 74:return "CardBox pallet_74";
          case 76:return "CardBox pallet_74";
          case 95:return "CardBox pallet_95";
          case 98:return "CardBox pallet_95";
          case 104:return "CardBox pallet_104";
          case 107:return "CardBox pallet_104";
              
          case 113:
              return "CardBox pallet_113";
          default:
          return "CardBox pallet_113";
      }
    }
    //-------------------------------------
    function pefoamccc($ccc) {
      $cce = strtolower($ccc);
      switch ($cce) {
          case "white":
              return "FE_foam_white";
          case "blue":return "FE_foam_blue";
          case "yellow":return "FE_foam_yellow";
          case "pink":return "FE_foam_pink";
          case "green":return "FE_foam_green";
          
          default:
          return "FE_foam_white";
      }
    }
    
    // Example usage:
    // $pallet = 71;
    // $alas = alaspallet($pallet);
    // echo $alas; // Output: CardBox pallet_71
    
    //----------------------------------------------
    // $data['pallet'] = 71;
    // $data['ispmht'] = "ISPMHT"; // or "ispmht"
    
    // $itenari = palletjen($data['pallet'], $data['ispmht']);
    // echo $itenari; // Output: pallet_71ht
    
    //-----------------------------------------
    //-----// fungsi cek panjang film,foam,dan panjang foam
     //cek penggunaan fe foam by lenght dan grade
    //   function panjangff($remark,$diaroll,$foamprotek,$fefoamuse){
    //     function calculatePanjangFF($remark, $diaroll, $foamprotek, $fefoamuse,$data) {
    //       global $data;
          
    //       $data['fefoam'] = (stripos($remark, 'pe foam') !== false) ? 'true' : 'false';
          
    //       if ($data['fefoam'] === 'true') {
    //           $data['panjangfefoam'] = ($diaroll * 3.14) + 500;
    //           $data['panjangfefoam'] *= $foamprotek * $fefoamuse;
    //       } else {
    //           $data['panjangfefoam'] = 0;
    //       }
          
    //       $data['plastikfilm'] = $data['panjangfefoam'] * 2;
          
    //       return $data;
    //   }
      
    //           }
            function panjangff($remark, $diaroll, $foamprotek, $fefoamuse, $data) {
              global $data;
              if (stristr($remark, 'pe foam') !== false || stristr($remark, 'PE Foam') !== false || stristr($remark, 'PE FOAM') !== false || stristr($remark, 'pe Foam') !== false) {
                  $data['fefoam'] = 'true';
                  $data['panjangfefoam'] = ($diaroll * 3.14) + 500;
                  $data['panjangfefoam'] *= $foamprotek * $fefoamuse;
                  //$data['panjangfefoam'] = $data['panjangfefoam'] * $foamprotek * $fefoamuse;
                  //$data['plastikfilm'] = $data['panjangfefoam'] * 2;
              } else {
                  $data['fefoam'] = 'false';
                  $data['panjangfefoam'] = 0;
                  //$data['plastikfilm'] = $data['panjangfefoam'] * 2;
              }
              $data['plastikfilm'] = $data['panjangfefoam'] * 2;
              return $data;
          }
    //-----------------------------------------------------
    //----- fungsi cek syspex --
    function syspex($rollpallet, $data) {
      global $data;
      $data['plastikfilmsyspex'] = $rollpallet * $data['panjangfefoam'] * 2;
      return $data;
    }
    
    // function syspex($rollpallet,$data){
    // global $data;
    
    // $data['plastikfilmsyspex']=$rollpallet*$data['panjangfefoam'];
    // //$data['plastikfilmsyspex']*2;
    // $data['plastikfilmsyspex']=$data['plastikfilmsyspex']*2;
    // return $data;
    
    // }
    //update panjang tali strapping
    function talistrap2($data){
    global $data;
    $data['talistrap2']=$data['talistrapping']*4;
    return $data;
    }
    function logQuery($query, $logFile) {
      // Open the log file in append mode
      $fp = fopen($logFile, 'a');
      if ($fp === false) {
          die("Error opening log file");
      }
    
      // Get the current timestamp
      $timestamp = date('Y-m-d H:i:s');
    
      // Write the query and timestamp to the log file
      fwrite($fp, "[$timestamp] $query\n");
    
      // Close the log file
      fclose($fp);
      }
      //----------------------------
      global $colorbp;
      $colorbp = [
        'grade' => null,
        'color' => null,
        'gsm' =>null,
        'bp' => null
      ];
    
      //-----------------------------
      function ccolor($a){
        $input = $a;//"CFC00055NRST";
    
    // Extract each component based on its position
            $grade = substr($input, 0, 3);
            $color = substr($input, 3, 3);
            $gsm = substr($input, 6, 2);
            $bp = substr($input, 8);
    
            global $colorbp;
            $colorbp = array(
                'grade' => $grade,
                'color' => $color,
                'gsm' => $gsm,
                'bp' => $bp
            );
    
          }
          //---------------------
            global $gradestr;
      $gradestr2 = [
        'width' => null,
        'lenght' => null,
        'core' =>null,
        'brand' => null
      ];
      
      function gradestr($a) {
        global $gradestr2;
        $input = $a; // Example: W240MML12000MC3IN4R/PI2A
    
        // Extract each component based on its position
        $width = substr($input, 0, 5);
        $lenght = substr($input, 6, 8);
        $core = substr($input, 13, 4);
        $rp = substr($input, 17, 4);
        $brand = substr($input, 21);
    
        // Store the extracted components into the $gradestr array
        $gradestr2 = array(
            'width' => $width,
            'lenght' => $lenght,
            'core' => $core,
            'rp' => $rp,
            'brand' => $brand
        );
    
        // Output the $gradestr array
       // print_r($gradestr);
    }
    //------------------------------------
    function getColorFoam($colorCode) {
      // Define an array mapping color codes to foam colors
      $colorFoamMap = array(
          '000' => 'white',
          '121' => 'yellow',
          '145' => 'pink',
          '155' => 'blue',
          '166' => 'green'
      );
    
      // Check if the color code exists in the map
      if (array_key_exists($colorCode, $colorFoamMap)) {
          // Return the foam color corresponding to the color code
          return $colorFoamMap[$colorCode];
      } else {
          // If the color code is not found, return null or handle the case accordingly
          return null;
      }
    }
    //-----------------------------------
    function searchISPMHT($input,$data) {
      // Convert the input string to lowercase for case-insensitive search
      global $data;
      $inputLower = strtolower($input);
      
      // Search for the occurrence of "ISPM HT"
      $pos = strpos($inputLower, 'ispm ht');
      
      // Check if "ISPM HT" is found in the string
      if ($pos !== false) {
          return $data['ispmht']="ISPMHT";
          //return true; // Return true if found
      } else {
          return $data['ispmht']="Biasa";
          //false; // Return false if not found
      }
    }
    function calculateQuantity($rollsPerPallet, $totalOrder) {
      // Calculate quantity
      $quantity = $rollsPerPallet * $totalOrder;
      
      // Return the calculated quantity
      return $quantity;
    }
    function calculateTotalLength($lengthPerRoll_mm, $quantity_rolls, $standardPackageLength_m) {
      // Convert length per roll from millimeters to meters
      $lengthPerRoll_m = $lengthPerRoll_mm / 1000;
    
      // Calculate total length in meters
      $totalLength_m = $lengthPerRoll_m * $quantity_rolls;
    
      // Calculate the number of standard packages needed
      $numStandardPackages = ceil($totalLength_m / $standardPackageLength_m);
    
      // Return an array with both values
      return array(
          'totalLength_m' => $totalLength_m,
          'numStandardPackages' => $numStandardPackages
      );
    }
    //-------------------------------------------------------------
    function searchInTableWithTwoParams($tableName, $searchColumn1, $searchWord1, $searchColumn2, $searchWord2) {
      // Connect to your database (replace these variables with your database credentials)
    include 'koneksi.php';
      // Sanitize the search words to prevent SQL injection (you can use other methods based on your requirements)
      $searchWord1 = $conn->real_escape_string($searchWord1);
      $searchWord2 = $conn->real_escape_string($searchWord2);
    
      // Build the SQL query for search
      $sql = "SELECT * FROM $tableName WHERE $searchColumn1 LIKE '%$searchWord1%' AND $searchColumn2 LIKE '%$searchWord2%'";
    
      $result = $conn->query($sql);
      
      
      // Close the connection
      $conn->close();
    
      return $searchResults;
    }
    //----------fungsi di report_packaging - display some word from iteration to cell fpdf
    //display pe foam
    function displayArrayInTable($pdf, $fefoam2, $columnWidth = 35) {
      // Set font for the cell
      $pdf->SetFont('Arial', '', 8);
    
      // Initialize an associative array to store the sum of lengths for each color
      $colorSums = array();
    
      // Loop through the array and display each element in a formatted way
      foreach ($fefoam2 as $value) {
          // Split the value into color and length
          list($color, $length) = explode(' - ', $value);
    
          // Display elements with color "white", "blue", "pink", "green", or "yellow"
          if (in_array($color, array("white", "blue", "pink", "green", "yellow"))) {
              // Display color in the first column
              //$pdf->Cell($columnWidth, 10, $color, 1, 0, 'C');
    
              // Display length in the second column
              //$pdf->Cell($columnWidth, 10, $length, 1, 1, 'C');
    
              // Update the sum of lengths for the current color
              if (!isset($colorSums[$color])) {
                  $colorSums[$color] = 0;
              }
              $colorSums[$color] += $length;
          }
      }
    
      // Display total length for each color
      foreach ($colorSums as $color => $sum) {
        $pdf->Cell($columnWidth, 10, "Pefoam " . $color , 1, 0, 'C');
    
          $pdf->Cell($columnWidth, 10,  " Total = " .$sum. " Meter", 1, 1, 'C');
      }
    
      // Move to the next line after displaying all elements
      $pdf->Ln();
    }
    
    // dispaly inserter
    
    function displayArrayInTable2($pdf, $inserter, $columnWidth = 35) {
      // Set font for the cell
      $pdf->SetFont('Arial', '', 8);
    
      // Initialize an associative array to store the sum of lengths for each color
      $inserterSums = array();
    
      // Loop through the array and display each element in a formatted way
      // Loop through the array and display each element in a formatted way
    foreach ($inserter as $value) {
      // Split the value into diameter and total
      list($dia, $tot) = explode(' - ', $value);
    
      // Display elements with certain diameters
      if (in_array($dia, array("650", "700", "865", "900", "950", "110"))) {
          // Update the sum of totals for the current diameter
          if (!isset($inserterSums[$dia])) {
              $inserterSums[$dia] = 0;
          }
          $inserterSums[$dia] += $tot;
      }
    }
    
    
      // Display total length for each color
      // Display total for each diameter
    foreach ($inserterSums as $dia => $sum) {
      $pdf->Cell($columnWidth, 10, "Inserter " . $dia , 1, 0, 'C');
      $pdf->Cell($columnWidth, 10,  " Total = " .$sum. " pcs", 1, 1, 'C');
    }
    
      //Move to the next line after displaying all elements
     $pdf->Ln();
    }
    // display pallet
    function displayArrayInTable3($pdf, $pallet, $columnWidth = 35) {
      // Set font for the cell
      $pdf->SetFont('Arial', '', 8);
    
      // Initialize an associative array to store the sum of totals for each jenis
      $palletSums = array();
    
      // Loop through the array and display each element in a formatted way
      foreach ($pallet as $value) {
          // Split the value into jenis and total
          list($jenis, $tot) = explode(' - ', $value);
      
          // Display elements with certain jenis
          if (in_array($jenis, array("71", "71ISPMHT", "71ISPMHT-BB", "74", "74ISPMHT", "74ISPMHT-BB", "76ISPMHT-BB", "95", "95ISPMHT", "104", "104ISPMHT", "107", "107ISPMHT", "110ISPMHT", "pallet plastik"))) {
              // Update the sum of totals for the current jenis
              if (!isset($palletSums[$jenis])) {
                  $palletSums[$jenis] = 0;
              }
              $palletSums[$jenis] += $tot;
          }
      }
      
      // Display total for each jenis
      foreach ($palletSums as $jenis => $sum) {
          $pdf->Cell($columnWidth, 10, "Pallet " . $jenis , 1, 0, 'C');
          $pdf->Cell($columnWidth, 10,  " Total = " .$sum. " Set", 1, 1, 'C');
      }
    
      // Move to the next line after displaying all elements
      $pdf->Ln();
    }
    //display alas pallet
    function displayArrayInTable4($pdf, $alaspallet, $columnWidth = 35) {
      // Set font for the cell
      $pdf->SetFont('Arial', '', 8);
    
      // Initialize an associative array to store the sum of totals for each jenis
      $alaspalletSums = array();
    
      // Loop through the array and display each element in a formatted way
      foreach ($alaspallet as $value) {
          // Split the value into jenis and total
          list($jenisalas, $tot) = explode(' - ', $value);
      
          // Display elements with certain jenis
          if (in_array($jenisalas, array("71", "74", "94", "95", "98", "103", "104", "110", "113"))) {
              // Update the sum of totals for the current jenis
              if (!isset($alaspalletSums[$jenisalas])) {
                  $alaspalletSums[$jenisalas] = 0;
              }
              $alaspalletSums[$jenisalas] += $tot;
          }
      }
      
      // Display total for each jenis
      foreach ($alaspalletSums as $jenisalas => $sum) {
          $pdf->Cell($columnWidth, 10, "Alas Pallet " . $jenisalas , 1, 0, 'C');
          $pdf->Cell($columnWidth, 10,  " Total = " .$sum. "pcs", 1, 1, 'C');
      }
    
      // Move to the next line after displaying all elements
      $pdf->Ln();
    }
    //display totpalastik
    function displayTotalsForPlastik($pdf, $totplastik, $columnWidth = 35) {
      // Initialize total variable
      $total = 0;
    
      // Loop through the combinations
      foreach ($totplastik as $value) {
          // Split the combination into plastik roll and plastik syspex
          list($plastik_roll, $plastik_syspex) = explode('-', $value);
    
          // Add the values together to get the total
          $total += (floatval($plastik_roll) + floatval($plastik_syspex));
    
          //$total += ($plastik_roll + $plastik_syspex);
    
          // Display the combination
          //$pdf->Cell($columnWidth, 10, $value, 1, 0, 'C');
      }
    
      // Display the total value
      $pdf->Cell($columnWidth, 10, "Total ", 1, 0, 'C');
      $pdf->Cell($columnWidth, 10, $total."M ", 1, 1, 'C');
      $pdf->Ln();
    }
    //display total tali strap
    function displayTotalForTalistrapping($pdf, $tottali, $columnWidth = 35) {
      // Initialize total variable
      $total = 0;
    
      // Loop through the values
      foreach ($tottali as $value) {
          // Add the value to the total
          $total += (floatval($value));
          //$total += $value;
      }
    
      // Display the total value
      $pdf->Cell($columnWidth, 10, "Total", 1, 0, 'C');
      $pdf->Cell($columnWidth, 10, number_format($total, 2)."M ", 1, 1, 'C'); // Format total as float with 2 decimal places
      $pdf->Ln();
    }
    
    //display protektor roll
    function displayTotalForprotektor($pdf, $protek, $columnWidth = 35) {
      // Initialize total variable
      $totalprotek = 0;
    
      // Loop through the values
      foreach ($protek as $value) {
          // Add the value to the total
          //$total += (floatval($value));
          $totalprotek += $value;
      }
    
      // Display the total value
      $pdf->Cell($columnWidth, 10, "Total", 1, 0, 'C');
      $pdf->Cell($columnWidth, 10, $totalprotek."pcs ", 1, 1, 'C'); // Format total as float with 2 decimal places
      $pdf->Ln();
    }
    
    
    
    
    //---------------------------------------------------------------------------------
    
            
            



    //---------------------------------------------------
  $numrow = 1;
  foreach($sheet as $row){
    // Ambil data pada excel sesuai Kolom
    //echo "$no_doc";
        $no_doc = $row['A']; 
        $mat_slip = $row['B'];
        $shift = $row['C']; 
        $sloc = $row['D'];
        $mvt = $row['E']; 
        $reason =$row['F'];
        $tracking_id =$row['G'];
        $material =$row['H'];
        $desc_material =$row['I'];
        $batch =$row['J'];
        $qty =$row['K'];
        $w_net=$row['L'];
        $w_gross =$row['M'];
        $uoe =$row['N'];
        $bin =$row['O'];

    // Cek jika semua data tidak diisi
     if($no_doc == "" && $mat_slip == "" && $shift == "" && $sloc == "" && $mvt == "" && 
     $reason =="" && $tracking_id =="" && $material =="" && $desc_material =="" && $batch =="" && $qty =="" && $w_net=="" && $w_gross =="" && $uoe =="" && $bin =="" )
        
      continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

    // Cek $numrow apakah lebih dari 1
    // Artinya karena baris pertama adalah nama-nama kolom
    // Jadi dilewat saja, tidak usah diimport
  
    if($numrow > 1){
              // Buat query Insert ---------------------------------------------------
        
              $det = mysqli_query($conn, "select * from rp where material='$material'");
              if (mysqli_num_rows($det)) {
                while ($t = mysqli_fetch_array($det)) {
                  global $data;
                  $sc = $t['sc'];
                  $label = $t['label'];
                  $remark = $t['remark'];
                  $grade = $t['grade'];
                  $rollpallet = $t['rollpallet'];
                }
              }
          //----------------------------------------------------------------------
          
              //try {
                
                $proses1 = pddroll($label, $data);
                $proses1->$data['length'];
                $proses1->$data['diaroll'];
              //} catch (exception $e) {
               // echo "Error: " . $e->getMessage();
              //}
             // try {
                $proses2 = graderoll($grade, $data);
                $proses2->$data['grade'];
                $proses2->$data['foamprotek'];
                $proses21 = ccolor($grade);
                $colorCode = $colorbp['color'];
                $proses22 = getColorFoam($colorCode);
              //} catch (exception $e) {
                //echo "Error: " . $e->getMessage();
             // }
          
             // global $pallet_data;
             // if (isset($data) && isset($pallet_data) && !empty($data) && !empty($pallet_data)) {
                //try { //cek pallet
                  $proses3 = cekpallet($data, $pallet_data);
                  $proses3->$data['pallet'];
                  $proses3->$data['inserter'];
                  $data['CardBox_pallet'] = $data['pallet'];
                  $proses3_1 = searchISPMHT($remark, $data);
                //} catch (exception $e) {
                 // echo "Error: " . $e->getMessage();
                //}
              //} else {
                //Handle case where $data or $pallet_data is missing or empty
               // echo "Error: Missing or empty data.";
             // }
          
          
          
             // try {
          
                $proses4 = pallet1set($data['pallet']);
                $proses5 = talistrap($label, $rollpallet, $data['pallet1set'], $data);
             // } catch (exception $e) {
               // echo "Error: " . $e->getMessage();
              //}
             // try { //proses 6
                $proses6 = panjangff($remark, $data['diaroll'], $data['foamprotek'], $data['fefoamuse'], $data);
                $proses6->$data['fefoam'];
                $proses6->$data['panjangfefoam'];
                $proses6->$data['plastikfilm'];
             // } catch (exception $e) {
               // echo "Error: " . $e->getMessage();
              //}
             // try { //proses 7
                $proses7 = syspex($rollpallet, $data);
                $proses7->$data['plastikfilmsyspex'];
             // } catch (exception $e) {
               // echo "Error: " . $e->getMessage();
              //}
              //try { //proses8
                talistrap2($data['talistrapping']);
                $quantity = calculateQuantity($rollpallet, $qty);
                $standardPackageLength_m = 300; // panjang fe foam per rollpackage
                $result = calculateTotalLength($data['panjangfefoam'], $quantity, $standardPackageLength_m);
             // } catch (exception $e) {
               // echo "Error: " . $e->getMessage();
             // }
          
          
              //----------------------------------------------
              $protekroll1 = '1'; //protektor roll if chin ta dan taiwan order
              //warna pe foam =proses 22
              // $result['totalLength_m']  panjang kebutuhan pe foam per meter X qty 
              $plastikpermeter = $data['plastikfilm'] * $quantity / 1000; //panjang kebutuhan plastik per roll X qty
              $qtyinserter = $qty * 2; //inserter X 2 pcs per roll X qty
              //$data['pallet'] ukuran pallet
              //$data['ispmht'];//jenis pallet
              $qtyalas = $qty * 2; //alas X 2 per pallet X qty
              $syspexpermeter = $data['plastikfilmsyspex'] / 1000 * $qty; //konfersi plastik syspek ke meter
              $talipermeter = $data['talistrap2'] / 1000 * $qty; //konfersi talistrap ke meter

          
//--------------------------------------------------------------------------------------------
//try {
                      $query = mysqli_query($conn, "INSERT INTO `keluar` (`id`, `no_doc`, `tanggal`, `shift`, `groupB`, `tracking_id`, `material`, `desc_material`, `qty`, `colorfoam`, `pack_foam`, `pack_plastik_roll`, `pack_inserter`, `qty_inserter`, `pack_pallet`, `jenis_pallet`, `qty_pallet`, `pack_alas`, `qty_alas`, `qty_protektor`, `pack_plastik_syspex`, `pack_strapping`)
                    VALUES (
                    'null',
                    '$no_doc',
                    '$tanggal',
                    '$shift',
                    '$groupB',
                    '$tracking_id',
                    '$material',
                    '$desc_material',
                    '$qty',
                    '" . $proses22 . "',
                    '" . $result['totalLength_m'] . "',
                    '" . $plastikpermeter . "',
                    '" . $data['inserter'] . "',
                    '" . $qtyinserter . "',
                    '" . $data['pallet'] . "',
                    '" . $data['ispmht'] . "',
                    '" . $qty . "',
                    '" . $data['pallet'] . "',
                    '" . $qtyalas . "',
                    '$protekroll1',
                    '" . $syspexpermeter . "',
                    '" . $talipermeter . "'
                    )");
                  
                    // if (!$query) {
                    //   throw new Exception("Error executing query: " . mysqli_error($conn));
                    // }
     //$query ="INSERT INTO keluar VALUES('" . $no_doc . "','" . $mat_slip . "','" . $shift . "','" . $sloc . "','" . $mvt . "','" . $reason . "','" . $tracking_id . "','" . $material . "','" . $desc_material . "','" . $batch . "','" . $qty . "','" . $w_net . "','" . $w_gross . "','" . $uoe . "','" . $bin . "')";

      // Eksekusi $query
      mysqli_query($conn, $query);
      echo "sukses1";
     
       
      //try{//proses 9 decrement inserter packaging
        //include "calc_output_packaging.php";
       // global $data;
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = "Inserter_" . $data['inserter'];
        $decrementValue = $qtyinserter;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
       // $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        //$conn->close();
      //}catch(exception $e){
       // echo "Error: " . $e->getMessage();
      //}
     // try{//proses 10 decrement pallet packaging
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = palletjen($data['pallet'],$data['ispmht']);
        $decrementValue = $qtyalas;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        //$tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        //$conn->close();
      //}catch(exception $e){
       // echo "Error: " . $e->getMessage();
      //}
      //try{//proses 11 decrement alas pallet packaging
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = alaspallet($data['pallet']);
        $decrementValue = $qty*2;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
       // $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
       // $conn->close();
      //}catch(exception $e){
      //  echo "Error: " . $e->getMessage();
      //}
     // try{//proses 12 decrement protektor roll
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = "CardBox pallet_protektor roll cass";
        $decrementValue = $protekroll1;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        //$tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
       // $conn->close();
      //}catch(exception $e){
       // echo "Error: " . $e->getMessage();
      //}
      //try{//proses 13 decrement pe foam
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = pefoamccc($proses22);
        $decrementValue = $result['totalLength_m'];
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
       // $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        //$conn->close();
      //}catch(exception $e){
      //  echo "Error: " . $e->getMessage();
      //}
      //try{//proses 14 decrement plastik film mc hs dan syspex
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = "Sterach Film";
        $decrementValue = $plastikpermeter+$syspexpermeter;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        //$tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
        //$conn->close();
      //}catch(exception $e){
       // echo "Error: " . $e->getMessage();
      //}
      //try{//proses 15 decrement talistrapping
        $tableName = "stock_take";
        $idColumnName = "1";
        $id = 1; // Replace with the actual ID you want to update
        $decrementColumn = "tali_strapping";
        $decrementValue = $talipermeter;
        $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
        //$tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
       // $conn->close();
     // }catch(exception $e){
      // echo "Error: " . $e->getMessage();
     // }
    // //} catch (Exception $e) {
    //   echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
    //   echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
    //   echo "Error: " . $e->getMessage();
    //   echo   "</div>";
    //   echo "</div>";
    // }
    echo "sukses2";
    echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
    echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
    echo "<p><center>Menambakan Data Sukses</center></p>";
    echo "<p><center>Record inserted successfully</center></p>";
    echo   "</div>";
    echo "</div>";
  }
    else  {
    //echo "$rem";
    echo "gagal 1";
    //echo "Error: " . $e->getMessage();
  }
    $numrow++; // Tambah 1 setiap kali looping
  }

    unlink($path); // Hapus file excel yg telah diupload, ini agar tidak terjadi penumpukan file

  }

header('location: keluar.php'); // Redirect ke halaman awal