<?php

class projectbudgetmodel extends CI_Model{
    
   
    function __construct() {
            parent::__construct();
            //$this->db_cms = $this->load->database('cms', TRUE);   
    }
    


    public function getRecognizedIncome($id)
    {
        $this->db->select_sum('rev_amount');
        $this->db->where('project_id', $id);
        $query = $this->db->get('project_revenue');

        return $query->row_array();
    }


    public function getRecognizedIncomeAll()
    {
        $this->db->select_sum('rev_amount');
        //$this->db->where('project_id', $id);
        $query = $this->db->get('project_revenue');

        return $query->row_array();
    }


    
    public function getAllRecognizedIncome()
    {
        $this->db->select_sum('rev_amount'); 
        $query = $this->db->get('project_revenue');

        return $query->row_array();
    }


    

    
    public function getallprojects($limit, $start){
      $query = $this->db->get("projects");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
   
}


public function getAllRevenueByProjectID($limit, $start,$project_id){

    $this->db->where('project_id', $project_id);
    $query = $this->db->get("project_revenue");
      if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
             // var_dump($this->GuestStatus($row->guestid));exit;
              $data[] = $row;
          }
          return $data;
      }
      return false;      
 
}

public function getprojectbudgetDetails($project_id){
   
//$this->db->join('projects', 'projects.id = project_budget_detail.project_id','left');
//$this->db->join('companystructures', 'companystructures.id = project_budget_detail.department','left'); 
$this->db->where('project_id', $project_id);
$query = $this->db->get("project_budget_detail");
  if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
         // var_dump($this->GuestStatus($row->guestid));exit;
          $data[] = $row;
      }
      return $data;
  }
  return false;      

}

public function getsingleprojectBudget($project_id){
    $this->db->where('project_id', $project_id);
    $query = $this->db->get("project_budget");
      if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
             // var_dump($this->GuestStatus($row->guestid));exit;
              $data[] = $row;
          }
          return $data;
      }
      return false;      
    
    }


public function getsingleprojectBudgetDetails($project_id){
        $this->db->where('project_id', $project_id);
        $query = $this->db->get("project_budget_detail");
          if ($query->num_rows() > 0) {
              foreach ($query->result() as $row) {
                 // var_dump($this->GuestStatus($row->guestid));exit;
                  $data[] = $row;
              }
              return $data;
          }
          return false;      
        
        }



public function getsingleprojectBudgetDetailsAll(){
          //  $this->db->where('project_id', $project_id);
            $query = $this->db->get("project_budget_detail");
              if ($query->num_rows() > 0) {
                  foreach ($query->result() as $row) {
                     // var_dump($this->GuestStatus($row->guestid));exit;
                      $data[] = $row;
                  }
                  return $data;
              }
              return false;      
            
            }



public function getsingleprojectBudgetDetailsHeader($project_id,$dept){
                $this->db->where('project_id', $project_id);
                $this->db->where('department', $dept);
                $query = $this->db->get("project_budget_details_header");
                  if ($query->num_rows() > 0) {
                      foreach ($query->result() as $row) {
                         // var_dump($this->GuestStatus($row->guestid));exit;
                          $data[] = $row;
                      }
                      return $data;
                  }
                  return false;      
                
                }


                public function ProjectRecieveableIncomeAllByDate($start_date,$end_date)
                {
                    $this->db->select_sum('rev_amount');
                    $this->db->select('project_id');
                    $this->db->group_by('project_id');
                    $date_from = date("Y-m-d", strtotime($start_date)) . ' 00:00:00';
                    $date_to = date("Y-m-d", strtotime($end_date)) . ' 23:59:59';
                    if ($start_date) $this->db->where("project_revenue.rev_date BETWEEN '$date_from' AND '$date_to'");                          
                    // $this->db->where('rev_date >=', $start_date);
                    // $this->db->where('rev_date <=', $end_date);
                    $query = $this->db->get('project_revenue');
                    //var_dump($query->num_rows());exit;
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                           // var_dump($this->GuestStatus($row->guestid));exit;
                            $data[$row->project_id] = $row->rev_amount;
                        }
                        return $data;
                    }
                    return false; 
                }

                public function ProjectRecieveableIncomeAll()
                {
                    $this->db->select_sum('rev_amount');
                    $this->db->select('project_id');
                    $this->db->group_by('project_id');
                    $query = $this->db->get('project_revenue');
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                           // var_dump($this->GuestStatus($row->guestid));exit;
                            $data[$row->project_id] = $row->rev_amount;
                        }
                        return $data;
                    }
                    return false; 
                }


public function ProjectBudgetDetailsHeaderByProject($project_id){
            $this->db->select('SUM(percentage) AS total_percentage,budget_head,SUM(budget_amount) AS sum_amount');
             $this->db->where('project_id', $project_id); 

            //project_budget_detail
            $this->db->group_by('budget_head'); 
            $query = $this->db->get("project_budget_details_header");
              if ($query->num_rows() > 0) {
                  foreach ($query->result() as $row) {
                      $data[] = $row;
                  }
                  return $data;
              }
              return false;      
            
            }



public function getsingleprojectBudgetDetailsHeaderByProject($project_id){
                $this->db->where('project_id', $project_id); 
                $query = $this->db->get("project_budget_details_header");
                  if ($query->num_rows() > 0) {
                      foreach ($query->result() as $row) {
                         // var_dump($this->GuestStatus($row->guestid));exit;
                          $data[] = $row;
                      }
                      return $data;
                  }
                  return false;      
                
                }


                //getsingleprojectBudgetDetailsHeaderByDept


public function getsingleprojectBudgetDetailsHeaderAll($dept){
                $this->db->where('department', $dept);
                $query = $this->db->get("project_budget_details_header");
                  if ($query->num_rows() > 0) {
                      foreach ($query->result() as $row) {
                         // var_dump($this->GuestStatus($row->guestid));exit;
                          $data[] = $row;
                      }
                      return $data;
                  }
                  return false;      
                
                }
    



public function getRevenueHead()
{
    //revenue_head
  $query = $this->db->get("revenue_head");
  if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
          $data[] = $row;
      }
      return $data;
  }
  return false;   
}

function insert_project_revenue($data){       
    $this->db->insert('project_revenue', $data);		
    $id = $this->db->insert_id();		
   return (isset($id)) ? $id : FALSE;
}

function insert_projects_budget($data){       
    $this->db->insert('project_budget', $data);		
    $id = $this->db->insert_id();		
   return (isset($id)) ? $id : FALSE;
}






function getsingleprojectBugetByDepartment($project_id,$department){
    $this->db->select('*');
    $this->db->where('project_id', $project_id);
    $this->db->where('department', $department);
    $query = $this->db->get('project_budget_detail');
    return $query->row_array();   
       
   }



   function getProjectRevSettings($project_id){
    $this->db->select('*');
    $this->db->where('project_id', $project_id); 
    $query = $this->db->get('project_budget_details_header');
    return $query->result() ;   
       
   }


   function getProjectDepartmentSettings($project_id,$department){
    $this->db->select('*');
    $this->db->where('project_id', $project_id);
    $this->db->where('department', $department); 
    $query = $this->db->get('project_budget_detail');
    return $query->row_array();   
       
   }


   function getProjectDepartmentBudgetRevSettings($project_id,$department,$rev_head){
    $this->db->select('*');
    $this->db->where('project_id', $project_id);
    $this->db->where('department', $department);
    $this->db->where('budget_head', $rev_head);
    $query = $this->db->get('project_budget_details_header');
    return $query->row_array();   
       
   }

function insert_projects_budget_details($data){       
    $this->db->insert('project_budget_detail', $data);		
    $id = $this->db->insert_id();		
   return (isset($id)) ? $id : FALSE;
}


function insert_project_budget_details_header($data){       
    $this->db->insert('project_budget_details_header', $data);		
    $id = $this->db->insert_id();		
   return (isset($id)) ? $id : FALSE;
}


public function delete_project_revenue($header_id)
{
    $this->db->where('project_rev_id', $header_id);
    $this->db->delete('project_revenue');
}


function delete_project_budget($id){
        
    $this->db->where('project_id', $id);
    $this->db->delete('project_budget');
    
} 

function delete_project_budget_details_header($id)
{
            
    $this->db->where('project_id', $id);
    $this->db->delete('project_budget_details_header');
}

      
function delete_project_budget_detail($id){
        
    $this->db->where('project_id', $id);
    $this->db->delete('project_budget_detail');
    
} 

function insert_projects($data){
       
       $this->db->insert('projects', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
   }
   
     function getsingleprojects($id){
    $this->db->select('*');
    $this->db->where('id', $id);
    $query = $this->db->get('projects');
    return $query->row_array();   
       
   }


   function sumprojectbudget(){
    $this->db->select('SUM(budget_amount) AS total_budget');
    //$this->db->where('id', $id);
    $query = $this->db->get('projects');
    return $query->row_array();   
       
   }



   function allAllocatedBudget(){
    $this->db->select('SUM(department_budget) AS total_allocation');
    //$this->db->where('id', $id);
    $query = $this->db->get('project_budget_detail');
    return $query->row_array();   
       
   }

   function getAllproject(){
    $query = $this->db->get("projects");
   
 
    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
           // var_dump($this->GuestStatus($row->guestid));exit;
            $data[] = $row;
        }
        return $data;
    }
    return false;      

       
   }

   function getAllprojectIndexed(){
    $this->db->select('clients.name as client_name');
     $this->db->select('projects.*');
    $this->db->join('clients', 'projects.client = clients.id','left');
     $query = $this->db->get("projects");
   
 
    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
           // var_dump($this->GuestStatus($row->guestid));exit;
            $data[$row->id] = $row;
        }
        return $data;
    }
    return false;      

       
   }


   function getsingleprojectsall($id){
    $this->db->select('*');
    $this->db->where('id', $id);
    $query = $this->db->get('projects');
    return $query->row_array();   
       
   }
   
   function getcurrentprojects(){
    $this->db->select('*');
    $this->db->where('projects_status','current');
    $query = $this->db->get('projects');
    return $query->row_array();   
       
   }
   
   function update_projects($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('projects', $data);
	}
        
         function clear_status($id, $data)
	{
		$this->db->where('projects_status', $id);
		$this->db->update('projects', $data);//exit;
	}
        
        
  function delete_projects($id){
        
        $this->db->where('id', $id);
        $this->db->delete('projects');
        
    } 
    



public function allprojects(){

    $query = $this->db->get("projects");
   
 
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