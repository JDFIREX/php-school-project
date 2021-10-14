

<?php 


    session_start();

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $_SESSION['actualLink'] = $actual_link;
    $_SESSION['mainLink'] = $actual_link."jonatan-blog/main.php";

    $url = $_SESSION['mainLink'];

    $_SESSION['logged'] = false;
    $_SESSION['loggedID'] = 0;

    $_SESSION['header'] = null;
    $_SESSION['lastheader'] = null;
    $_SESSION['src'] = null;
    $_SESSION['text'] = [];
    $_SESSION['category'] = null;
    $_SESSION['lastsrc'] = null;

    echo $url;

    header( "Location: $url" );

?>