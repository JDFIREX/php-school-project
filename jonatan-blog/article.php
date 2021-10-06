
<?php 

session_start();

if(!$_SESSION['logged'] || $_SESSION['article_id'] == 0){
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

   <div class="article_container" >

    <?php 

    $articleID = $_SESSION['article_id'];
    $myarticleQ = "SELECT * from article where article_id = '$articleID' ";
    $myarticleR = mysqli_query($server,$myarticleQ);

    while($d = mysqli_fetch_array($myarticleR)){
        echo "<div style='background-image: url($d[article_src])' class='article_bacground' ></div>";
        echo "<div class='article_header' >";
        echo "<h1>$d[article_header]</h1>";
        echo "</div>";
        echo "<div class='article_text' >";
        echo "<p>$d[article_text]</p>";
        echo "</div>";
    }
    

    
    ?>


   </div>


</body>
</html>