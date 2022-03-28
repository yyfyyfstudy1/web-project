<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class File_model extends CI_Model{

    // upload file
    public function upload($filename, $path, $username, $title, $content, $status, $category){

        $data = array(
            'filename' => $filename,
            'path' => $path,
            'username' => $username,
            'post'=> $status,
            'title'=> $title,
            'content' => $content,
            'category' => $category
        );
        $query = $this->db->insert('files', $data);

    }
    function fetch_data($query)
    {
        if($query == '')
        {
            return null;
        }else{
            $this->db->select("*");
            $this->db->from("files");
            $this->db->like('filename', $query);
            $this->db->or_like('username', $query);
            $this->db->order_by('filename', 'DESC');
            return $this->db->get();
        }
    }

    function print_img($username)
    {
        $this->db->select("*");
        $this->db->from("files");
        $this->db->like('username', $username);
        return $this->db->get();
        
    }
    //需要进行重构的函数
    public function user_pic($filename, $path, $username){

        $data = array(
            'filename' => $filename,
            'path' => $path,
            'username' => $username
        );
        $query = $this->db->insert('userpic', $data);

    }

     //需要进行重构的函数
    function print_img_profile($username)
    {
        $this->db->select("*");
        $this->db->from("userpic");
        $this->db->like('username', $username);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get();
        
    }

    //把用户头像信息插入user表的函数
    function update_user_profile($username, $filename)
    {
        $data = array(
            'avaterName' => $filename,
        
    );
    
    $this->db->where('username', $username);
    $this->db->update('users', $data);
        
    }


    function print_common_img($category)
    {
        $this->db->select("*");
        $this->db->from("files");
        $this->db->like('post', 'yes');
        $this->db->like('category', $category);
        // $this->db->like('username', $username);
        return $this->db->get();
        
    }

    function print_common_img2()
    {
        $this->db->select("*");
        $this->db->from("files");
        $this->db->like('post', 'yes');
        // $this->db->like('username', $username);
        return $this->db->get();
        
    }


    public function insert_common($filename, $comment, $username){

        $data = array(
            'filename' => $filename,
            'comment' => $comment,
            'username' => $username
        );
        $query = $this->db->insert('comments', $data);

    }

    public function read_comment($filename){

        $this->db->select("*");
        $this->db->from("comments");
        $this->db->like('filename', $filename);
        
        return $this->db->get();

    }

    public function pic_post($filename){


        $array = array(
            
            'post' => 'yes'
    );
    
    $this -> db -> where ( 'filename' ,  $filename ); 
    $this -> db -> update ( 'files' ,  $array ); 

    }

    public function pic_delete($filename){


        $array = array(
            
            'post' => 'no'
    );
    
    $this -> db -> where ( 'filename' ,  $filename ); 
    $this -> db -> update ( 'files' ,  $array ); 

    }

    //定义插入点赞信息的函数

    public function likes_add($likes_id){

        $this->db->set('user_likes', 'user_likes+1',false);
        $this->db->where('id', $likes_id);
        $this->db->update('files');
    }


    public function insert_llike($username, $likes_id){

        $data = array(
            'username' => $username,
            'likes_file' => $likes_id
    );
    
    $this->db->insert('user_likes', $data);
    }


    //判断用户是否点赞的函数
    public function if_likes($username, $likes_id){
        $this->db->where('username', $username);
        $this->db->where('likes_file', $likes_id);
        $result = $this->db->get('user_likes');

        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
        
    }

    // 用户提问插入的函数
    public function userPostQuestion($queTitle, $queCategory, $queContent, $userName){
        date_default_timezone_set('Asia/Shanghai');
         $data = array(
            'queTitle' => $queTitle,
            'queCategory' => $queCategory,
            'queContent' => $queContent,
            'pubTime' => date('Y-m-d H:i:s'),
            'userName' => $userName

        );
         $this->db->insert('question', $data);
        
    }


    // 获取用户提问列表的函数
    public function takePostQuestion($category){
        $this->db->select("*");
        $this->db->from("question");
        $this->db->join('users', 'users.username = question.userName');
        $this->db->order_by('queId', 'DESC');
        if($category==1){
            return $this->db->get();
        }
        $this->db->like('queCategory', $category);
        // $this->db->like('username', $username);
        return $this->db->get();
       
   }

    //  获取指定问题内容的函数
    public function showQuestion($id){
        $this->db->select("*");
        $this->db->from("question");
        $this->db->join('users', 'users.username = question.userName');
        $this->db->like('queId', $id);
        // $this->db->like('username', $username);
        // 这里有个神秘bug
        $this->db->limit(1);
        return $this->db->get();
       
   }

     //  获取指定回复内容的函数
     public function showAnswer($id){
        $this->db->select("*");
        $this->db->from("answer");
        $this->db->join('users', 'users.username = answer.answerUserName');
        $this->db->like('answerQueId', $id);
        return $this->db->get();
       
   }

    // 发布指定问题回答的函数
    public function userAnswerQuestion($answerContent, $userName, $queId){
        date_default_timezone_set('Asia/Shanghai');
         $data = array(

            'answerUserName' => $userName,
            'answerQueId' => $queId,
            'answerPubTime' => date('Y-m-d H:i:s'),
            'answerContent' => $answerContent
            
           

        );
         $this->db->insert('answer', $data);
        
    }


    //发布评论的函数
    public function post_comment($comment_content , $commentQueID, $comment_ans_id,$comment_reply_id, $commenter_name){
        date_default_timezone_set('Asia/Shanghai');
         $data = array(

            'comment_content' => $comment_content,
            'comment_que_id' => $commentQueID,
            'comment_ans_id' => $comment_ans_id,
            'comment_reply_id'=>$comment_reply_id,
            'comment_time' => date('Y-m-d H:i:s'),            
            'commenter_name'=>$commenter_name
            
           

        );


        $data2 = array(

            'copy_content' => $comment_content,
            'copy_que_id' => $commentQueID,
            'copy_answer_id' => $comment_ans_id,
            'copy_reply_id'=>$comment_reply_id,
            'copy_time' => date('Y-m-d H:i:s'),            
            'copy_name'=>$commenter_name
            
           

        );
         $this->db->insert('queboard_comments', $data);
         $id = $this->db->insert_id();
        if($comment_reply_id==0){

            $data_id = array(
                'comment_reply_id' => $id
            
             );
        
            $this -> db -> where ( 'comment_id' ,  $id ); 
            $this->db->update('queboard_comments', $data_id);


        }
        
         
         $this->db->insert('que_comment_copy', $data2);
        
    }



   

      //  获取指定评论的函数
      public function showComment(){
        $this->db->select("*");
        $this->db->from("queboard_comments");
        $this->db->join('users', 'users.username = queboard_comments.commenter_name');
        
        $this->db->join('que_comment_copy', 'que_comment_copy.copy_id = queboard_comments.comment_reply_id');
        $this->db->order_by('comment_id', 'ASC');
        
        return $this->db->get();
       
   }



}

