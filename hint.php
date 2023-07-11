<?php

include "db.php";  
session_start();    
$flag_id = $_GET["flag_id"];
$stm = 'SELECT * FROM ctf_c WHERE id="'.$flag_id.'"';
$f = $con->prepare($stm);
$f->execute();
$data = $f->fetch();
if(!$data){
    echo "not";
}else{
        $username = $_SESSION["username"]["username"];  
    $stm2 = "SELECT * FROM ctf WHERE username='$username'";
    $f2 = $con->prepare($stm2);
    $f2->execute();
    $data2 = $f2->fetch();
    if($data2["team_id"] !="0" ){
        $stmt = "SELECT * FROM ctf_teams WHERE id='".$data2["team_id"]."'";
        $ft = $con->prepare($stmt);
        $ft->execute();
        $t = $ft->fetch();
        if($t[$data["titile"]] == "0"){
            #$username = $_SESSION["username"]["username"];
        $chang = $data["titile"];
        $points = $data2['points'];
        $qqq = $t['count_points']-30;
        $qy3z = "UPDATE `ctf_teams` SET `count_points`='".$qqq."',`".$data["titile"]."`= 3 WHERE id='".$data2["team_id"]."'";
        
        #$qy3z = "UPDATE ctf_teams SET count_points='".$data['points']+$t['count_points']."' , ".$t[$data["titile"]]."= 1  WHERE id='".$data2["team_id"]."'";
        $con->prepare($qy3z)->execute();
        echo $data["hint"];
        $text = 'New Use Hint Username : '.$username.' | Name Challenge : '.$data["hash"].' [ '.date("Y-m-d H:i:s").' ] ';

        $fp2 = fopen('logs/'.$data2["team_id"].'.txt', 'a');//opens file in append mode  
        fwrite($fp2, "\n".$text);    
        fclose($fp2);
        }
        if($t[$data["titile"]] == "3"){
            echo $data["hint"]; 
        }
        
    }
}
?>