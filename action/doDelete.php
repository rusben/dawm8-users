<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "dawm8-mysql-php";
# Example (PDO)
# Insert Data With PDO (+ Prepared Statements)
# The following example uses prepared statements.
# We use PDO beacuse its portability
# We use prepared statements, because its enhaced security
# we use FETCH_ASSOC, theoretically faster because are basic types
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",
                        $username,
                        $password,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['doDelete'])) {

      $id = $_POST['id'];
      $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");

      $stmt->bindParam("id", $id);
    
      // Execute the UPDATE
      $stmt->execute();

      header("location: ../");
    }

    // Close connection
    $db = null;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
