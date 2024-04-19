<?php
session_start();
require_once 'conf/db.inc';

try {
    $db = new PDO(DSN, USER, PASS);
    $sql = 'SELECT * FROM player' . 
    ' WHERE (name=:name_input OR email=:name_input)' . 
    'AND passwd=PASWORD(:passwd_input); ';
    $statement = $db->prepare($sql);
    $statement->execute(
[
    'email_input' => $_POST['email'],
    'passwd_input' => $_POST['passwd'],
]
); 
$row = $statement->fetch(PDO::FETCH_ASSOC);
  if($row === FALSE){
    header('location:index.html');
  }
  else{
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    header('location:selectpersona.php');
  }
} catch (PDOException $pdoe) {
    die("Error : " . $pdoe->getMessage());
} catch (Exception $e) {
    die("Error : " . $e->getMessage());
}
?>

