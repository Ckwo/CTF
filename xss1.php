<?php
session_start();  
    if(!isset($_SESSION["username"])){
        header("location:login.php");
        exit();


    }else{
        $USER = $_SESSION['username']['username'];
        $stm = "SELECT * FROM ctf WHERE username='$USER'";
        include "db.php";
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
    }

?>

<!DOCTYPE html>
<html>
 
<body>
 

    
    
    <script>
        if(window.location.href.split("key=")[1]){

            var originalAlert = window.alert;
            document.write(decodeURI(window.location.href.split("key=")[1]))
            
                window.alert = function(s) {
                    originalAlert("Done")
                    var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open( "GET", "/xss1_api.php", false ); // false for synchronous request
                    xmlHttp.send( null );
                }            
                document.write(decodeURI(window.location.href.split("key=")[1]))
                document.body.innerHTML = decodeURI(window.location.href.split("key=")[1]);


       
        }else{
            window.location.href = "xss1.php?key=test"
        }
       
    </script>
 
</body>
 
</html>
