<?php
$css_path=BASE_URL.'assets/css/postLists.css';
$js_path=BASE_URL.'assets/js/live_search.js';
$sorting_js_path =BASE_URL.'assets/js/sorting.js';
$filter_js_path=BASE_URL.'assets/js/filter.js';
$sorting_js_ver=file_exists($sorting_js_path)?filemtime($sorting_js_path):time();
$filter_js_ver=file_exists($filter_js_path)?filemtime($filter_js_path):time();
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

        <?php if(!empty($_SESSION['user_id'])): ?>
            
            <p class="logout">Welcome <?=htmlspecialchars($_SESSION['user_id'])?>| <a href="index.php?route=logout">Logout</a> </p>

            
        <?php endif; ?>



        <input id="search" type="text" class="search_bar" placeholder="search items">
        <div class="search_container">
            <div id="search_results"></div>
            <h1>suggestions</h1>
            <div id="suggestions"></div>
            
        </div>
        <div class="sort_container">
            <label for="sorting">Sort By</label>
            <select id="sorting">
                <option value="date_desc" >Date (Newest First)</option>
                <option value="date_asc">Date (Oldest First) </option>
                <option value="title_asc">title (A-Z)</option>
                <option value="title_desc">title (Z-A)</option>
            </select>
            
        </div>
        
            
        <!-- <h1>BASE URL is <?= BASE_URL ?></h1> -->
        <h1>Posts</h1>
        <a href="index.php?route=posts/create" class="new_post">Create New Post</a>
        <?php if(!empty($_SESSION['user_id']) && $_SESSION['role']=='admin'): ?>

                <a href="index.php?route=posts/manage_users" class="manage_users">Manage Users</a>

        <?php endif; ?>
        <img src="<?=BASE_URL?>assets/images/menu.png" alt="" class="hamburger">
        <div class="sidebar">
            <img src="<?=BASE_URL?>assets/images/cross.png" alt="" class="close_hamburger">
            <!---->
            <form id="filters" class="myform">
                <label for="title">Filter by title</label>
                <input type="" name="filter_title" value="">
                <input type="date" name="filter_from" value="">
                <input type="date" name="filter_to" value="">
                <button type="submit">Filter</button>
            </form>

            <div class="clear_filters">

                <button>CLEAR FILTERS</button>
            
           </div> 

        </div> 
        
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
                            <a href="index.php?route=posts/details&id=<?=$post['id']?>"><?= htmlspecialchars($post['title'])?></a>
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
<div class="pages_cont">
    
<?php for ($i=1;$i<=$total_pages;$i++): ?>
        <div class="page_no" >
        <a href="index.php?route=posts&page=<?=$i?>" <?=$i==$page?'class=active':''?>><?=$i?> </a>
        </div>
<?php endfor;?>


</div>
        <script>
        const force_reload =(e)=>{
            if(e.persisted){
                window.location.reload();
            }
        }
        window.addEventListener("pageshow",force_reload);
    </script>



<script type="text/javascript" src="<?=BASE_URL?>assets/js/sorting.js?v=<?=$sorting_js_ver?>">
    

</script>
        <script type="text/javascript" src="<?= BASE_URL ?>assets/js/live_search.js?v=<?=$js_ver?>">

        </script>

    
<script type="text/javascript" src="<?=BASE_URL?>assets/js/filter.js?v=<?=$filter_js_ver?>">
            
        </script>


        
    </body>
</html>
