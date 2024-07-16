<?php

class Unitmodel extends CI_Model{
    
   
    function __construct() {
            parent::__construct();
            //$this->db_cms = $this->load->database('new_hospital', TRUE);   
    }
    
    
    
    
    public function getallunit($limit='', $start=''){
             
              
             
    $this->db->limit($limit, $start);
    $query = $this->db->get("unit");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
   
}

    
    public function getallfaculty($limit, $start){
    $this->db->limit($limit, $start);
    $query = $this->db->get("faculty");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
   
}


function insert_unit($data){
       
       $this->db->insert('unit', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
   }
   
     function getSingleUnit($id){
    $this->db->select('*');
    $this->db->where('unit_id', $id);
    $query = $this->db->get('unit');
    return $query->row_array();   
       
   }
   
   
   function update_unit($id, $data)
	{
		$this->db->where('unit_id', $id);
		$this->db->update('unit', $data);
	}
        
        
  function delete_unit($id){
        
        $this->db->where('unit_id', $id);
        $this->db->delete('unit');
        
    }  

}

?>