
<?php 

session_start();

$server = mysqli_connect('localhost','root','');
$db = mysqli_select_db($server, 'jonatanblog');

$getArticleID = $id = $_GET['id'];
$myarticleQ = "SELECT * from article where article_id = '$getArticleID' ";
$r = mysqli_query($server,$myarticleQ);


if(!$_SESSION['logged'] || !$getArticleID || mysqli_num_rows($r) == 0 ){
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

    <?php 
    
    
    $myarticleR = mysqli_query($server,$myarticleQ);

    while($d = mysqli_fetch_array($myarticleR)){
        if($_SESSION['loggedID'] == $d['article_owner_id']){
            $editURL = $_SESSION['actualLink'].'jonatan-blog/edit/article.php?id='.$getArticleID;
            echo "<a class='edit-button'  href='$editURL'  >Edytuj</a>";
        }
    }
    
    
    ?>



   <div class="article_container" >

    <?php 

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