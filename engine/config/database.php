<?php
include "table.php";
$host = '153.92.1.76';
$dbname   = 'mriy_dbtest';
$user = 'mriy_dbtest';
$pass = 'dbtest';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$opt = [
    //PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $db = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

$sql = "SELECT * FROM ucp_settings";
$statement = $db->prepare($sql);
$statement->execute ();
$ucp_settings = $statement->fetch();


