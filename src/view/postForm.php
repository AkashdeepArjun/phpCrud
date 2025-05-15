
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$post['id']?'Edit':'Create'?></title>
                <link href="<?=BASE_URL?>assets/css/postForm.css" rel="stylesheet">
    </head>
    <body>

            <h1><?=$post['id']?'Edit Post':'Create new Post'?></h1>

<form  class="cont" action="index.php?route=posts/<?=$post['id']?'update':'save'?>" method="POST">

            <?php if($post['id']):?>

                    <input type="hidden" name="id" value="<?=htmlspecialchars($post['id'])?>" required>
            <?php endif;?>


            <input type="text" name="title" value="<?=htmlspecialchars($post['title']) ?>"required placeholder="title">

        <textarea rows="5" cols="10"  placeholder="content here" name="content"><?= htmlspecialchars($post['content'])?> </textarea>

                <button type="submit"><?= $post['id']?'Update':'Save' ?></button>
</form>         


            






            


                
        </form>
                          



           </div>

             
        
            
        

    </body>
</html>
