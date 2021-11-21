<?php 

session_start();

if(!($_SESSION['logged'])){
    $actual_link = "http://$_SERVER[HTTP_HOST]";
    $url = $actual_link."/j/jonatan-blog/main.php";
    header( "Location: $url" );
}

$server = mysqli_connect('localhost','root','');
$db = mysqli_select_db($server, 'jonatanblog');

$getArticleID = $_GET['id'];
$myarticleQ = "SELECT * from article where article_id = '$getArticleID' ";
$r = mysqli_query($server,$myarticleQ);

while($d = mysqli_fetch_array($r)){
    if($d['article_owner_id'] != $_SESSION['loggedID'] ){
        $actual_link = "http://$_SERVER[HTTP_HOST]";
        $url = $actual_link."/j/jonatan-blog/main.php";
        header( "Location: $url" );
    }
}

if(mysqli_num_rows($r) == 0 ){
    $actual_link = "http://$_SERVER[HTTP_HOST]";
    $url = $actual_link."/j/jonatan-blog/main.php";
    header( "Location: $url" );
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Jonatan Blog</title>
   <link rel="stylesheet" href="../../main.css">
</head>
<body>
    
<?php include("../../components/nav.php") ?>

<main class='create-article' >

    <section class='delete-section' >
        <h1>Czy napewno chcesz usunąć ten artykuł</h1>
        <form method="post">
            <div class="buttons">
                <button type="submit" name='tak' value='tak' >Tak chce usunąć</button>
                <button type="submit" name='nie' value='nie' >Nie - wróć do swojego konta</button>
            </div>
        </form>
    </section>

    <?php 
    
    if(isset($_POST['tak'])){
        $c = "DELETE FROM `article_comment` where `comment_for_article_id` = '$getArticleID'";
        $q = "DELETE FROM `article` WHERE `article_id` = '$getArticleID'";
        mysqli_query($server,$c);
        mysqli_query($server,$q);
        $url2 = $_SESSION['actualLink']."moje/moje-konto.php";
        header( "Location: $url2" );
    }

    if(isset($_POST['nie'])){
        $url2 = $_SESSION['actualLink']."moje/moje-konto.php";
        header( "Location: $url2" );
    }
    
    ?>



</main>


</body>
</html>