


<?php 

session_start();

if(!($_SESSION['logged'])){
    $actual_link = "http://$_SERVER[HTTP_HOST]";
    $url = $actual_link."/j";
    header( "Location: $url" );
}

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

    <script>

        function startCount(e) {
            const popUp = document.querySelector(".popup");

            setTimeout(() => {

                popUp.style.left = "-500px";
                popUp.style.opacity = "0";

                setTimeout(() => {
                    popUp.remove()
                }, 1000);

            }, 5000);

        }

    </script>
   
   <?php include("../components/nav.php") ?>

    <main class='create-article' >

        <section>


            <form method="post" >
                <input type="hidden" name="setText" value='true' >


                <label class="src-label" >
                    <p>Link do głównego zjęcia artykułu</p>
                    <input type="text" name="src"  id="src" />
                </label>

                <label class="header-label" >
                    <p>Tytuł Artykułu</p>
                    <input type='text' name='header' id="header" placeholder='Podaj tytuł'  />
                </label>

                <label class="category-label" >

                    <p>Wybierz Kategorie</p>

                    <label>
                        <p>życiorys</p>
                        <input type="radio" name=categoria class="category-radio" value="1" />
                    </label>

                    <label>
                        <p>opinia</p>
                        <input type="radio" name=categoria class="category-radio" value="2" />
                    </label>

                    <label>
                        <p>kurs</p>
                        <input type="radio" name=categoria class="category-radio" value="3" />
                    </label>

                    <label>
                        <p>polecenia</p>
                        <input type="radio" name=categoria class="category-radio" value="4" />
                    </label>

                    <label>
                        <p>o wszystkim i o niczym</p>
                        <input type="radio" name=categoria class="category-radio" value="5" checked />
                    </label>

                </label>

                <div class='my-post' >
                    <div class='my-post-article-text_1' >
                        <h5>tekst - 1</h5>
                        <textarea name="text_1" id="text_1" cols="30" rows="10" class='text' onInput="textAreaValidation()" onChange='textAreaValidation()' onKeyDown='textAreaValidation()' ></textarea>
                    </div>
                </div>


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


        </section>


    </main>



    <script src="stworz-artykul.js"></script>
    

</body>
</html>