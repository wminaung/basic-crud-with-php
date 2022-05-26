<?php

require "config.php";

$idToDelete =  $_GET['id'];

$qry = "DELETE FROM posts WHERE id=:id";
$stmt = $pdo->prepare($qry);
$stmt->bindValue(':id', $idToDelete);
$stmt->execute();

header('Location: index.php');
