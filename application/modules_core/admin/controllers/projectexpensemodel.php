<?php

/**
 * Description of Role.
 *
 * @author Gbadeyanka Abass
 */
class projectexpensemodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    public function logProjectExpense($data)
    {
        $this->db->insert('project_exp_log', $data);
        $id = $this->db->insert_id();

        return (isset($id)) ? $id : false;
    }

    public function updateExpense($id, $data)
    {
        $this->db->where('proj_exp_id', $id);
        $resp = $this->db->update('project_exp_log', $data);
        return $resp;
    }

    public function getexpenseline($id)
    {
        $this->db->select('*');
        $this->db->where('expense_line.expense_line_id', $id);
        $this->db->join('expense_category', 'expense_category.expense_category_id = expense_line.expense_category_id', 'left');
        $query = $this->db->get('expense_line');

        return $query->row_array();
    }

    public function getBudgetTotal()
    {
        $this->db->select('SUM(budgeted_amount) AS total');
        $query = $this->db->get('expense_line');

        return $query->row_array();
    }

    public function getBudgetTotalDept($dept)
    {
        $where = "FIND_IN_SET('".$dept."', expense_line.department_map)";
        $this->db->where($where);
        $this->db->select('SUM(budgeted_amount) AS total');
        $query = $this->db->get('expense_line');

        return $query->row_array();
    }

    public function getSepentBudgetTotal()
    {//bua_exp_log
        $this->db->select('SUM(bua_exp_log.amount) AS total');
        // $this->db->join('bua_exp_log', 'bua_exp_log.exp_line = expense_line.expense_line_id','left');
        $this->db->where('bua_exp_log.director_status', 1);
        $query = $this->db->get('bua_exp_log');

        return $query->row_array();
    }

    public function getSepentBudgetTotalDept($dept)
    {
        $where = "FIND_IN_SET('".$dept."', expense_line.department_map)";
        $this->db->where($where);
        $this->db->select('SUM(b.amount) AS total');
        $this->db->join('expense_line', 'b.exp_line = expense_line.expense_line_id', 'left');
        $this->db->where('b.director_status', 1);
        $query = $this->db->get('bua_exp_log b');

        return $query->row_array();
    }

    public function getActiveProject()
    {    
        //bua_exp_log
        //$this->db->limit(8); 
         $this->db->select('projects.id as  project_id,projects.*,project_team.team_member, project_team.team_lead');
        $this->db->select('clients.name as client_name');
        $this->db->join('clients', 'clients.id = projects.client', 'left');
        $this->db->join('project_team', 'project_team.team_project_id = projects.id', 'left');
        $this->db->where('projects.status', 'Active');
        $this->db->order_by('projects.end_date', "DESC");
        $query = $this->db->get('projects');
     //  var_dump($query->result());exit;
        return $query->result();
    }

    public function getprojectDash()
    {
        $list = array();
       $list1 = array();
       $existing = [];
        $proj = $this->getActiveProject();
         if ($proj) {
            foreach ($proj as $row) {
            if (in_array($row->project_id, $existing)){
              continue;
            }
                $member = array();
                $member= explode(',', $row->team_member);
                $member[] = $row->team_lead;
                $member[] = $row->project_manager;
                $list1['project_id'] = $row->project_id;
                
                $list1['members'] = array_unique($member);
                $list1['client'] = $row->client_name;
                $list1['project'] = $row->name;
                $list1['budget'] = $row->budget_amount;
                $list1['start'] = $row->start_date;
                $list1['end'] = $row->end_date;
                $list1['actual'] = $row->actual_end_date;
                $exp = $this->getAmount($row->project_id);
                $cost = $this->getPersonnelCost($row->project_id);
            // var_dump($cost);exit;
                $list1['expenses'] = $exp['amount'];
                $list1['cost'] = $cost['rate_cost'];
               // var_dump($list1);
                $existing[] = $row->project_id;
                $list[] = $list1;
            }
            
        }
        
        return $list;

    }


    public function projectTaskByRoleId($role_id)
    { 
        $this->db->select('*');
        $this->db->where('role_id', $role_id);
        $query = $this->db->get('project_role_task');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getprojectexpensereport($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->select('projects.*');
        $this->db->select('clients.name as client_name');
        $this->db->join('clients', 'clients.id = projects.client', 'left');
        $query = $this->db->get('projects');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getAmount($id)
    {
        $this->db->select_sum('amount');
        $this->db->where('director_status', 1);
        $this->db->where('project_id', $id);
        $query = $this->db->get('project_exp_log');

        return $query->row_array();
    }


    public function getAllAmount()
    {
        $this->db->select_sum('amount');
        $this->db->where('director_status', 1); 
        $query = $this->db->get('project_exp_log');

        return $query->row_array();
    }


    public function getAllAmountByProjectRevenueHead($project_id,$rev_head)
    {
        $this->db->select_sum('amount');
        $this->db->where('director_status', 1); 
        $this->db->where('project_id', $project_id); 
        $this->db->where('expense_head', $rev_head); 

        //project_id  expense_head
        $query = $this->db->get('project_exp_log');

        return $query->row_array();
    }

    public function getAmountAll()
    {
        $this->db->select_sum('amount');
        $this->db->where('director_status', 1);
       // $this->db->where('project_id', $id);
        $query = $this->db->get('project_exp_log');

        return $query->row_array();
    }

    public function getExpByRevenueHeadDeptAmount($id,$revenueHead,$dept)
    {
        $this->db->select_sum('amount');
        $this->db->where('employees.department', $dept);
        $this->db->where('expense_head', $revenueHead);
        $this->db->where('director_status', 1);
        $this->db->where('project_id', $id);
        $this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $query = $this->db->get('project_exp_log');

        return $query->row_array();
    }


    public function getExpByRevenueHeadProjectAmount($id,$revenueHead)
    {
        $this->db->select_sum('amount'); 
        $this->db->where('expense_head', $revenueHead);
        $this->db->where('director_status', 1);
        $this->db->where('project_id', $id);
        $this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $query = $this->db->get('project_exp_log');

        return $query->row_array();
    }


    public function getExpByRevenueHeadDeptAmountByProject($project_id)
    {
        $this->db->select_sum('amount'); 
        $this->db->where('project_id', $project_id);
        $this->db->where('director_status', 1);
        
        //$this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $query = $this->db->get('project_exp_log');

        return $query->row_array();
    }


    public function getExpByRevenueHeadDeptAmountAll($revenueHead,$dept)
    {
        $this->db->select_sum('amount');
        $this->db->where('employees.department', $dept);
        $this->db->where('expense_head', $revenueHead);
        $this->db->where('director_status', 1);
        
        $this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $query = $this->db->get('project_exp_log');

        return $query->row_array();
    }

    public function getPersonnelCostByDepartment($dept)
    {
        $this->db->select_sum('rate_cost');
        $this->db->where('employees.department', $dept);
        $this->db->join('employees', 'employees.id = employee_hourly_cost_rate.employee_id', 'left');
        $query = $this->db->get('employee_hourly_cost_rate');

        return $query->row_array();
    }


    public function getPersonnelCost($id)
    {
        $this->db->select_sum('rate_cost');
        $this->db->where('project_id', $id);
        $query = $this->db->get('employee_hourly_cost_rate');

        return $query->row_array();
    }



    public function getAllPersonnelCost()
    {
        $this->db->select_sum('rate_cost'); 
        $query = $this->db->get('employee_hourly_cost_rate');

        return $query->row_array();
    }


    
    public function getPersonnelCostAll()
    {
        $this->db->select_sum('rate_cost');
        $query = $this->db->get('employee_hourly_cost_rate');

        return $query->row_array();
    }

    public function getTotalProject()
    {//bua_exp_log
        $this->db->select('count(*) AS total');
        $query = $this->db->get('projects');

        return $query->row_array();
    }

    public function getTotalClosedProject()
    {//bua_exp_log
        $this->db->select('count(*) AS total');
        $this->db->where('projects.status', 'Completed');
        $query = $this->db->get('projects');

        return $query->row_array();
    }

    public function getTotalOnHoldProject()
    {//bua_exp_log
        $this->db->select('count(*) AS total');
        $this->db->where('projects.status', 'On Hold');
        $query = $this->db->get('projects');

        return $query->row_array();
    }

    public function getTotalActiveProject()
    {//bua_exp_log
        $this->db->select('count(*) AS total');
        $this->db->where('projects.status', 'Active');
        $query = $this->db->get('projects');

        return $query->row_array();
    }

    public function getTotalBudgetByDept($deptId)
    {//bua_exp_log
        $this->db->select('SUM(budgeted_amount) AS total');
        $this->db->where('expense_line.department_map', $deptId);
        $query = $this->db->get('expense_line');

        return $query->row_array();
    }

    public function getTotalSpentOnBudgetByDept($deptId)
    {//bua_exp_log
        $this->db->select('SUM(budgeted_amount) AS total');
        $this->db->join('bua_exp_log', 'bua_exp_log.exp_line = expense_line.expense_line_id', 'left');
        $this->db->where('expense_line.department_map', $deptId);
        $this->db->where('bua_exp_log.director_status', 1);
        $query = $this->db->get('expense_line');

        return $query->row_array();
    }

    public function getTotalSpentOnBudgetByCategory($id)
    {
        $this->db->select('SUM(budgeted_amount) AS total');
        $this->db->join('bua_exp_log', 'bua_exp_log.exp_line = expense_line.expense_line_id', 'left');
        $this->db->join('expense_category', 'expense_category.expense_category_id = expense_line.expense_category_id', 'left');
        $this->db->where('expense_category.expense_category_id', $id);
      //  $this->db->where('bua_exp_log.director_statusn', 1);
        $query = $this->db->get('expense_line');

        return $query->row_array();
    }

    public function getDirectorExpLog($limit, $start, $employid)
    {
        // $this->db->limit($limit, $start);
        $this->db->select('employees.*');
        $this->db->select('projects.*');
        $this->db->select('expense_category.*');
        $this->db->select('expense_line.*');
        $this->db->select('project_exp_log.*');
        $this->db->select('projects.name as proj_name');

        $this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $this->db->join('projects', 'projects.id = project_exp_log.project_id', 'left');
        $this->db->join('expense_category', 'expense_category.expense_category_id = project_exp_log.exp_cat', 'left');
        $this->db->join('expense_line', 'expense_line.expense_line_id = project_exp_log.exp_line', 'left');
       // $this->db->where('project_exp_log.asssigned_director', $employid);
        $query = $this->db->get('project_exp_log');

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
        $this->db->select('projects.*');
        $this->db->select('project_role_task.task_name');
        $this->db->select('project_exp_log.*');
        $this->db->select('projects.name as proj_name');

        $this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $this->db->join('projects', 'projects.id = project_exp_log.project_id', 'left');
        $this->db->join('project_role_task', 'project_role_task.task_id = project_exp_log.project_task', 'left');
        $this->db->where('projects.project_manager', $employid);
        $query = $this->db->get('project_exp_log');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }


    public function getProjExpLogFinControlerCount()
    { 
        $query = $this->db->get('project_exp_log');

        return $query->num_rows();
    }


    public function getProjExpLogFinControler($limit, $start)
    {
        // $this->db->limit($limit, $start);
        $this->db->select('employees.*');
        $this->db->select('projects.*');
        $this->db->select('project_role_task.task_name');
        $this->db->select('project_exp_log.*');
        $this->db->select('projects.name as proj_name');

        $this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $this->db->join('projects', 'projects.id = project_exp_log.project_id', 'left');
        $this->db->join('project_role_task', 'project_role_task.task_id = project_exp_log.project_task', 'left');
 
        $query = $this->db->get('project_exp_log');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getRejectedProjExpLog($limit, $start, $employid)
    {
        // $this->db->limit($limit, $start);
        $this->db->select('employees.*');
        $this->db->select('projects.*');
        $this->db->select('project_role_task.task_name');
        $this->db->select('project_exp_log.*');
        $this->db->select('projects.name as proj_name');

        $this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $this->db->join('projects', 'projects.id = project_exp_log.project_id', 'left');
        $this->db->join('project_role_task', 'project_role_task.task_id = project_exp_log.project_task', 'left');
        //$where = 'projects.project_manager_status = null OR projects.account_controller_status = null OR projects.director_status = null';
        // $this->db->where($where);
        $this->db->where('project_exp_log.project_manager_status', 2);
        $this->db->or_where('project_exp_log.account_controller_status', 2);
        $this->db->or_where('project_exp_log.director_status', 2);
        
        $query = $this->db->get('project_exp_log');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getUnappProjExpLog($limit, $start, $employid)
    {
        // $this->db->limit($limit, $start);
        $this->db->select('employees.*');
        $this->db->select('projects.*');
        $this->db->select('project_role_task.task_name');
        $this->db->select('project_exp_log.*');
        $this->db->select('projects.name as proj_name');

        $this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $this->db->join('projects', 'projects.id = project_exp_log.project_id', 'left');
        $this->db->join('project_role_task', 'project_role_task.task_id = project_exp_log.project_task', 'left');
        //$where = 'projects.project_manager_status = null OR projects.account_controller_status = null OR projects.director_status = null';
        // $this->db->where($where);
        $this->db->where('project_exp_log.project_manager_status', null);
        $this->db->or_where('project_exp_log.account_controller_status', null);
        $this->db->or_where('project_exp_log.director_status', null);
        
        $query = $this->db->get('project_exp_log');

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
        $this->db->select('projects.*');
        $this->db->select('project_role_task.task_name');
        $this->db->select('project_exp_log.*');
        $this->db->select('projects.name as proj_name');
        $this->db->join('project_role_task', 'project_role_task.task_id = project_exp_log.project_task', 'left');
        $this->db->join('employees', 'employees.id = project_exp_log.employee_id', 'left');
        $this->db->join('projects', 'projects.id = project_exp_log.project_id', 'left');
        $this->db->join('expense_category', 'expense_category.expense_category_id = project_exp_log.exp_cat', 'left');
        $this->db->join('expense_line', 'expense_line.expense_line_id = project_exp_log.exp_line', 'left');
        $this->db->where('project_exp_log.employee_id', $employid);
        $query = $this->db->get('project_exp_log');

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

        $this->db->join('expense_category', 'expense_category.expense_category_id = project_exp_log.exp_cat', 'left');
        $this->db->join('projects', 'projects.id = project_exp_log.project_id', 'left');
        $this->db->join('project_role_task', 'project_role_task.task_id = project_exp_log.project_task', 'left');
        $this->db->where('project_exp_log.proj_exp_id', $id);
        $query = $this->db->get('project_exp_log');

        return $query->row_array();
    }

     public function delproexpense($id)
       {
          $this->db->where('proj_exp_id', $id);
        $this->db->delete('project_exp_log');
        return ($this->db->affected_rows()) ? true : false;
       }

}
