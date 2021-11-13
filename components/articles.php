<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php

if($_SESSION['logged']){

    if(isset($_POST['article'])){
        $url = $_SESSION['actualLink'].'jonatan-blog/article.php?id='.$_POST['article'];
        header( "Location: $url" );
    }

    $loggedID = $_SESSION['loggedID'];
    $myarticleQ = "SELECT * from article inner join user_login on article_owner_id = user_login.user_id where article_owner_id = '$loggedID'";
    $myarticleR = mysqli_query($server,$myarticleQ);


    echo "<div class='articles' >";

    while($d = mysqli_fetch_array($myarticleR)){

        $text = json_decode($d['article_text'], true, 512, JSON_UNESCAPED_UNICODE);

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
        echo "<p>Autor : $d[nickName]</p>";
        echo "<p>$text[text_1]</p>";
        echo "</div>";
        echo "<button type='submit' name='article' value='$d[article_id]' >Zobacz artykuł</button>";
        echo "</form>";
    }

    echo "</div>";

}


?>
</body>
</html>

