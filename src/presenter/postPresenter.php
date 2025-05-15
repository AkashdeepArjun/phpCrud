<?php

            
require_once PROJECT_ROOT.'/model/Post.php';

function listposts(){

    $posts=Post::all();
    require PROJECT_ROOT. '/view/postLists.php' ;


}

function createPost(){
    
    $post =['title'=>'','content'=>'','id'=>null];
    require PROJECT_ROOT. '/view/postForm.php' ;


}

function savePost(){

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $title=trim($_POST['title']);
        $content = trim($_POST['content']);

        if($title && $content){
            Post::create($title,$content);
            header('Location: index.php?route=posts');
            exit;

        } 


    }



}



function editPost(){
    
    $id=$_GET['id']??null;
    if($id){
    
        $post=Post::find($id);
        if($post){
            require PROJECT_ROOT.'/view/postForm.php';
        }

    }


}

function updatePost(){

    if($_SERVER['REQUEST_METHOD']=='POST'){

        
        $id=trim($_POST['id']);
        $title=trim($_POST['title']);
        $content=trim($_POST['content']);

        if($id && $title && $content){

    Post::update($id,$title, $content);
    header('Location:'.BASE_URL.'index.php?route=posts');
    exit;

    }


}

}

function deletePost(){

    /* if(isset($_GET['action']) && $_GET['action']==='delete'){ */

                
            $id=$_GET['id']??null;
            
        if($id){
                
            Post::delete($id);
            /* header('Location:src/index.php?route=posts'); */

            header('Location:'.BASE_URL.'index.php?route=posts');
            exit;

        }    



    /* } */



}













?>
    
