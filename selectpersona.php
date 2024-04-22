<?php
session_start();
require_once 'conf/db.inc';
try {
    $db = new PDO(DSN, USER, PASS); 
    $statement = $db->prepare('SELECT * FROM persona;'); 
    $statement->execute(
    ); 
} catch (PDOException $e) {
    die("Error : " . $e->getMessage());
} catch (Exception $ex) {
    die("Error : " . $ex->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=., initial-scale=1.0">
    <title>Persona</title>
    <style>
        table,
        tr,
        td,
        th {
            border: thin solid black;
            border-collapse: collapse;
            padding: 0.25em 1em;
        }
    </style>
</head>

<body>
    
    <form method="GET" action="play.php">
        <select name="table" onchange="document.forms[0].submit();">
            <?php
            foreach ($statement as $key => $row) {
                $table=$persona;
                echo '<option value="', $row['id'], '"',
                $row['id']==$table? 'SELECTED':'' ,'>', $row['name'], '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Envoyer" name="">
    </form>
    
</body>
</html>