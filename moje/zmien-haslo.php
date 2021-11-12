
<?php 

session_start();

if(!($_SESSION['logged'])){
    $actual_link = "http://$_SERVER[HTTP_HOST]";
    $url = $actual_link."/j";
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

    <script>

        function startCount(e) {
            const popUp = document.querySelector(".popup");

            setTimeout(() => {

                popUp.style.left = "-500px";
                popUp.style.opacity = "0";

                setTimeout(() => {
                    popUp.remove()
                }, 1000);

            }, 5000);

        }

    </script>
   
   <?php include("../components/nav.php") ?>


   <div class='Login'>

   <?php 
        $loggedID = $_SESSION['loggedID'];
        $nickq = "SELECT nickName from user_login where user_id = '$loggedID' ";
        $nickr = mysqli_query($server,$nickq);

        if(mysqli_query($server,$nickq)){
            while($d = mysqli_fetch_array($nickr)){
                echo "<h3>zmiana hasła dla użytkownika : $d[nickName] </h3>";
            }

        } else {
            $_SESSION['logged'] = false;
            $_SESSION['loggedID'] = 0;
            $url = $_SESSION['actualLink']."konto/zaloguj.php";
            header( "Location: $url" );
        }
    
    ?>

        <form action="./zmien-haslo.php" method="post">

            <fieldset>
                <legend>Podaj hasło</legend>
                <input type="password" name="oldPassword" id="oldPassword">
                <p class="text-login-error">Nick powinien mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <fieldset>
                <legend>podaj nowe hasło</legend>
                <input type="password" name="newPassword" id="newPassword">
                <p class="pass-error">Hasło powinino mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <fieldset>
                <legend>potwórz nowe hasło</legend>
                <input type="password" name="newPasswordSec" id="newPasswordSec">
                <p class="pass-error pass-error-sec">Hasło powinino mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <div class="buttons">
                <button id='changePassButton' type="submit" disabled>
                    Zmień hasło
                </button>
            </div>

        </form>

        <?php 
        
            if(isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['newPasswordSec'])  ){

                if($_POST['newPassword'] != $_POST['newPasswordSec']){
                    echo "<div class='popup warning-mess'>";
                    echo "<script> startCount() </script>";
                    echo "<p> nowe hasła nie są takie same </p>";
                    echo "</div>";
                } else {
                    $loggID = $_SESSION['loggedID'];
                    $qq = "SELECT * from user_login where `user_id` = $loggID ";
                    $rr = mysqli_query($server,$qq);
    
                    $same = false;
    
                    while($d = mysqli_fetch_array($rr)){
                        if(password_verify($_POST['newPassword'],$d['password'])){
                            echo "<div class='popup warning-mess'>";
                            echo "<script> startCount() </script>";
                            echo "<p> nowe Hasło == stare Hasło </p>";
                            echo "</div>";
    
                            $same = true;
                        }
                    }

                    if(!$same){

                        $loggID = $_SESSION['loggedID'];
                        $q = "SELECT * from user_login where `user_id` = $loggID ";
                        $r = mysqli_query($server,$q);

                        while($d = mysqli_fetch_array($r)){

                            if(password_verify($_POST['oldPassword'],$d['password'])){
                                $pass1 = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);

                                $newPassq = "UPDATE `user_login` SET `password` = '$pass1' WHERE `user_id`= $loggID ";
        
                                if(mysqli_query($server,$newPassq)){
                                    $url = $_SESSION['actualLink']."konto/wyloguj.php";
                                    header( "Location: $url" );
                                } else {
                                    echo "<div class='popup warning-mess' >";
                                    echo "<p> Coś poszło nie tak </p>";
                                    echo "<script> startCount() </script>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<div class='popup warning-mess' >";
                                echo "<p> Złe Hasło </p>";
                                echo "<script> startCount() </script>";
                                echo "</div>";
                            }
    
                        }
                    }
                }

                

                
    
            }
            
        
        ?>

   </div>


    <script src="zmien-haslo.js"></script>


</body>
</html>