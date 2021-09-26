
<?php 

session_start();

if(!$_SESSION['logged']){
    $url = $_SESSION['mainLink'];
    header( "Location: $url" );
}

$_SESSION['logged'] = false;
$_SESSION['loggedID'] = 0;

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

    <h3>Wylogowałeś się</h3>


</body>
</html>