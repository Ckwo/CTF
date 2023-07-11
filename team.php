<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
    exit();
}else{
    include "db.php";
    if(isset($_POST["accpet"])){
        
        $id = $_POST["accpet"];
     $stm4 = "SELECT * FROM ctf WHERE id='$id'";
    $f4 = $con->prepare($stm4);
    $f4->execute();
     
    $data4 = $f4->fetch();
       #$qu = "UPDATE `ctf` SET `wait_team`='0' WHERE `id`= '".$_POST['accept']."'";
       #$con->prepare($qu)->execute();

    $stm = "SELECT * FROM ctf_teams WHERE id='".$data4["wait_team"]."'";
    $f = $con->prepare($stm);
    $f->execute();
    $data = $f->fetch();
        
        $qu = "UPDATE `ctf` SET `team_id` ='".$data['id']."',`wait_team`='0' WHERE `id`= '".$id."'";
        $con->prepare($qu)->execute();
        
        
        
        $r = $data["count_members"]+1;
        
        
        $q2 = "UPDATE `ctf_teams` SET `count_members`='".$r."' WHERE `id`=".$data["id"];
        $con->prepare($q2)->execute();
        
        
       $text = "\nNew Accept ID ".$_POST['accept']." [ ".date('Y-m-d H:i:s')." ] ";


    $fp = fopen('logs/'.$data4['team_id'].'.txt', 'a');//opens file in append mode  
    fwrite($fp, $text."\n");    
    fclose($fp);
    }
   if(isset($_POST['unkick'])){
       $username = $_SESSION["username"]["username"];
     $stm4 = "SELECT * FROM ctf WHERE username='$username'";
    $f4 = $con->prepare($stm4);
    $f4->execute();
     
    $data4 = $f4->fetch();
       $qu = "UPDATE `ctf` SET `kicked_team`='0' WHERE `id`= '".$_POST['unkick']."'";
       $con->prepare($qu)->execute();
       $text = "\nNew UnKicked ID ".$_POST['unkick']." [ ".date('Y-m-d H:i:s')." ] ";

    $fp = fopen('logs/'.$data4['team_id'].'.txt', 'a');//opens file in append mode  
    fwrite($fp, $text."\n");    
    fclose($fp); 
       
   } 
if(isset($_POST['join'])){
    $open = "notopen";
    if($open == "open"){
        $username = $_SESSION["username"]["username"];
    $_POST["team_name"] =filter_var($_POST['team_name'],FILTER_SANITIZE_STRING);
    //''
    #$stm ='SELECT * FROM ctf_teams WHERE team_name="'.$_POST["team_name"].'"';
    
    $stm = "SELECT * FROM ctf_teams WHERE team_name='".$_POST["team_name"]."'";
    $f = $con->prepare($stm);
    $f->execute();
    $data = $f->fetch();
    
    if(!$data){
        echo "Not Found Team";
    }
    else{
        

    $stm1 = "SELECT * FROM ctf WHERE username='".$username."'";
    $f1 = $con->prepare($stm1);
    $f1->execute();
    $data1 = $f1->fetch();
    if($data1["kicked_team"] == $data['id']){
        echo "You Kicked";

    }
    
    else{
        $qu = "UPDATE `ctf` SET `team_id`='".$data['id']."' WHERE `username`= '".$username."'";
        $con->prepare($qu)->execute();
        $r = $data["count_members"]+1;
            $q2 = "UPDATE `ctf_teams` SET `count_members`='".$r."' WHERE `id`=".$data["id"];
        $con->prepare($q2)->execute();
    $text = "\nNew Join Username ".$username." [ ".date('Y-m-d H:i:s')." ] ";

    $fp = fopen('logs/'.$data['id'].'.txt', 'a');//opens file in append mode  
    fwrite($fp, $text."\n");    
    fclose($fp); 
    }
    
    }
    
    }
    
    
    
    
    else{
          $username = $_SESSION["username"]["username"];
    $_POST["team_name"] =filter_var($_POST['team_name'],FILTER_SANITIZE_STRING);
    //''
    #$stm ='SELECT * FROM ctf_teams WHERE team_name="'.$_POST["team_name"].'"';
    
    $stm = "SELECT * FROM ctf_teams WHERE team_name='".$_POST["team_name"]."'";
    $f = $con->prepare($stm);
    $f->execute();
    $data = $f->fetch();
    if(!$data){
        echo "Not Found Team";
    }
    else{
     $stm1 = "SELECT * FROM ctf WHERE username='".$username."'";
    $f1 = $con->prepare($stm1);
    $f1->execute();
    $data1 = $f1->fetch();
    
    
    if($data1["kicked_team"] == $data['id']){
        echo "You Kicked";

    }else{
        $qu = "UPDATE `ctf` SET `wait_team`='".$data['id']."' WHERE `username`= '".$username."'";
        $con->prepare($qu)->execute();
        #$r = $data["count_members"]+1;
        #$q2 = "UPDATE `ctf_teams` SET `count_members`='".$r."' WHERE `id`=".$data["id"];
        #$con->prepare($q2)->execute();
        echo "Is team privte wait owner accpet your request";
    $text = "\nNew Need Join Username ".$username." [ ".date('Y-m-d H:i:s')." ] ";

    $fp = fopen('logs/'.$data['id'].'.txt', 'a');//opens file in append mode  
    fwrite($fp, $text."\n");    
    fclose($fp); 
    }
    }
    }
    
    
}
if(isset($_POST['Delete'])){
    

    $username = $_SESSION["username"]["username"];
     $stm4 = "SELECT * FROM ctf WHERE username='$username'";
    $f4 = $con->prepare($stm4);
    $f4->execute();
     
    $data4 = $f4->fetch();
    unlink("logs/".$data4['team_id'].".txt");

    $q2 = "DELETE FROM `ctf_teams` WHERE `id`=".$data4["team_id"];

    $query = "SELECT * FROM ctf WHERE team_id=".$data4['team_id']."";
    foreach($con->query($query) as $row){
        $con->query($q2)->execute();
        $qu = "UPDATE `ctf` SET `team_id`='0',`wait_team`='0' WHERE `id`=".$row["id"]."";
        $con->prepare($qu)->execute();
        
    }

    
}
if(isset($_POST['submit']))
{
    $id_kick = $_POST['submit'];
    $username = $_SESSION["username"]["username"];
    $stm = "SELECT * FROM ctf WHERE id='$id_kick'";
    $f = $con->prepare($stm);
    $f->execute();
      
    $data = $f->fetch();
    
    $stm2 = "SELECT * FROM ctf WHERE username='$username'";
    $f2 = $con->prepare($stm2);
    $f2->execute();
      
    $data2 = $f2->fetch();
    
    $stm3 = "SELECT * FROM ctf_teams WHERE id='".$data2['team_id']."'";
    $f3 = $con->prepare($stm3);
    $f3->execute();
      
    $data3 = $f3->fetch();
    if($data["team_id"] == $data2["team_id"] && $data2["id"] == $data3["owner_id"]){
        $text = "\nNew Kicked Username ".$username." [ ".date('Y-m-d H:i:s')." ] ";
        $fp = fopen('logs/'.$data2['team_id'].'.txt', 'a');//opens file in append mode  
        fwrite($fp, $text."\n");    
        fclose($fp); 
        $qu = "UPDATE `ctf` SET `team_id`='0' ,`wait_team`='0', `kicked_team`='".$data["team_id"]."' WHERE `id`=".$data['id']."";
        $con->prepare($qu)->execute();


    }
    
    
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/2e88d1e88c.js" crossorigin="anonymous"></script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cyberthon CTF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="css/bootstrap4-neon-glow.min.css">


    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel='stylesheet' href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <link rel="stylesheet" href="css/main.css">
    
</head>



<body class="imgloaded">
    <div class="glitch">
        <div class="glitch__img"></div>
        <div class="glitch__img"></div>
        <div class="glitch__img"></div>
        <div class="glitch__img"></div>
        <div class="glitch__img"></div>
    </div>
    <div class="navbar-dark text-white">
        <div class="container">
            <nav class="navbar px-0 navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a href="index.php" class="pl-md-0 p-3 text-decoration-none text-light">
                            <h3 class="bold"><span class="color_danger">rnk</span><span class="color_white">CTF</span></h3>
                        </a>
                    </div>
                    <div class="navbar-nav ml-auto">
                    <?php include "fot.php";?>
                    </div>
                </div>
            </nav>

        </div>
    </div>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <h1 class="display-1 bold color_white content__title">RNK CTF<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        Type your credentials to conquer the world
                        
                    </p>
                    
                    <form name="form" action="" method="post">

                    <div class="row hackerFont">
                     
                        <div class="col-md-6">
                            
                            <?php
                            
                            $username = $_SESSION["username"]["username"];
                            $stm = "SELECT * FROM ctf WHERE username='$username'";
                            $f = $con->prepare($stm);
                            $f->execute();
                              
                            $data = $f->fetch();
                            
                            $stm2 = "SELECT * FROM ctf_teams WHERE id='".$data['team_id']."'";
                            $f2 = $con->prepare($stm2);
                            $f2->execute();
                              
                            $data2 = $f2->fetch();
                           
                             #echo '<button value="exit" class="btn btn-outline-danger btn-shadow px-1 my-2 ml-0 ml-sm-1 text-left typewriter" type="submit" name="Delete">
                         #<h7>Delete</h7>
                         #</button>';
                          
                            if($data["team_id"] == 0){
                                
                            
                            #echo '<script>alert("'..'")</script>'; 
                            echo '
                            <form name="form" action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="team_name" id="team_name" placeholder="Team Name">
                            </div>
                            <div class="col-xl-8">
                            <button class="btn btn-outline-danger btn-shadow px-1 my-2 ml-0 ml-sm-1 text-left typewriter" type="submit" name="join">
                            <h4>Join</h4>
                    
                            </button>
                            <small id="registerHelp" class="mt-3 form-text text-muted">Not Registered? <a href="team_new.php">Register here</a></small>
                            </div>
                            </form>';}
                            
                            if($data["team_id"] != 0){
                                if($data['id'] == $data2["owner_id"]){
                                echo '<div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
            <div class="row mt-5  justify-content-center">
                <div class="col-xl-10">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark hackerFont">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Points</th>
                                
<th><button value="exit" class="btn btn-outline-danger btn-shadow px-1 my-2 ml-0 ml-sm-1 text-left typewriter" type="submit" name="Delete">
                         <h7>Delete</h7>
                         </button></th>
                            </tr>
                        </thead>
                        <tbody>';
                            }else{
                                
                            
                                
                                #echo "Your Team ".$data["team_id"];
                                echo '<div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
            <div class="row mt-5  justify-content-center">
                <div class="col-xl-10">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark hackerFont">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Points</th>
                                

                            </tr>
                        </thead>
                        <tbody>';}
                        
    #include "db.php";
    
    $query = "SELECT * FROM ctf WHERE team_id=".$data['team_id']." OR kicked_team=".$data['team_id']." OR wait_team=".$data['team_id']."";
    //$count  = $conn->query($query);
    
    //echo $row["username"]." \ ".$row["points"];
    $i=0;
    foreach($con->query($query) as $row){
     $i+=1;
   
         if($row['id'] == $data2["owner_id"]){
                      echo '
     <tr>
     <th scope="row">'.$row['id'].'</th>
     <td><i class="fa-solid fa-crown"></i> '. $row["username"].'</td>
     <td>'.$row["points"].'</td>
     <td>';
              #echo '<td><i class="fa-solid fa-crown"></i>'.$row["username"].'</td>';

     }else{
         echo '
     <tr>
     <th scope="row">'.$row['id'].'</th>
     <td>'. $row["username"].'</td>
     <td>'.$row["points"].'</td>
     <td>';
     }
     //<i class="fa-solid fa-crown"></i>
     
     if($data['id'] == $data2["owner_id"]){
         if($row["id"] != $data2["owner_id"] and $row["kicked_team"] != $data['team_id']and $row["wait_team"] != $data['team_id']){
         
         echo '<button value="'.$row["id"].'" class="btn btn-outline-danger btn-shadow px-1 my-2 ml-0 ml-sm-1 text-left typewriter" type="submit" name="submit">
     <h7>Kick</h7>
     </button>';
         }
         if($row["id"] != $data2["owner_id"] and $row["kicked_team"] == $data['team_id']){
         
         echo '<button value="'.$row["id"].'" class="btn btn-outline-danger btn-shadow px-1 my-2 ml-0 ml-sm-1 text-left typewriter" type="submit" name="unkick">
     <h7>UnKick</h7>
     </button>';
         }if($row["id"] != $data2["owner_id"] and $row["wait_team"] == $data['team_id']){
         
         echo '<button value="'.$row["id"].'" class="btn btn-outline-danger btn-shadow px-1 my-2 ml-0 ml-sm-1 text-left typewriter" type="submit" name="accpet">
     <h7>Accpet</h7>
     </button>';
         }
     }
         
     
     echo '
   </td>

     </tr>';
    }
    echo "    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>";
                            }
                             if($data["team_id"] != 0){
    $logs =  file_get_contents("logs/".$data['team_id'].".txt");
    echo '<div class="form-group" > <textarea type="text" rows="5" class="form-control" name="logs" id="souce_code" placeholder="logs" style="margin-left: 220%; margin-right: -60%; height: 40vh !important; width:150%;
    color: #FFF;
    background: transparent;
    border: none;
    outline: none;">'.$logs.'</textarea> </div>';}
    
    
    ?>

                            
                            
                            
                            
                            
                    
                        </div>
                    
                    </div>
                    </form>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
<?php

/*
if(isset($_POST["submit"])){


include "db.php";
$username = $_POST['username'];
#$password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
$err = [];


if(empty($err)){
    $stm = "SELECT * FROM ctf WHERE username='$username'";
    $f = $con->prepare($stm);
    $f->execute();
    $data = $f->fetch();
    if(!$data){
        echo "Bad login";
    }else{
        $password_hash=$data['passwrod']; 
        $password = $_POST['password'];


        if(password_verify($password,$password_hash)){
            
            echo "true";
            $_SESSION["username"]=[
                'username'=>$username,
                'passwrod'=>$password
            ];
            
            $text = "New Login User $username [ ".date('Y-m-d H:i:s')." ] ";

            $fp = fopen('logs.txt', 'a');//opens file in append mode  
            fwrite($fp, $text."\n");    
            fclose($fp);   
        
            header("location:quests.php");
        }else{
            
            echo "false";
        }
          
        
    }
}
}

*/
?>









