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

    if (isset($_POST['doAdd'])) {

      $id = $_POST['id'];
      $email = $_POST['email'];
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $registered = $_POST['registered'];
      $lastLogin = $_POST['lastLogin'];
      $password = $_POST['password'];

      $stmt = $conn->prepare("INSERT INTO users (email, name, surname, registered, lastLogin, password) VALUES (:email, :name, :surname, :registered, :lastLogin, :password)");

      $stmt->bindParam("email", $email);
      $stmt->bindParam("name", $name);
      $stmt->bindParam("surname", $surname);
      $stmt->bindParam("registered", $registered);
      $stmt->bindParam("lastLogin", $lastLogin);
      $stmt->bindParam("password", $password);
      // Execute the INSERT
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
