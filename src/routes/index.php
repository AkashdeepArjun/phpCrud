<?php

    $route=$_GET['route']??'posts';
    switch ($route) {
    case 'posts':
        require_once PROJECT_ROOT. '/presenter/postPresenter.php';
        listposts(); 
        break; 
    case 'posts/create':
    require_once PROJECT_ROOT.'/presenter/postPresenter.php';
     createPost();
        break;
    case 'posts/save':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        savePost();
        break;
    case 'posts/edit':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        editPost();
        break;
    case 'posts/update':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        updatePost();
        break;
    case 'posts/delete':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        deletePost();
        break;
    case 'posts/search':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        search_posts();
        break;
    case 'posts/details':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        post_details();
        break;
    case 'posts/suggestions':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        get_query_suggestions();
        break;
    case 'posts/log':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        log_search_query();
        break;
    case 'signup':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        signup();
        break;
    case 'signup/submit':

        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        signup_submit();
        break;

    case 'login':
        require_once PROJECT_ROOT.'/presenter/postPresenter.php';
        login();
        break;

    case 'login/submit':
            require_once PROJECT_ROOT.'/presenter/postPresenter.php';
            login_submit();
        break;

    case 'logout':
            session_destroy();
            header("Location: index.php?route=login");
            exit;
        break;

    default:
        echo "404 not found ";
        break;
    }
?>
