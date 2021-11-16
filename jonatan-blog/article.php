
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
<script src="article.js"></script>
   
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

        $text = json_decode($d['article_text'], true, 512, JSON_UNESCAPED_UNICODE);

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


    <div class="article_comments">
        <?php 
        
            $getAllArticleComments = "SELECT * from article_comment INNER JOIN user_login on user_login.user_id = article_comment.comment_owner_id where comment_for_article_id = $getArticleID";
            $commentsR = mysqli_query($server, $getAllArticleComments);

            while($d = mysqli_fetch_array($commentsR)){
                echo '
                
                <div class="comment" >

                ';

                if(isset($_SESSION['loggedID']) && $_SESSION['loggedID'] == $d['comment_owner_id']){
                    echo "
                    <div class='comment-function-buttons'>
                        
                        <div class='function-button' onClick='removeComment(this)' data-commentID='$d[comment_id]' data-ownerID='$d[comment_owner_id]'  >
                        // svg
                        delete
                        </div>

                        <div class='function-button' onClick='editComment(this)' data-commentID='$d[comment_id]' data-ownerID='$d[comment_owner_id]'  >
                        // svg
                        edit
                        </div>

                    </div>
                    ";
                }

                echo "
                    <div class='comment-data' >
                    
                        <div class='comment-user'>
                            <h3>$d[nickName]</h3>
                        </div>

                        <div class='comment-text'>
                            <p>
                                $d[comment]
                            </p>
                        </div>
                    
                    </div>
                
                </div>
                ";
            }
        
        ?>
    </div>


    <script src="article.js"></script>

</body>
</html>