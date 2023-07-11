<?php
include "db.php";
session_start();  
$USER = $_SESSION['username']['username'];
$stm = "SELECT * FROM ctf WHERE username='$USER'";
$f = $con->prepare($stm);
$f->execute();
$data = $f->fetch();
$list = $data['list'];
$aa = explode(",",$list);
foreach($aa as $line){

    $name= explode(":",$line)[0];
    if($name == "xss1"){
        $value= explode(":",$line)[1];
       if($value == "1"){
        echo "<h1>finshed</h1>";
        exit();
       }
    }
    #echo $line;
}

$USER = $_SESSION['username']['username'];
$stm = "SELECT * FROM ctf WHERE username='$USER'";
$f = $con->prepare($stm);
$f->execute();
$data = $f->fetch();
$p = 80+$data['points'];
$qy = "UPDATE ctf SET points='$p' WHERE username='".$_SESSION["username"]["username"]."'";
$qy2 = "UPDATE ctf SET list='xss1:1,' WHERE username='".$_SESSION["username"]["username"]."'";


$con->prepare($qy)->execute();
$con->prepare($qy2)->execute();
# echo "DONE";


?>