<?php





function require_valid_user(){


    require_once PROJECT_ROOT.'/config.php';
    if(!isset($_SESSION['user_id'])){

        die("you must logged in");


    }
    $db=getDB();
    
    $query="SELECT role from users where id = ?";

    $stmt=$db->prepare($query);

    $stmt->execute([$_SESSION['user_id']]);
    
    $user=$stmt->fetch();

    if(!$user || $user['role']!='admin'){

        die('Access Denied Only Admins are permitted to use this operation');
    }

    

}


function reguire_login(){

    if(empty($_SESSION['user_id'])){
        header("Location: index.php?route=login");
        exit;
    }


}



function require_permission($perm){

    reguire_login();
    
    if(empty($_SESSION['permissions'])){
        
        http_response_code(403);
        error_log("PERMISSIONS DENIED for user {$_SESSION['uname']} on {$perm}");
        exit('no permissions granted');


    }    

    $user_perms= array_map('trim',explode(',',$_SESSION['permissions']));
    
    if(!in_array($perm,$user_perms)){

        
            http_response_code(403);
    
            exit('you dont have permission of '.htmlspecialchars($perm));



    }




}



?>
    
