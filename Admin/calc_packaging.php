<?php
include 'koneksi.php';?>
<!-----------------fungsi kalkulasi packaging---------->
<?php

    function cekpackaging($s){
      include 'koneksi.php';
      $det=mysqli_query($conn, "select * from rp where sc='$s'");
      while($t=mysqli_fetch_array($det)){
          $sc=$t['sc'];
          $label=$t['label'];
          $remark=$t['remark'];
          $grade=$t['grade'];
          $pm=$t['pm'];
          $rollpallet=$t['rollpallet'];
          $totalplan=$t['totalplan'];
          $totalorder=$t['totalorder'];
      }
      $lenghtroll; //panjang roll dan diameter
      if (stristr($label,'4000')==true){
        $lenghtroll ='4000';
        $diaroll='700';
      }else if(stristr($label,'6000')==true){
        $lenghtroll = "6000";
        $diaroll='730';
      }else if(stristr($label,'10500')==true){
        $lenghtroll='10500';
        $diaroll='940';
      }else if(stristr($label,'11950')==true){
        $lenghtroll='11950';
        $diaroll='1030';
      }else if(stristr($label,'12000')==true){
        $lenghtroll='12000';
        $diaroll='1030';
      }else if(stristr($label,'15000')==true){
        $lenghtroll='15000';
        $diaroll='1120';
      }else if(stristr($label,'18000')==true){
        $lenghtroll='18000';
        $diaroll='17900';
      }
      $graderoll;//const hitung jumlah layer fe foam
      if (stristr($grade,'cfb')==true){
        $graderoll='cfb';
        $foamprotec='2';
      }
      else if(stristr($grade,'cf')==true){
        $graderoll='cf';
        $foamprotec='1';
     }
     else if (stristr($grade,'cb')==true){
      $graderoll='cb';
      $foamprotec='1';
     }
      $pallet;//cek penggunaan pallet
      $inserter;//cek penggunaan protek sisi roll /inserter
      switch(true)
      {
          case ($lenghtroll == "4000" && $graderoll == "cb" ):
              $inserter='700';
              $pallet='74';
              break;
          case ($lenghtroll == "6000" && $graderoll =="cb" ):
                $inserter='700';
                $pallet='74';
                break;
          case ($lenghtroll == "10500" && $graderoll == "cb" ):
              $inserter='900';
              $pallet='98';
              break;
              case ($lenghtroll == "11950" && $graderoll == "cb" ):
                $inserter='950';
                $pallet='107';
                break;
          case ($lenghtroll == "12000" && $graderoll == "cb" ):
              $inserter='950';
              $pallet='107';
              break;
        case ($lenghtroll == "15000" && $graderoll =="cb" ):
              $inserter='1020';
              $pallet='1113';
              break; 
        case ($lenghtroll == "18000" && $graderoll =="cb" ):
              $inserter='1020';
              $pallet='1113';
              break; 
              case ($lenghtroll == "4000" && $graderoll == "cf" ):
                $inserter='650';
                $pallet='71';
                break;
            case ($lenghtroll == "6000" && $graderoll =="cf" ):
                  $inserter='650';
                  $pallet='71';
                  break;
            case ($lenghtroll == "10500" && $graderoll == "cf" ):
                $inserter='865';
                $pallet='95';
                break;
                case ($lenghtroll == "11950" && $graderoll == "cf" ):
                  $inserter='900';
                  $pallet='104';
                  break;
            case ($lenghtroll == "12000" && $graderoll == "cf" ):
                $inserter='900';
                $pallet='104';
                break;
          case ($lenghtroll == "15000" && $graderoll =="cf" ):
                $inserter='950';
                $pallet='1113';
                break; 
          case ($lenghtroll == "18000" && $graderoll =="cf" ):
                $inserter='1020';
                $pallet='1113';
                break; 
                
                case ($lenghtroll == "6000" && $graderoll =="cfb" ):
                  $inserter='650';
                  $pallet='71';
                  break;
            case ($lenghtroll == "10500" && $graderoll == "cfb" ):
                $inserter='865';
                $pallet='95';
                break;
            case ($lenghtroll == "12000" && $graderoll == "cfb" ):
                $inserter='900';
                $pallet='104';
                break;
          case ($lenghtroll == "15000" && $graderoll =="cfb" ):
                $inserter='950';
                $pallet='1113';
                break; 
          case ($lenghtroll == "18000" && $graderoll =="cfb" ):
                $inserter='1020';
                $pallet='1113';
                break; 
          default:
              echo "@";
      }

      $talistrapping;//panjang tali strapping
      $widhtroll;//lebar roll
      $fefoamuse;//foam multi layer calc by widht
      $tallroll;
      $pallet1set=10+$pallet*2;
      if (stristr($label,'210')==true){
        $fefoamuse ='1';
        $talistrapping= 210*$rollpallet+$pallet1set;
        $tallroll=210*$rollpallet;
      }else if(stristr($label,'229')==true){
        $fefoamuse ='1';
        $talistrapping= 229*$rollpallet+$pallet1set;
        $tallroll=229*$rollpallet;
      }else if(stristr($label,'241')==true){
        $fefoamuse ='1';
        $talistrapping= 241*$rollpallet+$pallet1set;
        $tallroll=241*$rollpallet;
      }else if(stristr($label,'250')==true){
        $fefoamuse ='1';
        $talistrapping= 250*$rollpallet+$pallet1set;
        $tallroll=250*$rollpallet;
      }else if(stristr($label,'260')==true){
        $fefoamuse ='1';
        $talistrapping= 260*$rollpallet+$pallet1set;
        $tallroll=260*$rollpallet;
      }else if(stristr($label,'279')==true){
        $fefoamuse ='1';
        $talistrapping= 279*$rollpallet+$pallet1set;
        $tallroll=279*$rollpallet;
      }else if(stristr($label,'300')==true){
        $fefoamuse ='1';
        $talistrapping= 300*$rollpallet+$pallet1set;
        $tallroll=300*$rollpallet;
      }else if(stristr($label,'305')==true){
        $fefoamuse ='2';
        $talistrapping= 305*$rollpallet+$pallet1set;
        $tallroll=305*$rollpallet;
      }else if(stristr($label,'320')==true){
        $fefoamuse ='2';
        $talistrapping= 320*$rollpallet+$pallet1set;
        $tallroll=320*$rollpallet;
      }else if(stristr($label,'330')==true){
        $fefoamuse ='2';
        $talistrapping= 330*$rollpallet+$pallet1set;
        $tallroll=330*$rollpallet;
      }else if(stristr($label,'340')==true){
        $fefoamuse ='2';
        $talistrapping= 340*$rollpallet+$pallet1set;
        $tallroll=340*$rollpallet;
      }else if(stristr($label,'345')==true){
        $fefoamuse ='2';
        $talistrapping= 345*$rollpallet+$pallet1set;
        $tallroll=345*$rollpallet;
      }else if(stristr($label,'360')==true){
        $fefoamuse ='2';
        $talistrapping= 360*$rollpallet+$pallet1set;
        $tallroll=360*$rollpallet;
      }else if(stristr($label,'370')==true){
        $fefoamuse ='2';
        $talistrapping= 370*$rollpallet+$pallet1set;
        $tallroll=370*$rollpallet;
      }else if(stristr($label,'380')==true){
        $fefoamuse ='2';
        $talistrapping= 380*$rollpallet+$pallet1set;
        $tallroll=380*$rollpallet;
      }else if(stristr($label,'389')==true){
        $fefoamuse ='2';
        $talistrapping= 389*$rollpallet+$pallet1set;
        $tallroll=389*$rollpallet;
      }else if(stristr($label,'400')==true){
        $fefoamuse ='2';
        $talistrapping= 400*$rollpallet+$pallet1set;
        $tallroll=400*$rollpallet;
      }else if(stristr($label,'420')==true){
        $fefoamuse ='2';
        $talistrapping= 420*$rollpallet+$pallet1set;
        $tallroll=420*$rollpallet;
      }else if(stristr($label,'430')==true){
        $fefoamuse ='2';
        $talistrapping= 430*$rollpallet+$pallet1set;
        $tallroll=430*$rollpallet;
      }else if(stristr($label,'440')==true){
        $fefoamuse ='2';
        $talistrapping= 440*$rollpallet+$pallet1set;
        $tallroll=440*$rollpallet;
      }else if(stristr($label,'458')==true){
        $fefoamuse ='2';
        $talistrapping= 458*$rollpallet+$pallet1set;
        $tallroll=458*$rollpallet;
      }else if(stristr($label,'460')==true){
        $fefoamuse ='2';
        $talistrapping= 460*$rollpallet+$pallet1set;
        $tallroll=460*$rollpallet;
      }else if(stristr($label,'470')==true){
        $fefoamuse ='2';
        $talistrapping= 470*$rollpallet+$pallet1set;
        $tallroll=470*$rollpallet;
      }else if(stristr($label,'480')==true){
        $fefoamuse ='2';
        $talistrapping= 480*$rollpallet+$pallet1set;
        $tallroll=480*$rollpallet;
      }else if(stristr($label,'498')==true){
        $fefoamuse ='2';
        $talistrapping= 498*$rollpallet+$pallet1set;
        $tallroll=498*$rollpallet;
      }else if(stristr($label,'500')==true){
        $fefoamuse ='3';
        $talistrapping= 500*$rollpallet+$pallet1set;
        $tallroll=500*$rollpallet;
      }else if(stristr($label,'520')==true){
        $fefoamuse ='3';
        $talistrapping= 520*$rollpallet+$pallet1set;
        $tallroll=520*$rollpallet;
      }else if(stristr($label,'540')==true){
        $fefoamuse ='3';
        $talistrapping= 540*$rollpallet+$pallet1set;
        $tallroll=540*$rollpallet;
      }else if(stristr($label,'560')==true){
        $fefoamuse ='3';
        $talistrapping= 560*$rollpallet+$pallet1set;
        $tallroll=560*$rollpallet;
      }else if(stristr($label,'570')==true){
        $fefoamuse ='3';
        $talistrapping= 570*$rollpallet+$pallet1set;
        $tallroll=570*$rollpallet;
      }else if(stristr($label,'678')==true){
        $fefoamuse ='4';
        $talistrapping= 678*$rollpallet+$pallet1set;
        $tallroll=678*$rollpallet;
      }else if(stristr($label,'720')==true){
        $fefoamuse ='4';
        $talistrapping= 720*$rollpallet+$pallet1set;
        $tallroll=720*$rollpallet;
      }else if(stristr($label,'740')==true){
        $fefoamuse ='4';
        $talistrapping= 740*$rollpallet+$pallet1set;
        $tallroll=740*$rollpallet;
      }else if(stristr($label,'750')==true){
        $fefoamuse ='4';
        $talistrapping= 750*$rollpallet+$pallet1set;
        $tallroll=750*$rollpallet;
      }else if(stristr($label,'770')==true){
        $fefoamuse ='4';
        $talistrapping= 770*$rollpallet+$pallet1set;
        $tallroll=770*$rollpallet;
      }else if(stristr($label,'810')==true){
        $fefoamuse ='4';
        $talistrapping= 810*$rollpallet+$pallet1set;
        $tallroll=810*$rollpallet;
      }else if(stristr($label,'820')==true){
        $fefoamuse ='4';
        $talistrapping= 820*$rollpallet+$pallet1set;
        $tallroll=820*$rollpallet;
      }else if(stristr($label,'800')==true){
        $fefoamuse ='4';
        $talistrapping= 800*$rollpallet+$pallet1set;
        $tallroll=800*$rollpallet;
      }else if(stristr($label,'900')==true){
        $fefoamuse ='5';
        $talistrapping= 900*$rollpallet+$pallet1set;
        $tallroll=900*$rollpallet;
      }else if(stristr($label,'920')==true){
        $fefoamuse ='5';
        $talistrapping= 920*$rollpallet+$pallet1set;
        $tallroll=920*$rollpallet;
      }else if(stristr($label,'940')==true){
        $fefoamuse ='5';
        $talistrapping= 940*$rollpallet+$pallet1set;
        $tallroll=940*$rollpallet;
      }else if(stristr($label,'990')==true){
        $fefoamuse ='5';
        $talistrapping= 990*$rollpallet+$pallet1set;
        $tallroll=990*$rollpallet;
      }else if(stristr($label,'1000')==true){
        $fefoamuse ='5';
        $talistrapping= 1000*$rollpallet+$pallet1set;
        $tallroll=1000*$rollpallet;
      }
       
          $plastikfilm;
          $fefoam; //cek penggunaan fe foam by rp
          $panjangfefoam;  //cek penggunaan fe foam by lenght dan grade
          if (stristr($remark,'pe foam')!== false){
            $fefoam ='true';
            $panjangfefoam=$diaroll * 3.14 + 500;
            $panjangfefoam=$panjangfefoam * $foamprotec * $fefoamuse;
            $plastikfilm=$panjangfefoam * 2;

          }else{
            $fefoam ='false';
            $panjangfefoam=0;
            $plastikfilm=$panjangfefoam * 2;
            }
            $plastikfilmsyspex=$rollpallet*$panjangfefoam;
             echo"keterangan inserter $inserter</br>";
           echo "keterangan pallet $pallet</br>";
            echo "no sc $sc <br/>";
            echo "keterangan label $label <br/>";
            echo "keterangan spec by ppic $remark</br>";
            echo "keterangan penggunaan fefoam $fefoam</br>";
            echo "keterangan panjang roll $lenghtroll</br>";
            echo "keterangan grade roll $graderoll<br/>";
            echo "keterangan panjang fe foam yg di gunakan per roll $panjangfefoam</br>";
            echo "keterangan panjang plastik yg di gunakan per roll $plastikfilm</br>";
            echo "keterangan lebar roll $fefoamuse</br>";
            echo "keterangan panjang tali strapping ";
            echo $talistrapping*2;
            echo"<br/>";
            echo "keterangan panjang film syspex";
            echo $plastikfilmsyspex*2;


















  }//akhir fungsi cek packaging


?>
<!------------------------------------------->
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
          while($s=mysqli_fetch_array($det)){
            ?>

            <tr>
            <td>KETERANGAN</td>
            <td><?php cekpackaging($s['sc']);
            
            
        }
    }
            ?></td>
            </tr>
        
        