<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
    exit();
}else{
    include "db.php";
    
if(isset($_POST['new'])){
    $_POST["team_name"] =filter_var($_POST['team_name'],FILTER_SANITIZE_STRING);
    $username = $_SESSION["username"]["username"];
    
    $stm4 = "SELECT * FROM ctf WHERE username='$username'";
    $f4 = $con->prepare($stm4);
    $f4->execute();
      
    $data4 = $f4->fetch();

        #$qu = "UPDATE `ctf` SET `team_id`='".$data['id']."' WHERE `username`=".$username."";
        #$con->prepare($qu)->execute();
        if($data4["team_id"] == "0"){
            #echo "<script>alert(0)</script>";
            
            $stm = "SELECT * FROM ctf_teams WHERE team_name='".$_POST["team_name"]."'";
            $f = $con->prepare($stm);
            $f->execute();
            $data = $f->fetch();
    
    
    
            if($data){
                echo "Used Team Name";
            }else{
                $qy = "INSERT INTO `ctf_teams` ( `team_name`, `owner_id`) VALUES ('".$_POST["team_name"]."','".$data4['id']."')";

                $d = $con->prepare($qy)->execute();
                
                $stmz = "SELECT * FROM ctf_teams WHERE team_name='".$_POST["team_name"]."'";
                $fz = $con->prepare($stmz);
                $fz->execute();
                $dataz = $fz->fetch();
                
                $qu = "UPDATE `ctf` SET `team_id`='".$dataz["id"]."' WHERE `id`=".$data4["id"]."";
                $con->prepare($qu)->execute();
                $name_file = "logs/".$dataz["id"].".txt";
                $myfile = fopen($name_file, "w") or die("Unable to open file!");
                $txt = "Welcome < ".$username." >";
                fwrite($myfile, $txt);
                #$txt = "Jane Doe\n";
                #fwrite($myfile, $txt);
                fclose($myfile);
                #$myfile = fopen($name_file, "w") or die("Unable to open file!".$dataz["id"]);

                
            }
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
        $qu = "UPDATE `ctf` SET `team_id`='0' WHERE `id`=".$data['id']."";
        $con->prepare($qu)->execute();
    }
    
    
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
                            
                            if($data["team_id"] == 0){
                                
                            
                            #echo '<script>alert("'..'")</script>'; 
                            echo '
                            <form name="form" action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="team_name" id="team_name" placeholder="Team Name">
                            </div>
                            <div class="col-xl-8">
                            <button class="btn btn-outline-danger btn-shadow px-1 my-2 ml-0 ml-sm-1 text-left typewriter" type="submit" name="new">
                            <h4>Create</h4>
                    
                            </button>
                            <small id="registerHelp" class="mt-3 form-text text-muted">You Have Team? <a href="team.php">here</a></small>
                            </div>
                            </form>';}
                            
    
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









