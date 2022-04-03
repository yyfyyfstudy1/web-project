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
       function verifyEmailID($key)
       {
           $data = array('status' => 1);
           $this->db->where('md5(Email)', $key);
           return $this->db->update('users', $data);
       }
}
?>
