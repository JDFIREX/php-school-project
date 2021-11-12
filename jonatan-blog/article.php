
<?php 

session_start();

$server = mysqli_connect('localhost','root','');
$db = mysqli_select_db($server, 'jonatanblog');

$getArticleID = $id = $_GET['id'];
$myarticleQ = "SELECT * from article where article_id = '$getArticleID' ";
$r = mysqli_query($server,$myarticleQ);

if(mysqli_num_rows($r) == 0 ){
    $actual_link = "http://$_SERVER[HTTP_HOST]";
    $url = $actual_link."/j";
    header( "Location: $url" );
};

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
            $DeleteURL = $_SESSION['actualLink'].'jonatan-blog/delete/article.php?id='.$getArticleID;
            echo "<a class='edit-button'  href='$editURL'  >Edytuj</a>";
            echo "<a class='edit-button'  href='$DeleteURL'  >Usuń</a>";
        }
    }
    
    
    ?>



   <div class="article_container" >

    <?php 

    $myarticleR = mysqli_query($server,$myarticleQ);

    while($d = mysqli_fetch_array($myarticleR)){

        $text = json_decode($d['article_text'], true);

        echo "<div style='background-image: url($d[article_src])' class='article_bacground' ></div>";
        echo "<div class='article_header' >";
        echo "<h1>$d[article_header]</h1>";
        echo "</div>";
        echo "<div class='article_text' >";


        foreach(array_keys($text) as $r){
            $x = explode( '_', $r )[0];

            if($x == "text"){
                echo "<p>$text[$r]</p>";
            } else {
                echo "<img src='$text[$r]' alt='obraz' />";
            }
        }

        echo "</div>";
    }

    
    ?>


   </div>


</body>
</html>