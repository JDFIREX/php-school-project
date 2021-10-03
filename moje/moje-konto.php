
<?php 

session_start();

if(!$_SESSION['logged']){
    $url = $_SESSION['mainLink'];
    header( "Location: $url" );
}

$server = mysqli_connect('localhost','root','');
$db = mysqli_select_db($server, 'jonatanblog');

?>

<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Jonatan Blog</title>
   <link rel="stylesheet" href="../main.css">
</head>
<body>
   
   <?php include("../components/nav.php") ?>


    <div class="user-info">

        <?php 
            $loggedID = $_SESSION['loggedID'];
            $nickq = "SELECT nickName from user_login where user_id = '$loggedID' ";
            $nickr = mysqli_query($server,$nickq);

            if(mysqli_query($server,$nickq)){
                while($d = mysqli_fetch_array($nickr)){
                    echo "<h1>Witaj ! $d[nickName]</h1>";
                }

            } else {
                $_SESSION['logged'] = false;
                $_SESSION['loggedID'] = 0;
                $url = $_SESSION['actualLink']."konto/zaloguj.php";
                header( "Location: $url" );
            }
        
        ?>

        <div class="user-stats" >

            <?php 
                $loggedID = $_SESSION['loggedID'];
                $nickq = "SELECT nickName from user_login where user_id = '$loggedID' ";
                $nickr = mysqli_query($server,$nickq);

                if(mysqli_query($server,$nickq)){
                    while($d = mysqli_fetch_array($nickr)){
                        echo "<div>";
                            echo "<div>";
                                echo "<h1>nickName : $d[nickName]</h1> <a href='zmien-nick.php' >Zmień Nick</a>";
                            echo "</div>";
                            echo "<div class='zmien-haslo'>";
                                echo "<a href='zmien-haslo.php'>zmień hasło</a>";
                            echo "</div>";
                        echo "</div>";
                    }
                }

                $nickq = "SELECT count(article_id) as suma from article where article_owner_id = '$loggedID' ";
                $nickr = mysqli_query($server,$nickq);


                if(mysqli_query($server,$nickq)){
                    while($d = mysqli_fetch_array($nickr)){
                        echo "<h1>liczba Artykułów : $d[suma]</h1>";
                    }
                }
            
            ?>


        </div>

    </div>


    <?php include("../components/articles.php") ?>

</body>
</html>