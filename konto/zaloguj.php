
<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
    
    <?php include("../components/nav.php") ?>

    <section>
        <h3>Zaloguj się</h3>

        <form method="post">
            <fieldset>
                <legend>Login</legend>
                <input type="text" name="text" id="text">
            </fieldset>

            <fieldset>
                <legend>Password</legend>
                
            </fieldset>
        </form>
    </section>

</body>
</html>