<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "dawm8-mysql-php";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$database",
                        $username,
                        $password,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {

      $id = $_GET['id'];

      $stmt = $conn->prepare("SELECT * FROM users WHERE id= :id");
      $stmt->bindParam("id", $id);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user) {
?>
<form method="post" action="../action/doDelete.php" style="color:red;">
  Id: <input name="id" type="text" value="<?=$user['id']?>" readonly /> <br/>
  Email: <input name="email" type="text" value="<?=$user['email']?>" readonly /> <br/>
  Name: <input name="name" type="text" value="<?=$user['name']?>" readonly /> <br/>
  Surname: <input name="surname" type="text" value="<?=$user['surname']?>" readonly /> <br/>
  Registered: <input name="registered" type="text" value="<?=$user['registered']?>" readonly /> <br/>
  Last Login: <input name="lastLogin" type="text" value="<?=$user['lastLogin']?>" readonly /> <br/>
  Password: <input name="password" type="password" value="<?=$user['password']?>" readonly /> <br/>
  <input type="submit" name="doDelete" value="Delete"/>
</form>
<a href="../">Back</a>
<?php
  } else {
    // print_r("ERROR");
    // print_r("<br/>");
    // var_dump($user);
  }
}
    // Close connection
    $db = null;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
