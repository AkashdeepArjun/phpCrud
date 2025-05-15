<?php

require_once PROJECT_ROOT.'/config.php';


class Post{


static function all() {

        $db=getDB();
        $stmt=$db->query("SELECT * FROM posts ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

    static function find($id){

        $db=getDB();
        $stmt=$db->prepare(" SELECT * FROM posts where id = ? ");
        $stmt->execute([ $id ]);
        /* error_log($stmt->fetch(PDO::FETCH_ASSOC)); */
        return $stmt->fetch(PDO::FETCH_ASSOC);


    }

static function create($title,$content){

            $db=getDB();
            $stmt=$db->prepare('INSERT INTO posts (title,content) VALUES (?,?)');
            $stmt->execute([$title,$content]);   
}
static function update($id,$title,$content){

        $db = getDB();
        $stmt=$db->prepare('UPDATE posts SET title =? ,content=? WHERE id =?');
        $stmt->execute([$title,$content,$id]);


   

}

static function delete($id){

        $db=getDB();
                $stmt =$db->prepare('DELETE FROM posts where id =?');
                $stmt->execute([$id]);

        }




}








?>

