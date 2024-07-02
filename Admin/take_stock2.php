<?php 
  class Database {
    private $conn;

    public function __construct() {
        include 'koneksi.php'; // Include the database connection script
        $this->conn = $conn;
    }

    public function updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue) {
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Build the SQL query
        $sql = "UPDATE $tableName SET $decrementColumn = $decrementColumn - $decrementValue WHERE $idColumnName = '$id'";

        // Execute the query
        if ($this->conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->conn->error;
        }

        // Close the connection
        $this->conn->close();
    }
}

// Call the class method
//$database = new Database();
//$database->updateTableDecrement($tableName, $idColumnName, $id, $decrementColumn, $decrementValue);
?>