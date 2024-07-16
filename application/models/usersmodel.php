<?php
/**
 * Description of amenity.
 *
 * @author Gbadeyanka Abass
 */
class usersModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    public function getallUsers($limit, $start)
    {
        $this->db = $this->load->database('default', true);
        $this->db->select('employees.first_name');
        $this->db->select('employees.last_name');
        $this->db->select('employees.middle_name');
        $this->db->select('users.*');
        $this->db->select('group_table.*');
        $this->db->select('companystructures.title');
        $this->db->select('employees.id as employee_index');
        $this->db->join('group_table', 'group_table.group_id = users.group_id', 'left');
        $this->db->join('employees', 'employees.id = users.employee_id', 'left');
        $this->db->join('companystructures', 'companystructures.id = users.dept_id', 'left');
        $this->db->from('users');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getallGroup()
    {
        $this->db->select('*');
        $this->db->from('group_table');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function insert_user($data)
    {
        $this->db->insert('users', $data);
        $id = $this->db->insert_id();

        return (isset($id)) ? $id : false;
    }

    public function update_user($id, $data)
    {  //var_dump($id, $data);exit;
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }

    public function uniqueUser($username)
    {
        $this->db = $this->load->database('default', true);
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        return (isset($id)) ? false : true;
    }

    public function getSingleUser($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('users');

        return $query->row_array();
    }

    public function getUsername($id)
    {
        $this->db->select('work_email');
        $this->db->where('status !=', 'Terminated');
        $this->db->where('id', $id);
        $query = $this->db->get('employees');
        return $query->row();
    }

    public function update_password($data, $user_id, $old)
    {
        //var_dump($_SESSION);EXIT;

        $this->db->select('*');
        $this->db->where('id', $user_id);
        $this->db->where('password', md5($old));
        $query = $this->db->get('users');
        $output_data['exitence'] = $query->row_array();

        if (count($output_data['exitence']) < 1) {
            return 0;
        }

        $this->db->where('id', $user_id);
        $this->db->where('password', md5($old));
        $output_data['update'] = $this->db->update('users', $data);

        return $output_data;
    }
}
