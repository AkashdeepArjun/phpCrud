<?php

$css_path=BASE_URL.'assets/css/postDetail.css';
$css_ver=file_exists($css_path)?filemtime($css_path):time();
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title><?=$post['title']??null?></title>
<link href="<?=BASE_URL?>assets/css/postDetail.css?v=<?=$css_ver?>" rel="stylesheet">
        </head>
        <body>

                <div class="cont">
                        <p><?= htmlspecialchars($post['title']) ?></p>
                        <textarea rows="1" cols="2"><?=htmlspecialchars($post['content'])?></textarea>

                        
                </div>
        
        </body>
</html>
