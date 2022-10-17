<?php

const DSN = "mysql:host=us-cdbr-east-06.cleardb.net;dbname=heroku_0c93e90c8a69bf0;" ;
const USER = "b413372f80993a" ;
const PASSWORD = "7b190f1b" ;

 $db = new PDO(DSN, USER, PASSWORD) ;
function addtoListtable($listname,$id)
{
    
    global $db;
   if(!isAlreadyList($listname,$id))

   { 
     $stmt=$db->prepare("INSERT INTO liststable (listName,listBelongsTo) VALUES (?,?)");
    $stmt->execute([$listname,$id]);
}


}

function isAlreadyList($listname,$id)
{
    global $db;
    $stmt=$db->prepare("select * from liststable where listname=?");
    $stmt->execute([$listname]);
    if($stmt->rowCount()){
        $list=$stmt->fetch(PDO::FETCH_ASSOC);
        return $list;

    }
    return false;

}

function addContentToLists($listcontentname,$itemBelongsto,$listbelongsto)
{
    
    global $db;
   if(!alreadyinList($listcontentname,$itemBelongsto))

   { 
     $stmt=$db->prepare("INSERT INTO listcontents (listcontentname,itemBelongsto,completed,important,itemsbelongstouser) VALUES (?,?,?,?,?)");
    $stmt->execute([$listcontentname,$itemBelongsto,0,0,$listbelongsto]);
   }
}
function alreadyinList($listcontentname,$itemBelongsto)
{
    global $db;
    $stmt=$db->prepare("select * from listcontents where listcontentname=? and itemBelongsto=$itemBelongsto");
    $stmt->execute([$listcontentname]);
    if($stmt->rowCount()){
        $listitem=$stmt->fetch(PDO::FETCH_ASSOC);
        return $listitem;

    }
    return false;

}


 function checkUser($email, $pass){

    global $db;
    $stmt=$db->prepare("select * from registeredusers where email=?");
    $stmt->execute([$email]);
    if($stmt->rowCount()){
        $user=$stmt->fetch(PDO::FETCH_ASSOC);
        return password_verify($pass,$user["password"]);

    }
    return false;

 }

 function registerUser($name,$email,$pass,$file)
 {
    
    global $db;
    if (!checkUser($email,$pass))
    {
        $stmt=$db->prepare("INSERT INTO registeredusers(Username,email,password,file) VALUES (?,?,?,?)");
        $stmt->execute([$name,$email,password_hash($pass,PASSWORD_BCRYPT),$file]);
        


    }
 }
function getUser($email)
{
    global $db;
    $stmt=$db->prepare("select * from registeredusers where email=?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function validSession() {
    return isset($_SESSION["user"]) ;
}
