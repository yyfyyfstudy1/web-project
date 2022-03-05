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
}

