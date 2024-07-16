<?php

class subunitmodel extends CI_Model{
    
   
    function __construct() {
            parent::__construct();
            //$this->db_cms = $this->load->database('cms', TRUE);   
    }
    
    public function getallsubunitByUnit($unit_id=0){
    
    if(isset($unit_id))$this->db->where('unit_id', $unit_id);
    $query = $this->db->get("subunit");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
             
                $data[] = $row;
            }
                return $data;
        }
        return false;      
   
}
    public function getallsubunit($limit, $start){
    $this->db->limit($limit, $start);
    $this->db->join('unit', 'unit.unit_id = subunit.unit_id','left');
    $query = $this->db->get("subunit");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
   
}

  public function getallunitbal($limit, $start){
   // $this->db->limit($limit, $start);
    $query = $this->db->get("unit_stock_balance");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
   
}


function insert_subunit($data){
       
       $this->db->insert('subunit', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
   }
   
     function getsinglesubunit($id){
    $this->db->select('*');
    $this->db->join('unit', 'unit.unit_id = subunit.unit_id','left');
    $this->db->where('subunit_id', $id);
    $query = $this->db->get('subunit');
    return $query->row_array();   
       
   }
   
   
   function update_subunit($id, $data)
	{
		$this->db->where('subunit_id', $id);
		$this->db->update('subunit', $data);
	}
        
        
  function delete_subunit($id){
        
        $this->db->where('subunit_id', $id);
        $this->db->delete('subunit');
        
    } 
    
    public function getalldepartmentbyfaculty($fac_id=0){
    
    if(isset($fac_id))$this->db->where('faculty_id', $fac_id);
    $query = $this->db->get("department");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
             
                $data[] = $row;
            }
                return $data;
        }
        return false;      
   
}
public function allunit(){

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

public function allsubunit(){

    $query = $this->db->get("subunit");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            
            
            return $data;
        }
        return false;      
   
}

public function alldepartment(){

    $query = $this->db->get("department");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            
            
            return $data;
        }
        return false;      
   
}

  function getsingleunitbalance($id){
    $this->db->select('*');
    $this->db->where('unit_stock_balance.unit_id', $id);
    $query = $this->db->get('unit_stock_balance');
    return $query->row_array();   
       
   }
   

}

?>