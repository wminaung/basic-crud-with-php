<?php

define('USER', 'root');
define('PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'curd');

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);

$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, USER, PASSWORD);
