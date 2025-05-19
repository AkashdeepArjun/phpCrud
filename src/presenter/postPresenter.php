<?php
ob_clean();            
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
    ob_clean();
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $title=trim($_POST['title']);
        $content = trim($_POST['content']);

        if($title && $content){
            Post::create($title,$content);
            header('Content-Type: application/json');
            echo json_encode(['redirect'=>BASE_URL .'index.php?route=posts']);
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
    ob_clean();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id=trim($_POST['id']);
        $title=trim($_POST['title']);
        $content=trim($_POST['content']);
        if($id && $title && $content){

            Post::update($id,$title, $content);
            header('Content-Type: application/json');
            echo json_encode(['redirect'=>BASE_URL .'index.php?route=posts']);
            exit;
    }
}
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['error'=>'invalid request']);
    exit;
}

function deletePost(){
            $id=$_GET['id']??null;
        if($id){
                
            Post::delete($id);
            header('Location:'.BASE_URL.'index.php?route=posts');
            exit;

        }    
}

function search_posts(){
    
    $q=$_GET['q']??'';
    $q=trim($q);
    if($q!=''){
        
        $results=Post::search_by_title_content($q);

        if($results){
            echo json_encode(['data'=>$results]);
        }else{
           echo json_encode(['error'=>'could not load data']);
        }




    }




}



?>
