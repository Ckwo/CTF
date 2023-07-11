


<?php  
session_start();
if(isset($_SESSION['username'])){
    header('location:quests.php');
    exit();
}
if(isset($_POST["submit"])){


include "db.php";
$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);

$password = password_hash($_POST['password'],PASSWORD_BCRYPT);

$err = [];

if(empty($username)&& empty($password)){
    
    $err[]= "Empty Pass&User"; 
}
$stm = "SELECT username FROM ctf WHERE username='$username'";
$f = $con->prepare($stm);
$f->execute();
$data = $f->fetch();
if($data){
    $err[] = "Username Used";
}
if(empty($err)){
    $qy = "INSERT INTO `ctf`( `username`, `passwrod`) VALUES ('$username','$password')";
    $_SESSION["username"]=[
        'username'=>$username,
        'passwrod'=>$password
    ];
    
    $con->prepare($qy)->execute();
    $text = "New Register User $username [ ".date('Y-m-d H:i:s')." ] ";

    $fp = fopen('logs.txt', 'a');//opens file in append mode  
    fwrite($fp, $text."\n");    
    fclose($fp);   
    header("location:quests.php");
}else{
    print_r($err);
}
}
?>









<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lakshya CTF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="css/bootstrap4-neon-glow.min.css">


    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel='stylesheet' href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="imgloaded">
    <div class="glitch">
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
        <div class="glitch__img glitch__img_register"></div>
    </div>
    <div class="navbar-dark text-white">
        <div class="container">
            <nav class="navbar px-0 navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a href="index.html" class="pl-md-0 p-3 text-decoration-none text-light">
                            <h3 class="bold"><span class="color_danger">LAKSHYA</span><span class="color_white">CTF</span></h3>
                        </a>
                    </div>
                    <div class="navbar-nav ml-auto">
                        <a href="index.html" class="p-3 text-decoration-none text-light bold">Home</a>
                        
                        <a href="hackerboard.php" class="p-3 text-decoration-none text-light bold">Hackerboard</a>
                        <a href="login.php" class="p-3 text-decoration-none text-light bold">Login</a>
                        <a href="register.php" class="p-3 text-decoration-none text-white bold">Register</a>
                    </div>
                </div>
            </nav>

        </div>
    </div>

    <div class="jumbotron bg-transparent mb-0 pt-3 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-10">
                    <h1 class="display-1 bold color_white content__title">LAKSHYA CTF<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        Join the community and be part of the future of the information security industry.
                    </p>
                    <form name="form" action="" method="post">
                    <div class="row  hackerFont">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" id="username" placeholder="username(ex. F15)">
                                <small id="reciept_id_help" class="form-text text-muted">Enter Here Username </small>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <small id="passHelp" class="form-text text-muted">Make sure nobody's behind you</small>
                            </div>
                            <div class="col-xl-12">
                            <button class="btn btn-outline-danger btn-shadow px-3 my-2 ml-0 ml-sm-1 text-left typewriter" type="submit" name="submit">
                    <h4>Register</h4>
                    </button>
                    <small id="registerHelp" class="mt-2 form-text text-muted">Already Registered? <a href="login.php">Login here</a></small>
                </div>
                        </div>
                    </div>
                    </form>
                </div>
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

