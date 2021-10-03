<?php 


if($_SESSION['logged']){

    $loggedID = $_SESSION['loggedID'];
    $myarticleQ = "SELECT * from article where article_owner_id = '$loggedID' ";
    $myarticleR = mysqli_query($server,$myarticleQ);
    

    echo "<div class='articles' >";

    while($d = mysqli_fetch_array($myarticleR)){
        echo "<div class='article' >";
        echo "<img src='$d[article_src]' alt='article image' />";
        echo "<div class='article_info' >";
        echo "<h1>$d[article_header]</h1>";
        echo "<p>$d[article_text]</p>";
        echo "</div>";
        echo "</div>";
    }

    echo "</div>";

}


?>