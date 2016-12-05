<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "dawm8-mysql-php";
# Example (PDO)
# Select Data With PDO (+ Prepared Statements)
# The following example uses prepared statements.
# We use PDO beacuse its portability
# We use prepared statements, because its enhaced security
# we use FETCH_ASSOC, theoretically faster because are basic types
try {
//    echo "----- Connection -----";
//    echo "<br/>";
    $conn = new PDO("mysql:host=$servername;dbname=$database",
                        $username,
                        $password,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //  echo "----- SELECT all users -----";
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<a href="view/addForm.php">New</a>
<table border="1">
  <thead>
    <th>id</th>
    <th>email</th>
    <th>name</th>
    <th>surname</th>
    <th>registered</th>
    <th>lastLogin</th>
    <th></th>
  </thead>

<?php foreach ($users as $key => $user) { ?>
    <tr>
      <td><?=$user['id']?></td>
      <td><?=$user['email']?></td>
      <td><?=$user['name']?></td>
      <td><?=$user['surname']?></td>
      <td><?=$user['registered']?></td>
      <td><?=$user['lastLogin']?></td>
      <td><a href="view/deleteForm.php?id=<?=$user['id']?>">delete</a>
        | <a href="view/editForm.php?id=<?=$user['id']?>">edit</a></td>
    </tr>
<?php } ?>
</table>
<?php
    // Close connection
    $db = null;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
