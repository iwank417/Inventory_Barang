<?php
function updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue) {
    include 'koneksi.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Build the SQL query
    $sql = "UPDATE $tableName SET $decrementColumn = $decrementColumn - $decrementValue WHERE $idColumnName = '$id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}

// Example usage:
// $tableName = "stock_take";
// $idColumnName = "1";
// $id = 1; // Replace with the actual ID you want to update
// $decrementColumn = "pallet_71";
// $decrementValue = 2;

// updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
?>
