<header>

    <div class='nav' >
        <h1>Blog</h1>
        <?php 
            $url = $_SESSION['mainLink'];
            echo "<a href='http://$_SERVER[HTTP_HOST]/j/jonatan-blog/main.php' >Główna</a>";
        ?>

        <?php 
        
            if(isset($_SESSION['logged']) && $_SESSION['logged']){
                $url = $_SESSION['actualLink']."moje/moje-konto.php";
                echo "<a href='$url' >Moje Konto</a>";
            }
        
        ?>
    </div>

    <div class='logged'>
        <?php 
            
                
            if (isset($_SESSION['logged']) && $_SESSION['logged'] ) {
                $url = $_SESSION['actualLink']."konto/wyloguj.php";
                echo "<a href='$url' >Wyloguj się</a>";
            } else {
                $url = $_SESSION['actualLink']."konto/zaloguj.php";
                echo "<a href='$url' >Zaloguj się</a>";
            }
        
        ?>
    </div>
</header>
