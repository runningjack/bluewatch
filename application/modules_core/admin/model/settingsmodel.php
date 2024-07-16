<?php



/**
 * Description of Role
 *
 * @author Gbadeyanka Abass
 */
class settingsmodel extends CI_Model{
    
    function __construct() {
            parent::__construct();
          $this->db = $this->load->database('default', TRUE);  
    }
    
    
    function getCountry()
    {

      $this->db->select('code,id,name');
      $results = $this->db->get('country')->result();
      $country_select = array();
      foreach ($results as $result) {
          $country_select[$result->code] = $result->name;
      } 
    return $country_select;
      
    }


    

    
    
    
    
    
    
}

?>
