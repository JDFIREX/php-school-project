<header>

    <div class='nav' >
        <h1>Blog</h1>
        <?php 
            $url = $_SESSION['mainLink'];
            echo "<a href='$url' >Główna</a>";
        ?>

        <?php 
        
            $logged = $_SESSION['logged'];

            if($logged){
                $url = $_SESSION['actualLink']."moje/moje-artykuły.php";
                echo "<a href='$url' >Moje artykuły</a>";
            }
        
        ?>
    </div>

    <div class='logged'>
        <?php 
            
            $logged = $_SESSION['logged'];

            if(!$logged){
                $url = $_SESSION['actualLink']."konto/zaloguj.php";
                echo "<a href='$url' >Zaloguj się</a>";
            } else {
                $url = $_SESSION['actualLink']."konto/wyloguj.php";
                echo "<a href='$url' >Wyloguj się</a>";
            }
        
        ?>
    </div>
</header>
