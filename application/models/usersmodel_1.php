<?php
/**
 * Description of amenity
 *
 * @author Gbadeyanka Abass
 */
class usersModel extends CI_Model{
    
    function __construct() {
            parent::__construct();
            $this->db = $this->load->database('default', TRUE);
            
    }
    
  function getallUsers($limit, $start) {
    $this->db = $this->load->database('default', TRUE);  //exit;
    
    $this->db->select('*');
    $this->db->join('roles', 'roles.role_id = users.group_id','left');
    $this->db->from('users');
    
        $query = $this->db->get();
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
  
   

   
   function insert_user($data){
       
       $this->db->insert('users', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
   }
   
   function update_user($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}
  
  
    function delete_guest($id){
        
        $this->db->where('id', $id);
        $this->db->delete('users');
        
    }    
    
    
   
    
     function uniqueUser($username)
	{       $this->db = $this->load->database('default', TRUE);
		$this->db->where('username', $username);
		$query = $this->db->get('users');
                return (isset($id)) ? FALSE :TRUE ;
	}
        
        function getSingleUser($id){
    $this->db->select('*');
    $this->db->where('id', $id);
    $query = $this->db->get('users');
    return $query->row_array();   
       
   }
   
}

