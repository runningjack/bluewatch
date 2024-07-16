<?php
class Employee_charge_out_rate_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
        
    }
    public function insert_batch($data) {
        return $this->db->insert_batch('employee_charge_out_rates', $data);
    }

    public function update_batch($data, $column) {
        return $this->db->update_batch('employee_charge_out_rates', $data, $column);
    }

     /**
     * Insert charge-out rate data into the database
     *
     * @param array $data
     * @return bool
     */
    public function insert_charge_out_rate($data) {
        
        return $this->db->insert('employee_charge_out_rates', $data);
    }

    /**
     * Retrieve charge-out rate data for a specific staff ID
     *
     * @param int $employee_id
     * @return array
     */
    public function get_charge_out_rate_by_employee_id($employee_id) {
        $this->db->select('employee_charge_out_rates.*, employees.employee_id as emp_id, employees.first_name, employees.middle_name, employees.last_name, employees.gender');
        $this->db->join('employees', 'employees.employee_id = employee_charge_out_rates.employee_id');
        $this->db->where('employee_charge_out_rates.employee_id', $employee_id);
        $query = $this->db->get('employee_charge_out_rates');
        return $query->row();
    }
    

    /**
     * Retrieve all charge-out rate data
     *
     * @return array
     */

     public function get_all_employee_charge_out_rates()
     {
         $this->db->select('employee_charge_out_rates.*, employees.employee_id as emp_id, employees.first_name, employees.middle_name, employees.last_name, employees.gender');
         $this->db->join('employees', 'employees.employee_id = employee_charge_out_rates.employee_id');
         $results = $this->db->get('employee_charge_out_rates')->result();
     
         $employees_multiselect = array();
         foreach ($results as $result) {
             $employees_multiselect[] = $result;
         }
     
         return $employees_multiselect;
     }
     

    /**
     * Update charge-out rate data for a specific staff ID
     *
     * @param int $employee_id
     * @param array $data
     * @return bool
     */
    public function update_charge_out_rate($employee_id, $data) {
        $this->db->where('employee_id', $employee_id);
        return $this->db->update('employee_charge_out_rates', $data);
    }

    /**
     * Delete charge-out rate data for a specific staff ID
     *
     * @param int $employee_id
     * @return bool
     */
    public function delete_charge_out_rate($employee_id) {
        $this->db->where('employee_id', $employee_id);
        return $this->db->delete('employee_charge_out_rates');
    }
}