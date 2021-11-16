
<?php 

session_start();

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


    <?php 
    
    if(isset($_POST['article'])){
        $url = $_SESSION['actualLink'].'jonatan-blog/article.php?id='.$_POST['article'];
        header( "Location: $url" );
    }

    
    $allArticles = "SELECT * from article";
    $r = mysqli_query($server, $allArticles);


    echo "<div class='articles' >";

    while($d = mysqli_fetch_array($r)){

        $text = json_decode($d['article_text'], true, 512, JSON_UNESCAPED_UNICODE);
        $idD = $d['article_id'];
        $ownerID = $d['article_owner_id'];
        $articleOwnerQuery = "SELECT * from user_login where user_id = $ownerID";
        $OwnerR = mysqli_query($server,$articleOwnerQuery);
        $commentsCount = "SELECT count(comment_id) as cc from article_comment where comment_for_article_id = $idD";
        $commentR = mysqli_query($server,$commentsCount);
        $count;
        $owenerNick;

        while($x = mysqli_fetch_array($commentR)){
            $count = $x['cc'];
        }

        while($x = mysqli_fetch_array($OwnerR)){
            $owenerNick = $x['nickName'];
        }




        $category = $d['article_category_id'];
        $textCategory;
        if($category == 1) $textCategory = "życiorys";
        if($category == 2) $textCategory = "opinia";
        if($category == 3) $textCategory = "kurs";
        if($category == 4) $textCategory = "polecenia";
        if($category == 5) $textCategory = "o wszystkim i o niczym";

        echo "<form class='article' method='post'>";
        echo "<div style='background-image: url($d[article_src])' class='image' ></div>";
        echo "<div class='article_info' >";
        echo "<h1>$d[article_header]</h1>";
        echo "<p>Utworzono : $d[article_created]</p>";
        echo "<p>Ostatnia aktulizacja : $d[article_updated]</p>";
        echo "<p>Kategoria : $textCategory</p>";
        echo "<p>Autor : $owenerNick</p>";
        echo "<p>Liczba komentarzy : $count</p>";
        echo "<p>$text[text_1]</p>";
        echo "</div>";
        echo "<button type='submit' name='article' value='$d[article_id]' >Zobacz artykuł</button>";
        echo "</form>";
    };
    
    echo "</div>";
    
    ?>



</body>
</html>