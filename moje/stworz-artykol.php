


<?php 

session_start();

$server = mysqli_connect('localhost','root','');
$db = mysqli_select_db($server, 'jonatanblog');

if(!$_SESSION['logged'] ){
    $url = $_SESSION['mainLink'];
    header( "Location: $url" );
}

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

    <div class='create-article' >

        <div class='article-background' >
            <?php


            if(isset($_POST['bg'])){

                if($_POST['bg'] == "change"){
                    $_SESSION['lastsrc'] = $_SESSION['src'];
                    $_SESSION['src'] = null;
                } else {
                    $_SESSION['src'] = $_POST['bg'];
                    $_SESSION['lastsrc'] = $_POST['bg'];
                }

            }

            
            if($_SESSION['src']){
                echo "<div style='background-image: url($_SESSION[src])' class='article_bacground_src' ></div>";
                echo '
                    <form method="post" action="stworz-artykol.php" class="change-src">
                        <input type="hidden" name="bg" value="change" />
                        <button type="submit" >zmień tło</button>
                    </form>
                ';
            } else {

                if($_SESSION['lastsrc']){
                    echo "<div style='background-image: url($_SESSION[lastsrc])' class='article_bacground_src' ></div>";
                }

                echo '
                    <form method="post" action="stworz-artykol.php" class="select-src">
                        <p>
                            Podaj link do tła 
                        </p>
                        <input type="text" name="bg" />
                        <button type="submit" >Potwierdź tło</button>
                    </form>
                ';
            }
            
            ?>
        </div>
            

        <div class='article-header' >


        <?php


            if(isset($_POST['header'])){

                if($_POST['header'] == "change"){
                    $_SESSION['lastheader'] = $_SESSION['header'];
                    $_SESSION['header'] = null;
                } else {
                    $_SESSION['header'] = $_POST['header'];
                    $_SESSION['lastheader'] = $_POST['header'];
                }

            }

            if($_SESSION['header']){
                echo "<h1>$_SESSION[header]</h1>";
                echo '
                    <form method="post" action="stworz-artykol.php" class="change-src">
                        <input type="hidden" name="header" value="change" />
                        <button type="submit" >zmień Header</button>
                    </form>
                ';
            } else {

                $v = null;
                if($_SESSION['header'] != null){
                    $v = $_SESSION['header'];
                } else {
                    if($_SESSION['lastheader']){
                        $v = $_SESSION['lastheader'];
                    } else {
                        $v = null;
                    }
                }

                echo $v;

                echo "
                    <form method='post' action='stworz-artykol.php' class='select-src'>
                        <input type='text' name='header' placeholder='Podaj tytuł' value='$v' />
                        <button type='submit' >Potwierdź header</button>
                    </form>
                ";
                
            }

            ?>


        </div>

    </div>


    

</body>
</html>