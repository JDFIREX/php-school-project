
<?php 

 session_start();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jonatan Blog</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    
    <header>
        <h1>Blog</h1>

        <div class='nav' >
            <?php 
                $url = $_SESSION['mainLink'];
                echo "<a href='$url' >Główna</a>";
            ?>

            <?php 
            
                $logged = $_SESSION['logged'];

                if($logged){
                    $url = $_SESSION['mainLink']."/moje/moje-artykuły.php";
                    echo "<a href='$url' >Moje artykuły</a>";
                }
            
            ?>
        </div>

        <div class='logged'>
            <?php 
                
                $logged = $_SESSION['logged'];

                if(!$logged){
                    $url = $_SESSION['mainLink']."/konto/zaloguj.php";
                    echo "<a href='$url' >Zaloguj się</a>";
                } else {
                    $url = $_SESSION['mainLink']."/konto/wyloguj.php";
                    echo "<a href='$url' >Wyloguj się</a>";
                }
            
            ?>
        </div>
    </header>

</body>
</html>