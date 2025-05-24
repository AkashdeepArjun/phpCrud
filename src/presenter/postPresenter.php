<?php
ob_clean();            
require_once PROJECT_ROOT.'/model/Post.php';
function listposts(){

        reguire_login();
    /* $posts=Post::all(); */
    $page=isset($_GET['page'])?max(1,(int)$_GET['page']):1;
    $data_per_page=7;
    $offset =($page-1)*$data_per_page;
    $order_by='created_at DESC';
    $sort_choice=$_GET['sort']??'date_desc';
    switch ($sort_choice) {
        case 'title_asc':
            $order_by='title ASC';
            break;
        
        case 'title_desc':
            $order_by='title DESC';
            break;

        case 'date_asc':
            $order_by='created_at ASC';
            break;


        case 'date_desc':
            $order_by='created_at DESC';
            break;


        default:
            $order_by='created_at DESC';
            break;
    }
    
    $posts=Post::paginate($data_per_page,$offset,$order_by);
    $total_posts=Post::entries();
    $total_pages=ceil($total_posts/$data_per_page); 
    require PROJECT_ROOT. '/view/postLists.php' ;


}

function signup(){

    $title='Signup';
    require PROJECT_ROOT.'/view/signup.php';


}

function login(){

   $title='Login'; 
    require_once PROJECT_ROOT.'/view/login.php';


}



function signup_submit(){

    $uname =trim($_POST['uname']??'');
    $upass=trim($_POST['upass']??'');
    
    if($uname && $upass){
    
        $hashed_pass = password_hash($upass,PASSWORD_DEFAULT);

        $db=getDB();

        $stmt=$db->prepare('INSERT INTO users (uname,upass) VALUES (?,?)');
        try {
            
            $stmt->execute([$uname,$hashed_pass]);
            header("Location: index.php?route=login");
            exit;

        } catch (PDOException $e) {
            error_log("ERROR AT".__FILE__." message is ".$e->getMessage());
        }

 //user gets created i checked at mysql but is running alternate condition else part as well 
    }else{
        /* http_response_code(404); */
        echo "invalid credentials";

    }
}

function login_submit(){

    $uname = trim( $_POST['uname']??'' );
    $upass= trim($_POST['upass']??'');

    $db=getDB();
    $stmt=$db->prepare('SELECT * from users WHERE uname=?');
    $stmt->execute([$uname]);
    $user =$stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($upass,$user['upass'])){
        $_SESSION['user_id']=$user['id'];
        $_SESSION['uname']=$user['uname'];
        $_SESSION['role'] =$user['role'];
        session_regenerate_id(true); 
        header("Location: index.php?route=posts");
        exit;

    }else{
        
            echo "invalid user ".$user['upass'];
            exit;


    }

// oh thanks it worked add as of now i am able to access posts route without login ..seems have to add some sort of session logic there ?



}

function post_details(){
    
    $id= $_GET['id']??null;
    if($id){

        $post = Post::find($id);
        
        if($post){
            
            require PROJECT_ROOT.'/view/postDetail.php';
        
        }
        

    }
    

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
    header('Content-Type: application/json');
    if($q===''){
        echo json_encode(['data'=>[]]);
        exit;
    }
    if($q!=''){
        
        $results=Post::search_by_title_content($q);

        if($results){
            echo json_encode(['data'=>$results]);
            exit;
        }else{
            echo json_encode(['error'=>'could not load data']);
            exit;
        }
    }
// i put exit after echo json_encode it fixed why ?



}
function log_search_query(){
    $q=$_POST['q']??'';
    
    $q = trim($q);

    if($q==='') return;
    
    header('Content-Type: application/json');

    try {

    $db = getDB();
    $stmt = $db->prepare("INSERT INTO popular_queries (q,count) VALUES (?,1) ON DUPLICATE KEY UPDATE count=count+1");
    $stmt->execute([$q]);
    echo json_encode(['status'=>'ok']);

   
    } catch (\Throwable $th) {
        //throw $th;
        echo json_encode(['fail'=>$th->getMessage()]);
    }
}



function get_query_suggestions(){

    $q=$_GET['q']??'';
    $q=trim($q);
    header('Content-Type: application/json');
    
    if($q===''){
        echo json_encode(['suggestions'=>[]]);
        error_log('empty suggestions');
        exit;
    }

    $db =getDB();
    $stmt=$db->prepare('SELECT q from popular_queries where q LIKE ? ORDER BY count DESC LIMIT 5');
    $final_q="%".$q."%";
    $stmt->execute([$final_q]);
    $suggestions=$stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode(['suggestions'=>$suggestions]);
    exit;


 
    // there is issue that we are logging queries on db  on change listener which is costly since it is saving 
    // query on db everytime text changes but logging should happen when user select one of search results sending you my js <fieldset>
        

}

function reguire_login(){

    if(empty($_SESSION['user_id'])){
        header("Location: index.php?route=login");
        exit;
    }


}



?>
