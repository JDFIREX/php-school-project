


<?php 

session_start();

$server = mysqli_connect('localhost','root','');
$db = mysqli_select_db($server, 'jonatanblog');

if(!$_SESSION['logged'] ){
    $url = $_SESSION['mainLink'];
    header( "Location: $url" );
}

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

    <main class='create-article' >

        <section>


            <form method="post" >
                <input type="hidden" name="setText" value='true' >


                <label class="src-label" >
                    <p>Link do głównego zjęcia artykułu</p>
                    <input type="text" name="src"  />
                </label>

                <label class="header-label" >
                    <p>Tytuł Artykułu</p>
                    <input type='text' name='header' placeholder='Podaj tytuł'  />
                </label>

                <label class="category-label" >

                    <p>Wybierz Kategorie</p>

                    <label>
                        <p>życiorys</p>
                        <input type="radio" name=categoria" class="category-radio" value="0" />
                    </label>

                    <label>
                        <p>opinia</p>
                        <input type="radio" name=categoria" class="category-radio" value="1" />
                    </label>

                    <label>
                        <p>kurs</p>
                        <input type="radio" name=categoria" class="category-radio" value="2" />
                    </label>

                    <label>
                        <p>polecenia</p>
                        <input type="radio" name=categoria" class="category-radio" value="3" />
                    </label>

                    <label>
                        <p>o wszystkim i o niczym</p>
                        <input type="radio" name=categoria" class="category-radio" value="4" checked />
                    </label>

                </label>

                <div class='my-post' >
                    <div class='my-post-article-text_1' >
                        <h5>tekst - 1</h5>
                        <textarea name="text_1" id="text_1" cols="30" rows="10"></textarea>
                    </div>
                </div>


                <div class="article-buttons" >
                    <p class='add-section' >dodaj nową sekcje</p>
                    <p class='add-img' >dodaj obraz</p>
                </div>


                <button class="article-add"  type="submit" >Zapisz artykuł</button>


            </form>

            <?php

            if(isset($_POST['setText'])){
                $s = $_POST;
                $t = array_shift($s);
                $_SESSION['text'] = $s;
                print_r( $_SESSION['text'] );
            }

            ?>


        </section>


    </main>



    <script src="stworz-artykul.js"></script>
    

</body>
</html>