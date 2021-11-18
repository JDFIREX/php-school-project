
<?php 

session_start();

$server = mysqli_connect('localhost','root','');
$db = mysqli_select_db($server, 'jonatanblog');


if(isset($_POST['edit'])){
    $editID = $_POST['edit-id'];
    $editValue = $_POST['edit-value'];
    $qEdit = "UPDATE `article_comment` SET `comment` = '$editValue' where `comment_id` = '$editID' ";
    mysqli_query($server,$qEdit);
};


$getArticleID = $id = $_GET['id'];
$myarticleQ = "SELECT * from article where article_id = '$getArticleID' ";
$r = mysqli_query($server,$myarticleQ);

$getAllArticleComments = "SELECT * from article_comment INNER JOIN user_login on user_login.user_id = article_comment.comment_owner_id where comment_for_article_id = $getArticleID";
$commentsR = mysqli_query($server, $getAllArticleComments);

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
        <h1>Komentarze</h1>
        <?php 

            while($d = mysqli_fetch_array($commentsR)){
                echo '
                
                <div class="comment" >

                ';

                $comment = "".$d['comment'];

                if(isset($_SESSION['loggedID']) && $_SESSION['loggedID'] == $d['comment_owner_id']){
                    echo "
                    <div class='comment-function-buttons'>
                        
                        <div class='function-button' onClick='removeComment($d[comment_id])' >
                        // svg
                        delete
                        </div>

                        <div class='function-button' onClick='editComment($d[comment_id],\"$comment\")' >
                            ".'
                            <svg 
                            aria-hidden="true" 
                            focusable="false" 
                            data-prefix="fas" 
                            data-icon="edit" 
                            class="svg-inline--fa fa-edit fa-w-18" 
                            role="img" 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="18"
                            viewBox="0 0 576 512">
                                <path 
                                fill="currentColor" 
                                d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
                                </path>
                            </svg>
                            '."
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


    <!-- <div class='remove'>

        <form class='remove-buttons' method='post' >
            <input type="button" value="usuń" name='remove' >
            <input type="button" value="anuluj usuwanie" name='remove-cancel' >
        </form>
    </div> -->

    <div class='edit' >
            <form class='edit-buttons' method='post' >
                <input type="hidden" name="edit-id" class='edit-id' >
                <input type="text" name="edit-value" class='edit-value' >
                <input type="submit" value="zapisz zmiany" name='edit'>
                <input type="submit" value="anuluj edytowanie" name='edit-cancel'>
            </form>
    </div>

    <script src="article.js"></script>

</body>
</html>