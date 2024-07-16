<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accessControlModel
 *
 * @author Gbadeyanka Abass
 */
class accessControlModel extends CI_Model{
   
    
     function __construct() {
            parent::__construct();
            $this->db = $this->load->database('default', TRUE);
            
    }
    
 
 
     function loginEmail($username)
 {
   $this->db->select('users.*');
   $this->db->select('users.id AS user_id');
   $this->db->select('Employees.department');
   $this->db->select('Employees.id AS id');
    $this->db->join('Employees', 'Employees.id = users.employee_id', 'left');
   $this->db->where('users.username', $username); 
   $this->db->limit(1);

   $query = $this->db->get('users');

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 
 
 
 
 
    function login($username, $password)
 {
   $this->db->select('users.*');
   $this->db->select('users.id AS user_id');
   $this->db->select('Employees.department');
   $this->db->select('Employees.id AS id');
    $this->db->join('Employees', 'Employees.id = users.employee_id', 'left');
   $this->db->where('users.username', $username);
   //$this->db->where('users.password', MD5($password));
   $this->db->limit(1);

   $query = $this->db->get('users');

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 
 
  function std_login($username, $password)
 {
   $this->db->select('*');
   $this->db->from('login');
   $this->db->where('log_username', $username);
   $this->db->where('log_password', MD5($password));
   $this->db->limit(1);

   $query = $this->db->get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 
 
 function addrole(){
     
    
 }
 
 
 
}

?>
