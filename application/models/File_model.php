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

    public function user_pic($filename, $path, $username){

        $data = array(
            'filename' => $filename,
            'path' => $path,
            'username' => $username
        );
        $query = $this->db->insert('userpic', $data);

    }


    function print_img_profile($username)
    {
        $this->db->select("*");
        $this->db->from("userpic");
        $this->db->like('username', $username);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get();
        
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


}

