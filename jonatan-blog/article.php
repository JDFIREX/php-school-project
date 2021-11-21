
<?php 

session_start();

$server = mysqli_connect('localhost','root','');
$db = mysqli_select_db($server, 'jonatanblog');
$getArticleID = $id = $_GET['id'];

if(isset($_POST['edit'])){
    $editID = $_POST['edit-id'];
    $editValue = $_POST['edit-value'];
    $qEdit = "UPDATE `article_comment` SET `comment` = '$editValue' where `comment_id` = '$editID' ";
    mysqli_query($server,$qEdit);
    $url = $_SESSION['actualLink'].'jonatan-blog/article.php?id='.$getArticleID;
    header( "Location: $url" );
};


if(isset($_POST['remove'])){
    $removeID = $_POST['remove-id'];
    $qRemove = "DELETE FROM `article_comment` WHERE `comment_id` = '$removeID' ";
    mysqli_query($server,$qRemove);
    $url = $_SESSION['actualLink'].'jonatan-blog/article.php?id='.$getArticleID;
    header( "Location: $url" );
};

if(isset($_POST['new-comment'])){
    $user = intval($_SESSION['loggedID']);
    $art = intval($getArticleID);
    $newComm = $_POST['new-comment'];
    $qNewComm = "INSERT INTO `article_comment` (`comment_for_article_id`, `comment_owner_id`, `comment`) VALUES ( $art, $user, '$newComm' )";
    $r = mysqli_query($server,$qNewComm);
    $url = $_SESSION['actualLink'].'jonatan-blog/article.php?id='.$getArticleID;
    header( "Location: $url" );
};



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

   <?php 
   
   
   if(isset($_SESSION['logged']) && $_SESSION['logged'] > 0){
       echo '
       <div class="add-comment" >
        <h1 >Dodaj komentarz</h1>
            <form  method="post">
                <input type="text" name="new-comment" class="comment-add" >
                <p class="new-comment-error" >Komentarz nie może być pusty</p>
                <input type="submit"  class="add" name="add-comm" value="Dodaj komentarz" >
            </form>
        </div>
       ';
   } else {
       echo '<h3 style="padding: 0 100px 20px 100px"  >Aby zostawić komentarz musisz mieć konto</h3>';
   };
   
   
   ?>

   

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
                        
                            ".'<svg  width="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg>
                            '."
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


    <div class='remove'>
        <form class='remove-buttons' method='post' >
            <h2>Potwierdź usunięcie tego komentarza</h2>
            <input type="hidden" name="remove-id" class='remove-id' >
            <div>
                <input type="submit" value="usuń" name='remove' >
                <input type="button" class='cancel-remove' value="anuluj usuwanie" name='remove-cancel' >
            </div>
        </form>
    </div>

    <div class='edit' >
            <form class='edit-buttons' method='post' >
                <h2>Edytuj komentarz</h2>
                <input type="hidden" name="edit-id" class='edit-id' >
                <input type="text" name="edit-value" class='edit-value' >
                <p class='edit-value-error' >komentarz nie możę być pusty</p>
                <div>
                    <input type="submit" class='save-edit' value="zapisz zmiany" name='edit'>
                    <input type="button" class='cancel-edit' value="anuluj edytowanie" name='edit-cancel'>
                </div>
            </form>
    </div>

    <script src="article.js"></script>

</body>
</html>