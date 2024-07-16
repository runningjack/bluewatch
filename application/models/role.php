<?php



/**
 * Description of Role
 *
 * @author Gbadeyanka Abass
 */
class role extends CI_Model{
    
    function __construct() {
            parent::__construct();
          $this->db = $this->load->database('default', TRUE);  
    }
    
    
    /**This Function add users Role
    * 
    * 
    */
    
    function addRole(){
          extract($_POST);
           $this->db = $this->load->database('default', TRUE);  
        $data = array('role_name'=> $role_name,
                      'description'=> $role_des);
		
		$this->db->insert('roles', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
                
        
    }
    
    function viewRole(){
$this->db = $this->load->database('default', TRUE);  	
     $query = $this->db->get("group_table");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
        
        
    }
    
    
    public function viewSingleRole($id){
        
		
$this->db = $this->load->database('default', TRUE);  		
     $this->db->where('group_id', $id);
     $query = $this->db->get("group_table"); 
     
    return $query->row_array();;   
       
		
        
    }
    
    
     function deleteRole(){
         $this->db = $this->load->database('default', TRUE);  
	   extract($_POST);
        
         $this->db->where('group_id', $id);
        $this->db->delete('group_table');       
        echo "<script type='text/javascript'>window.location.href = '".base_url('admin/accesscontrollist/rolelist/')."'</script>";
    }
    
    
    function editRole(){
        extract($_POST);
       
		$data = array('group_name'=> $role_name,
                      'group_description'=> $role_des);
		$this->db->where('group_id', $id);
		$this->db->update('group_table', $data);
      
        
        echo "<script type='text/javascript'>window.location.href = '".base_url('admin/accesscontrollist/rolelist/')."'</script>";

    }
    function fetchAllModule(){
	
     
     $this->db->select('*');
     $this->db->distinct('module_name');
     $query = $this->db->get("module");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
        
        
    }
	
	function fetchAllModulePermissions($id){
	
   
     $this->db->select('*');
     $this->db->where('module_id', $id);
     $query = $this->db->get("permissions");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
        
        
    }

    
    function rolePriviledge($id){
              
        
         $module_menu = array();
         $list = array();
         $perm = array();
                
        
        
        $role = Role::viewSingleRole($id);
        
        $module_menu['role'] = $role;
        
       
                  //fetch enabled menus
                  
                  $emodule = Role::fetchAllModule();                  
                  foreach($emodule as $s){
                      $list['module_name'] = $s->module_name;
                      $id =$s->module_id;
                   
                     
                      //echo $lsql;
                      $res2 = Role::fetchAllModulePermissions($id);
                      $menu =array();
                      $m_name_des =array();
                     // var_dump($res2);//exit;
                    
                      if($res2){
                          foreach($res2 as $k){ 
                          $menu['perm_name'] = $k->perm_name;
                          $menu['perm_desc'] = $k->perm_desc;
                          $menu['id'] = $k->perm_id;
                          $m_name_des [] = $menu;
                         // var_dump($menu);exit;
                      }
                      }
                     $list['menu'] = $m_name_des ;
                     $perm [] = $list;
                  }
        
           $module_menu['perm']  = $perm;
          return $module_menu;
    }
    
    
    function haveAccess($role_id,$perm_name){
   // var_dump($role_id,$perm_name);   exit; 	
    $this->db->select('*');
    $this->db->where('role_perm.role_id', $role_id);
	$this->db->where('permissions.perm_name', $perm_name);
    
    $this->db->join('role_perm', 'role_perm.perm_id = permissions.perm_id','left');
    $query = $this->db->get('permissions');
   // var_dump($query->row_array());exit;
    return $query->row_array(); 
        
    }
    
    
    
     function getPermId($perm_name){
	 
	 $this->db->select('perm_id');
    $this->db->where('perm_name', $perm_name);
	$query = $this->db->get('permissions');
    return $query->row_array(); 
       
        
    }
    
     function delete_role($id){
      
        $this->db->where('role_id', $id);
        $this->db->delete('role_perm');
        
    }   
    function updateRolePermition(){
      $this->db = $this->load->database('default', TRUE);   
        extract($_POST);
        $perm = array();
        $perm_ids = array();
       
        
       // echo $role_id;
        
        $perm = array_keys($group_role);
     //  var_dump($perm);
  //  exit();
        
        foreach($perm as $p){
            //var_dump($p);exit;
            $ky = $this->getPermId($p);
            $perm_ids[]= $ky;
            
        }
        //Update role permition
        $role_id = (int)$role_id;
        $this->delete_role($role_id);
      
        
        for($i=0;$i<count($group_role);$i++){
            //var_dump($perm_ids[$i]);exit;
            if($perm_ids[$i]){
           if($group_role[$perm[$i]]== 1){
		   
		     $data = array('role_id'=> $role_id,
                      'perm_id'=> $perm_ids[$i]["perm_id"]);
       $this->db = $this->load->database('default', TRUE);   
             $this->db->insert('role_perm', $data);		
                    
           }
            }
           
           
       }
        
    }
    
    
    function getModule(){
    $this->db = $this->load->database('default', TRUE);       
     $this->db->select('*');	 
     $query = $this->db->get("module");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
        
        
    }
    
    
    function addPermition(){
        extract($_POST);
   
       
	   $data = array('module_id'=> $module,
                      'perm_name'=> $value,
					  'perm_desc'=> $perm_name,
					  'visible'=> $visible);
       
       $this->db->insert('permissions', $data);		
       $id = $this->db->insert_id();		
     
       
      echo "<script type='text/javascript'>window.location.href = '".base_url('admin/accesscontrollist/viewperm/')."'</script>";
 
      
       
        
    }
    
    function editPermition($id){ 
      extract($_POST);
      $this->db = $this->load->database('default', TRUE);  
  
	    $data = array('module_id'=> $module,
                      'perm_name'=> $value,
					  'perm_desc'=> $perm_name,
					  'visible'=> $visible);
	   $this->db->where('perm_id', $id);
		$this->db->update('permissions', $data);
       
         
          echo "<script type='text/javascript'>window.location.href = '".base_url('admin/accesscontrollist/viewperm/')."'</script>";
    }
    
    
    function viewPerm(){
           $this->db = $this->load->database('default', TRUE);  
           $emodule = Role::fetchAllModule();                  
                  foreach($emodule as $s){
                      $list['module_name'] = $s->module_name;
                      $id =$s->module_id;
                   
                     
                      //echo $lsql;
                      $res2 = Role::fetchAllModulePermissions($id);
                      $menu =array();
                      $m_name_des =array();
                      //var_dump($res2);exit;
                      if($res2){
                      foreach($res2 as $k){
                          $menu['perm_name'] = $k->perm_name;
                          $menu['perm_desc'] = $k->perm_desc;
                          $menu['id'] = $k->perm_id;
						  
                          $menu['visible'] = $k->visible;
                          
                          $m_name_des [] = $menu;
                      }
                     $list['menu'] = $m_name_des ;
                     $perm [] = $list;
                  }}
        
           $module_menu['perm']  = $perm;
           ///var_dump($module_menu);exit;
          return $module_menu;
        
        
    }
    
     function viewSinglePerm($id){
	$this->db = $this->load->database('default', TRUE);   
	  $this->db->select('*');
    $this->db->where('perm_id', $id);
    $query = $this->db->get('permissions');
    return $query->row_array(); 
        
       
    }
    
    function deletePerm($perm_id){
        $this->db = $this->load->database('default', TRUE);   
	$this->db = $this->load->database('default', TRUE);  
        $this->db->where('perm_id', $perm_id);
        $this->db->delete('permissions');       
        
       
         echo "<script type='text/javascript'>window.location.href = '".base_url('admin/accesscontrollist/viewperm/')."'</script>";
    }
    
    
    
    
    
    
    
    
    
    
}

?>
