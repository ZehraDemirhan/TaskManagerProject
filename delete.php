<?php


session_start();
header("Content-Type: application/json");
require "db.php";

$id=$_GET['id'];

$stmt2=$db->prepare("select * from listcontents where id=?");
$stmt2->execute([$id]);
$item=$stmt2->fetch(PDO::FETCH_ASSOC);


$stmt=$db->prepare("DELETE from listcontents where id=?");
$stmt->execute([$id]);







echo json_encode(["iscomp" => $item['completed']]) ;