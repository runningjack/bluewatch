<?php

/**
 * Description of Role.
 *
 * @author Gbadeyanka Abass
 */
class Buaexpensemodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }


    function logProjectExpense($data){
        $this->db->insert('bua_exp_log', $data);		
        $id = $this->db->insert_id();		
       return (isset($id)) ? $id : FALSE;        
    }

    function updateExpense($id, $data)
	{
		$this->db->where('bau_exp_id', $id);
		$resp = $this->db->update('bua_exp_log', $data);
        return $resp;
    }
    
    function delbauexpense($id)
	{
		$this->db->where('bau_exp_id', $id);
		$resp = $this->db->delete('bua_exp_log');
    return $resp;
	}


    function getexpenseline($id){
        $this->db->select('*');
        $this->db->where('expense_line.expense_line_id', $id);
        $this->db->join('expense_category', 'expense_category.expense_category_id = expense_line.expense_category_id','left');
        $query = $this->db->get('expense_line');
        return $query->row_array();           
       }


       public function getDirectorBuaExpLog($limit, $start, $employid)
       {
          // $this->db->limit($limit, $start);
           $this->db->select('employees.*'); 
           $this->db->select('expense_category.*');
           $this->db->select('expense_line.*');
           $this->db->select('bua_exp_log.*'); 

           $this->db->join('employees', 'employees.id = bua_exp_log.employee_id', 'left'); 
           $this->db->join('expense_category', 'expense_category.expense_category_id = bua_exp_log.exp_cat', 'left');
           $this->db->join('expense_line', 'expense_line.expense_line_id = bua_exp_log.exp_line', 'left');
           $this->db->where('bua_exp_log.asssigned_director', $employid);
           $query = $this->db->get('bua_exp_log');
   
           if ($query->num_rows() > 0) {
               foreach ($query->result() as $row) {
                   $data[] = $row;
               }
   
               return $data;
           }
   
           return false;
       }

       public function getDirectorExpLog($limit, $start, $employid)
       {
          // $this->db->limit($limit, $start);
           $this->db->select('employees.*');
           $this->db->select('projects.*');
           $this->db->select('expense_category.*');
           $this->db->select('expense_line.*');
           $this->db->select('bua_exp_log.*');
           $this->db->select('projects.name as proj_name');

           $this->db->join('employees', 'employees.id = bua_exp_log.employee_id', 'left');
           $this->db->join('projects', 'projects.id = bua_exp_log.project_id', 'left');
           $this->db->join('expense_category', 'expense_category.expense_category_id = bua_exp_log.exp_cat', 'left');
           $this->db->join('expense_line', 'expense_line.expense_line_id = bua_exp_log.exp_line', 'left');
           $this->db->where('bua_exp_log.asssigned_director', $employid);
           $query = $this->db->get('bua_exp_log');
   
           if ($query->num_rows() > 0) {
               foreach ($query->result() as $row) {
                   $data[] = $row;
               }
   
               return $data;
           }
   
           return false;
       }


       public function getProjExpLog($limit, $start, $employid)
       {
          // $this->db->limit($limit, $start);
           $this->db->select('employees.*');
        //   $this->db->select('projects.*');
           $this->db->select('expense_category.*');
           $this->db->select('expense_line.*');
           $this->db->select('bua_exp_log.*');
         //  $this->db->select('projects.name as proj_name');

           $this->db->join('employees', 'employees.id = bua_exp_log.employee_id', 'left');
        //   $this->db->join('projects', 'projects.id = bua_exp_log.project_id', 'left');
           $this->db->join('expense_category', 'expense_category.expense_category_id = bua_exp_log.exp_cat', 'left');
           $this->db->join('expense_line', 'expense_line.expense_line_id = bua_exp_log.exp_line', 'left');
         //  $this->db->where('projects.project_manager', $employid);
           $query = $this->db->get('bua_exp_log');
   
           if ($query->num_rows() > 0) {
               foreach ($query->result() as $row) {
                   $data[] = $row;
               }
   
               return $data;
           }
   
           return false;
       }


       public function getHodExpLog($limit, $start, $dept_id)
       {
          // $this->db->limit($limit, $start);
           $this->db->select('employees.*');
        //   $this->db->select('projects.*');
           $this->db->select('expense_category.*');
           $this->db->select('expense_line.*');
           $this->db->select('bua_exp_log.*');
         //  $this->db->select('projects.name as proj_name');

           $this->db->join('employees', 'employees.id = bua_exp_log.employee_id', 'left');
        //   $this->db->join('projects', 'projects.id = bua_exp_log.project_id', 'left');
           $this->db->join('expense_category', 'expense_category.expense_category_id = bua_exp_log.exp_cat', 'left');
           $this->db->join('expense_line', 'expense_line.expense_line_id = bua_exp_log.exp_line', 'left');
          $this->db->where('employees.department', $dept_id);
           $query = $this->db->get('bua_exp_log');
   
           if ($query->num_rows() > 0) {
               foreach ($query->result() as $row) {
                   $data[] = $row;
               }
   
               return $data;
           }
   
           return false;
       }

       
       public function getUnappExpLog($limit, $start, $employid)
       {
          // $this->db->limit($limit, $start);
           $this->db->select('employees.*');
        //   $this->db->select('projects.*');
           $this->db->select('expense_category.*');
           $this->db->select('expense_line.*');
           $this->db->select('bua_exp_log.*');
         //  $this->db->select('projects.name as proj_name');

           $this->db->join('employees', 'employees.id = bua_exp_log.employee_id', 'left');
        //   $this->db->join('projects', 'projects.id = bua_exp_log.project_id', 'left');
           $this->db->join('expense_category', 'expense_category.expense_category_id = bua_exp_log.exp_cat', 'left');
           $this->db->join('expense_line', 'expense_line.expense_line_id = bua_exp_log.exp_line', 'left');
         //  $this->db->where('projects.project_manager', $employid);
         $this->db->where('bua_exp_log.hod_status', null);
         $this->db->or_where('bua_exp_log.account_controller_status', null);
         $this->db->or_where('bua_exp_log.director_status', null);
           $query = $this->db->get('bua_exp_log');
   
           if ($query->num_rows() > 0) {
               foreach ($query->result() as $row) {
                   $data[] = $row;
               }
   
               return $data;
           }
   
           return false;
       }

    public function getRejectedExpLog($limit, $start, $employid)
    {
        // $this->db->limit($limit, $start);
        $this->db->select('employees.*');
        //   $this->db->select('projects.*');
           $this->db->select('expense_category.*');
           $this->db->select('expense_line.*');
           $this->db->select('bua_exp_log.*');
         //  $this->db->select('projects.name as proj_name');

           $this->db->join('employees', 'employees.id = bua_exp_log.employee_id', 'left');
        //   $this->db->join('projects', 'projects.id = bua_exp_log.project_id', 'left');
           $this->db->join('expense_category', 'expense_category.expense_category_id = bua_exp_log.exp_cat', 'left');
           $this->db->join('expense_line', 'expense_line.expense_line_id = bua_exp_log.exp_line', 'left');
         //  $this->db->where('projects.project_manager', $employid);
         $this->db->where('bua_exp_log.hod_status', 2);
         $this->db->or_where('bua_exp_log.account_controller_status', 2);
         $this->db->or_where('bua_exp_log.director_status', 2);
           $query = $this->db->get('bua_exp_log');
   
           if ($query->num_rows() > 0) {
               foreach ($query->result() as $row) {
                   $data[] = $row;
               }
   
               return $data;
           }
   
           return false;
    }


       public function getEmployeeExpLog($limit, $start, $employid)
       {
           $this->db->limit($limit, $start);
           $this->db->select('employees.*');
           $this->db->select('expense_category.*');
           $this->db->select('expense_line.*');
           $this->db->select('bua_exp_log.*'); 

           $this->db->join('employees', 'employees.id = bua_exp_log.employee_id', 'left');
           //$this->db->join('projects', 'projects.id = bua_exp_log.project_id', 'left');
           $this->db->join('expense_category', 'expense_category.expense_category_id = bua_exp_log.exp_cat', 'left');
           $this->db->join('expense_line', 'expense_line.expense_line_id = bua_exp_log.exp_line', 'left');
           $this->db->where('bua_exp_log.employee_id', $employid);
           $query = $this->db->get('bua_exp_log');
   
           if ($query->num_rows() > 0) {
               foreach ($query->result() as $row) {
                   $data[] = $row;
               }
   
               return $data;
           }
   
           return false;
       }



       public function getsinglelog($id)
       {
           $this->db = $this->load->database('default', true);
           $this->db->select('*');           
           $this->db->join('expense_category', 'expense_category.expense_category_id = bua_exp_log.exp_cat', 'left');
         //  $this->db->join('projects', 'projects.id = bua_exp_log.project_id', 'left');
           $this->db->join('expense_line', 'expense_line.expense_line_id = bua_exp_log.exp_line', 'left');
           $this->db->where('bua_exp_log.bau_exp_id', $id);
           $query = $this->db->get('bua_exp_log');
             
           return $query->row_array();
       }


       public function getHod($dept_id){
        $this->db = $this->load->database('default', true);
        $this->db->select('*');           
        $this->db->join('users', 'users.employee_id = employees.id', 'left');
        $this->db->where('employees.department', $dept_id);
        $this->db->where('users.group_id',4);
        $query = $this->db->get('employees');
          
        return $query->row_array();

       }
    

   
}
