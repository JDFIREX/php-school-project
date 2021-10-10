<?php 



if($_SESSION['logged']){

    if(isset($_POST['article'])){
        $url = $_SESSION['actualLink'].'jonatan-blog/article.php?id='.$_POST['article'];
        header( "Location: $url" );
    }

    $loggedID = $_SESSION['loggedID'];
    $myarticleQ = "SELECT * from article where article_owner_id = '$loggedID' ";
    $myarticleR = mysqli_query($server,$myarticleQ);


    echo "<div class='articles' >";

    while($d = mysqli_fetch_array($myarticleR)){
        echo "<form class='article' method='post'>";
        echo "<div style='background-image: url($d[article_src])' class='image' ></div>";
        echo "<div class='article_info' >";
        echo "<h1>$d[article_header]</h1>";
        echo "<p>$d[article_text]</p>";
        echo "</div>";
        echo "<button type='submit' name='article' value='$d[article_id]' >Zobacz artykuł</button>";
        echo "</form>";
    }

    echo "</div>";

}


?>