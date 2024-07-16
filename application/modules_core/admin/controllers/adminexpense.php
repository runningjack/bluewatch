<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class adminexpense extends MX_Controller
{
    public $crud;
    public $module;

    public function __construct()
    {
        //$this->load->model('guestsmodel');
        $this->load->model('generalmodel');
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
        // $this->load->model('cms');
        $this->load->model('generalmodel');
        /*  $this->load->model('unitmodel');
          $this->load->model('subunitmodel');
          $this->load->model('reportmodel');*/
        $this->load->model('settingsmodel');
        $this->load->model('utitlitymodel');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD();
        $this->load->model('adminexpensemodel');
        ////$this->crud->set_theme('datatables');
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

   
    public function expenselog()
    {
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();
        // var_dump($data['task_status']);exit;

        //send success message to view
        if (isset($_SESSION['success_message'])) {
            $data['sucess_message'] = $_SESSION['success_message'];
        }
        $_SESSION['success_message'] = '';

        //send error message to view
        if (isset($_SESSION['message_error'])) {
            $data['message_error'] = $_SESSION['message_error'];
        }
        $_SESSION['message_error'] = '';
        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users';
        $config['total_rows'] = $this->utitlitymodel->getemployeetimelogcount($_SESSION['login_detal']->employee_id); // $this->db->count_all('users');
        $config['per_page'] = '1000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->adminexpensemodel->getEmployeeExpLogAdmin($config['per_page'], $page, $_SESSION['login_detal']->employee_id);

        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('adminexpenselog', $data);
        $this->load->view('footer');
    }

    public function deleteclaimexpense($id){

    $resp = $this->adminexpensemodel->deladmexpense($id);
    if ($resp) {
      $_SESSION['success_message'] = 'Expense deleted';

    } else {
     $_SESSION['message_error'] = 'Expense could not be deleted. Please try again';

    }
    redirect(base_url('admin/adminexpense/expenselog'));
    }

    public function photo($image, $display = 0)
    {
        //  var_dump(base_url('passport/'.$image));exit;
        // if(getimagesize(base_url('passport/'.$image)))

        if (strpos($image, 'pdf') !== false) {
            $myfilename = base_url('exp_files/pdf.jpg');
            $dmyfilename = "<img  src='$myfilename' "
        .' />';
            echo $dmyfilename;
        } else {
            if (empty($image)) {
                $image = 'default.png';       //if image not found this will display
            }
            $myfilename = base_url('exp_files/'.$image);
            $dir = 'exp_files/'.$image;
            $defaultfilename = base_url('exp_files/default.png'); //var_dump(($myfilename));exit;
            if (file_exists($dir)) {
                $dmyfilename = "<img  style='width:70px;height:80px;' src='$myfilename' "
              .' />';
                if ($display == 1) {
                    $dmyfilename = "<img  src='$myfilename' "
              .' />';
                }
            } else {
                $dmyfilename = "<img style='width:120px;height:120px;' src='$defaultfilename' />";
                if ($display == 1) {
                    $dmyfilename = "<img  src='$defaultfilename' "
              .' />';
                }
            }

            echo $dmyfilename;
        }
    }

    public function editclaimexpense($id)
    {
        $log_id = $id;
        $data['id'] = $id;
        $data['log_details'] = $this->adminexpensemodel->getsinglelog($log_id);
       //var_dump($data['log_details']);exit;

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
      $data['directors'] = $this->settingsmodel->getDirectors();
     
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
      
        if ($_POST) {  
            $config = array(
                'upload_path' => './exp_files/',
                'allowed_types' => 'gif|jpg|png|jpeg|pdf',
                'overwrite' => FALSE,
                'max_size' => '2048', // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'encrypt_name' => TRUE
                );
            //var_dump($_FILES["userfile"]['name']);exit;
            if ($_FILES['userfile']['name'] != '') {
                $new_name = time().$_FILES['userfile']['name'];

                $this->load->library('upload', $config);
            $this->upload->initialize($config);
                if ($this->upload->do_upload('userfile')) {
                    $pass = $this->upload->data();
                    //$data_record = array('upload_data' => $this->upload->data());
                    extract($_POST);
                    $exp_details = array(
                            'file_name' => $pass['file_name'],
                            'exp_cat' => $exp_cat,
                            'exp_line' => $exp_line,
                            'log_date' => $log_date,
                            'fin_year_date' => $_SESSION['finacial_year']->year."-".date('m-d'),
                            'amount' => $amount,
                            "department_id"=>10,
                            'employee_id' => $_SESSION['login_detal']->employee_id,
                            'description' => $desc,
                            'beneficiary' => $beneficiary,
                            'current_date' => date('Y-m-d H:i:s'),
                            'asssigned_director' => $director
                );
                            

                    $log_id = $this->adminexpensemodel->updateExpense($id, $exp_details);
                    if ($log_id) {
                        $this->sendStaffMailMotification($id, $exp_details);
                        $this->session->set_flashdata('sucess_message', 'Expense modified successfully');
                         redirect('admin/adminexpense/expenselog');
                    }else{
                    $data['message_error'] = 'Internal Server Error, Please try again later';
                }
                   
                } else {
                    $data['message_error'] = $this->upload->display_errors();
                }
            } else {
                extract($_POST);
                $exp_details = array(
                    'exp_cat' => $exp_cat,
                    'exp_line' => $exp_line,
                    'log_date' => $log_date,
                    'fin_year_date' => $_SESSION['finacial_year']->year."-".date('m-d'),
                    'amount' => $amount,
                    "department_id"=>10,
                    'employee_id' => $_SESSION['login_detal']->employee_id,
                    'description' => $desc,
                    'beneficiary' => $beneficiary,
                    'current_date' => date('Y-m-d H:i:s'),
                    'asssigned_director' => $director
                );
                $log_id = $this->adminexpensemodel->updateExpense($id, $exp_details);
                if ($log_id) {
                        $this->sendStaffMailMotification($id, $exp_details);
                        $this->session->set_flashdata('sucess_message', 'Expense modified successfully');
                         redirect('admin/adminexpense/expenselog');
                    }else{
                    $data['message_error'] = 'Internal Server Error, Please try again later';
                }
            }
        } 
        $this->load->view('admineditclaimexpense', $data);
            $this->load->view('footer');
    }

     public function genTransactionID()
    {
        
        do {
                $bytes = openssl_random_pseudo_bytes(rand(100,999));
                $hex   = substr(bin2hex($bytes),1,10);
                $response = $this->generalmodel->check_duplicate_trans($hex, 'admin_exp_log');
            } while ($response == TRUE);
           
        return "BCT/EXP/ADM".$hex;
    }

    public function claimexpense()
    {
        $log_id = $id;
        $data['id'] = $id;
        $data['log_details'] = $this->settingsmodel->getsinglelog($log_id);
        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        $data['directors'] = $this->settingsmodel->getDirectors();
        if ($_POST) {
             $config = array(
                'upload_path' => './exp_files/',
                'allowed_types' => 'gif|jpg|png|jpeg|pdf',
                'overwrite' => FALSE,
                'max_size' => '2048', // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'encrypt_name' => TRUE
                );

             if ($_FILES['userfile']['name'] != '') {
            $new_name = time().$_FILES['userfile']['name'];
           

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('userfile')) {
                $pass = $this->upload->data();
                //$data_record = array('upload_data' => $this->upload->data());
                extract($_POST);
                $exp_details = array(
                    'file_name' => $pass['file_name'],
                    'exp_cat' => $exp_cat,
                    'exp_line' => $exp_line,
                    'log_date' => $log_date,
                    'trans_id' => $this->genTransactionID(),
                    'fin_year_date' => $_SESSION['finacial_year']->year."-".date('m-d'),
                    'amount' => $amount,
                    "department_id"=>10,
                    'employee_id' => $_SESSION['login_detal']->employee_id,
                    'current_date' => date('Y-m-d H:i:s'),
                    'asssigned_director' => $director,
                    'description' => $desc,
                    'beneficiary' => $beneficiary

                );
                $log_id = $this->adminexpensemodel->logProjectExpense($exp_details);
                if ($log_id) {
                        $this->sendStaffMailMotification($log_id, $exp_details);
                        $data['sucess_message'] =  'Expense logged successfully';
                         $_POST = array();
                    }else{
                    $data['message_error'] = 'Internal Server Error, Please try again later';
                }
            } else {
                $data['message_error'] = $this->upload->display_errors();
            }

        } else {
             extract($_POST);
                $exp_details = array(
                    'file_name' => 'default.jpg',
                    'exp_cat' => $exp_cat,
                    'exp_line' => $exp_line,
                    'log_date' => $log_date,
                    'trans_id' => $this->genTransactionID(),
                    'fin_year_date' => $_SESSION['finacial_year']->year."-".date('m-d'),
                    'amount' => $amount,
                    "department_id"=>10,
                    'employee_id' => $_SESSION['login_detal']->employee_id,
                    'current_date' => date('Y-m-d H:i:s'),
                    'asssigned_director' => $director,
                    'description' => $desc,
                    'beneficiary' => $beneficiary

                );
                $log_id = $this->adminexpensemodel->logProjectExpense($exp_details);
                if ($log_id) {
                        $this->sendStaffMailMotification($log_id, $exp_details);
                        $data['sucess_message'] =  'Expense logged successfully';
                        $_POST = array();
                    }else{
                    $data['message_error'] = 'Internal Server Error, Please try again later';
                }
        }
        }
         $this->load->view('adminclaimexpense', $data);
            $this->load->view('footer');
    }

    public function expenselogprojmana()
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

        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users';
        $config['total_rows'] = $this->utitlitymodel->getemployeetimelogcount($_SESSION['login_detal']->employee_id); // $this->db->count_all('users');
        $config['per_page'] = '1000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->employee_id);
        $department = $emplyee_details['department'];
        $data['results'] = $this->adminexpensemodel->getHodExpLog($config['per_page'], $page, $department);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('expenseloghodmanager', $data);
        $this->load->view('footer');
    }

    public function expenselogdirector()
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

        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users';
        $config['total_rows'] = $this->utitlitymodel->getemployeetimelogcount($_SESSION['login_detal']->employee_id); // $this->db->count_all('users');
        $config['per_page'] = '5000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->adminexpensemodel->getDirectorAdminExpLog($config['per_page'], $page, $_SESSION['login_detal']->employee_id);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('adminexpenselogdirector', $data);
        $this->load->view('footer');
    }

    public function expenselogfincont()
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

        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users';
        $config['total_rows'] = $this->utitlitymodel->getemployeetimelogcount($_SESSION['login_detal']->employee_id); // $this->db->count_all('users');
        $config['per_page'] = '5000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->adminexpensemodel->getProjExpLog($config['per_page'], $page, $_SESSION['login_detal']->employee_id);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('buaexpenselogfinctr', $data);
        $this->load->view('footer');
    }

    public function dirupdate($id)
    {
        $log_id = $id;
        $data['id'] = $id;
        $data['log_id'] = $id;
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach ($taskStatus as $s) {
            $taskStatus_arr[$s->status_id] = $s->status;
        }
        $data['taskStatus_arr'] = $taskStatus_arr;
        $data['log_details'] = $this->adminexpensemodel->getsinglelog($log_id);
        // var_dump($data['log_details']);exit;

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        $data['directors'] = $this->settingsmodel->getDirectors();
        //var_dump($data['directors']);exit;
        if ($_POST) {
            //$data_record = array('upload_data' => $this->upload->data());
            extract($_POST);
            $exp_details = array(
                                'director_status' => $status,
                                'director_comment' => $comment,
                                'director_update_date' => date('Y-m-d H:i:s'),
                            );
            $log_id = $this->adminexpensemodel->updateExpense($id, $exp_details);
            $this->sendStaffMailMotificationDirector($id, $exp_details);
            redirect('admin/bauexpense/expenselogdirector');
        } else {
            $this->load->view('baudirupdate', $data);
            $this->load->view('footer');
        }
    }

    public function fincontroler($id)
    {
        $log_id = $id;
        $data['id'] = $id;
        $data['log_id'] = $id;
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach ($taskStatus as $s) {
            $taskStatus_arr[$s->status_id] = $s->status;
        }
        $data['taskStatus_arr'] = $taskStatus_arr;
        $data['log_details'] = $this->adminexpensemodel->getsinglelog($log_id);
        // var_dump($data['log_details']);exit;

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        $data['directors'] = $this->settingsmodel->getDirectors();
        //var_dump($data['directors']);exit;
        if ($_POST) {
            //$data_record = array('upload_data' => $this->upload->data());
            extract($_POST);
            $exp_details = array(
                                'account_controller_id' => $_SESSION['login_detal']->employee_id,
                                'account_controller_status' => $status,
                                'account_controller_comment' => $comment,
                                'asssigned_director' => $director,
                                'account_controller_date' => date('Y-m-d H:i:s'),
                            );
            $log_id = $this->adminexpensemodel->updateExpense($id, $exp_details);
            $this->sendStaffMailMotificationFinController($id, $exp_details);
            redirect('admin/bauexpense/expenselogfincont');
        } else {
            $this->load->view('finControllereditbua', $data);
            $this->load->view('footer');
        }
    }

    public function projectfinupdate($id)
    {
        $log_id = $id;
        $data['id'] = $id;
        $data['log_id'] = $id;
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach ($taskStatus as $s) {
            $taskStatus_arr[$s->status_id] = $s->status;
        }
        $data['taskStatus_arr'] = $taskStatus_arr;
        $data['log_details'] = $this->adminexpensemodel->getsinglelog($log_id);
        // var_dump($data['log_details']);exit;

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        $data['directors'] = $this->settingsmodel->getDirectors();
        //var_dump($data['directors']);exit;
        if ($_POST) {
            //$data_record = array('upload_data' => $this->upload->data());
            extract($_POST);
            $exp_details = array(
                                'account_controller_id' => $_SESSION['login_detal']->employee_id,
                                'account_controller_status' => $status,
                                'account_controller_comment' => $comment,
                                'asssigned_director' => $director,
                                'account_controller_date' => date('Y-m-d H:i:s'),
                            );
            $log_id = $this->adminexpensemodel->updateExpense($id, $exp_details);
            $this->sendStaffMailMotificationFinController($id, $exp_details);
            redirect('admin/bauexpense/expenselogfincont');
        } else {
            $this->load->view('finControllereditbuaexpense', $data);
            $this->load->view('footer');
        }
    }

    public function hodmanagerupdate($id)
    {
        // var_dump($id);exit;

        $log_id = $id;
        $data['log_id'] = $log_id;
        $data['id'] = $id;
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $data['log_details'] = $this->adminexpensemodel->getsinglelog($log_id);
        // var_dump($data['log_details']);exit;

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();

        if ($_POST) {
            //$data_record = array('upload_data' => $this->upload->data());
            extract($_POST);
            $exp_details = array( 
                                'director_status' => $status,
                                'director_comment' => $comment,
                                'director_update_date' => date('Y-m-d H:i:s'),
                            );
          
            $log_id = $this->adminexpensemodel->updateExpense($id, $exp_details);
            
             if ($log_id) {
                $this->session->set_flashdata('sucess_message', 'Expense modified successfully');
                      $this->sendStaffMailMotificationdirector($id, $exp_details);
            redirect('admin/adminexpense/expenselogdirector');
                    }else{
                    $data['message_error'] = 'Internal Server Error, Please try again later';
                }
        } 
            $this->load->view('dirEditclaimexpense', $data);
            $this->load->view('footer');
      
    }

    public function sendStaffMailMotificationDirector($log_id, $data_details)
    {
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach ($taskStatus as $s) {
            $taskStatus_arr[$s->status_id] = $s->status;
        }
        //var_dump($taskStatus);exit;
        $log_details = $this->adminexpensemodel->getsinglelog($log_id);
        extract($log_details);
        extract($data_details);
        // var_dump($log_details);exit;

        //send maile to project manager
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($asssigned_director);
        //var_dump($emplyee_details);exit;
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_acc = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        $subject = 'Update Notification';
        $body = 'Your Update on request ('.$trans_id.') was successful.The finacial controller will be notify for neccessary action.';
        $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);
        //contruct status

        $pro_name = '<p><strong>Transaction ID</strong>:'.$trans_id.'</p><p><strong>Director Name</strong>:'.$employee_fullname.'</p>';
        $pro_status = '<p><strong>Director Status</strong>:'.$taskStatus_arr[$director_status].'</p>';
        $pro_comment = '<p><strong>Director Comment</strong>:'.$director_comment.'</p>';
        $pro_amount = '<p><strong>Amount</strong>:'.number_format($amount, 2).'</p>';
        if ($director_status == 1) {
            $pro_code = '<p><strong>Approval Code</strong>: ADMINPP'.$log_id.'</p>';
        } else {
            $pro_code = '';
        }

        $full_details = $pro_name.$pro_status.$pro_comment.$pro_amount.$pro_code;

        $loger_details = $this->settingsmodel->getEmployeeDetails($employee_id);
        $loger_fullname = $loger_details['first_name'].' '.$loger_details['last_name'];

        //send mail to employee that logged the details
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($employee_id);
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_useable = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        $body = $employee_fullname_acc.' just update expense request status you sent to him.<br>
        Below is the full details '.$full_details.'<br/> You can use the link below to view status<br/>
        <a href="'.base_url('admin/adminexpense/status/'.$log_id).'"> Update Status </a>';
        $subject = $loger_fullname.'request log update.';
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $employee_email);


        //send mail to financial controller/hr
        $finController = $this->settingsmodel->getFinControllerDetails();
        $body = $employee_fullname_acc.' just update expense request by '.$employee_fullname.'.<br>
            Below is the full details '.$full_details.'<br/> You can use the link below to approve/reject the request<br/>'.base_url('admin/bauexpense/fincontroler/'.$log_id);
        $subject = 'Admin expense request log update';

        foreach ($finController as $t) {
            $recipiant_name = $t->first_name.' '.$t->last_name;
            $to = $t->work_email;
            // var_dump($t);exit;
            $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
        }
    }

    public function sendStaffMailMotificationFinController($log_id, $data_details)
    {
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach ($taskStatus as $s) {
            $taskStatus_arr[$s->status_id] = $s->status;
        }
        //var_dump($taskStatus);exit;
        $log_details = $this->adminexpensemodel->getsinglelog($log_id);
        extract($log_details);
        extract($data_details);
        // var_dump($log_details);exit;

        //send maile to project manager
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($account_controller_id);
        //var_dump($emplyee_details);exit;
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_acc = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        $subject = 'Approval Notification Notification';
        $body = 'Your approval/rejection Update was successful.
         <br/> You can use the link below to track the progress<br/><a href="'.base_url('admin/bauexpense/status/'.$log_id).'"> View Log Status</>';
        $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);
        //contruct status
        $details_cat = '<p><strong>Expense Category </strong>:'.$expense_category_name.'</p>';
        $details_line = '<p><strong>Expense Category </strong>:'.$expense_line_name.'</p>';
        $details_amt = '<p><strong>Requested Amount </strong>:'.number_format($amount, 2).'</p>';
        $pro_name = '<p><strong>Forward by </strong>:'.$employee_fullname.'</p>';
        $pro_status = '<p><strong> Status</strong> :'.$taskStatus_arr[$account_controller_status].'</p>';
        $pro_comment = '<p><strong>Comment </strong> :'.$account_controller_comment.'</p>';
        $full_details = $details_cat.$details_line.$details_amt.$pro_name.$pro_status.$pro_comment;

        //send mail to employee that logged the details
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($employee_id);
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_useable = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        $body = $employee_fullname_acc.' just update your expense request status <br>
        Below is the full details '.$full_details.'<br/> You can use the link below to view status<br/>'.base_url('admin/bauexpense/status/'.$log_id);
        $subject = $employee_fullname_useable.' update your expense request log.';
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $employee_email);

        //send mail to Director

        $emplyee_details = $this->settingsmodel->getEmployeeDetails($asssigned_director);
        //var_dump($emplyee_details);exit;
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;

        $body = $employee_fullname_acc.' just forward expense request of '.$employee_fullname_useable.' for approval.<br>
        Below is the full details '.$full_details.'<br/> You can use the link below to approve/reject the request<br/><a href="'.base_url('admin/bauexpense/dirupdate/'.$log_id).'">Approve/Reject Request</a>';
        $subject = $employee_fullname_useable.' expense request approval';
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $employee_email);
    }

    public function sendStaffMailMotificationHod($log_id, $data_details)
    {
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach ($taskStatus as $s) {
            $taskStatus_arr[$s->status_id] = $s->status;
        }
        //var_dump($taskStatus);exit;
        $log_details = $this->adminexpensemodel->getsinglelog($log_id);
        extract($log_details);

        extract($data_details);
        //send maile to project manager
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($hod_id);
        //var_dump($emplyee_details);exit;
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_useable = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        $subject = 'Approval Notification Notification';
        $body = 'Your approval/rejection Update was successful.
             <br/> You can use the link below to track the progress<br/><a href="'.base_url('admin/projectexpense/status/'.$log_id).'"> View Log Status</>';
        $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);
        //contruct status
        $details_cat = '<p><strong>Expense Category </strong>:'.$expense_category_name.'</p>';
        $details_line = '<p><strong>Expense Category </strong>:'.$expense_line_name.'</p>';
        $details_amt = '<p><strong>Requested Amount </strong>:'.number_format($amount, 2).'</p>';
        $pro_name = '<p><strong>HOD Name </strong>:'.$employee_fullname.'</p>';
        $pro_status = '<p><strong>HOD Status</strong> :'.$taskStatus_arr[$hod_status].'</p>';
        $pro_comment = '<p><strong>HOD Comment</strong> :'.$hod_comment.'</p>';
        $full_details = $details_cat.$details_line.$details_amt.$pro_name.$pro_status.$pro_comment;

        //send mail to employee that logged the details
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($employee_id);
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        // $employee_fullname_useable = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        $body = $employee_fullname_useable.' just update your expense request status <br>
            Below is the full details '.$full_details.'<br/> You can use the link below to view status<br/>'.base_url('admin/bauexpense/status/'.$log_id);
        $subject = $employee_fullname_useable.' update your expense request log.';
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $employee_email);

        //send mail to financial controller/hr
        $finController = $this->settingsmodel->getFinControllerDetails();
        $body = $employee_fullname_useable.' just update expense request of '.$employee_fullname.'.<br>
            Below is the full details '.$full_details.'<br/> You can use the link below to approve/reject the request<br/>'.base_url('admin/bauexpense/fincontroler/'.$log_id);
        $subject = $employee_fullname.' expense request log update';

        foreach ($finController as $t) {
            $recipiant_name = $t->first_name.' '.$t->last_name;
            $to = $t->work_email;
            // var_dump($t);exit;
            $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
        }
    }

    public function status($id)
    {
        $log_id = $id;
        $data['id'] = $id;
        $data['stat'] = 'adm';
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $data['log_details'] = $this->adminexpensemodel->getsinglelog($log_id);
        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach ($taskStatus as $s) {
            $taskStatus_arr[$s->status_id] = $s->status;
        }
        $data['taskStatus_arr'] = $taskStatus_arr;
        $this->load->view('expStatus', $data);
        $this->load->view('footer');
    }

    public function sendStaffMailMotification($log_id, $data_details)
    {
        extract($data_details);
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->employee_id);
        $department = $emplyee_details['department'];

        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_useable = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        $subject = 'Payment Claim Notification';
        $body = 'Your payment request was successfully logged and waiting for approval from your Director, You will be updated once he approved.<br>'
                 .'Transaction ID : '.$trans_id.' <br>'
                 .'Description : '.$desc.' <br>'
                 .'Beneficiary : '.$beneficiary.' <br>'
                
            .'<br/> You can use the link below to track the progress<br/><a href="'.base_url('admin/adminexpense/status/'.$log_id).'"> View Status</a>';
        $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);
        $expense = $this->adminexpensemodel->getexpenseline($exp_line);

       // $hod = $this->adminexpensemodel->getHod($department);
        $details_cat = '<p>Transaction ID :'.$trans_id.'</p><p>Expense Category :'.$expense['expense_category_name'].'</p>';
        $details_line = '<p>Expense Category :'.$expense['expense_line_name'].'</p>';
        $details_amt = '<p>Requested Amount :'.number_format($amount, 2).'</p>';
        $full_details = $details_cat.$details_line.$details_amt;
         

        $director_details = $this->settingsmodel->getEmployeeDetails($asssigned_director);
         

        $dir_fullname = $director_details['first_name'].' '.$director_details['last_name'];
        $dir_email = $director_details['work_email'];

        $body = $employee_fullname_useable.' Just logged an Admin expense request. Please note that this is waiting for your approval.<br>'.
            'Description : '.$desc.' <br>'
            .'Beneficiary : '.$beneficiary.' <br>'.
            'Below is the request details'.$full_details.'<br/> You can use the link below to approve/reject the request<br/>
            <a href="'.base_url('admin/adminexpense/hodmanagerupdate/'.$log_id).'"> Approve/Disapprove</a>';
        $subject = 'Administrative expense request log';

        $this->sendTeamLeadTimeLogMail($subject, $dir_fullname, $body, $dir_email);

        $finController = $this->settingsmodel->getFinControllerDetails();
        $body = $employee_fullname_useable.' just logged expense request on  '.$dir_fullname.'.<br>'.
        'Description : '.$desc.' <br>'
        .'Beneficiary : '.$beneficiary.' <br>'.
            'Below is the full details '.$full_details.'<br/> You can use the link below to monitor the status.<br/><a href="'.base_url('admin/adminexpense/status/'.$log_id).'"> View Status</a>';
        $subject = $employee_fullname.' expense request log update';
        
        foreach ($finController as $t) {
            $recipiant_name = $t->first_name.' '.$t->last_name;
            $to = $t->work_email;
            // var_dump($t);exit;
            $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
        }

    }

    public function sendTeamLeadTimeLogMail($mail_title, $recipiant_name, $body, $to)
    {
        $body = '<html>
    <head>
        <title>Bluechip Technology</title>
    </head>
    <body>
<table style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px; color:#757575; width:600px; background-color:#fff; margin:0" bgcolor="#fff">
	<tbody>
		<tr>
            <td valign="top"></td>
            <td width="600" valign="top">
                <div style="max-width:600px;display:block;margin:0 auto;padding:20px">
                    <table style="background-color:#f5f2f5; margin:0" width="598px" cellspacing="0" cellpadding="0" bgcolor="#F5F2F5">
                        <tbody>
							<tr style="margin:0">
								<td style="text-align:right;padding-right:15px;padding-top:20px">
									<img src="http://bluechiptech.biz/wp-content/uploads/2019/03/bluechip-light-1.png"  >
								</td>
							</tr>
							<tr>
								<td valign="top" style="padding:20px">
									<table width="550px" cellspacing="0" cellpadding="0">
										<tbody>
											<tr >
												<td style="font-weight:bold;color:black; font-size:20px;line-height:18px;vertical-align:top;margin:0;padding:0 0 20px" valign="top">
                                                '.$mail_title.'
												</td>
											</tr>
											<tr style="background-color:#fff;">
												<td style="color:#000; padding:20px" valign="top">
													<table>
														<tbody>
															<tr>
																<td>
																	Dear '.$recipiant_name.',
																</td>
															</tr>
															<tr>
																<td style="padding:10px 0; font-size:14px;">
                                                                '.$body.' 
																</td>
															</tr>

														</tbody>
													</table>
													 
													<br />
													If you need to know more, send an email to 
													<span style="color:#ab0b4b">support@bluechtech.biz</span>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
                        </tbody>
					</table>
				</div>
			</td>
		</tr>
    </tbody>
</table>
	</body>
</html>';

        $this->load->helper('mymail');
        Mailfunction1($to, $mail_title, $body);
    }

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
