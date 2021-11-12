
<?php 

session_start();

if(($_SESSION['logged'])){
    $actual_link = "http://$_SERVER[HTTP_HOST]";
    $url = $actual_link."/j";
    header( "Location: $url" );
}


$server = mysqli_connect('localhost','root','');
$db = mysqli_select_db($server, 'jonatanblog');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../main.css">
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

    <section class="Login">
        <h3>Zarejestruj się</h3>

        <form method="post" action="./zarejestruj.php">
            <fieldset>
                <legend>nickName</legend>
                <input type="text" name="text" id="text">
                <p class="text-error">Nick powinien mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <fieldset>
                <legend>Password</legend>
                <input type="password" name="password" id="password">
                <p class="pass-error">Hasło powinino mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <fieldset>
                <legend>Password</legend>
                <input type="password" name="password2" id="passwordsec">
                <p class="pass-sec-error">Hasło powinino mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <div class="buttons">
                <button id='rejestr' type="submit" disabled>
                    Zarejestruj się
                </button>
                <a href="./zaloguj.php">Mam już konto</a>
            </div>
        </form>
    </section>

    <?php 
    
        if(isset($_POST['text']) && isset($_POST['password']) && isset($_POST['password2'])  ){

            $login = $_POST['text'];

            $q = "SELECT * from user_login where nickName = '$login' ";
            $r = mysqli_query($server,$q);

            if(mysqli_num_rows($r) == 0){
                
                $pass1 = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pass2 = password_hash($_POST['password2'], PASSWORD_BCRYPT);

                if(password_verify($_POST['password'],$pass2)){

                    $q2 = "INSERT INTO `user_login`( `nickName`, `password`) VALUES ('$login','$pass1')";

                    if(mysqli_query($server,$q2)){
                        $url = $_SESSION['actualLink']."konto/zaloguj.php";
                        header( "Location: $url" );
                    } else {
                        echo "<div class='popup warning-mess'>";
                        echo "<script> startCount() </script>";
                        echo "<p> Nie udało się stworzyć konta </p>";
                        echo "</div>";
                    }

                } else {
                    echo "<div class='popup warning-mess'>";
                    echo "<script> startCount() </script>";
                    echo "<p> hasłą nie są takie same </p>";
                    echo "</div>";
                }

            } else {
                echo "<div class='popup warning-mess'>";
                echo "<script> startCount() </script>";
                echo "<p> konto już istnieje </p>";
                echo "</div>";
            }

        }
    
    
    ?>


<script src="./zarejestruj.js" ></script>

</body>
</html>