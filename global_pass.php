<?php
$hostname = 'http://ironlinks.ru';
$domain = 'http://ironlinks.ru/project';
define("DOMAIN", "/");

$host = 'localhost';
$user ='towerofpower';
$password ='qwe123098';
$db = 'supertest';

$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $password, $opt);
$pdo->exec("set names utf8");

$WHITE_LIST = array();
$tables_sql= $pdo->prepare("SHOW TABLES FROM $db");
$tables_sql->execute();
$i = 0;
while($table = $tables_sql->fetch()){
    $WHITE_LIST[$i] = $table["Tables_in_$db"];
    $i++;
}


require_once('functions/index.php');
?>