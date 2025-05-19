<?php
$css_path=BASE_URL.'assets/css/postLists.css';
$js_path=BASE_URL.'assets/js/live_search.js';
$ver=file_exists($css_path)?filemtime($css_path):time();
$js_ver=file_exists($js_path)?filemtime($js_path):time();
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="<?= BASE_URL ?>assets/css/postLists.css?v=<?=$ver?>" rel="stylesheet">
    </head>
    <body>

        <input id="search" type="text" class="search_bar" placeholder="search items">
        <div id="search_results">
            
        </div>
        <!-- <h1>BASE URL is <?= BASE_URL ?></h1> -->
        <h1>Posts</h1>
        <a href="index.php?route=posts/create">Create New Post</a>
        <table>
            <thead>

                <th class='t'>
                titles
                </th>

                <th class='t'>
                content 
                </th>

                <th class='t'>
                createdAt
                </th>

                <tbody>
                    <?php
                      foreach($posts as $post):
                    ?>

                    <tr> 
                        <td>
                            <?= htmlspecialchars($post['title'])?> 
                        </td>
                        <td>
                            <?=htmlspecialchars($post['content'])?> 
                        </td> 
                        <td>
                            <?=htmlspecialchars($post['created_at'])?> 
                        </td>
                        <td> 
                            <a href="index.php?route=posts/edit&id=<?= $post['id']?>">Edit</a>
                        </td>
                        <td> 
                            <a class="del" href="index.php?route=posts/delete&id=<?= $post['id']?>">Delete</a>
                        </td>
                    </tr>

                    <?php endforeach;?>

                </tbody>
            </thead>
        </table>


        <script>
        const force_reload =(e)=>{
            if(e.persisted){
                window.location.reload();
            }
        }
        window.addEventListener("pageshow",force_reload);
    </script>

<script type="text/javascript" src="<?= BASE_URL ?>assets/js/live_search.js?v=<?=$js_ver?>">
            
        </script>

    </body>
</html>
