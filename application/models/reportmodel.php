<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reportmodel
 *
 * @author Gbadeyanka Abass
 */
class reportmodel extends CI_Model{
    
   
    function __construct() {
            parent::__construct();
            //$this->db_cms = $this->load->database('cms', TRUE);   
    }
    
    
    public function getalltransaction($limit, $start){
    $this->db->limit($limit, $start);
    $this->db->select('*');
    $this->db->group_by('trans_no');    
    $this->db->where('delete_status', '0');
    //$this->db->join('batch', 'transation_status.batch_id = batch.batch_id','left');
    $this->db->join('transation_status', 'transation_status.transaction_no = transaction_commited.trans_no','left');
    $query = $this->db->get("transaction_commited");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }  
        return false;      
        
    }

    public function getCatBudget($year, $cat_id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->select_sum('department_exp_budget.budgeted_amount');
        $this->db->join('expense_line', 'expense_line.expense_line_id = department_exp_budget.expense_line_id', 'left');
        $this->db->where('department_exp_budget.year',$year);
        $this->db->where('expense_line.expense_category_id', $cat_id);
        $query = $this->db->get('department_exp_budget');

        return $query->row_array();
    }

     public function getExpenseCatBudget($dbFilter,$year,$cat_id)
    {
        if ($dbFilter == 'YEAR') {
            $selectQuery = "YEAR(budget_expense_log.update_date) AS month";
            $groupbyQuery = "YEAR(budget_expense_log.update_date)";
        } elseif($dbFilter == 'QUARTER') {
           $selectQuery = "QUARTER(budget_expense_log.update_date) AS month";
           $groupbyQuery = "QUARTER(budget_expense_log.update_date)";
        }else{
            $selectQuery = "MONTH(budget_expense_log.update_date) AS month";
            $groupbyQuery = "MONTH(budget_expense_log.update_date)";
        }
        
        $this->db = $this->load->database('default', true);

        $this->db->select_sum('amount');
        $this->db->select($selectQuery);
        $this->db->where('YEAR(update_date)',$year);
        $this->db->where('exp_cat', $cat_id);
        $this->db->group_by($groupbyQuery);
        $this->db->order_by('YEAR(update_date)', 'DESC');
        $query = $this->db->get('budget_expense_log');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }

    public function getCatExpline($cat_id)
    {
        $this->db->select('expense_line_id');
        $this->db->select('expense_line_name');
        $this->db->where('expense_category_id', $cat_id);
        $query = $this->db->get('expense_line');
        return $query->result();
    }

    public function getDeptExpline($exp_id)
    {
        $this->db->select('department_map');
        $this->db->where('expense_line_id', $exp_id);
        $query = $this->db->get('expense_line');
        return $query->row_array();
    }

    public function getDeptName($dpt_id)
    {
        $this->db->select('title');
        $this->db->where('id', $dpt_id);
        $query = $this->db->get('companystructures');
        return $query->row_array();
    }

    public function getExpenseActual($dbFilter,$year,$exp_id, $dept)
    {
         if ($dbFilter == 'YEAR') {
            $selectQuery = "YEAR(budget_expense_log.update_date) AS month";
            $groupbyQuery = "YEAR(budget_expense_log.update_date)";
        } elseif($dbFilter == 'QUARTER') {
           $selectQuery = "QUARTER(budget_expense_log.update_date) AS month";
           $groupbyQuery = "QUARTER(budget_expense_log.update_date)";
        }else{
            $selectQuery = "MONTH(budget_expense_log.update_date) AS month";
            $groupbyQuery = "MONTH(budget_expense_log.update_date)";
        }


        $this->db = $this->load->database('default', true);
        $this->db->select_sum('amount');
        $this->db->select($selectQuery);
        $this->db->where('exp_line', $exp_id);
        if (!empty($dept)) {
            $this->db->where('department_id',$dept);
        }
        $this->db->where('YEAR(update_date)',$year);
        $this->db->group_by($groupbyQuery);
        $this->db->order_by('YEAR(update_date)', 'DESC');
        $query = $this->db->get('budget_expense_log');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;

    }

     public function getExpenseBudget($year,$exp_id,$dept)
    {
        $this->db = $this->load->database('default', true);
        $this->db->select_sum('budgeted_amount');
        $this->db->where('expense_line_id', $exp_id);
        $this->db->where('year',$year);
        if (!empty($dept)) {
            $this->db->where('department_id',$dept);
        }
        $query = $this->db->get('department_exp_budget');

        return $query->row_array();
    }

     public function getCatExpenseLineBudget($dbFilter,$year,$cat_id,$dept=null)
    {
       $list = array();
       $list1 = array();
        $expline = $this->getCatExpline($cat_id);
        if ($expline) {
            foreach ($expline as $row) {
                $list1['expense_line_id'] = $row->expense_line_id;
                $list1['expense_line_name'] = $row->expense_line_name;
                $exp = $this->getExpenseActual($dbFilter,$year,$row->expense_line_id,$dept);
                //var_dump($exp);exit;
                $bud = $this->getExpenseBudget($year,$row->expense_line_id,$dept);
                $list1['budget'] = $bud['budgeted_amount'];
                $list1['actual'] = $exp;

                $list[] = $list1;
            }
            
        }
        
        return $list;
        
    }

      public function getExpenseLineBudget($dbFilter,$year,$exp_id)
    {
        if ($dbFilter == 'YEAR') {
            $selectQuery = "YEAR(budget_expense_log.update_date) AS month";
            $groupbyQuery = "YEAR(budget_expense_log.update_date)";
        } elseif($dbFilter == 'QUARTER') {
           $selectQuery = "QUARTER(budget_expense_log.update_date) AS month";
           $groupbyQuery = "QUARTER(budget_expense_log.update_date)";
        }else{
            $selectQuery = "MONTH(budget_expense_log.update_date) AS month";
            $groupbyQuery = "MONTH(budget_expense_log.update_date)";
        }
        $this->db = $this->load->database('default', true);
        $this->db->select_sum('amount');
        $this->db->select($selectQuery);
         if ($dbFilter == 'YEAR') {
            $this->db->where('YEAR(update_date) IN ('.$year.')', null, false);
        } else{
           $this->db->where('YEAR(update_date)',$year);
        }
        $this->db->where('exp_line', $exp_id);
        $this->db->group_by($groupbyQuery);
        $this->db->order_by('YEAR(update_date)', 'DESC');
        $query = $this->db->get('budget_expense_log');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }

    public function getDeptExpenseLineBudget($dbFilter, $expense_id, $year, $deptt=null)
    {
        $list = array();
       $list1 = array();
        $dept = $this->getDeptExpline($expense_id);
        $dpt =  explode(',', $dept['department_map']);
       
        
         if ($dept) {

             if (!empty($deptt)) {
            if (in_array($deptt, $dpt)) {
            $dpt = array();
            $dpt[] = $deptt;
        }else{
            $dpt = array();
        }
        } 
            foreach ($dpt as $row) {

                $resp = $this->getDeptName(intval($row));
                $list1['department_name'] = $resp['title'];
                $exp = $this->getDeptActual($dbFilter,$year,$expense_id,intval($row));
                //var_dump($exp);exit;
                $bud = $this->getDeptBudget($year,$expense_id,intval($row));
                $list1['budget'] = $bud['budgeted_amount'];
                $list1['actual'] = $exp;

                $list[] = $list1;
            }
            
        }
        return $list;

    }

    public function getDeptActual($dbFilter,$year,$exp_id,$dpt_id)
    {
         if ($dbFilter == 'YEAR') {
            $selectQuery = "YEAR(budget_expense_log.update_date) AS month";
            $groupbyQuery = "YEAR(budget_expense_log.update_date)";
        } elseif($dbFilter == 'QUARTER') {
           $selectQuery = "QUARTER(budget_expense_log.update_date) AS month";
           $groupbyQuery = "QUARTER(budget_expense_log.update_date)";
        }else{
            $selectQuery = "MONTH(budget_expense_log.update_date) AS month";
            $groupbyQuery = "MONTH(budget_expense_log.update_date)";
        }


        $this->db = $this->load->database('default', true);
        $this->db->select_sum('amount');
        $this->db->select($selectQuery);
        $this->db->where('department_id',$dpt_id);
        $this->db->where('exp_line', $exp_id);
        $this->db->where('YEAR(update_date)',$year);
        $this->db->group_by($groupbyQuery);
        $this->db->order_by('YEAR(update_date)', 'DESC');
        $query = $this->db->get('budget_expense_log');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;

    }

     public function getDeptBudget($year,$exp_id,$dpt_id)
    {
        $this->db = $this->load->database('default', true);
        $this->db->select('budgeted_amount');
        $this->db->where('expense_line_id', $exp_id);
        $this->db->where('department_id', $dpt_id);
        $this->db->where('year',$year);
        $query = $this->db->get('department_exp_budget');

        return $query->row_array();
    }


     public function getDepartmentBudget($dbFilter,$dpt,$year,$exp_id)
    {
        if ($dbFilter == 'YEAR') {
            $selectQuery = "YEAR(budget_expense_log.update_date) AS month";
            $groupbyQuery = "YEAR(budget_expense_log.update_date)";
        } elseif($dbFilter == 'QUARTER') {
           $selectQuery = "QUARTER(budget_expense_log.update_date) AS month";
           $groupbyQuery = "QUARTER(budget_expense_log.update_date)";
        }else{
            $selectQuery = "MONTH(budget_expense_log.update_date) AS month";
            $groupbyQuery = "MONTH(budget_expense_log.update_date)";
        }
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('companystructures.title');
        $this->db->select($selectQuery);
        //$this->db->select('department_exp_budget.budgeted_amount');
        $this->db->select_sum('budget_expense_log.amount');
        $this->db->join('companystructures', 'companystructures.id = budget_expense_log.department_id', 'left');
        $this->db->where('budget_expense_log.department_id IN ('.$dpt.')', null, false);
         if ($dbFilter == 'YEAR') {
            $this->db->where('YEAR(update_date) IN ('.$year.')', null, false);
        } else{
           $this->db->where('YEAR(update_date)',$year);
        }
        $this->db->where('budget_expense_log.exp_line', $exp_id);
        $this->db->group_by($groupbyQuery);
        $this->db->order_by('YEAR(update_date)', 'DESC');
        $query = $this->db->get('budget_expense_log');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }

     public function getTotalBudget($dbFilter,$year)
    {
        if ($dbFilter == 'YEAR') {
            $selectQuery = "YEAR(budget_expense_log.update_date) AS month";
            $groupbyQuery = "YEAR(budget_expense_log.update_date)";
        } elseif($dbFilter == 'QUARTER') {
           $selectQuery = "QUARTER(budget_expense_log.update_date) AS month";
           $groupbyQuery = "QUARTER(budget_expense_log.update_date)";
        }else{
            $selectQuery = "MONTH(budget_expense_log.update_date) AS month";
            $groupbyQuery = "MONTH(budget_expense_log.update_date)";
        }
        $this->db->select_sum('amount');
        $this->db->select($selectQuery);
         if ($dbFilter == 'YEAR') {
            $this->db->where('YEAR(update_date) IN ('.$year.')', null, false);
        } else{
           $this->db->where('YEAR(update_date)',$year);
        }
        $this->db->group_by($groupbyQuery);
        $this->db->order_by('YEAR(update_date)', 'DESC');
        $query = $this->db->get('budget_expense_log');
         if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }
    
    
    public function supRejectedTransaction($limit, $start){
        
    $this->db->limit($limit, $start);
    $this->db->join('batch', 'transation_status.batch_id = batch.batch_id','left');
    $this->db->where('supervisor_status', 'rejected');
    $this->db->where('delete_status', '0');
    $query = $this->db->get("transation_status");
    
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
        
    }
    
    public function getAllRejectedTransaction($limit, $start){
    $this->db->limit($limit, $start);
     $this->db->join('batch', 'transation_status.batch_id = batch.batch_id','left');
    $this->db->where('status', 'rejected');
    $this->db->where('delete_status', '0');
    $query = $this->db->get("transation_status");
    
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
        
    }
    
    
    public function getAllPendingTransaction($limit, $start){
    $this->db->limit($limit, $start);
    $this->db->where('status', 'pending');
    $this->db->where('delete_status', '0');
    $query = $this->db->get("transation_status");
    
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
        
    }
    
    public function getalltransactionByUnit($limit, $start){
    $this->db->select('*');
    $this->db->select('transaction_main.trans_date,transation_status.status');
    $this->db->limit($limit, $start);
    $this->db->join('unit', 'unit.unit_id = transaction_main.unit_id','left');
    $this->db->where('delete_status', '0');
    
    $this->db->join('transation_status', 'transation_status.transaction_no = transaction_main.trans_id','left');
    $query = $this->db->get("transaction_main");
    
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
        
    }
    
    public function getalltransactionByUnitSearch($limit, $start,$id){
    $this->db->select('*');
    $this->db->select('transaction_main.trans_date,transation_status.status');
    $this->db->limit($limit, $start);
    $this->db->join('unit', 'unit.unit_id = transaction_main.unit_id','left');
    $this->db->where('delete_status', '0');
    $this->db->join('transation_status', 'transation_status.transaction_no = transaction_main.trans_id','left');
    $this->db->where('transaction_main.unit_id',$id);
    $query = $this->db->get("transaction_main");
    
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;      
        
    }
    
    public function getalltransactionBySubUnitSearch($limit, $start,$id){
    $this->db->select('*');
    $this->db->where('delete_status', '0');
    $this->db->select('transaction_main.trans_date,transaction_main.hospital_no,transation_status.status');
    $this->db->limit($limit, $start);
    $this->db->join('unit', 'unit.unit_id = transaction_main.unit_id','left');
    $this->db->join('subunit', 'subunit.subunit_id = transaction_main.subunit_id','left');
    $this->db->join('transation_status', 'transation_status.transaction_no = transaction_main.trans_id','left');
    $this->db->where('transaction_main.subunit_id',$id);
    $query = $this->db->get("transaction_main");
    
 
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
