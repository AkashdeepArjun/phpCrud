<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="<?= BASE_URL?>assets/css/postLists.css" rel="stylesheet">
    </head>
    <body>

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


    </body>
</html>
