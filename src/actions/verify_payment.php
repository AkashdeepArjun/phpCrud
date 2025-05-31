<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
/* file_put_contents(__DIR__.'/debug.log',json_encode([ */
/*     'session_id'=>$_SESSION['user_id']??'not set', */
/*     'post user id '=>json_decode(file_get_contents('php://input'),true), */
/*     'session status ' =>session_status()] */
/* ,JSON_PRETTY_PRINT)); */
require_once __DIR__.'/../config.php';

header('Content-Type: application/json');

$data=json_decode(file_get_contents("php://input"),true);

$user_id=$data['user_id'];

$session_id=$_SESSION['user_id']??'not set';

if(!$user_id ||(string)$user_id!=(string)$session_id){
    error_log('ERORRRRRR USER ID IS '.$user_id.' SESSION ID NULL IS '.$session_id);
    http_response_code(403);
    echo json_encode(['status'=>'error','msg'=>'unauthorized act']);
    exit;
}
try {

    $db=getDB();
    $query="UPDATE users SET is_premium = 1 WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id]);
    $_SESSION['is_premium']=1;
    echo json_encode(['status'=>'success']);
    exit;
} catch (Exception $th) {
    http_response_code(500);
    echo json_encode(['status'=>'fail','msg'=>'database error']);
}







?>

