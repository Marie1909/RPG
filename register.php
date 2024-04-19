<?php
session_start();
require_once 'conf/db.inc';

$table = $_GET['table'] ?? 'player';
try { // on demande de tester la variable $db
    // PHP Data Object
    $db = new PDO(DSN, USER, PASS);
    $statement = $db->prepare($sql); // on prépare la requête SELECT + sécurité dans la recherche
    $statement->execute(); // Exécution de la requête
} catch (PDOException $pdoe) { //$pdoe variable créer si il y a une erreur (exception) générer par PDO
    die("PDO Error : " . $pdoe->getMessage());
} catch (Exception $ex) { //$ex variable créer si il y a une erreur (exception) générer autre que PDO
    die("Error : " . $ex->getMessage());
}


try {
    $sql = 'INSERT INTO  player (name, passwd, email) ' .
    'VALUES(:pseudo, :passwd, :email);';

    $prepared_request = $db->prepare($sql);
    // Exécution de la requête
    $prepared_request->execute(
        [
            'pseudo_input' => $_POST['pseudo'],
            'passwd_input' => $_POST['passwd'],
        ]
    );

    $row = $prepared_request->fetch(PDO::FETCH_ASSOC);
    if ($row === FALSE) {
        header('location:register.html');
    } else {
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        header('location:index.html');
    }
} catch (PDOException $pdoe) {
    die("PDO Error : " . $pdoe->getMessage());
} catch (Exception $e) {
    die("Error : " . $e->getMessage());
}
