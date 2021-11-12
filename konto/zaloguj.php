
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
        <h3>Zaloguj się</h3>

        <form method="post" action="./zaloguj.php">
            <fieldset>
                <legend>nickName</legend>
                <input type="text" name="text" id="login">
                <p class="text-login-error">Nick powinien mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <fieldset>
                <legend>Password</legend>
                <input type="password" name="password" id="passwordLog">
                <p class="pass-error">Hasło powinino mieć 5 lub więcej znaków !! </p>
            </fieldset>

            <div class="buttons">
                <button id='loginBtn' type="submit" disabled>
                    Zaloguj się
                </button>
                <a href="./zarejestruj.php">Załóż konto</a>
            </div>
        </form>
    </section>

    <?php 
    
        if(isset($_POST['text']) && isset($_POST['password']) ){

            $login = $_POST['text'];

            $q = "SELECT * from user_login where nickName = '$login' ";

            $r = mysqli_query($server,$q);

            if(mysqli_num_rows($r) == 0){
                echo "<div class='popup warning-mess'>";
                echo "<script> startCount() </script>";
                echo "<p> Podałeś zły login !!</p>";
                echo "</div>";
            } else {

                while($d = mysqli_fetch_array($r)){

                    if(password_verify($_POST['password'],$d['password'])){
                        $_SESSION['logged'] = true;
                        $_SESSION['loggedID'] = $d['user_id'];
                        $url = $_SESSION['mainLink'];
                        header( "Location: $url" );
                    } else {
                        echo "<div class='popup warning-mess' >";
                        echo "<p> Podałeś złe hasło !!</p>";
                        echo "<script> startCount() </script>";
                        echo "</div>";
                    }
    
                }

            }

            

        }
    
    
    ?>


    <script src="./zaloguj.js" ></script>

</body>
</html>