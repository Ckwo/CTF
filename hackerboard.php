<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>rnk CTF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="css/bootstrap4-neon-glow.min.css">


    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel='stylesheet' href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="imgloaded">
    <div class="glitch">
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
        <div class="glitch__img glitch__img_leaderboard"></div>
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
                            <h3 class="bold"><span class="color_danger">Cyberthon</span><span class="color_white">CTF</span></h3>
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
                <div class="col-xl-12">
                    <h1 class="display-1 bold color_white content__title text-center"><span class="color_danger">HACKER</span>BOARD<span class="vim-caret">&nbsp;</span></h1>
                    <p class="text-grey lead text-spacey text-center hackerFont">
                        Where are the heroes ranked!
                    </p>
                    <div class="row justify-content-center my-5">

                    </div>
                </div>
            </div>
            <div class="row mt-5  justify-content-center">
                <div class="col-xl-10">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark hackerFont">
                            <tr>
                                <th>#</th>
                                <th>Team</th>
                                <th>Points</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php
    include "db.php";
    
    $query = "SELECT * FROM ctf_teams ORDER BY count_points DESC LIMIT 3";
    //$count  = $conn->query($query);
    
    //echo $row["username"]." \ ".$row["points"];
    $i=0;
    foreach($con->query($query) as $row){
     $i+=1;
     echo '
     <tr>
     <th scope="row">'.$i.'</th>
     <td>'.$row["team_name"].'</td>
     <td>'.$row["count_points"].'</td>

     </tr>';
    }
    
    
    
    
    
    ?>
                        </tbody>
                    </table>
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