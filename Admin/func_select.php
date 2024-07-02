<?php
function selectFromTable($tableName, $idColumnName, $id) {
    // Connect to your database (replace these variables with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databarang";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Build the SQL query for SELECT
    $sql = "SELECT * FROM $tableName WHERE $idColumnName = '$id'";
    $result = $conn->query($sql);

    $selectedRecords = array();

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $selectedRecords[] = $row;
        }
        print_r($selectedRecords); // Print the selected records array
    } else {
        echo "No records found";
    }

    // Close the connection
    $conn->close();

    return $selectedRecords;
}

function deleteFromTable($tableName, $idColumnName, $id) {
    // Connect to your database (replace these variables with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databarang";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Build the SQL query for DELETE
    $sql = "DELETE FROM $tableName WHERE $idColumnName = '$id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}

// Example usage for SELECT:
$tableName = "stock_take";
$idColumnName = "1";
$id = 1; // Replace with the actual ID you want to select

$selectResult = selectFromTable($tableName, $idColumnName, $id);

// Example usage for DELETE:
// Uncomment the line below if you want to delete the record after selecting it
// deleteFromTable($tableName, $idColumnName, $id);
?>
