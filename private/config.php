<?php

session_start();
$db_name = 'sisger';
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_password);

$base = 'localhost/sisger/LRISisger/src/views/adm/pages';


