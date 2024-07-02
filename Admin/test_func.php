 <?php
// include "calc_output_packaging.php";
// $input = "CFC00055NRST";
// $tt=ccolor($input);
// global $colorbp;
// echo $colorbp['grade'];
// echo "</br>";
// echo $colorbp['color'];
// echo "</br>";

// echo $colorbp['gsm'];echo "</br>";
// echo $colorbp['bp'];echo "</br>";

// $ee="W240MML12000MC3IN4R/PI2A";
// $tr=gradestr($ee);
// global $gradestr2;
// echo $gradestr2['width'];
// echo "</br>";
// echo $gradestr2['lenght'];
// echo "</br>";
// echo $gradestr2['core'];
// echo "</br>";
// echo $gradestr2['brand'];

// $colorCode = '145';
// $foamColor = getColorFoam($colorCode);
// echo "</br>Foam color for color code {$colorCode}: {$foamColor}";

// // $input = "MADE IN INDONESIA ISPM HT Roll/Pt - t FA 0 Plt - PALLET ISPM#15(HT-DB) - PE foam - PAKAI PALLET - PALLET SIZE 71 X 71 X 113 CM";
// // if (searchISPMHT($input)) {
// //     echo "</br>The string contains 'ISPM HT'.";
// // } else {
// //     echo "</br>The string does not contain 'ISPM HT'.";
// // }

// // -------------------proses decrement acitve ketika proses calculasi dan update ke db selsesai
 

// //---------------------------------------------------------------
// // function updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue) {
// //     include 'koneksi.php';
  
// //     //Check connection
// //     if ($conn->connect_error) {
// //         die("Connection failed: " . $conn->connect_error);
// //     }
// // //Build the SQL query
// // $sql = "UPDATE $tableName SET `$decrementColumn` = `$decrementColumn` - $decrementValue WHERE $idColumnName = '$id'";

// // //Execute the query
// // if ($conn->query($sql) === TRUE) {
// //     echo "Record updated successfully";
    
// // } else {
// //     echo "Error updating record: " . $conn->error;
    
    
// // }
// // $conn->close();
// // $tableName = null;
// // $idColumnName = null;
// // $id = null;
// // $decrementColumn = null;
// // $decrementValue = null;
// // //Close the connection

// // return $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
// // }
// //---------------------------------------------------------------------------------------------------


//   // try{
//   //     $det=mysqli_query($conn, "select * from stock_take ");
//   // if(mysqli_num_rows($det)){
//   //   while($t=mysqli_fetch_array($det)){
//   //       $sc=$t['sc'];
//   //       $label=$t['label'];
//   //       $remark=$t['remark'];
//   //       $grade=$t['grade'];
//   //       $rollpallet=$t['rollpallet'];
//   //       }
//   //   }
//   //   }catch(exception $e){
//   //     echo "Error: " . $e->getMessage();
//   //   }


// //     cekpackaging($mate); 
// // $calcpackaging =cekpackaging($material);
// // if($calcpackaging==1){
   
// //     $x = $calcpackaging ['sc'];
// //     $y = $calcpackaging ['label'];
// //     $z = $calcpackaging ['remark'];
// //   echo "$sc";
// //   echo "$label";
// //   echo "$remark";
// // }

//     // try{//proses 3.1 decrement pallet
//     //   $tableName = "stock_take";
//     //   $idColumnName = "1";
//     //   $id = 1; // Replace with the actual ID you want to update
//     //   $decrementColumn = "pallet_71";
//     //   $decrementValue = 2;
//     //   $prosesdpallet=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
//     //   $tableName=null; $idColumnName=null; $id=null; $decrementColumn=null; $decrementValue =null;
//     //   $conn->close();
//     // }catch(exception $e){
//     //   echo "Error: " . $e->getMessage();
//     // }
// //     try{//proses 3.2 decrement cardbox(alas)
// //       $tableName = "stock_take";
// //       $idColumnName = "1";
// //       $id = 1; // Replace with the actual ID you want to update
// //       $decrementColumn = "CardBox pallet_" . $proses3->pallet;
// //       $decrementValue = $qty;
// //       $prosesdalas=updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
// //     }catch(exception $e){
// //       echo "Error: " . $e->getMessage();
// //     }
// // }


// function searchInTableWithTwoParams($tableName, $searchColumn1, $searchWord1, $searchColumn2, $searchWord2) {
//     // Connect to your database (replace these variables with your database credentials)
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "databarang";

//     $conn = new mysqli($servername, $username, $password, $dbname);

//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // Sanitize the search words to prevent SQL injection (you can use other methods based on your requirements)
//     $searchWord1 = $conn->real_escape_string($searchWord1);
//     $searchWord2 = $conn->real_escape_string($searchWord2);

//     // Build the SQL query for search
//     $sql = "SELECT * FROM $tableName WHERE $searchColumn1 LIKE '%$searchWord1%' AND $searchColumn2 LIKE '%$searchWord2%'";

//     $result = $conn->query($sql);

//     $searchResults = array();

//     if ($result->num_rows > 0) {
//         // Output data of each row
//         echo "<table border='1'>";
//         echo "<tr><th>$searchColumn1</th><th>$searchColumn2</th></tr>";
//         while ($row = $result->fetch_assoc()) {
//             echo "<tr><td>".$row[$searchColumn1]."</td><td>".$row[$searchColumn2]."</td></tr>";
//         }
//         echo "</table>";
//     } else {
//         echo "No matching records found";
//     }

//     // Close the connection
//     $conn->close();

//     return $searchResults;
// }




// // Example usage:
// $tableName = "keluar";
// $searchColumn1 = "shift";
// $searchWord1 = "haeri-ari-ncr";
// $searchColumn2 = "groupB";
// $searchWord2 = "a";

// searchInTableWithTwoParams($tableName, $searchColumn1, $searchWord1, $searchColumn2, $searchWord2); -->
///
include 'koneksi.php';

function generateOptions($conn) {
    // Query to fetch distinct noreservasi values
    $query = "SELECT DISTINCT noreservasi FROM masuk WHERE status1 = 1";
    $result = mysqli_query($conn, $query);

    // Check if query executed successfully
    if (!$result) {
        // Handle error, return empty string or throw exception
        return '';
    }

    $options = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $noreservasi = $row['noreservasi'];

        // Query to fetch nama based on noreservasi
        $namaQuery = "SELECT nama FROM masuk WHERE noreservasi = '$noreservasi' LIMIT 1";
        $namaResult = mysqli_query($conn, $namaQuery);

        // Check if query executed successfully
        if ($namaResult && mysqli_num_rows($namaResult) > 0) {
            $namaRow = mysqli_fetch_assoc($namaResult);
            $nama = $namaRow['nama'];

            // Append option to the options string
            $options .= "<option value='$noreservasi'>$nama</option>";
        }
    }

    return $options;
}

// Usage example:
echo "<select name='noreservasi'>";
echo generateOptions($conn);
echo "</select>";


?>