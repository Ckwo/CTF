<?php

$dbhost = "localhost";
$username = "f15onlin_ctf";
$password = "Aa11223344@#@#";
$dbname = "f15onlin_ctf";
try{
$con = new PDO("mysql:host=$dbhost;dbname=$dbname",$username,$password);

    


}

catch(Exception $e){


exit();


}