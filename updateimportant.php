<?php 
session_start();
header("Content-Type: application/json");
require "db.php";

$id=$_GET['id'];
$stmt1=$db->prepare("select * from listcontents where id=?");
$stmt1->execute([$id]);
$item=$stmt1->fetch(PDO::FETCH_ASSOC);


$stmt2=$db->prepare("UPDATE listcontents SET important=1-{$item['important']} where id=?");
$stmt2->execute([$id]);



echo json_encode(["important" => $item['important']]) ;