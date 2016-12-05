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

    if (isset($_POST['doEdit'])) {

      $id = $_POST['id'];
      $email = $_POST['email'];
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $registered = $_POST['registered'];
      $lastLogin = $_POST['lastLogin'];
      $password = $_POST['password'];

      $stmt = $conn->prepare("UPDATE users SET email=:email,
                                               name=:name,
                                               surname=:surname,
                                               registered=:registered,
                                               lastLogin=:lastLogin,
                                               password=:password
                                            WHERE id=:id");

      $stmt->bindParam("id", $id);
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
