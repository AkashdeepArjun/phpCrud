<?php
$css_path=BASE_URL.'assets/css/signup.css';
$css_ver=file_exists($css_path)?filemtime($css_path):time();


?>




<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title><?=$title?></title>
                <link href="<?=BASE_URL?>assets/css/signup.css?v=<?=$css_ver?>" rel="stylesheet">
</head>
<body>
        <form class="cont" action="input.php?route=login/submit" method="post">
                
                <input type="text" name="uname" value="" placeholder="username">
                <input type="password" name="upass" value="" placeholder="password">
                <!-- <input type="password" name="" value="" placeholder="confirm password"> -->
                <button type="submit" class="submit">Login</button>
                
        </form>


</body>
</html>
