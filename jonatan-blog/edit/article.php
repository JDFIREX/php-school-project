
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
};

?>

<!DOCTYPE html>
<html lang="pl">
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

        <section>

            <form method="post">

                <?php

                    $myarticleR = mysqli_query($server,$myarticleQ);

                    while($d = mysqli_fetch_array($myarticleR)){

                
                ?>

                <input type="hidden" name="setText" value='true' >


                <?php  // article background

                        $src = $d["article_src"];
                
                        echo "
                        <label class='src-label' >
                            <p>Link do głównego zjęcia artykułu</p>
                            <input type='text' name='src'  id='src' value='$src' />
                        </label>
                        ";
                
                ?>


                <?php  // article background

                        $header = $d["article_header"];
                
                        echo "
                        <label class='header-label' >
                            <p>Tytuł Artykułu</p>
                            <input type='text' name='header' id='header' placeholder='Podaj tytuł' value='$header'  />
                        </label>
                        ";
                
                ?>

                <?php // article category 
                
                
                
                ?>


                <?php // article text 
                
                
                
                ?>


                <?php 
                
                    }; // while close
                
                ?>


            </form>
    </section>


</main>

<!-- //
//
    //    $text = json_decode($d['article_text'], true);
//
     //   echo "<div style='background-image: url($d[article_src])' class='article_bacground' ></div>";
     //   echo "<div class='article_header' >";
//echo "<h1>$d[article_header]</h1>";
     //   echo "</div>";
     //   echo "<div class='article_text' >";
//
//
     //   foreach(array_keys($text) as $r){
     //       $x = explode( '_', $r )[0];
//
     //       if($x == "text"){
     //           echo "<p>$text[$r]</p>";
    //        } else {
    //            echo "<img src='$text[$r]' alt='obraz' />";
    //        }
     //   }
//
    //    echo "</div>";
//
    // -->




</body>
</html>