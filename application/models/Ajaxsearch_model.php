<?php
class Ajaxsearch_model extends CI_Model
{




 function fetch_data($query)
 {
  $this->db->select("*");
  $this->db->from("files");
  if($query != '')
  {

   $this->db->like('id', $query);
   $this->db->or_like('filename', $query);
   $this->db->or_like('username', $query);
   
//    $this->db->or_like('PostalCode', $query);
//    $this->db->or_like('Country', $query);
  }
  $this->db->order_by('id', 'DESC');


  return $this->db->get();
 }





 function wchat_record()
 {
  $this->db->select("*");
  $this->db->from("wechat");
  $this->db->order_by('id', 'ASC');
  return $this->db->get();
 }


 public function insert_wechat_record($username, $record, $date){

  $data = array(
      'username' => $username,
      'record' => $record,
      'time' => $date
  );
  $this->db->insert('wechat', $data);

}




}
?>