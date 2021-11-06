
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

<?php 

$Gheader;
$Gsrc;

?>
   
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
                        $Gsrc = $src;
                
                        echo "
                        <label class='src-label' >
                            <p>Link do głównego zjęcia artykułu</p>
                            <input type='text' name='src'  id='src' value='$src' />
                        </label>
                        ";

                ?>


                <?php  // article header

                        $header = $d["article_header"];
                        $Gheader = $header;
                
                        echo "
                        <label class='header-label' >
                            <p>Tytuł Artykułu</p>
                            <input type='text' name='header' id='header' placeholder='Podaj tytuł' value='$header'  />
                        </label>
                        ";

                ?>

                <?php // article category 
                
                    $category = $d["article_category_id"];
                    $c0 = $category == 0;
                    $c1 = $category == 1;
                    $c2 = $category == 2;
                    $c3 = $category == 3;
                    $c4 = $category == 4;

                    echo "
                    <label class='category-label' >

                        <p>Wybierz Kategorie</p>

                        <label>
                            <p>życiorys</p>
                            <input type='radio' name=categoria class='category-radio' value='0' checked='$c0'  />
                        </label>

                        <label>
                            <p>opinia</p>
                            <input type='radio' name=categoria class='category-radio' value='1' checked='$c1' />
                        </label>

                        <label>
                            <p>kurs</p>
                            <input type='radio' name=categoria class='category-radio' value='2' checked='$c2' />
                        </label>

                        <label>
                            <p>polecenia</p>
                            <input type='radio' name=categoria class='category-radio' value='3' checked='$c3' />
                        </label>

                        <label>
                            <p>o wszystkim i o niczym</p>
                            <input type='radio' name=categoria class='category-radio' value='4' checked='$c4' />
                        </label>

                    </label>
                    
                    "
                
                ?>


                <?php // article text 
                
                    $text = json_decode($d['article_text'], true);
                    $f = array_shift($text);

                    echo "
                    <div class='my-post' >
                        <div class='my-post-article-text_1' >
                            <h5>tekst - 1</h5>
                            <textarea 
                                name='text_1' 
                                id='text_1' 
                                cols='30' 
                                rows='10' 
                                class='text' 
                                onInput='textAreaValidation()' 
                                onChange='textAreaValidation()' 
                                onKeyDown='textAreaValidation()' 
                                >$f</textarea>
                        </div>";
                    

                    foreach(array_keys($text) as $r){
                        $x = explode( '_', $r )[0];

                        if($x == "text"){
                            $t = $text[$r];
                            echo "
                                <div class='my-post-article' >
                                    <h5 class='header' >tekst - 2</h5>
                                    <textarea name='text_2' class='text' cols='30' rows='10' onFocus='textAreaValidation()' onBlur='textAreaValidation()' onClick='textAreaValidation()' onInput='textAreaValidation()'  onChange='textAreaValidation()' onKeyDown='textAreaValidation()' >$t</textarea>
                                    <p class='remove-article' data-id='2' onClick='removeArticle(this)' >usuń artykuł</p>
                                </div>
                            ";
                        } else {
                            $t = $text[$r];
                            echo "
                                <div class='my-post-img' >
                                    <h5 class='header' >Obraz - 2</h5>
                                    <input value='$t'  name='src_2' class='src' placeholder='link do img' onFocus='srcArticleValidation()' onBlur='srcArticleValidation()' onClick='srcArticleValidation()' onInput='srcArticleValidation()' onChange='srcArticleValidation()' onKeyDown='srcArticleValidation()'  />
                                    <p class='remove-img' data-id='2' onClick='removeIMG(this)' >usuń zdj</p>
                                </div>
                            ";
                        }
                    }

                    echo "</div>";
                
                ?>


                <?php 
                
                    }; // while close
                
                ?>

                

                <div class="article-buttons" >
                    <p class='add-section' >dodaj nową sekcje</p>
                    <p class='add-img' >dodaj obraz</p>
                </div>

                <div class="article-errors">
                    <p class='error src_error' >Tło do artykułu nie może być puste</p>
                    <p class='error header_error' >Header nie może być pusty</p>
                    <p class='error texts_error' >Teksty nie mogą być puste</p>
                    <p class='error imgs_error' >Obrazy nie mogą być puste</p>
                </div>

                <button class="article-add"  type="submit" disabled >Zapisz artykuł</button>


            </form>
    </section>


</main>

<script src="./article-edit.js"></script>

<?php 
                
echo "
    <script>
        updateTextAreaDOM();
        updateSrcDOM();
    </script>
";

echo "<script>
    const a = '$Gsrc'
    const b = '$Gheader'

    srcValidation(a);
    headerValidation(b)
</script>";

?>

</body>
</html>


<?php

            if(isset($_POST['setText'])){
                $s = $_POST;
                $t = array_shift($s);

                $src = array_shift($s); // article_src
                $header = array_shift($s); // article_header
                $category = array_shift($s); // article_category_id
                $text = json_encode($s);
                $author = $_SESSION['loggedID'];
                $date = date("Y-m-d");

                $createArticleQ = "INSERT INTO `article`(`article_header`, `article_src`, `article_text`, `article_category_id`, `article_created`, `article_updated`, `article_owner_id`) VALUES ('$header','$src','$text','$category','$date','$date','$author')";

                if(mysqli_query($server,$createArticleQ)){
                    $url = $_SESSION['actualLink']."moje/moje-konto.php";
                    header( "Location: $url" );
                } else {
                    echo "<div class='popup warning-mess'>";
                    echo "<script> startCount() </script>";
                    echo "<p> coś poszło nie tak </p>";
                    echo "</div>";
                }

            }

            ?>