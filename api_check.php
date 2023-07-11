<?php
#session_start();      
include "db.php";  
session_start();    
$flag_id = $_GET["flag_id"];
$flag_text = $_GET["flag_text"];
$sql = "SELECT * FROM ctf_c";
$users = $con->query($sql);
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
        
    #echo $r;
    if($flag_text == $data["flag"] ){

        if($t[$data["titile"]] == "0" or $t[$data["titile"]] =="3"){

        
        $username = $_SESSION["username"]["username"];
        $chang = $data["titile"];
        $points = $data2['points'];
        
        $text = 'New Solve | Username : '.$username.' | Name Challenge : '.$data["hash"].' [ '.date("Y-m-d H:i:s").' ] ';
        $url ="https://api.telegram.org/bot5387499950:AAEMehjZn5vAM4dQuZndc5AIjVhRHDwkk48/sendMessage?chat_id=@Iogss&parse_mode=Markdown&text=$text";
        
        #$q = "UPDATE `ctf` SET `".$data['titile']."` = '1' WHERE `username`='$username' ";
        #$con->prepare($q)->execute();

        $all = $data['solvers']+1;
        $qy4 = "UPDATE ctf_c SET solvers='".$all."' WHERE id=".$data['id']."";
        $con->prepare($qy4)->execute();
        $qy3z = "UPDATE `ctf_teams` SET `count_points`='".$data['points']+$t['count_points']."',`".$data["titile"]."`= 1 WHERE id='".$data2["team_id"]."'";
        
        #$qy3z = "UPDATE ctf_teams SET count_points='".$data['points']+$t['count_points']."' , ".$t[$data["titile"]]."= 1  WHERE id='".$data2["team_id"]."'";
        $con->prepare($qy3z)->execute();

        $qy3 = "UPDATE ctf SET points='".$data['points']+$data2['points']."' WHERE username='".$_SESSION["username"]["username"]."'";
        $con->prepare($qy3)->execute();

        echo "done";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $result = json_decode($response);
        curl_close($ch); // Close the connection
        #echo $data['titile'];
        $fp = fopen('admin/logs.txt', 'a');//opens file in append mode  
        fwrite($fp, $text."\n");    
        fclose($fp); 
        
        $fp2 = fopen('logs/'.$data2["team_id"].'.txt', 'a');//opens file in append mode  
        fwrite($fp2, "\n".$text);    
        fclose($fp2);
    }else{
        echo "Already";

    }
    } else{
        echo "bad";

    }
}else{
    echo "Join Team Plzz";
}


}
    
?>
