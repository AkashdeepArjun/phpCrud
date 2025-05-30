<?php

require_once PROJECT_ROOT.'/config.php';


class Post{

        static function getUsers(){
                $current_user = $_SESSION['user_id'];
                $query = "SELECT * FROM users where id != ?";
                $db=getDB();
                $stmt=$db->prepare($query);
                $stmt->execute([$current_user]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);



        }


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


        static function search_by_title_content($term){
                
                $trimmed = trim($term);

                if ($trimmed==='' | strlen($trimmed)===0) {
                        error_log(__FILE__.' :QUERY EMPTY');
                        return [];
                }

                $db =getDB();
                $stmt=$db->prepare("SELECT  * FROM posts WHERE title LIKE ? OR content LIKE ? LIMIT 10");
                $key="%$trimmed%";
                $stmt->execute([$key,$key]);
                 return $stmt->fetchAll(PDO::FETCH_ASSOC);


        }
 
                
        static function paginate($data_per_page,$offset,$order_by='created_at DESC',$where='',$params=[]){

                $db=getDB();
                $query="SELECT * FROM posts";
                if(!empty($where)){
                        
                        $query .= " WHERE 1=1 ". $where;
                        
                }
                $query.=" ORDER BY $order_by LIMIT $data_per_page OFFSET $offset";
                $stmt=$db->prepare($query);
                error_log('QUERY PASSED '.$query);
                error_log('PASSED PARAMETERS'.json_encode($params)); 
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                

        }

        //inititlay when page loads $where is supposed to be empty isnt?

        static function enteries($where='',$params=[]){
                
                $db=getDB();
                $query = "SELECT COUNT(*) FROM posts";
                if(!empty($where)){
                    
                        $query .= " WHERE 1=1 ". $where;
                        
                } 
                $stmt=$db->prepare($query);
                $stmt->execute($params);
                return $stmt->fetchColumn();
        

        }





}








?>

