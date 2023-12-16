<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    // set the PDO error mode to exception
    $pdo = new PDO("mysql:host=$servername;dbname=test;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

//$sth = $pdo->prepare("SELECT name FROM users");
//$sth->execute();
//
//$res = $sth -> fetchAll(PDO::FETCH_ASSOC);
//print_r($res);

