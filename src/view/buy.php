<?php

$user_id = $_SESSION['user_id'];
$user_role =$_SESSION['role'];
$is_premium =$_SESSION['is_premium']??0;

                
$js=BASE_URL.'assets/js/buy.js';
$js_ver =  file_exists($js)?filemtime($js):time();
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title></title>
                <link href="css/style.css" rel="stylesheet">
        </head>
              
                 
                

        <body >
                
                  <h1>Thanks for offring us a coffee</h1>
                
                <div id="paypal_cont">
                        
                </div>
                
                
                <?php if($user_role!='admin' && !$is_premium):?>
                       <script>document.body.dataset.userid = <?=json_encode($_SESSION['user_id'])?> </script>
                <script src="https://www.paypal.com/sdk/js?client-id=AYeDoWGlfpB3VHJcJvdki4j4Ah3ZXi0FzsVlHkTcVc2Mf9jyCnUVxahtRB1ff-LbHd77pHdPPgVOqwrK&currency=USD"></script>
                <script type="text/javascript" src="<?=BASE_URL?>assets/js/buy.js?v=<?=$js_ver?>"></script>

                <?php endif;?>  
</body>
</html>
