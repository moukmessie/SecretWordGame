<?php
require __DIR__ . "/class/Autoloader.php" ;
Autoloader::register() ;
use swg\SecretWordGame ;

$secret = "have fun";
$game = new SecretWordGame($secret);

$word = isset($_REQUEST['word']) ? strtolower(join ("",($_REQUEST['word']) )): null ;
$word = str_split($word, 1) ;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Secret Game</title>

    <link rel="stylesheet" href="css/swg.css">
    <script src="js/swg_v2.js"></script>

</head>
<body>

<?php include "elements/header.php" ?>

<div id="main-content">
    <form id="secret-word-form" method="post">
         <?php

            $response = $game->try($word) ;
            if ($response['win']){
                $game->generateWin();
            } else{
                $game->generateInput($response);
            }

        ?>
    </form>
</div>

<?php include "elements/footer.php" ?>

</body>
</html>
