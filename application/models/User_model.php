<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{

    // Log in
    public function login($username, $password){
        // Validate
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('users');

        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
    }

    public function userRegister($emailAddress, $username, $password){
        $data = array(
            'username' => $username,
            'password' => $password,
            'Email' => $emailAddress
        );
       $this->db->insert('users', $data);
    }

    public function sendEmail($emailAddress){
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> '.base_url().'SignUp/verify/' . md5($emailAddress) . '<br /><br /><br />Thanks<br />Mydomain Team';
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.qq.com';
        $config['smtp_user'] = '294006654@qq.com';
        $config['smtp_pass'] = "mtfmbqvtpjhlbgje";//填写腾讯邮箱开启POP3/SMTP服务时的授权码，即核对密码正确
        $config['smtp_port'] = 465;
        $config['charset'] = 'utf-8';
        $config['smtp_timeout'] = 30;
        $config['mailtype'] = 'text';
        $config['wordwrap'] = TRUE;
        $config['crlf'] = PHP_EOL;
        $config['newline'] = PHP_EOL;


        $this->email->initialize($config);
        $this->email->from('294006654@qq.com', 'Learner Team');
        $this->email->to($emailAddress);
        $this->email->cc('XXXXXXXX@qq.com');
        $this->email->bcc('XXXXXXXX@qq.com');   
        $this->email->subject('resgister confirm Email');
        $this->email->message($message);
        //echo $this->email->print_debugger();
        //return $this->email->send();
        if($this->email->send()){
                
                }else{
                echo $this->email->print_debugger();
                }

    }

    
       //activate user account
       function verifyEmailID($key, $key2)
       {
           $data = array('status' => 1);
           $this->db->where('md5(Email)', $key);
           $this->db->where('md5(password)', $key2);

           return $this->db->update('users', $data);
       }


       // 检测用户是否存在
       function chekUsernameEmail($email, $username){

        $this->db->where('Email', $email);
        $this->db->where('username', $username);
        $result = $this->db->get('users');

        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }

       }

       function takeOldPassword($username){
        $this->db->select("*");
        $this->db->where('username', $username);
       $data =  $this->db->get('users')->result();
       foreach($data as $use){
            return $use->password;
            break;
       }
       

       }

       function takeUpdateTime($email, $password){
        $this->db->select("*");
        $this->db->where('Email', $email);
        $this->db->where('password', $password);
        $data =  $this->db->get('users')->result();
        foreach($data as $use){
             return $use->updateTime;
             break;
        }
       }

       //发送让用户修改密码的邮件
       function sendChangeEmail($email, $password){
        
        date_default_timezone_set("Asia/Shanghai");
        // 更新账户更改的时间
        $data = array('updateTime' => date('Y-m-d H:i:s'));
        $this->db->where('Email', $email);
        $this->db->where('password', $password);

        $this->db->update('users', $data);

        $message = 'Dear User,<br /><br />Please click on the below activation link to upload your password in 1 Hour.<br /><br /> '.base_url().'ForgetPassword/verify/' . md5($email) . '/'.md5($password).'<br /><br /><br />Thanks<br />Mydomain Team';
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.qq.com';
        $config['smtp_user'] = '294006654@qq.com';
        $config['smtp_pass'] = "mtfmbqvtpjhlbgje";//填写腾讯邮箱开启POP3/SMTP服务时的授权码，即核对密码正确
        $config['smtp_port'] = 465;
        $config['charset'] = 'utf-8';
        $config['smtp_timeout'] = 30;
        $config['mailtype'] = 'text';
        $config['wordwrap'] = TRUE;
        $config['crlf'] = PHP_EOL;
        $config['newline'] = PHP_EOL;


        $this->email->initialize($config);
        $this->email->from('294006654@qq.com', 'Learner Team');
        $this->email->to($email);
        $this->email->cc('XXXXXXXX@qq.com');
        $this->email->bcc('XXXXXXXX@qq.com');   
        $this->email->subject('resgister confirm Email');
        $this->email->message($message);
        //echo $this->email->print_debugger();
        //return $this->email->send();
        if($this->email->send()){
                
                }else{
                echo $this->email->print_debugger();
                }


       }
       // 更像用户的密码
       public function updateUserPassword($email, $oldPassword, $password){
        $data = array('password' => $password);
        $this->db->where('md5(Email)', $email);
        $this->db->where('md5(password)', $oldPassword);
        return $this->db->update('users', $data);
       }
}
?>
