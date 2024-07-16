<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Manageemployee extends MX_Controller
{
    public $crud;
    public $module;

    public function __construct()
    {
        $this->load->model('generalmodel');
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
        $this->load->model('generalmodel');
        $this->load->model('settingsmodel');
        $this->load->model('utitlitymodel');
        $this->load->model('Employee_charge_out_rate_model');
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->library('csvimport');
        $this->crud = new grocery_CRUD();
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
    }

    public function _example_output($output = null)
    {
        $this->load->view('example.php', (array) $output);
    }

    public function offices()
    {
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    public function index()
    {
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();

        //send success message to view
        if (isset($_SESSION['sucess_message'])) {
            $data['sucess_message'] = $_SESSION['sucess_message'];
        }
        $_SESSION['sucess_message'] = '';

        //send error message to view
        if (isset($_SESSION['message_error'])) {
            $data['message_error'] = $_SESSION['message_error'];
        }
        $_SESSION['message_error'] = '';
        // var_dump($_SESSION['login_detal']);exit;
        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users';
        $config['total_rows'] = $this->db->count_all('employees'); // $this->db->count_all('users');
        $config['per_page'] = '1000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->settingsmodel->getAllEmployee();

        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('employeeindex', $data);
        $this->load->view('footer');
    }
    
    public function upload()
    {
       $csv = array();

        // check there are no errors
        if($_FILES['csv']['error'] == 0){
            $name = $_FILES['csv']['name'];
            $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
            $type = $_FILES['csv']['type'];
            $tmpName = $_FILES['csv']['tmp_name'];

            // check the file is a csv
            if($ext === 'csv'){
                if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                    // necessary if a large csv file
                    set_time_limit(0);

                    $row = 0;

                    while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                        // number of fields in the csv
                        $sn = (int)$data[0];
                        if($sn > 0){
                        $col_count = count($data);
                        $name = $data[1];
                        $email = $data[2];
                        $employee_rate = $data[3];
                        
                        $details = $this->settingsmodel->getEmployeeByEmail($email);
                        $id = $details[0]->id;  
                    //  var_dump($id );exit;               
                        
                    $details = array("employee_id"=>$id,"employee_rate"=>$employee_rate,"updated_by"=>$_SESSION['login_detal']->id);
                    $this->settingsmodel->insertEmployeeRate($details,$id); 
                        
                        }
        
                    }
                    fclose($handle);
                    redirect('admin/manageemployee/');
                }
            }
            
        }
    }

    public function updaterate($id)
    {
        $data['id'] = $id;
        $data['employ_details'] = $this->settingsmodel->getSingleEmployee($id);

        if($_POST){
            extract($_POST);
            $details = array("employee_id"=>$id,"employee_rate"=>$employee_rate,"updated_by"=>$_SESSION['login_detal']->id);
            $this->settingsmodel->insertEmployeeRate($details,$id); 
            redirect('admin/manageemployee/index');  
        }

        $this->load->view('header');
        $this->load->view('updaterate', $data);
        $this->load->view('footer');
    }


    public function chargeoutrateindex(){

        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();

        //send success message to view
        if (isset($_SESSION['sucess_message'])) {
            $data['sucess_message'] = $_SESSION['sucess_message'];
        }
        $_SESSION['sucess_message'] = '';

        //send error message to view
        if (isset($_SESSION['message_error'])) {
            $data['message_error'] = $_SESSION['message_error'];
        }
        $_SESSION['message_error'] = '';
        // var_dump($_SESSION['login_detal']);exit;
        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users';
        $config['total_rows'] = $this->db->count_all('employees'); // $this->db->count_all('users');
        $config['per_page'] = '1000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->settingsmodel->getAllEmployee();

        $data['links'] = $this->pagination->create_links();

        $data['charge_out_rates'] = $this->Employee_charge_out_rate_model->get_all_employee_charge_out_rates();
        $this->load->view('header');
        $this->load->view('admin/employee/chargeoutrateindex', $data);
        $this->load->view('footer');
    }

    public function chargeoutrate($id= null) {
        $data = [];
        $id = $this->input->get('id');    
        $data['id'] = $id;
       
        $data['employ_details'] = $this->Employee_charge_out_rate_model->get_charge_out_rate_by_employee_id($id);
   
        $this->load->view('header');
        $this->load->view('admin/employee/updatechargeoutrate', $data);
        $this->load->view('footer');
    }
    


    public function postchargeoutrate() {
        $data=[];
        $this->form_validation->set_rules('employee_id', 'Employee ID', 'required');
        $this->form_validation->set_rules('charge_out_rate', 'Charge Out Rate', 'required|numeric');
        $employee_id = $this->input->post('employee_id');
        if ($this->form_validation->run() == FALSE) {
            $data['error_message'] = validation_errors();
            redirect('admin/employee/chargeoutrate?id='. $employee_id,$data );
        } else {
            
            $charge_out_rate = $this->input->post('charge_out_rate');
    
            $data = array(
                'employee_id' => $employee_id,
                'charge_out_rate' => $charge_out_rate,
                'updated_by' => 'admin', // Assuming 'admin' is the current user. Replace as needed.
                'updated_at' => date('Y-m-d H:i:s')
            );
    
            try {
                // Check if the employee_id already exists in the table
                $existing_entry = $this->Employee_charge_out_rate_model->get_charge_out_rate_by_employee_id($employee_id);
    
                if ($existing_entry) {
                    // Update the existing record
                    $this->Employee_charge_out_rate_model->update_charge_out_rate($employee_id, $data);
                    $data['success_message'] = "Charge out rate updated successfully.";
                } else {
                    // Insert a new record
                    $data['created_by'] = 'admin'; // Assuming 'admin' is the current user. Replace as needed.
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $this->Employee_charge_out_rate_model->insert_charge_out_rate($data);
                    $data['success_message'] = "Charge out rate added successfully.";
                }
    
                redirect('admin/manageemployee/chargeoutrateindex',$data);
            } catch (Exception $e) {
                $_SESSION['error_message'] = "An error occurred: " . $e->getMessage();
                redirect('admin/manageemployee/chargeoutrate?id='.$employee_id,$data);
            }
        }
    }
    
    
    public function uploadchargeoutrate() {
        try {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = 1000;
            $data = [];
            $this->upload->initialize($config);
    
            if (!$this->upload->do_upload('csv')) {
                $error_message = $this->upload->display_errors();
                throw new Exception($error_message);
            } else {
                $file_data = $this->upload->data();
                $file_path = './uploads/'.$file_data['file_name'];
    
                if ($this->csvimport->get_array($file_path)) {
                    $csv_array = $this->csvimport->get_array($file_path);

                    
    
                    $insert_data = [];
                    $update_data = [];
                    foreach ($csv_array as $row) {
                        $employee = $this->settingsmodel->getEmployeeByEmailSingle($row['email']);
                        if (!$employee) {
                            throw new Exception('Employee not found: ' . $row['email']);
                        }
                        $existing_entry = $this->Employee_charge_out_rate_model->get_charge_out_rate_by_employee_id($employee->employee_id);
                       
                        $data = array(
                            'employee_id' => $employee->employee_id,
                            'charge_out_rate' => $row['charge_out_rate'],
                            'created_by' => 'admin',
                            'updated_by' => 'admin'
                        );
                        
                        
    
                        if ($existing_entry) {
                            $data['id'] = $existing_entry->id;
                            $data['updated_at'] = date('Y-m-d H:i:s');
                            $update_data[] = $data;
                        } else {
                            $insert_data[] = $data;
                        }
                    }
    
                    if (!empty($insert_data)) {
                        $this->Employee_charge_out_rate_model->insert_batch($insert_data);
                    }
    
                    if (!empty($update_data)) {
                        $this->Employee_charge_out_rate_model->update_batch($update_data, 'id');
                    }
    
                    $_SESSION['success_message'] = "File successfully uploaded";
                        $data['success_message'] = $_SESSION['success_message'];
                    redirect('admin/manageemployee/chargeoutrateindex', $data);
                } else {
                    throw new Exception('Error occurred while processing the file.');
                }
            }
        } catch (Exception $e) {
            $data['error_message'] = $e->getMessage();
            $this->load->view('header');
            $this->load->view('employee/chargeoutrateindex', $data);
            $this->load->view('footer');
        }
    }

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
