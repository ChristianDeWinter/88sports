<?php
$host = 'localhost';
$user = 'bit_academy';
$password = 'bit_academy';
$dbname = 'fitnessdb';

try {
    $dsn = 'mysql:host=' . $host . '; dbname=' . $dbname;
    $dbconn = new PDO($dsn, $user, $password);
    $dbconn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbconn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);   
} catch (PDOexception $error) {
    $error->getMessage();
    echo'failed to connect';
}
?>