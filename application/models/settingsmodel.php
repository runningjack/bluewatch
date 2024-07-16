<?php

/**
 * Description of Role.
 *
 * @author Gbadeyanka Abass
 */
class settingsmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }
    
    
     public function get_holidays($start_date,$end_date)
    {
        $this->db->select('*'); 
        $this->db->where('holiday_date >=', $start_date);
        $this->db->where('holiday_date <=', $end_date); 
        $query = $this->db->get('holiday');         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function active_user_count($start_date,$end_date)
    {
        $this->db->select('COUNT(employee_id) as total_usage'); 
        $this->db->where('log_date >=', $start_date);
        $this->db->where('log_date <=', $end_date);
        $this->db->group_by("employee_id");
        $query = $this->db->get('activities');         
        $res   = $query->row();   
        return $res;
    }

    public function assign_role()
    {
        $this->db->select('count(*) as hours');  
        $query = $this->db->get('project_team_role');         
        $res   = $query->row();   
        return $res;
    }

    public function project_count()
    {
        $this->db->select('count(*) as total_project');  
        $query = $this->db->get('projects');         
        $res   = $query->row();   
        return $res;
    }


    public function hourly_sum($start_date,$end_date)
    {
        $this->db->select('SUM(hours) as hours'); 
        $this->db->where('log_date >=', $start_date);
       // $this->db->where( $end_date,' < log_date',false); 
       $less_query = "('".$end_date."'".' <= log_date)';
        $this->db->where($less_query);
        $query = $this->db->get('activities');         
        $res   = $query->row();   
        return $res;
    }

    public function deleted_project_tasks($data)
    {
        $this->db->insert('deleted_project_tasks', $data);
        $id = $this->db->insert_id();

        return (isset($id)) ? $id : false;
    }



    public function getTaskByID($task_id)
    {
        
        $this->db->where('activities.activity_id', $task_id);  
        $query = $this->db->get('activities');
        return $query->row();
  
   }
 
    public function getSumByDay($employee_id,$date)
    {
        $this->db = $this->load->database('default', true);
        $this->db->select_sum('activities.hours');         
        $this->db->where('activities.log_date', $date); 
        $this->db->where('activities.employee_id', $employee_id); 
        $query = $this->db->get('activities');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }


    public function getAllDayTemptLog($employee_id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->select('*');
        $this->db->where('emp_temp_activities.employee_id', $employee_id); 
        $query = $this->db->get('emp_temp_activities');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return false;
    }



    public function getSumByDayTempt($employee_id,$date)
    {
        $this->db = $this->load->database('default', true);
        $this->db->select_sum('emp_temp_activities.hours');         
        $this->db->where('emp_temp_activities.log_date', $date); 
        $this->db->where('emp_temp_activities.employee_id', $employee_id); 
        $query = $this->db->get('emp_temp_activities');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }

    public function delete_temp_activity($activity_id)
    {
        $this->db->where('activity_id', $activity_id);
        $this->db->delete('emp_temp_activities');			
        return TRUE; 
    }

    public function delete_temp_activity_by_employee($employee_id)
    {
        $this->db->where('employee_id', $employee_id);
        $this->db->delete('emp_temp_activities');			
        return TRUE; 
    }


    
    public function delete_tasks_by_user($employee_id,$project_id)
    {
        $this->db->where('project_id', $employee_id);
        $this->db->where('assigned_to', $project_id);
        $this->db->delete('project_team_role');			
        return TRUE; 
    }

    

    

    public function add_single_temp_activities($data)
    {
        $this->db->insert('emp_temp_activities', $data);
        $id = $this->db->insert_id();

        return (isset($id)) ? $id : false;
    }
    

    public function add_single_activities($data)
    {
        $this->db->insert('activities', $data);
        $id = $this->db->insert_id();

        return (isset($id)) ? $id : false;
    }


    public function insert_project_tasks($data)
    {
        $this->db->insert('project_team_role', $data);
        $id = $this->db->insert_id();

        return (isset($id)) ? $id : false;
    }


    public function getTeamByID($id)
    {        
          $query = $this->db->get('projects');//->result();
          $this->db->where('id', $id);
          return $query->row();
    }
  
    public function getsinglelog($id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->join('project_role_task', 'project_role_task.task_id = activities.project_task', 'left');
        $this->db->where('activity_id', $id);
        $query = $this->db->get('activities');

        return $query->row_array();
    }

    function setBatchImport($batchImport){
    $this->_batchImport = $batchImport;
  }



  public function getTempEmployeelog($employ_id)
  {
      $this->db = $this->load->database('default', true);
      $this->db->join('project_role_task', 'project_role_task.task_id = emp_temp_activities.project_task', 'left');
      $this->db->join('projects', 'projects.id = emp_temp_activities.project_id', 'left');   
      $this->db->where('employee_id', $employ_id);
      $query = $this->db->get('emp_temp_activities');
    
   
 
      if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
           
              $data[] = $row;
          }
              return $data;
      }
      return false;   
  }
  //getEmployee


  public function getProjectWIthManagers($project_list)
  {
  //  var_dump($project_list);exit;
      $this->db = $this->load->database('default', true);
      $this->db->join('employees', 'employees.id = projects.project_manager', 'left');
      $this->db->where_in('projects.id', $project_list);
       
      $query = $this->db->get('projects');
    
      if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
           
              $data[] = $row;
          }
              return $data;
      }
      return false;   
  }



  
  public function getCustomers()
  {
       
    $results = $this->db->get('clients')->result();
    foreach ($results as $result) {
        $projects_multiselect[] = $result;
    }
    
    return $results;
  }


  public function GetResourceProjectByClient($employee_id,$client_id)
  {

    //  var_dump($_SESSION['login_detal']->id);
      $current_date =  date('Y-m-d');   
      $this->db->select('projects.*,project_team_role.*,projects.id as proj_id');
      $this->db->join('projects', 'projects.id = project_team_role.project_id', 'left');     
      $this->db->join('clients', 'clients.id = projects.client', 'left'); 
      $this->db->join('project_roles', 'project_roles.project_role_id = project_team_role.project_role_id', 'left');  
      
      
      $this->db->where('clients.id', $client_id); 
      $this->db->where('project_team_role.assigned_to', $employee_id);      
      $results = $this->db->get('project_team_role')->result();
        
      foreach ($results as $result) {
          $projects_multiselect[] = $result;
      }
      
      return $results;

  }


  public function GetResourceProject($employee_id)
  {

    //  var_dump($_SESSION['login_detal']->id);
      $current_date =  date('Y-m-d');   
      $this->db->select('projects.*,project_team_role.*,projects.id as proj_id');   
    //  $this->db->join('Employees', 'Employees.id = project_team_role.assigned_to', 'left'); 
      $this->db->join('project_roles', 'project_roles.project_role_id = project_team_role.project_role_id', 'left');  
      $this->db->join('projects', 'projects.id = project_team_role.project_id', 'left');  
      
      
      $this->db->where('project_team_role.assigned_to', $employee_id);      
      $results = $this->db->get('project_team_role')->result();
        
      foreach ($results as $result) {
          $projects_multiselect[] = $result;
      }
      
      return $results;

  }


  public function GetProjectResourceByDepartment($project_id,$depart_id)
  {

    //  var_dump($_SESSION['login_detal']->id);
      $current_date =  date('Y-m-d');   
      $this->db->select('*');   
      $this->db->select('project_roles.name as resource_role_name,Employees.id as employee_id');
      $this->db->join('Employees', 'Employees.id = project_team_role.assigned_to', 'left'); 
      $this->db->join('project_roles', 'project_roles.project_role_id = project_team_role.project_role_id', 'left');  
      $this->db->join('projects', 'projects.id = project_team_role.project_id', 'left');
      $this->db->join('employee_rate', 'employee_rate.employee_id = Employees.id', 'left');
      //

      $this->db->where('Employees.department', $depart_id); 
      $this->db->where('project_team_role.project_id', $project_id);      
      $results = $this->db->get('project_team_role')->result();
        
      foreach ($results as $result) {
          $projects_multiselect[] = $result;
      }
      
      return $results;

  }

  public function GetProjectResource($project_id)
  {

    //  var_dump($_SESSION['login_detal']->id);
      $current_date =  date('Y-m-d');   
      $this->db->select('*');   
      $this->db->select('project_roles.name as resource_role_name,Employees.id as employee_id');
      $this->db->join('Employees', 'Employees.id = project_team_role.assigned_to', 'left'); 
      $this->db->join('project_roles', 'project_roles.project_role_id = project_team_role.project_role_id', 'left');  
      $this->db->join('projects', 'projects.id = project_team_role.project_id', 'left');  
      
      
      $this->db->where('project_team_role.project_id', $project_id);      
      $results = $this->db->get('project_team_role')->result();
        
      foreach ($results as $result) {
          $projects_multiselect[] = $result;
      }
      
      return $results;

  }


  public function GetProjectRoleSingle($project_id,$user_id)
  {

       $current_date =  date('Y-m-d');   
      $this->db->select('*');        
       $this->db->where('project_team_role.project_id', $project_id); 
       $this->db->where('project_team_role.assigned_to', $user_id);        
      $results = $this->db->get('project_team_role')->row();
       
      
      return $results;
 
  }


  public function GetProjectRole($project_id,$user_id)
  {

       $current_date =  date('Y-m-d');   
      $this->db->select('project_team_role.project_role_id'); 
      $this->db->join('projects', 'projects.id = project_team_role.project_id', 'left');        
       $this->db->where('project_team_role.project_id', $project_id); 
       $this->db->where('project_team_role.assigned_to', $user_id);        
      $results = $this->db->get('project_team_role')->result();
        
      foreach ($results as $result) {
          $projects_multiselect[] = $result;
      }
      
      return $results;


//project_tasks

  }

  public function project_role_task($role_id)
  {
     
     $this->db->where('project_role_task.role_id', $role_id);        
    $results = $this->db->get('project_role_task')->result();
      
    foreach ($results as $result) {
        $projects_multiselect[] = $result;
    }
    
    return $results;

  }


  //save data
  public function importData(){
    $data = $this->_batchImport;
    $this->db->insert_batch('department_exp_budget', $data);
  }

  public function updateFinYear($value)
  {
      $resp = $this->db->update('finacial_year_setting', $value);
      return $resp;
  }

  public function getCurrentFinancialYear()
  {        
        $query = $this->db->get('finacial_year_setting');//->result();
        return $query->row();
  }

  public function getExpenseLineCode($code)
  {
        $this->db->where('expense_line_code',$code);        
        $query = $this->db->get('expense_line');//->result();
        return $query->row();
  }

  public function getDepartmentCode($code)
  {
     $this->db->where('code',$code);        
        $query = $this->db->get('companystructures');//->result();
        return $query->row();
  }



    public function getexpensecat()
    {
        $this->db = $this->load->database('default', true);  
        $query = $this->db->get('expense_category');
        return $query->result();;
    }


    public function update_project_role($data,$project_id,$employee_id)
    {
        $this->db->where('assigned_to', $employee_id);
        $this->db->where('project_id', $project_id); 
        $this->db->update('project_team_role', $data);
    }

    public function getProjectRoles()
    {  
        $query = $this->db->get('project_roles');
        $results = $query->result();

        $select = array();
        foreach ($results as $result) {
            $select[$result->project_role_id] = $result->name;
        }

        return $select;
    }

    public function structure()
    {
        $this->db->select('id,title');
        $results = $this->db->get('companystructures')->result();
        $companystructures_select = array();
        foreach ($results as $result) {
            $companystructures_select[$result->id] = $result->title;
        }

        return $companystructures_select;
    }
    public function getsingleline($employee_id,$project_id,$loopdate){
        $this->db->where('employee_id',$employee_id);
        $this->db->where('project_id',$project_id);
        $this->db->where('log_date',$loopdate);        
        $query = $this->db->get('activities');//->result();
        $record = $query->row();
        return $record;
       // var_dump($record);exit;
    }

    public function getClients()
    {
        $this->db->select('id,name');
        $results = $this->db->get('clients')->result();
        $multiselect = array();
        foreach ($results as $result) {
            $multiselect[$result->id] = $result->name;
        }

        return $multiselect;
    }

    public function getProjectCategories()
    {
        $this->db->select('id,name');
        $results = $this->db->get('projectcategory')->result();
        $multiselect = array();
        foreach ($results as $result) {
            $multiselect[$result->id] = $result->name;
        }

        return $multiselect;
    }

    public function insert_activity($data)
    {
       // var_dump($data);exit;
        $user = $_SESSION['login_detal']->employee_id;
        if (!empty($data)) {
             $logQuery = 'INSERT INTO activities (employee_id,project_id,project_task,log_date,hours)VALUES';
             $count = count($data);
             $count2 = count($data["projectID"]);
             $i = 0;
            
        foreach ($data as $key => $value) {
            if ($key == "projectID" || $key == "task") {
                continue;
            }
          //  var_dump($key);exit; 
            $j = 0;
            foreach ($data["projectID"] as $row) {
               
                $date = DateTime::createFromFormat('d/m/Y', $key); 
                //var_dump($date->format('Y-m-d'));exit;
                $this->db->where('employee_id', $user);
               // $this->db->where('log_date', $date->format('Y-m-d'));
                $this->db->where('log_date', $key);
                $this->db->delete('activities');//exit;


                if ($i == $count-2 && $j == $count2-1 ) {
               $logQuery .= '('.$user.','.intval($row).',"'.$value['task'][$j].'","'.$key.'",'.intval($value['hour'][$j]).')';
               break;
            }
                $logQuery .= '('.$user.','.intval($row).',"'.$value['task'][$j].'","'.$key.'",'.intval($value['hour'][$j]).'),';
                $j++;
            }
            $i++;
        }

        }
        //var_dump($logQuery);exit;
        $this->db->trans_start();
        
        $this->db->query($logQuery);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return FALSE;
        }else{
            return TRUE;
        }
    }

     public function save_activity($data)
    {
        
        $user = $_SESSION['login_detal']->employee_id;
        
        
       // var_dump($data);exit;
        $this->db->trans_start();
        
        if (!empty($data)) {
            /* $logQuery = 'INSERT INTO activities_review (employee_id,project_id,log_date,project_manager,project_manager_hour,project_manager_comment)VALUES';
             $count2 = count($data["projectID"]);*/

             foreach($data['approved_task_id'] as $task_id)
             {
                
                $current_approved_hour = $data['approved_hour_id'][$task_id];
                $update_data['approved_hours'] = $current_approved_hour;
                $update_data['project_manager_id'] = $user;
                $update_data['project_manager_status'] = 1;
                $update_data['final_approved_by'] = $user;
                $update_data['date_approved'] = date('Y-m-d');
                
                $this->db->where('activity_id', $task_id);
                $this->db->update('activities', $update_data);
 
             }
            
             $j = 0;
            foreach ($data["projectID"] as $row) {
              /*  if ($j == $count2-1 ) {
               $logQuery .= '('.$data["userId"].','.intval($row).',"'.$data["dateRange"].'",'.$user.','.$data["projManagerhour"][$j].',"'.$data["projManagercomment"][$j].'")';
               break;
            }
                $logQuery .= '('.$data["userId"].','.intval($row).',"'.$data["dateRange"].'",'.$user.','.$data["projManagerhour"][$j].',"'.$data["projManagercomment"][$j].'"),';
                */
                $queryData = array(
                            'employee_id' => $data["userId"],
                            'project_id' => intval($row),
                            'log_date' => $data["dateRange"],
                            'project_manager' => $user,
                            'project_manager_hour' => $data["projManagerhour"][$j],
                            'project_manager_comment' => $data["projManagercomment"][$j] );

                $updatedata = FALSE;
                if (!empty($data["updateproject"])) {
                    
               foreach ($data["updateproject"] as $update) {
                  if ($update == $row) {
                    $updatedata = TRUE;
                  }
                  
               }
                }
               if ($updatedata) {
                      $this->db->where('employee_id', $data["userId"]);
                      $this->db->where('project_id', $row);
                      $this->db->where('log_date', $data["dateRange"]);
                        $this->db->update('activities_review', $queryData);

                  } else {
            
                $this->db->insert('activities_review', $queryData);
                  }
                
               $j++;
            }

        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function save_teamlead_activity($data)
    {
        
        $user = $_SESSION['login_detal']->employee_id;
        
        //var_dump($logQuery);exit;
        $this->db->trans_start();
        
        if (!empty($data)) {
            /* $logQuery = 'INSERT INTO activities_review (employee_id,project_id,log_date,project_manager,project_manager_hour,project_manager_comment)VALUES';
             $count2 = count($data["projectID"]);*/
            
             $j = 0;
            foreach ($data["projectID"] as $row) {
              /*  if ($j == $count2-1 ) {
               $logQuery .= '('.$data["userId"].','.intval($row).',"'.$data["dateRange"].'",'.$user.','.$data["projManagerhour"][$j].',"'.$data["projManagercomment"][$j].'")';
               break;
            }
                $logQuery .= '('.$data["userId"].','.intval($row).',"'.$data["dateRange"].'",'.$user.','.$data["projManagerhour"][$j].',"'.$data["projManagercomment"][$j].'"),';
                */
                $queryData = array(
                            'employee_id' => $data["userId"],
                            'project_id' => intval($row),
                            'log_date' => $data["dateRange"],
                            'teamlead' => $user,
                            'teamlead_hour' => $data["teamLeadhour"][$j],
                            'teamlead_comment' => $data["teamLeadcomment"][$j] );

                $updatedata = FALSE;
                if (!empty($data["updateproject"])) {
                    
               foreach ($data["updateproject"] as $update) {
                  if ($update == $row) {
                    $updatedata = TRUE;
                  }
                  
               }
                }
               if ($updatedata) {
                      $this->db->where('employee_id', $data["userId"]);
                      $this->db->where('project_id', $row);
                      $this->db->where('log_date', $data["dateRange"]);
                        $this->db->update('activities_review', $queryData);

                  } else {
            
                $this->db->insert('activities_review', $queryData);
                  }
                
               $j++;
            }

        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function save_cdo_activity($data)
    {
        $user = $_SESSION['login_detal']->employee_id;
         
        $counter = 0;
        foreach($data['approved_task_id'] as $task_id)
        {

            $task_details = $this->getTaskByID($task_id);
            $date = $task_details->log_date;
             
            $current_approved_hour = $data['approved_hour_id'][$counter];

            $day_hourly_summary =  $this->settingsmodel->getSumByDay($data['member_id'],$date);
            $time =  $day_hourly_summary[0]->hours+$current_approved_hour;//exit;
           // echo  $time.'<br/>';
      
            if((int)$time > 24)
            {
      
             $error_message = "Activity in Date ".$date." is more than 24hours";
             $response['status'] = FALSE;
             $response['error_message'] = $error_message;
             return $response;

            }else{
           
           
           $update_data['approved_hours'] = $current_approved_hour;
           $update_data['project_manager_id'] = $user;
           $update_data['project_manager_status'] = 1;
           $update_data['final_approved_by'] = $user;
           $update_data['date_approved'] = date('Y-m-d');
            

           
           $this->db->where('activity_id', $task_id);
           $this->db->update('activities', $update_data);
            }

           $counter++;
        }
        
        //var_dump($logQuery);exit;
        $this->db->trans_start();
        
        if (!empty($data)) {
             $j = 0;
            foreach ($data["projectID"] as $row) {
                $queryData = array(
                            'employee_id' => $data["userId"],
                            'project_id' => intval($row),
                            'log_date' => $data["dateRange"],
                            'cdo' => $user,
                            'cdo_hour' => $data["projManagerhour"][$j],
                            'cdo_comment' => $data["projManagercomment"][$j] );

                $updatedata = FALSE;
                if (!empty($data["updateproject"])) {
                    
               foreach ($data["updateproject"] as $update) {
                  if ($update == $row) {
                    $updatedata = TRUE;
                  }
                  
               }
                }
               if ($updatedata) {
                      $this->db->where('employee_id', $data["userId"]);
                      $this->db->where('project_id', $row);
                      $this->db->where('log_date', $data["dateRange"]);
                        $this->db->update('activities_review', $queryData);

                  } else {
            
                $this->db->insert('activities_review', $queryData);
                  }
                
               $j++;
            }

        }

        $this->db->trans_complete();
        $response['error_message'] = $error_message;

        if ($this->db->trans_status() === FALSE)
        {
            $response['status'] = FALSE;
            return $response;
            return FALSE;
        }else{
            $response['status'] = TRUE;
            return $response;
            return TRUE;
        }
    }

    public function checkDate($date)
    {
        $this->db = $this->load->database('default', true);
        $this->db->where('log_date',$date);
        $query = $this->db->get('activities');

        if ($query->num_rows() > 0) {
            return 1;
        }
        return 0;
    }

    public function insert_activitybkk($data)
    {
        $this->db->insert('activities', $data);
        $id = $this->db->insert_id();

        return (isset($id)) ? $id : false;
    }

    public function getExpenseLine()
    {

        $this->db->select('expense_line_id');
        $query = $this->db->get("expense_line");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;


    }


       public function getEmployeeByEmail($email)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('*');
        $this->db->where('work_email', $email);
        $query = $this->db->get('employees');
        return $query->result();
    }

    public function getmaxYear()
    {
       $this->db = $this->load->database('default', true);
        $this->db->select_max('year');
        $query = $this->db->get('department_exp_budget');
        return $query->row();
    }

    public function getExpenseCategory()
    {
       $this->db = $this->load->database('default', true);
        $this->db->select('*');
        $query = $this->db->get('expense_category');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;

    }
    
     public function getDepartByID($dpt)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('*');
        $this->db->where('id', $dpt); 
        $query = $this->db->get('hr_department');
        return $query->result();
    }

     public function getDepartmentExpense($dpt, $exp_id)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('budgeted_amount');
        $this->db->where('department_id', $dpt);
        $this->db->where('expense_line_id', $exp_id);
        $query = $this->db->get('department_exp_budget');
        return $query->result();
    }

     public function getDepartmentMap($dpt)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->where('id IN ('.$dpt.')', null, false);

        $query = $this->db->get('companystructures');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }

    public function getExpenseCatBudget($year,$cat_id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->select_sum('department_exp_budget.budgeted_amount');
        $this->db->select('department_exp_budget.year');
        $this->db->join('expense_line', 'expense_line.expense_line_id = department_exp_budget.expense_line_id', 'left');
        $this->db->where('department_exp_budget.year IN ('.$year.')', null, false);
        $this->db->where('expense_line.expense_category_id', $cat_id);
        $this->db->order_by('department_exp_budget.year', 'DESC');
        $this->db->group_by('department_exp_budget.year');
        $query = $this->db->get('department_exp_budget');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }

    public function getExpenseLineBudget($year,$exp_id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->select_sum('department_exp_budget.budgeted_amount');
        $this->db->select('department_exp_budget.year');
        $this->db->where('department_exp_budget.year IN ('.$year.')', null, false);
        $this->db->where('department_exp_budget.expense_line_id', $exp_id);
        $this->db->order_by('year', 'DESC');
        $this->db->group_by('year');
        $query = $this->db->get('department_exp_budget');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }

     public function getDepartmentBudget($dpt,$year,$exp_id)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('companystructures.title');
        $this->db->select('department_exp_budget.budgeted_amount');
        $this->db->select('department_exp_budget.year');
        $this->db->select('department_exp_budget.dpt_exp_budget_id');
        $this->db->join('companystructures', 'companystructures.id = department_exp_budget.department_id', 'left');
        $this->db->where('department_exp_budget.department_id IN ('.$dpt.')', null, false);
        $this->db->where('department_exp_budget.year IN ('.$year.')', null, false);
        $this->db->where('department_exp_budget.expense_line_id', $exp_id);
        $this->db->order_by('year', 'DESC');
        $query = $this->db->get('department_exp_budget');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }

    public function getSingleDepartmentBudget($exp_id)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('companystructures.title');
        $this->db->select('department_exp_budget.*');
        $this->db->select('expense_line.expense_line_name');
        $this->db->join('companystructures', 'companystructures.id = department_exp_budget.department_id', 'left');
        $this->db->join('expense_line', 'expense_line.expense_line_id = department_exp_budget.expense_line_id', 'left');
        $this->db->where('department_exp_budget.dpt_exp_budget_id', $exp_id);
        $query = $this->db->get('department_exp_budget');

        return $query->row();
    }

    public function updateDepartmentBudget($amount,$id)
    {
        $this->db->set('budgeted_amount', $amount);
        $this->db->where('dpt_exp_budget_id', $id);
        $this->db->update('department_exp_budget');		
        $id = $this->db->insert_id();		
        return (isset($id)) ? $id : FALSE; 
    }

    public function deleteBudgetByYear($year)
    {
        $this->db->where('year', $year);
        $this->db->delete('department_exp_budget');			
        return TRUE; 
    }

    public function getTotalBudget($year)
    {
        $this->db->select_sum('budgeted_amount');
        $this->db->select('year');
        $this->db->where('year IN ('.$year.')', null, false);
        $this->db->order_by('year', 'DESC');
        $this->db->group_by('year');
        $query = $this->db->get('department_exp_budget');
         if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }


    public function saveBudgetExpense($budget)
    {
        $this->db->trans_start();

        $count = 0;
        foreach ($budget as $data) {
            //var_dump($data);exit;
        $this->db->insert('department_exp_budget', $data);
        $count++;
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function getBudgetExpense()
    {
        
        $exp_line = array();

        $budget_expense = array();
        $list = array();

            $ecategory = $this->getExpenseCategory();
                 //var_dump($ecategory);exit;

            foreach ($ecategory as $s) {
                $list['cat_name'] = $s->expense_category_name;
                $list['cat_id'] = $s->expense_category_id;
                $id = $s->expense_category_id;
                      
                      //echo $lsql;
                $res2 = $this->getExpenseDetails($id);
                //var_dump($res2);exit;
                $menu = array();
                $m_name_des = array();
                if ($res2) {
                    foreach ($res2 as $k) {
                        //  var_dump($res2);
                        $menu['expenseName'] = $k->expense_line_name;
                        $menu['expenseCat'] = $k->expense_category_id;
                        $dpt = $k->department_map;
                        $menu['expID'] = $k->expense_line_id;
                        $menu['dpt'] = '';
                        if (!empty($dpt)) {
                           $menu['dpt'] = $this->getDepartmentMap($dpt);
                        }
                        $m_name_des[] = $menu;
                        
                    }
                    $list['menu'] = $m_name_des;
                    $budget_expense[] = $list;
                }
            }
        //var_dump($budget_expense);exit;
        return $budget_expense;

    }

     public function getExpenseDetails($id)
    {


        $this->db->select('*');
        $this->db->where('expense_category_id', $id);
        $query = $this->db->get("expense_line");
        
        if ($query->num_rows() > 0) {
            
            foreach ($query->result() as $row) {
               // var_dump($row);//exit;
                $data[] = $row;
            }
            return $data;
            //var_dump($data);exit;
        }
        return false;
        
    }

    public function getBudgetReport()
    {
        

        $budget_expense = array();
        $list = array();
        

            $eyear = $this->getExpenseYear();
            foreach ($eyear as $y) {
              $list['year'] = $y->year;

               $ecategory = $this->getExpenseCategory();
                $exp_cat = array();
                foreach ($ecategory as $s) {
                $cat = array();
               
                $cat['cat_name'] = $s->expense_category_name;
                $id = $s->expense_category_id;
                      
                      //echo $lsql;
                $res2 = $this->getExpenseDetails($id);
                //var_dump($res2);exit;
                
                $m_name_des = array();
                if ($res2) {
                    foreach ($res2 as $k) {
                        $expline = array();
                        //  var_dump($res2);
                        $expline['expenseName'] = $k->expense_line_name;
                        $expline['expenseCat'] = $k->expense_category_id;
                        $dpt = $k->department_map;
                        $expline['expID'] = $k->expense_line_id;
                        $expline['dptbudget'] = '';
                        if (!empty($dpt)) {
                           $expline['dptbudget'] = $this->getDepartmentBudget($dpt, $y->year, $k->expense_line_id);
                        }
                        $m_name_des[] = $expline;
                        
                    }
                    $cat['exp'] = $m_name_des;
                    
                }
                $exp_cat[] = $cat;
                $list['cat'] = $exp_cat;
            }
            //var_dump($list['cat']);exit();
            
            $budget_expense[] = $list;
           }
           //var_dump($budget_expense);exit;
           return $budget_expense;
    }

    public function getExpenseYear()
    {
        $query = $this->db->query('SELECT DISTINCT year FROM department_exp_budget order by dpt_exp_budget_id desc limit 2');
        return $query->result();
    }


     public function getExpensebyYear($year)
    {
        $this->db->where('year', $year);
        $query = $this->db->get('department_exp_budget');


        return $query->result();
    }


    public function getEmployeeDetails($employee_id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->join('companystructures', 'companystructures.id = employees.department', 'left');
        $this->db->where('employees.id', $employee_id);
        $query = $this->db->get('employees');

        return $query->row_array();
    }

    public function getEmployeeByEmp_IdDetails($employee_id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->join('companystructures', 'companystructures.id = employees.department', 'left');
        $this->db->where('employees.employee_id', $employee_id);
        $query = $this->db->get('employees');

        return $query->row_array();
    }

    public function getEmployeeByName($name)
    {
        $this->db = $this->load->database('default', true);
        
        $employe_name = explode(' ', $name);
        // Var_dump($employe_name[1]);
        // exit();
        $this->db->where('first_name', $employe_name[0]);
        $this->db->where('last_name', $employe_name[1]);
        $query = $this->db->get('employees');
        // Var_dump($query->row_array());
        // exit();

        return $query->row_array();
    }

    public function getPojectByName($name)
    {
        $this->db = $this->load->database('default', true);
        $this->db->where('name', $name);
        $query = $this->db->get('projects');

        return $query->row_array();
    }

    public function getProjectMembers($members){
        $teammembers = explode(',', $members);
        $this->db = $this->load->database('default', true);
        $this->db->where_in('id', $teammembers);
        $query = $this->db->get('employees');

        return $query->result(); 
    }

    public function getprojecttask($project_id){
        //$teammembers = explode(',', $members);
        $this->db = $this->load->database('default', true);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_tasks');

        return $query->result(); 
    }

    public function getTeamDetails($project_id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->where('team_project_id', $project_id);
        $query = $this->db->get('project_team');

        return $query->row_array();
    }

    public function getProjectDetails($id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->join('projects', 'projects.id = project_team.team_project_id', 'left');
        $this->db->where('team_id', $id);
        $query = $this->db->get('project_team');

        return $query->row_array();
    }

    public function getProjectManagerDetails($project_id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->where('id', $project_id);
        $query = $this->db->get('projects');

        return $query->row_array();
    }

    public function taskStatus()
    {
        $this->db->select('*');
        $this->db->from('activity_status');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $result) {
                $list[] = $result;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function employee_list()
    {
        $this->db->select('*');
        $this->db->from('employees');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $result) {
                $list[$result->id] = $result;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function partial_employee_list()
    {
        $this->db->select('*');
        $this->db->from('employees');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $result) {
                $list[$result->id] = $result->first_name.' '.$result->last_name;
            }

            return $list;
        } else {
            return false;
        }
    }

    public function getProjectTeamLeads($teamleads)
    {
        $this->db->select('*');
        $where = "FIND_IN_SET('".$teamleads."', employees.id)";
        $this->db->where($where);
        $results = $this->db->get('employees')->result();
        $projects_multiselect = array();
        foreach ($results as $result) {
            $projects_multiselect[] = $result;
        }

        return $projects_multiselect;
    }

    public function getProjectTeamLeadsbyProject($id, $user_id)
    {
        $this->db->select('employees.*');
        $this->db->join('employees','employees.id=project_team.team_lead', 'left');
        $where = "FIND_IN_SET(".$user_id.", project_team.team_member) AND project_team.team_project_id = ".$id;
        $this->db->where($where);
        $results = $this->db->get('project_team')->result_array();
        
        return $results;
    }

    public function getProjectManager($id)
    {
        $this->db->select('first_name,last_name,work_email');
        $this->db->where('id',$id);
        $results = $this->db->get('employees')->row_array();
        
        return $results;
    }

    public function totalhours($user_id, $proj_id, $startDate, $endDate)
    {
        $this->db->select_sum('hours');
        $start_date = "( `log_date` BETWEEN '".$startDate."' AND '".$endDate."')";
        $this->db->where($start_date);
        $this->db->where('project_id', $proj_id);
        $this->db->where('employee_id', $user_id);
        $query = $this->db->get('activities');
        return $query->row_array();

    }

    public function getteamleadhours($user_id, $proj_id, $date)
    {
        $this->db->select('teamlead_hour');
        $this->db->select('teamlead_comment');
        $this->db->where('project_id', $proj_id);
        $this->db->where('employee_id', $user_id);
        $this->db->where('log_date', $date);
        $query = $this->db->get('activities_review');
        return $query->row_array();
    }

    public function getprojmanagerhours($user_id, $proj_id, $date)
    {
        $this->db->select('teamlead_hour');
        $this->db->select('teamlead_comment');
        $this->db->select('project_manager_hour');
        $this->db->select('project_manager_comment');
        $this->db->where('project_id', $proj_id);
        $this->db->where('employee_id', $user_id);
        $this->db->where('log_date', $date);
        $query = $this->db->get('activities_review');
        return $query->row_array();
    }

     public function getcdohours($user_id, $proj_id, $date)
    {
        $this->db->select('teamlead_hour');
        $this->db->select('teamlead_comment');
        $this->db->select('project_manager_hour');
        $this->db->select('project_manager_comment');
        $this->db->select('cdo_hour');
        $this->db->select('cdo_comment');
        $this->db->where('project_id', $proj_id);
        $this->db->where('employee_id', $user_id);
        $this->db->where('log_date', $date);
        $query = $this->db->get('activities_review');
        return $query->row_array();
    }

    public function totalprojhours($user_id, $startDate, $endDate)
    {
       $this->db->select_sum('hours');
        $start_date = "( `log_date` BETWEEN '".$startDate."' AND '".$endDate."')";
        $this->db->where($start_date);
        $this->db->where('employee_id', $user_id);
        $query = $this->db->get('activities');
        return $query->row_array();
    }

    public function getTeamProjectlogTest($user_id, $startDate, $endDate)
    {   
        $current_date =  date('Y-m-d');   
        $this->db->select('*');
        $where = "FIND_IN_SET(".$user_id.", project_team.team_member) AND ('".$current_date."' >= `projects`.`start_date` AND ('".$current_date."' <= `projects`.`end_date` OR '".$current_date."' <= `projects`.`actual_end_date`) AND (('".$startDate."' BETWEEN `projects`.`start_date` AND `projects`.`end_date`) OR ('".$endDate."' BETWEEN `projects`.`start_date` AND `projects`.`end_date`)) )";
        $this->db->join('projects', 'projects.id = project_team.team_project_id', 'left');
        $this->db->join('project_tasks', 'projects.id = project_tasks.project_id', 'left');
        $this->db->group_by("projects.id");
        $this->db->where($where);
       // $start_date = "('".$startDate."' BETWEEN `projects`.`start_date` AND `projects`.`end_date`)";
       // $this->db->where($start_date);
       // $end_date = "('".$endDate."' BETWEEN `projects`.`start_date` AND `projects`.`end_date`)";
       // $this->db->or_where($end_date); date('Y-m-d)
       
        
        $results = $this->db->get('project_team')->result();
        $projects_multiselect = array();
        foreach ($results as $result) {
            $projects_multiselect[] = $result;
        }
        
        return $results;
    }


    //here project_team_role.project_id
    public function getTeamProjectlogByProjectId($project_id,$user_id, $startDate, $endDate)
    {   
        $current_date =  date('Y-m-d');   
        $this->db->select('*');
        
      //  $where = "FIND_IN_SET(".$user_id.", project_team.team_member) AND '".$current_date."' >= `projects`.`start_date` AND ('".$current_date."' <= `projects`.`end_date` OR '".$current_date."' <= `projects`.`actual_end_date`)";
        $where = "(".$user_id." = project_team_role.assigned_to) 
        AND project_team_role.project_id = '".$project_id."'
        AND '".$current_date."' >= `projects`.`start_date` 
        AND ('".$current_date."' <= `projects`.`end_date` 
        OR '".$current_date."' <= `projects`.`actual_end_date`)";
       
       
       
        $this->db->join('projects', 'projects.id = project_team_role.project_id', 'left');
        $this->db->where($where);



        // $start_date = "('".$startDate."' BETWEEN `projects`.`start_date` AND `projects`.`end_date`)";
        // $this->db->where($start_date);
        // $end_date = "('".$endDate."' BETWEEN `projects`.`start_date` AND `projects`.`end_date`)";
        // $this->db->or_where($end_date); //date('Y-m-d)
       
        
        $results = $this->db->get('project_team_role')->result();
        $projects_multiselect = array();
        foreach ($results as $result) {
            $projects_multiselect[] = $result;
        }
       // var_dump($projects_multiselect);exit();
        return $results;
    }

//here project_team_role.project_id
    public function getTeamProjectlog($user_id, $startDate, $endDate)
    {   
        $current_date =  date('Y-m-d');   
        $this->db->select('*');
        
      //  $where = "FIND_IN_SET(".$user_id.", project_team.team_member) AND '".$current_date."' >= `projects`.`start_date` AND ('".$current_date."' <= `projects`.`end_date` OR '".$current_date."' <= `projects`.`actual_end_date`)";
        $where = "(".$user_id." = project_team_role.assigned_to) AND '".$current_date."' >= `projects`.`start_date` AND ('".$current_date."' <= `projects`.`end_date` OR '".$current_date."' <= `projects`.`actual_end_date`)";
       
       
       
        $this->db->join('projects', 'projects.id = project_team_role.project_id', 'left');
        $this->db->where($where);



        // $start_date = "('".$startDate."' BETWEEN `projects`.`start_date` AND `projects`.`end_date`)";
        // $this->db->where($start_date);
        // $end_date = "('".$endDate."' BETWEEN `projects`.`start_date` AND `projects`.`end_date`)";
        // $this->db->or_where($end_date); //date('Y-m-d)
       
        
        $results = $this->db->get('project_team_role')->result();
        $projects_multiselect = array();
        foreach ($results as $result) {
            $projects_multiselect[] = $result;
        }
       // var_dump($projects_multiselect);exit();
        return $results;
    }

    public function getAllProjects()
    {

        $results = $this->db->get('projects')->result();
        $projects_multiselect = array();
        foreach ($results as $result) {
            $projects_multiselect[] = $result;
        }
      //  var_dump($projects_multiselect);exit;
        return $projects_multiselect;

    }

    public function getTeamProject($user_id)
    {
        $this->db->select('*');
        //var_dump($_SESSION['login_detal']->group_id);exit();
        if(!($_SESSION['login_detal']->group_id==7 || $_SESSION['login_detal']->group_id==1) )
        {
        $where = "(".$user_id." = project_team_role.assigned_to)  OR FIND_IN_SET('".$user_id."', projects.project_manager)
            AND (projects.actual_end_date <= '".date('Y-m-d')."' OR projects.actual_end_date is null)";
       
           
            $this->db->where($where);
        }
        $this->db->join('project_team_role', 'projects.id = project_team_role.project_id', 'left');
        $results = $this->db->get('projects')->result();
        $projects_multiselect = array();
        foreach ($results as $result) {
            $projects_multiselect[] = $result;
        }
      //  var_dump($projects_multiselect);exit;
        return $projects_multiselect;
    }

    public function getAllDepartment()
    {
        //department
        
        $query = $this->db->get('department');

        return $query->result();

    }


    public function getAllDepartmentHr()
    {
        //department
        
        $query = $this->db->get('hr_department');

        return $query->result();

    }

    public function AllEmployeeByDepart($dept)
    {

        $this->db->select('*');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        return $result;

    }



  public function logByProjectGroupWeeks($dept,$project)
    {

         $this->db->select('id');
          $this->db->where('department', $dept);
          $query = $this->db->get('Employees');
          $result = $query->result();
          $ids = array(); // Initialize the $ids array
          foreach ($result as $id) {
              $ids[] = $id->id;
          }

          $sql = "
              SELECT WEEK(`log_date`) AS week_number, SUM(hours) AS total_hours
              FROM activities
              WHERE YEAR(log_date) = YEAR(CURRENT_DATE)
              AND employee_id IN (" . implode(',', $ids) . ")
              AND project_id = '" . $project . "'
              GROUP BY WEEK(log_date)
              ORDER BY week_number
              LIMIT 0, 30
          ";
          // echo $sql;
          // exit;

          $query = $this->db->query($sql);
          $result = $query->result();
          $record_array = array();
              // Access the results
              foreach ($result as $row) {
                  $record_array[$row->week_number] = $totalHours = $row->total_hours;
              }
        return $record_array;
    }


    public function usablilityCheckLogByDepartID($dept, $start_date,$end_date)
    {

        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
       
          
        $this->db->select('SUM(hours) as hours,log_date,employee_id'); 
        $this->db->where('log_date >=', $start_date); 
        $less_query = "(log_date <= '".$end_date."'".')';
       $this->db->where($less_query);
        $this->db->where_in('employee_id',$ids);
        $this->db->group_by('log_date,employee_id');
        $query = $this->db->get('activities');         
        $res   = $query->result();
        foreach( $res  as $record)
        {
            $record_array[$record->employee_id][$record->log_date] = $record->hours;
        }
        

       

        return $record_array;
    }
    
    
    
    
    
    
    public function usablilityCheckLogByDepartRemoveHolidays($dept, $start_date,$end_date,$holiday_date)
    {

        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
        $last_query = $this->db->last_query();
       
       
          
        $this->db->select('SUM(hours) as hours'); 
        $this->db->select('COUNT(DISTINCT(employee_id)) AS staff_count');
        $this->db->where("log_date BETWEEN '$start_date' AND '$end_date'");
        $this->db->where_not_in('log_date', $holiday_date);
      
        $this->db->where_in('employee_id',$ids);
        $query = $this->db->get('activities');         
        $res   = $query->row();
        $last_query = $this->db->last_query();
 
        return $res;
    }
    
    
    
    
    
           public function getNumberofDays($dept, $start_date,$end_date,$holiday_date)
    {

//var_dump($holiday_date);exit;
        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
        $last_query = $this->db->last_query();
       
          
        $this->db->select('SUM(hours) as hours'); 
        $this->db->select('COUNT(DISTINCT(log_date)) AS number_of_days');
        $this->db->where_not_in('log_date', $holiday_date);
        $this->db->where("log_date BETWEEN '$start_date' AND '$end_date'");
         
        //$this->db->where_in('employee_id',$ids);
       
        $query = $this->db->get('activities');         
        $res   = $query->row();
        $last_query = $this->db->last_query();

  
      
        return $res;
    }
    
    
    
    
        public function usablilityCheckLogByDepartMinusHoliday($dept, $start_date,$end_date,$holiday_date)
    {

        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
        $last_query = $this->db->last_query();
       
       
          
        $this->db->select('SUM(hours) as hours'); 
        $this->db->select('COUNT(DISTINCT(employee_id)) AS staff_count');
        $this->db->where_not_in('log_date', $holiday_date);
        $this->db->where("log_date BETWEEN '$start_date' AND '$end_date'");
       
        $this->db->where_in('employee_id',$ids);
        $query = $this->db->get('activities');         
        $res   = $query->row();
        $last_query = $this->db->last_query();

  
      
        return $res;
    }
    
    
        public function departmentStaffCount($dept)
    {

        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
   

      
        return count($ids);
    }
    

    public function usablilityCheckLogByDepart($dept, $start_date,$end_date)
    {

        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
        $last_query = $this->db->last_query();
       
       
          
        $this->db->select('SUM(hours) as hours'); 
        $this->db->select('COUNT(DISTINCT(employee_id)) AS staff_count');

          $this->db->where("log_date BETWEEN '$start_date' AND '$end_date'");
        //$this->db->where('log_date >=', $start_date); 
        //$less_query = "('".$end_date."'".' <= log_date)';
        //$this->db->where($less_query);
        $this->db->where_in('employee_id',$ids);
        $query = $this->db->get('activities');         
        $res   = $query->row();
        $last_query = $this->db->last_query();

        // //var_dump($last_query);echo "<br/><br/><br/><br/><br/>"; 
        //  if($dept==1)
        // {
        //   var_dump($last_query);echo "<br/><br/><br/><br/><br/>";
        //   var_dump($res);
        // }

      
        return $res;
    }
    
      
      
         public function usablilityCheckRejectedLogByDepart($dept, $start_date,$end_date)
    {

        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
        $last_query = $this->db->last_query();
       
       
          
        $this->db->select('SUM(hours) as hours'); 
        $this->db->select('COUNT(DISTINCT(employee_id)) AS staff_count');

          $this->db->where("log_date BETWEEN '$start_date' AND '$end_date'");          
         $this->db->where('project_manager_status', "Rejected"); 
        //$this->db->where('log_date >=', $start_date); 
        //$less_query = "('".$end_date."'".' <= log_date)';
        //$this->db->where($less_query);
        $this->db->where_in('employee_id',$ids);
        $query = $this->db->get('activities');         
        $res   = $query->row();
        $last_query = $this->db->last_query();

        // //var_dump($last_query);echo "<br/><br/><br/><br/><br/>"; 
        //  if($dept==1)
        // {
        //   var_dump($last_query);echo "<br/><br/><br/><br/><br/>";
        //   var_dump($res);
        // }

      
        return $res;
    }
      
      
      
      
               public function usablilityCheckRejectedLogByDepartMinusHoliday($dept, $start_date,$end_date,$holiday_date)
    {

        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
        $last_query = $this->db->last_query();
       
       
          
        $this->db->select('SUM(hours) as hours'); 
        $this->db->select('COUNT(DISTINCT(employee_id)) AS staff_count');

          $this->db->where("log_date BETWEEN '$start_date' AND '$end_date'");          
         $this->db->where('project_manager_status', "Rejected"); 
      $this->db->where_not_in('log_date', $holiday_date);
        $this->db->where_in('employee_id',$ids);
        $query = $this->db->get('activities');         
        $res   = $query->row();
        $last_query = $this->db->last_query();

   
      
        return $res;
    }
      
      
      
      
      
            public function usablilityCheckApprovedLogByDepartMinusHoliday($dept, $start_date,$end_date,$holiday_date)
    {

        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
        $last_query = $this->db->last_query();
       
       
          
        $this->db->select('SUM(hours) as hours'); 
        $this->db->select('COUNT(DISTINCT(employee_id)) AS staff_count');

          $this->db->where("log_date BETWEEN '$start_date' AND '$end_date'");          
         $this->db->where('project_manager_status', "Approved"); 
  $this->db->where_not_in('log_date', $holiday_date);
        $this->db->where_in('employee_id',$ids);
        $query = $this->db->get('activities');         
        $res   = $query->row();
        $last_query = $this->db->last_query();

     

      
        return $res;
    }
    
      
      
      
        public function usablilityCheckApprovedLogByDepart($dept, $start_date,$end_date)
    {

        $this->db->select('id');
        $this->db->where('department',$dept);
        $query = $this->db->get('Employees');
        $result = $query->result();
        foreach($result as $id){
            $ids[] = $id->id;
        }
        $last_query = $this->db->last_query();
       
       
          
        $this->db->select('SUM(hours) as hours'); 
        $this->db->select('COUNT(DISTINCT(employee_id)) AS staff_count');

          $this->db->where("log_date BETWEEN '$start_date' AND '$end_date'");          
         $this->db->where('project_manager_status', "Approved"); 
        //$this->db->where('log_date >=', $start_date); 
        //$less_query = "('".$end_date."'".' <= log_date)';
        //$this->db->where($less_query);
        $this->db->where_in('employee_id',$ids);
        $query = $this->db->get('activities');         
        $res   = $query->row();
        $last_query = $this->db->last_query();

        // //var_dump($last_query);echo "<br/><br/><br/><br/><br/>"; 
        //  if($dept==1)
        // {
        //   var_dump($last_query);echo "<br/><br/><br/><br/><br/>";
        //   var_dump($res);
        // }

      
        return $res;
    }
    
    //project_manager_status

    public function getmemberprojecttimelog($user_id, $date)
    {
        $this->db->select('hours');
        $this->db->select('project_role_task.task_name as project_task');
        $this->db->join('project_role_task','project_role_task.task_id=activities.project_task', 'left');
        $this->db->where('employee_id',$user_id);
        $this->db->where('log_date',$date);
        $query = $this->db->get('activities');

        return $query->result();
    }


    public function getmemberprojecttimelogByProject($user_id, $date,$project_id)
    { //abass
        $this->db->select('hours');
        $this->db->select('hours');
        $this->db->select('team_lead_status,project_manager_status,final_approved_by,activity_id');
        $this->db->select('team_lead_status,project_manager_status,final_approved_by,activity_id');
        $this->db->select('project_role_task.task_name as project_task');
        $this->db->join('project_role_task','project_role_task.task_id=activities.project_task', 'left');
        $this->db->where('employee_id',$user_id);
        $this->db->where('project_id',$project_id);
        $this->db->where('log_date',$date);
        $query = $this->db->get('activities');

        return $query->result();
    }

        public function getmemberprojecttimelogByProjectIds($user_id, $date,$project_id)
    {
        $this->db->select('hours');
        $this->db->select('project_role_task.task_name as project_task');
        $this->db->join('project_role_task','project_role_task.task_id=activities.project_task', 'left');
        $this->db->where('project_id',$project_id);
        $this->db->where('employee_id',$user_id);
        $this->db->where('log_date',$date);
        $query = $this->db->get('activities');

        return $query->result();
    }


  public function getmemberprojecttimelogByProjectId($project_id,$user_id, $date)
    {
        $this->db->select('hours');
        $this->db->select('project_task');
        $this->db->select('project_role_task.task_name as project_task');
        $this->db->join('project_role_task','project_role_task.task_id=activities.project_task', 'left');
        $this->db->where('employee_id',$user_id);
        $this->db->where('project_id',$project_id);
        $this->db->where('log_date',$date);
        $query = $this->db->get('activities');

        return $query->result();
    }
    public function getProject()
    {
        $this->db->select('id,name');
        $results = $this->db->get('projects')->result();
        $projects_multiselect = array();
        foreach ($results as $result) {
            $projects_multiselect[$result->id] = $result->name;
        }

        return $projects_multiselect;
    }


 public function getProjectAll()
    {
        $this->db->select('*');
        $results = $this->db->get('projects')->result();
        $projects_multiselect = array();
        foreach ($results as $result) {
            $projects_multiselect[] = $result;
        }

        return $projects_multiselect;
    }



    public function getSingleProject($id)
    {
        $this->db->select('id,name,project_manager');
            $this->db->where('id', $id);
            return $this->db->get('projects')->row_array();
    }

    public function setUniqueProjectNumber($id, $unique_number){
        $this->db->set('project_code', $unique_number);
        $this->db->where('id', $id);
        $this->db->update('projects');		
        $id = $this->db->insert_id();		
        return (isset($id)) ? $id : FALSE; 
    }

    public function getProjectByprojectManager($id)
    {
        
        $this->db->select('id,name');
      if($_SESSION['login_detal']->group_id !=7)  $this->db->where('project_manager', $id);
        $results = $this->db->get('projects')->result();
        
        $projects_multiselect = array();
        foreach ($results as $result) {
            $projects_multiselect[$result->id] = $result->name;
        }

        return $projects_multiselect;
    }

    function getProjectByManager($id){
        $this->db = $this->load->database('default', TRUE);    
         $this->db->select('id,name');
         if(!($_SESSION['login_detal']->group_id==7 || $_SESSION['login_detal']->group_id==1) )
            {
            $this->db->where('project_manager', $id);
            }

         $query = $this->db->get("projects");
     
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
            
            
        }

        public function getProTasks($limit, $start)
        {
            $this->db = $this->load->database('default', TRUE);
            $this->db->select('project_tasks.*');
            $this->db->select('projects.name');
            $this->db->select('project_role_task.task_name');
            $this->db->select('employees.*');
            $this->db->join('projects','projects.id=project_tasks.project_id', 'left');
            $this->db->join('employees','employees.id=project_tasks.assigned_to', 'left');
            $this->db->join('project_role_task','project_role_task.task_id=project_tasks.task_id', 'left');
            $this->db->limit($limit, $start);  
            $this->db->order_by('project_tasks.task_id', 'desc');  
            $query = $this->db->get("project_tasks");
    
            return $query->result();
        }



  public function getProTasksFilter($limit, $start,$project_id)
        {
            $this->db = $this->load->database('default', TRUE);
            $this->db->select('project_tasks.*');
            $this->db->select('projects.name');
            $this->db->select('employees.*');
            $this->db->select('project_role_task.task_name');
            $this->db->join('projects','projects.id=project_tasks.project_id', 'left');
            $this->db->join('employees','employees.id=project_tasks.assigned_to', 'left');
            $this->db->join('project_role_task','project_role_task.task_id=project_tasks.task_id', 'left');
            $this->db->where_in('project_tasks.project_id', $project_id);
            $this->db->limit($limit, $start);  
            $this->db->order_by('project_tasks.task_id', 'desc');  
            $query = $this->db->get("project_tasks");
    
            return $query->result();
        }

        public function getStaffProjectTask($limit, $start, $emp_id){
            $this->db->select('project_tasks.*');
            $this->db->select('projects.name');
            $this->db->select('project_role_task.task_name');
            $this->db->join('projects','projects.id=project_tasks.project_id', 'left');
            $this->db->join('project_role_task','project_role_task.task_id=project_tasks.task_id', 'left');
            $this->db->where('assigned_to', $emp_id); 
            $this->db->order_by('project_tasks.task_id', 'desc');  
            $query = $this->db->get("project_tasks");
            return $query->result();
        }

        public function getStaffActivityProjectTask($proj_id, $emp_id){
            $this->db->select('task_name, project_tasks.task_id');
            $this->db->join('project_role_task','project_role_task.task_id=project_tasks.task_id', 'left');
            $this->db->where('project_id', $proj_id); 
            $this->db->where('assigned_to', $emp_id);
            $query = $this->db->get("project_tasks");
            return $query->result_array();
        }


        public function getStaffActivityProjectTaskDetailed($proj_id, $emp_id){
            $current_date = date("Y-m-d");
           // $where = "('".$current_date."' > project_tasks.start_date AND '".$current_date."' <= project_tasks.end_date)";
            $this->db->select('project_role_task.task_name,project_tasks.task_id');            
            $this->db->join('project_role_task','project_role_task.task_id=project_tasks.task_id', 'left');
            $this->db->where('project_tasks.assigned_to', $emp_id);
            $this->db->where('project_tasks.project_id', $proj_id); 
          //  $this->db->where($where); 
            $query = $this->db->get("project_tasks");
           
            return $query->result_array();
          //  print_r($this->db->last_query());    exit;
        }

        public function getSingleTask($id){
            $this->db = $this->load->database('default', TRUE);
            $this->db->where('task_id', $id);
            $query = $this->db->get("project_tasks");
            if ($query->num_rows() == 1) {
                return $query->row_array();
            }
            return false;

        }

        public function getProTasksCount()
        {
            $this->db = $this->load->database('default', TRUE);
            $query = $this->db->get("project_tasks");
    
            return $query->num_rows();
        }

        public function getStaffProTasksCount($emp_id)
        {
            $this->db = $this->load->database('default', TRUE);
            $this->db->where('assigned_to', $emp_id); 
            $query = $this->db->get("project_tasks");
    
            return $query->num_rows();
        }



    public function getLeaveGroup()
    {
        $this->db->select('id,name');
        $results = $this->db->get('leavegroups')->result();
        $projects_multiselect = array();
        $projects_multiselect[''] = '';
        foreach ($results as $result) {
            $projects_multiselect[$result->id] = $result->name;
        }

        return $projects_multiselect;
    }

    public function getOperationalExpenses()
    {
        $this->db->select('expense_line_id,expense_line_name');
        $results = $this->db->get('expense_line')->result();
        $expense_line_multiselect = array();
        foreach ($results as $result) {
            $expense_line_multiselect[$result->id] = $result->expense_line_name;
        }

        return $expense_line_multiselect;
    }

    public function getEmployee()
    {
        $this->db->select('id,first_name,last_name');
        $results = $this->db->get('employees')->result();
        $employees_multiselect = array();
        foreach ($results as $result) {
            $employees_multiselect[$result->id] = $result->first_name.' '.$result->last_name;
        }

        return $employees_multiselect;
    }

    public function saveTask($project_id, $task_name, $task_desc,$task_owner, $assigned_to){
        $data = array(
            'project_id'=> $project_id,
            'task_name'=> $task_name,
            'task_description'=> $task_desc,
            'task_owner'=> $task_owner,
            'assigned_to'=> $assigned_to
            

        );
        $this->db->insert('tasks', $data);
        return ($this->db->affected_rows() != 1) ? false: true;
    }

    public function deleteTask($id){
        $this->db->where('task_id', $id);
        $this->db->delete('tasks');	
        return ($this->db->affected_rows() != 1) ? false: true;		
             
    }

    public function editTask($id, $project_id, $task_name, $task_desc,$task_owner, $assigned_to){
        $data = array(
            'project_id'=> $project_id,
            'task_name'=> $task_name,
            'task_description'=> $task_desc,
            'task_owner'=> $task_owner,
            'assigned_to'=> $assigned_to

        );
        $this->db->where('task_id', $id);
        $this->db->update('tasks', $data);
        return ($this->db->affected_rows() != 1) ? false: true;
    }

    public function ProjectTimeline($project_id, $task_name, $duration,$start_date, $end_date){
        $data = array(
            'project_id'=> $project_id,
            'task_name'=> $task_name,
            'duration'=> $duration,
            'start_date'=> $start_date,
            'end_date'=> $end_date

        );
        // Var_dump($data); exit;
        $this->db->insert('project_tasks', $data);
        return ($this->db->affected_rows() != 1) ? false: true;
    }

    public function getTaskEmployee($date){
        $this->db = $this->load->database('default', TRUE);
        $this->db->select('employees.first_name, employees.last_name, employees.work_email'); 
        $this->db->select('project_tasks.*'); 
        $this->db->join('employees','employees.id=project_tasks.assigned_to', 'left');

        $where = "'{$date}' >= project_tasks.start_date AND '{$date}' <= project_tasks.end_date";
        $this->db->where($where, null, false);

        $query = $this->db->get("project_tasks");
        return $query->result();
    }

    public function checkLogdate($id, $date){
        $this->db = $this->load->database('default', TRUE);
        $this->db->where('employee_id', $id);
        $this->db->where('log_date', $date);

        $query = $this->db->get("activities");
        return $query->row();
    }

    public function getProjectTaskByName($name){
        $this->db = $this->load->database('default', TRUE);
        $this->db->where('project_role_task.task_name', $name); 
        $this->db->join('project_role_task','project_role_task.task_id=project_tasks.task_id', 'left');

        $query = $this->db->get("project_tasks");
        return $query->row();
    }

    public function getDepartmentEmployee($id)
    {
        $this->db->select('employees.id,employees.first_name,employees.last_name');
        $this->db->from('employees');
        $this->db->join('users', 'users.employee_id = employees.id', 'left');
        $this->db->where('users.dept_id', $id);
        $results = $this->db->get()->result();
        $employees_multiselect = array();
        $employees_multiselect['0'] = 'Vacant';
        foreach ($results as $result) {
            $employees_multiselect[$result->id] = $result->first_name.' '.$result->last_name;
        }

        return $employees_multiselect;
    }

    public function getSingleEmployee($id)
    {
        $this->db->select('*');
        $this->db->select('employees.employee_id as emp_id');        
        $this->db->join('employee_rate', 'employee_rate.employee_id = employees.id', 'left');
        $this->db->where('employees.id', $id);
        $results = $this->db->get('employees')->result();
        $employees_multiselect = array();
        foreach ($results as $result) {
            $employees_multiselect[] = $result;
        }

        return $employees_multiselect;
    }

    public function getAllEmployee()
    {
        $this->db->select('*');
        $this->db->select('employees.employee_id as emp_id');
        $this->db->join('employee_rate', 'employee_rate.employee_id = employees.id', 'left');
        $results = $this->db->get('employees')->result();
        $employees_multiselect = array();
        foreach ($results as $result) {
            $employees_multiselect[] = $result;
        }

        return $employees_multiselect;
    }


    public function getDirectors()
    {
        $this->db->select('employees.id as emplid');
        $this->db->select('employees.*');
        $this->db->select('users.*');
        $this->db->select('employees.employee_id as emp_id');
        $this->db->join('users', 'users.employee_id = employees.id', 'left'); 
        $this->db->where('users.group_id',2);
        $results = $this->db->get('employees')->result();
        $employees_multiselect = array();
        foreach ($results as $result) {
            $employees_multiselect[] = $result;
        }

        return $employees_multiselect;
    }

    public function getFinControllerDetails()
    {
        $this->db->select('*');
        $this->db->select('employees.employee_id as emp_id');
        $this->db->join('users', 'users.employee_id = employees.id', 'left');
        //$this->db->where('users.group_id', );
        $this->db->where('users.group_id',7);
        $results = $this->db->get('employees')->result();
        $employees_multiselect = array();
        foreach ($results as $result) {
            $employees_multiselect[] = $result;
        }

        return $employees_multiselect;
    }

    public function getTrainingSessions()
    {
        $this->db->select('id,name');
        $results = $this->db->get('trainingsessions')->result();
        $employees_multiselect = array();
        foreach ($results as $result) {
            $employees_multiselect[$result->id] = $result->name;
        }

        return $employees_multiselect;
    }

    public function getDepartment()
    {
        $this->db->select('id,title');
        $results = $this->db->get('companystructures')->result();
        $deparment_select = array();
        foreach ($results as $result) {
            $deparment_select[$result->id] = $result->title;
        }

        return $deparment_select;
    }

    public function expenseCategory()
    {
        $this->db->select('expense_category_id,expense_category_name');
        $results = $this->db->get('expense_category')->result();
        $cat_select = array();
        foreach ($results as $result) {
            $cat_select[$result->expense_category_id] = $result->expense_category_name;
        }

        return $cat_select;
    }

    public function getYear()
    {
        $this->db->select('id,year');
        $results = $this->db->get('year')->result();
        $year_select = array();
        foreach ($results as $result) {
            $year_select[$result->id] = $result->year;
        }

        return $year_select;
    }

    public function getRoles()
    {
        $this->db->select('group_id,group_name');
        $results = $this->db->get('group_table')->result();
        $roles_select = array();
        foreach ($results as $result) {
            $roles_select[$result->group_id] = $result->group_name;
        }

        return $roles_select;
    }


    public function getCountry()
    {
        $this->db->select('code,id,name');
        $results = $this->db->get('country')->result();
        $country_select = array();
        foreach ($results as $result) {
            $country_select[$result->code] = $result->name;
        }

        return $country_select;
    }

    public function getCourses()
    {
        $this->db->select('code,id,name');
        $results = $this->db->get('courses')->result();
        $currency_select = array();
        foreach ($results as $result) {
            $currency_select[$result->id] = $result->name;
        }

        return $currency_select;
    }

    public function getCurrency()
    {
        $this->db->select('code,id,name');
        $results = $this->db->get('currencytypes')->result();
        $currency_select = array();
        foreach ($results as $result) {
            $currency_select[$result->code] = $result->name;
        }

        return $currency_select;
    }

    public function updateactivitylog($id, $data)
    {
        $this->db->where('activity_id', $id);
        $this->db->update('activities', $data);
    }

    function insertEmployeeRate($data,$id){
        
      $this->db->where('employee_id', $id);
      $this->db->delete('employee_rate');
       
      $this->db->insert('employee_rate', $data);		
      $id = $this->db->insert_id();		
     return (isset($id)) ? $id : FALSE;
      
  }

  public function getEmployeeByEmailSingle($email)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('*');
        $this->db->where('work_email', $email);
        $query = $this->db->get('employees');
        return $query->row();
    }

    public function getEmployeeByIdSingle($id)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('*');
        $this->db->where('employee_id', $id);
        $query = $this->db->get('employees');
        return $query->row();
    }



  
}
