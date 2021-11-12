
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
                echo "<h3>Aktualny twój nick to : $d[nickName] </h3>";
            }

        } else {
            $_SESSION['logged'] = false;
            $_SESSION['loggedID'] = 0;
            $url = $_SESSION['actualLink']."konto/zaloguj.php";
            header( "Location: $url" );
        }
    
    ?>


        <form action="./zmien-nick.php" method="post">

            <fieldset>
                <legend>Podaj nowy nickName</legend>
                <input type="newLogin" name="text" id="newlogin">
                <p class="text-login-error">Nick powinien mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <fieldset>
                <legend>Password</legend>
                <input type="password" name="password" id="passwordLog">
                <p class="pass-error">Hasło powinino mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <div class="buttons">
                <button id='changeLoginBTN' type="submit" disabled>
                    Zmień Login
                </button>
            </div>

        </form>

        <?php 
        
            if(isset($_POST['text']) && isset($_POST['password'])  ){

                $newlogin = $_POST['text'];

                $qq = "SELECT * from user_login where nickName = '$newlogin' ";
                $rr = mysqli_query($server,$qq);

                if(mysqli_num_rows($rr) != 0){
                    echo "<div class='popup warning-mess'>";
                    echo "<script> startCount() </script>";
                    echo "<p> Taki login już istnieje </p>";
                    echo "</div>";
                } else {

                    $loggID = $_SESSION['loggedID'];
                    $q = "SELECT * from user_login where `user_id` = $loggID ";
                    $r = mysqli_query($server,$q);

                    while($d = mysqli_fetch_array($r)){

                        if(password_verify($_POST['password'],$d['password'])){

                            $newLoginq = "UPDATE `user_login` SET `nickName` = '$newlogin' WHERE `user_id`= $loggID ";
    
                            if(mysqli_query($server,$newLoginq)){
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
                            echo "<p> Podałeś złe hasło !! </p>";
                            echo "<script> startCount() </script>";
                            echo "</div>";
                        }

                    }
        
                }
    
            }
            
        
        ?>

   </div>


    <script src="zmien-nick.js"></script>


</body>
</html>