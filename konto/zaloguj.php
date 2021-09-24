
<?php 

session_start();

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
    
    <?php include("../components/nav.php") ?>

    <section class="Login">
        <h3>Zaloguj się</h3>

        <form method="post">
            <fieldset>
                <legend>Login</legend>
                <input type="text" name="text" id="text">
            </fieldset>

            <fieldset>
                <legend>Password</legend>
                <input type="password" name="password" id="password">
            </fieldset>

            <div class="buttons">
                <button type="submit">
                    Zaloguj się
                </button>
                <a href="">Załóż konto</a>
            </div>
        </form>
    </section>

    <?php 
    
        if(isset($_POST['text']) && isset($_POST['password']) ){
            echo "log in ";

            $login = $_POST['text'];

            $q = "SELECT * from user_login where nickName = '$login' ";

            $r = mysqli_query($server,$q);

            while($d = mysqli_fetch_array($r)){

                if(password_verify($_POST['password'],$d['password'])){
                    echo "pass correct !!";
                }

            }

        }
    
    
    ?>

</body>
</html>