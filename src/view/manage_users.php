<?php

$css=BASE_URL.'assets/css/postLists.css';
$css_ver=file_exists($css)?filemtime($css):time();
$js =BASE_URL.'assets/js/manage_users.js';
$js_ver=file_exists($js)?filemtime($js):time();

?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title></title>
<link href="<?=BASE_URL?>assets/css/postLists.css?v=<?=$css_ver?>" rel="stylesheet">
        </head>
        <body>
                <form id="jhopat" action="index.php?route=update_permissions" method="post">
                        
                <table>
                        <thead>
                                <tr> 
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                </tr>
                        </thead>
                        <tbody>
                        
                                <?php foreach($users as $user):$user_permissions= explode(',',$user['permissions']);?>


                                <tr> 
                                        <td><?=$user['uname']?></td>
                                        <td><?=$user['role']?></td>
                                        <td> 
                                                
                                        <?php foreach (['read','write','edit','delete'] as $perm): ?>
                                                <label>
                                                        
                                                        <input type="checkbox" name="permissions[<?=$user['id'] ?>][]" value="<?=$perm ?>"
                                                        
                                                                <?=in_array($perm,$user_permissions)?'checked':''?>
                                                        >

                                                        <?=ucfirst($perm) ?>

                                                </label>

                                
                                        


                                        <?php endforeach;?>
                                        </td> 
                                </tr>

                                <?php endforeach;?>

                                
                        </tbody>
                        </table>
                        <button type="submit">Update Permissions</button>
                </form>

<script type="text/javascript" src="<?=BASE_URL?>assets/js/manage_users.js?v=<?=$js_ver?>">
                        
                </script>
        
        </body>
</html>
