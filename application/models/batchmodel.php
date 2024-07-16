<?php

class batchmodel extends CI_Model{
    
   
    function __construct() {
            parent::__construct();
            //$this->db_cms = $this->load->database('cms', TRUE);   
    }
    
    
    public function getallbatch($limit, $start){
      $query = $this->db->get("batch");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
   
}


function insert_batch($data){
       
       $this->db->insert('batch', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
   }
   
     function getsinglebatch($id){
    $this->db->select('*');
    $this->db->where('batch_id', $id);
    $query = $this->db->get('batch');
    return $query->row_array();   
       
   }
   
   function getcurrentbatch(){
    $this->db->select('*');
    $this->db->where('batch_status','current');
    $query = $this->db->get('batch');
    return $query->row_array();   
       
   }
   
   function update_batch($id, $data)
	{
		$this->db->where('batch_id', $id);
		$this->db->update('batch', $data);
	}
        
         function clear_status($id, $data)
	{
		$this->db->where('batch_status', $id);
		$this->db->update('batch', $data);//exit;
	}
        
        
  function delete_batch($id){
        
        $this->db->where('batch_id', $id);
        $this->db->delete('batch');
        
    } 
    



public function allbatch(){

    $query = $this->db->get("batch");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            
            
            return $data;
        }
        return false;      
   
}

}

?>