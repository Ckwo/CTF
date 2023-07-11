


<?php
session_start();  
    if(!isset($_SESSION["username"])){
        header("location:login.php");
        exit();
    }
    include "db.php";
    $username = $_SESSION["username"]["username"];
    $sql_list = "SELECT * FROM ctf WHERE username='$username' ";
    $f = $con->prepare($sql_list);
    $f->execute();
    $data = $f->fetch(); 
    if($data["team_id"] == "0"){
        header("location:team.php");

        exit();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
</head>

<body>
<div class="glitch">
            <div class="glitch__img"></div>
            <div class="glitch__img"></div>
            <div class="glitch__img"></div>
            <div class="glitch__img"></div>
            <div class="glitch__img"></div>
        </div>
    <div class="navbar-dark text-white">
        <div class="container">
            <nav class="navbar px-0 py-0 navbar-expand-lg navbar-dark">
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
    
    <div class="jumbotron bg-transparent mb-0 pt-0 radius-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-12  text-center">
                    <h1 class="display-1 bold color_white content__title"><?php
    include "db.php";
    $username = $_SESSION["username"]["username"];
    $sql_list = "SELECT * FROM ctf WHERE username='$username' ";
    $f = $con->prepare($sql_list);
    $f->execute();
    $data = $f->fetch(); 
    echo $data['points'];?><span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey text-spacey hackerFont lead mb-5">
                        It's time to show the world what you can do!
                    </p>
                </div>
            </div>
            <div class="row hackerFont">

<script>
                 function go(id){

                      Swal.fire({
  title: 'Are you sure?',
  text: '30 points will be deducted from your team',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.isConfirmed) {
  var xmlHttp = new XMLHttpRequest();
                    //var dd =document.getElementById("flag_131").value
                    xmlHttp.open( "GET", "hint.php?flag_id="+id, false );

                    xmlHttp.send( null );
                   
    Swal.fire(
      'Hint',
      xmlHttp.response,
      'success'
    )
  }
})
                 }
</script>  
                
<?php
 #echo "<script>alert(0)</script>";
#session_start();       
include "db.php";      

$sql = "SELECT * FROM ctf_c ORDER BY qsm";
$users = $con->query($sql);



$web= 0;
$forensic= 0;
$crypto= 0;
$general_information= 0;
$malware= 0;
foreach ($users as $row) {
    
    $tit = $row["hash"];
    $tit2 = $row["titile"];
    $dis = $row["descripson"];
    $points = $row["points"];
    $solvers = $row["solvers"];
    $id = $row["id"];
    $souce_code = $row["souce_code"];
    $url = $row["url"];
    $hint= $row['hint'];
    $qsm = $row['qsm'];
    $username = $_SESSION["username"]["username"];
    $sql_list = "SELECT * FROM ctf WHERE username='$username' ";
    #$list = $con->query($sql_list);
    $os = array("id", "username", "passwrod", "points","list");
    $f = $con->prepare($sql_list);
    $f->execute();
    $data = $f->fetch();
    
    
    $sql_list2 = "SELECT * FROM ctf_teams WHERE id='".$data["team_id"]."' ";
    #$list = $con->query($sql_list);
    
    $f2 = $con->prepare($sql_list2);
    $f2->execute();
    $ctf_teams = $f2->fetch();
    
    
    if($qsm == "0"){
        if($web == 0){
        echo '
    <div class="col-md-12">
    <h4>Web</h4>
    </div>';
    $web=1;
        }

    


    #print_r($list);
    #echo $key;
    if($ctf_teams[$tit2] == "1"){
        $solved = "solved";
    }else{
        $solved = "notsolved";
    }
    
    #if()

    echo '<div class="col-md-4 mb-3">
    <div class="card category_web">
    <div class="card-header '.$solved.'" data-target="#problem_id_'.$id.'" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_'.$id.'">
        '.$tit.' <span class="badge">'.$solved.'</span> <span class="badge">'.$points.' points</span>
    </div>
    <div id="problem_id_'.$id.'" class="collapse card-body">
        <blockquote class="card-blockquote">
            <div style="display: flex;">
                <h6 class="solvers">Solvers: <span class="solver_num">'.$solvers.'</span> <br>
               
            </div>
            <p> '.$dis.'
            </p>';
            if(strpos($url, 'http') !== false){
                echo '<a target="_blank" href="'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-download""></span>Download</a>';
            }else{
                echo '<a target="_blank" href="/'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-play"></span>Start</a>';
            }
            echo'
             <a href="#hint_'.$id.'" onclick="go('.$id.')" data-toggle="modal" data-target="#hint_'.$id.'" class="btn btn-outline-secondary btn-shadow"><span class="far fa-lightbulb mr-2"></span>Hint</a>

            <div class="input-group mt-3">

                <input type="text" class="form-control" name="flag_'.$id.'" id="flag_'.$id.'" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button id="submit_'.$id.'" name="submit_'.$id.'" class="btn btn-outline-secondary" onclick=myFunction'.$id.'() type="button">Go!</button>
                </div>
                <script>
                 
                function myFunction'.$id.'() {
                    var xmlHttp = new XMLHttpRequest();
                    var dd =document.getElementById("flag_'.$id.'").value
                    xmlHttp.open( "GET", "api_check.php?flag_id='.$id.'&flag_text="+dd, false );

                    xmlHttp.send( null );
                    if("done" == xmlHttp.response){
                        
                          Swal.fire(
                            \'SUCCESS\',
                            \'Awesome, you solved this challenge\',
                            \'success\'
                          )
                        
                    }
                    if("Already" == xmlHttp.response){
                       
                        Swal.fire(
                            \'ERROR\',
                            \'This challenge has already been solved\',
                            \'error\'
                          )
                    }
                    if("bad" == xmlHttp.response){
                       
                        Swal.fire(
                            \'WRONG\',
                            \'Oh, the flag is wrong, try again\',
                            \'warning\'
                          )
                    }
                    
                }
                
                </script>
            </div>

        </blockquote>
    </div>
    
</div>

</div>';
    }if($qsm == "1"){
        if($forensic == 0){
        echo '
    <div class="col-md-12">
    <h4>Forensic</h4>
    </div>';
    $forensic=1;
        }

    


    #print_r($list);
    #echo $key;
    if($ctf_teams[$tit2] == "1"){
        $solved = "solved";
    }else{
        $solved = "notsolved";
    }
    
    #if()
    
    echo '<div class="col-md-4 mb-3">
    <div class="card category_web">
    <div class="card-header '.$solved.'" data-target="#problem_id_'.$id.'" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_'.$id.'">
        '.$tit.' <span class="badge">'.$solved.'</span> <span class="badge">'.$points.' points</span>
    </div>
    <div id="problem_id_'.$id.'" class="collapse card-body">
        <blockquote class="card-blockquote">
            <div style="display: flex;">
                <h6 class="solvers">Solvers: <span class="solver_num">'.$solvers.'</span> <br>
               
            </div>
            <p> '.$dis.'
            </p>';
            if(strpos($url, 'http') !== false){
                echo '<a target="_blank" href="'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-download""></span>Download</a>';
            }else{
                echo '<a target="_blank" href="/'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-play"></span>Start</a>';
            }
            echo'<a href="#hint_'.$id.'" onclick="go('.$id.')" data-toggle="modal" data-target="#hint_'.$id.'" class="btn btn-outline-secondary btn-shadow"><span class="far fa-lightbulb mr-2"></span>Hint</a>

            <div class="input-group mt-3">

                <input type="text" class="form-control" name="flag_'.$id.'" id="flag_'.$id.'" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button id="submit_'.$id.'" name="submit_'.$id.'" class="btn btn-outline-secondary" onclick=myFunction'.$id.'() type="button">Go!</button>
                </div>
                <script>

                function myFunction'.$id.'() {
                    var xmlHttp = new XMLHttpRequest();
                    var dd =document.getElementById("flag_'.$id.'").value
                    xmlHttp.open( "GET", "api_check.php?flag_id='.$id.'&flag_text="+dd, false );

                    xmlHttp.send( null );
                    if("done" == xmlHttp.response){
                        
                          Swal.fire(
                            \'SUCCESS\',
                            \'Awesome, you solved this challenge\',
                            \'success\'
                          )
                        
                    }
                    if("Already" == xmlHttp.response){
                       
                        Swal.fire(
                            \'ERROR\',
                            \'This challenge has already been solved\',
                            \'error\'
                          )
                    }
                    if("bad" == xmlHttp.response){
                       
                        Swal.fire(
                            \'WRONG\',
                            \'Oh, the flag is wrong, try again\',
                            \'warning\'
                          )
                    }
                    
                }
                
                </script>
            </div>

        </blockquote>
    </div>
    
</div>

</div>';
    }if($qsm == "2"){
        if($crypto == 0){
        echo '
    <div class="col-md-12">
    <h4>Crypto</h4>
    </div>';
    $crypto=1;
        }

    


    #print_r($list);
    #echo $key;
    if($ctf_teams[$tit2] == "1"){
        $solved = "solved";
    }else{
        $solved = "notsolved";
    }
    
    #if()
    
    echo '<div class="col-md-4 mb-3">
    <div class="card category_web">
    <div class="card-header '.$solved.'" data-target="#problem_id_'.$id.'" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_'.$id.'">
        '.$tit.' <span class="badge">'.$solved.'</span> <span class="badge">'.$points.' points</span>
    </div>
    <div id="problem_id_'.$id.'" class="collapse card-body">
        <blockquote class="card-blockquote">
            <div style="display: flex;">
                <h6 class="solvers">Solvers: <span class="solver_num">'.$solvers.'</span> <br>
               
            </div>
            <p> '.$dis.'
            </p>';
            if(strpos($url, 'http') !== false){
                echo '<a target="_blank" href="'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-download""></span>Download</a>';
            }else{
                echo '<a target="_blank" href="/'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-play"></span>Start</a>';
            }
            echo'<a href="#hint_'.$id.'" onclick="go('.$id.')" data-toggle="modal" data-target="#hint_'.$id.'" class="btn btn-outline-secondary btn-shadow"><span class="far fa-lightbulb mr-2"></span>Hint</a>

            <div class="input-group mt-3">

                <input type="text" class="form-control" name="flag_'.$id.'" id="flag_'.$id.'" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button id="submit_'.$id.'" name="submit_'.$id.'" class="btn btn-outline-secondary" onclick=myFunction'.$id.'() type="button">Go!</button>
                </div>
                <script>

                function myFunction'.$id.'() {
                    var xmlHttp = new XMLHttpRequest();
                    var dd =document.getElementById("flag_'.$id.'").value
                    xmlHttp.open( "GET", "api_check.php?flag_id='.$id.'&flag_text="+dd, false );

                    xmlHttp.send( null );
                    if("done" == xmlHttp.response){
                        
                          Swal.fire(
                            \'SUCCESS\',
                            \'Awesome, you solved this challenge\',
                            \'success\'
                          )
                        
                    }
                    if("Already" == xmlHttp.response){
                       
                        Swal.fire(
                            \'ERROR\',
                            \'This challenge has already been solved\',
                            \'error\'
                          )
                    }
                    if("bad" == xmlHttp.response){
                       
                        Swal.fire(
                            \'WRONG\',
                            \'Oh, the flag is wrong, try again\',
                            \'warning\'
                          )
                    }
                    
                }
                
                </script>
            </div>

        </blockquote>
    </div>
    
</div>

</div>';
    }if($qsm == "3"){
        if($general_information == 0){
        echo '
    <div class="col-md-12">
    <h4>General information</h4>
    </div>';
    $general_information=1;
        }

    


    #print_r($list);
    #echo $key;
    if($ctf_teams[$tit2] == "1"){
        $solved = "solved";
    }else{
        $solved = "notsolved";
    }
    
    #if()
    
    echo '<div class="col-md-4 mb-3">
    <div class="card category_web">
    <div class="card-header '.$solved.'" data-target="#problem_id_'.$id.'" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_'.$id.'">
        '.$tit.' <span class="badge">'.$solved.'</span> <span class="badge">'.$points.' points</span>
    </div>
    <div id="problem_id_'.$id.'" class="collapse card-body">
        <blockquote class="card-blockquote">
            <div style="display: flex;">
                <h6 class="solvers">Solvers: <span class="solver_num">'.$solvers.'</span> <br>
               
            </div>
            <p> '.$dis.'
            </p>';
            if(strpos($url, 'http') !== false){
                echo '<a target="_blank" href="'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-download""></span>Download</a>';
            }else{
                echo '<a target="_blank" href="/'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-play"></span>Start</a>';
            }
            echo'<a href="#hint_'.$id.'" onclick="go('.$id.')" data-toggle="modal" data-target="#hint_'.$id.'" class="btn btn-outline-secondary btn-shadow"><span class="far fa-lightbulb mr-2"></span>Hint</a>

            <div class="input-group mt-3">

                <input type="text" class="form-control" name="flag_'.$id.'" id="flag_'.$id.'" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button id="submit_'.$id.'" name="submit_'.$id.'" class="btn btn-outline-secondary" onclick=myFunction'.$id.'() type="button">Go!</button>
                </div>
                <script>

                function myFunction'.$id.'() {
                    var xmlHttp = new XMLHttpRequest();
                    var dd =document.getElementById("flag_'.$id.'").value
                    xmlHttp.open( "GET", "api_check.php?flag_id='.$id.'&flag_text="+dd, false );

                    xmlHttp.send( null );
                    if("done" == xmlHttp.response){
                        
                          Swal.fire(
                            \'SUCCESS\',
                            \'Awesome, you solved this challenge\',
                            \'success\'
                          )
                        
                    }
                    if("Already" == xmlHttp.response){
                       
                        Swal.fire(
                            \'ERROR\',
                            \'This challenge has already been solved\',
                            \'error\'
                          )
                    }
                    if("bad" == xmlHttp.response){
                       
                        Swal.fire(
                            \'WRONG\',
                            \'Oh, the flag is wrong, try again\',
                            \'warning\'
                          )
                    }
                    
                }
                
                </script>
            </div>

        </blockquote>
    </div>
    
</div>

</div>';
    }if($qsm == "4"){
        if($malware == 0){
        echo '
    <div class="col-md-12">
    <h4>Malware</h4>
    </div>';
    $malware=1;
        }

    


    #print_r($list);
    #echo $key;
    if($ctf_teams[$tit2] == "1"){
        $solved = "solved";
    }else{
        $solved = "notsolved";
    }
    
    #if()
    
    echo '<div class="col-md-4 mb-3">
    <div class="card category_web">
    <div class="card-header '.$solved.'" data-target="#problem_id_'.$id.'" data-toggle="collapse" aria-expanded="false" aria-controls="problem_id_'.$id.'">
        '.$tit.' <span class="badge">'.$solved.'</span> <span class="badge">'.$points.' points</span>
    </div>
    <div id="problem_id_'.$id.'" class="collapse card-body">
        <blockquote class="card-blockquote">
            <div style="display: flex;">
                <h6 class="solvers">Solvers: <span class="solver_num">'.$solvers.'</span> <br>
               
            </div>
            <p> '.$dis.'
            </p>';
            if(strpos($url, 'http') !== false){
                echo '<a target="_blank" href="'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-download""></span>Download</a>';
            }else{
                echo '<a target="_blank" href="/'.$url.'" class="btn btn-outline-secondary btn-shadow"><span class="fa fa-solid fa-play"></span>Start</a>';
            }
            echo'<a href="#hint_'.$id.'" onclick="go('.$id.')" data-toggle="modal" data-target="#hint_'.$id.'" class="btn btn-outline-secondary btn-shadow"><span class="far fa-lightbulb mr-2"></span>Hint</a>

            <div class="input-group mt-3">

                <input type="text" class="form-control" name="flag_'.$id.'" id="flag_'.$id.'" placeholder="Enter Flag" aria-label="Enter Flag" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button id="submit_'.$id.'" name="submit_'.$id.'" class="btn btn-outline-secondary" onclick=myFunction'.$id.'() type="button">Go!</button>
                </div>
                <script>

                function myFunction'.$id.'() {
                    var xmlHttp = new XMLHttpRequest();
                    var dd =document.getElementById("flag_'.$id.'").value
                    xmlHttp.open( "GET", "api_check.php?flag_id='.$id.'&flag_text="+dd, false );

                    xmlHttp.send( null );
                    if("done" == xmlHttp.response){
                        
                          Swal.fire(
                            \'SUCCESS\',
                            \'Awesome, you solved this challenge\',
                            \'success\'
                          )
                        
                    }
                    if("Already" == xmlHttp.response){
                       
                        Swal.fire(
                            \'ERROR\',
                            \'This challenge has already been solved\',
                            \'error\'
                          )
                    }
                    if("bad" == xmlHttp.response){
                       
                        Swal.fire(
                            \'WRONG\',
                            \'Oh, the flag is wrong, try again\',
                            \'warning\'
                          )
                    }
                    
                }
                
                </script>
            </div>

        </blockquote>
    </div>
    
</div>

</div>';
    }
    

//echo "</div>";

}

?>
                
                
                
                
                
                
            </div>

        </div>
        <script>
            
            var dataset = [
                [41, 42, 43, 44, 45, 0], // keep the zero here
                [10, 9, 8, 7, 6, 0],
                [21, 16, 23, 1, 15, 0],
                [71, 12, 13, 17, 25, 0],
                [31, 5, 23, 24, 10, 0],
                [11, 2, 13, 41, 15, 0],
                [31, 5, 23, 24, 10, 0],
                [11, 2, 13, 41, 15, 0],
            ]

            function getBarChartData(i) {
                return barChartData = {
                    labels: ['Easy1', 'Easy2', 'Medium3', 'Hard4', 'Hard5'],
                    datasets: [{
                        label: 'Dataset 1',
                        backgroundColor: [
                            '#17b06b', '#17b06b', '#ffce56', '#ef121b', '#ef121b'
                        ],
                        borderColor: [
                            '#17b06b', '#17b06b', '#ffce56', '#ef121b', '#ef121b'
                        ],
                        borderWidth: 1,
                        data: dataset[i - 1]
                    }]

                };
            }

            window.onload = function() {
                var numcharts = 8;
                for (let i = 1; i <= numcharts; i++) {
                    var ctx = document.getElementById('problem_id_' + i + '_chart').getContext('2d');
                    window.myBar = new Chart(ctx, {
                        type: 'bar',
                        data: getBarChartData(i),
                        options: {
                            tooltips: {
                                enabled: false,
                            },
                            responsive: false,
                            legend: {
                                display: false,
                            },
                            scales: {
                                yAxes: [{
                                    display: false
                                }],
                                xAxes: [{
                                    display: false
                                }]
                            }
                        }
                    });
                    myBar.canvas.parentNode.style.width = '80px';
                    myBar.canvas.parentNode.style.height = '20px';
                }
            };
        </script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>