<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
if(isset($_SESSION['user_id'])){
        header("Location: index.php?route=posts");
        exit;

}

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
