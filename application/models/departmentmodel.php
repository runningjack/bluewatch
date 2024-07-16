<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utility
 *
 * @author Gbadeyanka Abass
 */
class departmentmodel extends CI_Model{
    
     function __construct() {
            parent::__construct();
            $this->db = $this->load->database('default', TRUE);
            
    }
    
   function getAllDepartment()
    {
        $this->db->select('*');
        $query = $this->db->get("companystructures");
        return $query->result();
    }

    function getAllHrDepartment()
    {
        $this->db->select('*');
        $query = $this->db->get("hr_department");
        return $query->result();
    }

    // hr_department

   
}

?>
