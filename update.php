<?php
session_start();
header("Content-Type: application/json");
require "db.php";

$id=$_GET['id'];
$stmt1=$db->prepare("select * from listcontents where listcontentname=?");
$stmt1->execute([$id]);
$item=$stmt1->fetch(PDO::FETCH_ASSOC);


$stmt2=$db->prepare("UPDATE listcontents SET completed=1-{$item['completed']} where listcontentname=?");
$stmt2->execute([$id]);





echo json_encode(["completed" => $item['completed']]) ;