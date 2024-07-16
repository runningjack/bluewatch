<?php

/**
 * Description of Users.
 *
 * @author Gbadeyanka Abass
 */
class Users extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('usersmodel');
        $this->load->model('role');
        $this->load->model('Menu');
        $this->load->model('departmentmodel');
        //    $this->load->model('academycoursesmodel');
        //    $this->load->model('facultymodel');
        //    $this->load->model('levelmodel');
        //     $this->load->model('semestermodel');
        //      $this->load->model('studentmodel');
        $this->load->model('generalmodel');
        //      $this->load->model('courseoptionmodel');
        //       $this->load->model('programmemodel');
        $this->load->model('settingsmodel');
    }

    public function index()
    {
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
        $config['total_rows'] = $this->db->count_all('users');
        $config['per_page'] = '50';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->usersmodel->getallUsers($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('user_index', $data);
        $this->load->view('footer');
    }

    public function edit($id = 0)
    {
        $this->form_validation->set_rules('username', 'username', 'required|xss_clean');
        $this->form_validation->set_rules('group', 'group', 'required|xss_clean');
        $this->form_validation->set_rules('department_id', 'department_id', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

        $data['group'] = $this->usersmodel->getallGroup();
        $data['department'] = $this->departmentmodel->getAllDepartment();
    //    $data['prog'] = $this->programmemodel->fetchallprogramme();
        $data['modules'] = $this->role->fetchAllModule();
        $data['employeelist'] = $this->settingsmodel->employee_list();

        if (isset($id)) {
            $user_details = $this->usersmodel->getSingleUser($id);
            $data['id'] = $id; 
            //print_r($user_details);exit;
            $data['user_details'] = $user_details;

            if (!isset($user_details['fac_id'])) {
                $user_details['fac_id'] = 0;
            }
          //  $dept = $this->departmentmodel->getalldepartmentbyfaculty($user_details['fac_id']);
           // $data['dept'] = $dept;
        // var_dump($user_details);exit;
        } else {
            $data['message_error'] = 'Invalid User';
            // exit;
        }
        if (empty($user_details)) {
            $data['message_error'] = 'The full details of this User could not be retrieved';
            // exit;
        }

        if ($this->form_validation->run() == true) {
            $pass = $this->input->post('password');

            if ($this->input->post('password') != $this->input->post('confirmpassword')) {
                $data['message_error'] = 'The Password does not match';

                //send error message to the index through session variable cos of redirection
                $_SESSION['message_error'] = $data['message_error'];

                redirect(base_url().'admin/users/');
            }

            $data = array('username' => $this->input->post('username'),
                            'password' => md5($pass),
                            'group_id' => $this->input->post('group'),
                            'prog_id' => $this->input->post('programme_id'),
                            'fac_id' => $this->input->post('faculty_id'),
                            'dept_id' => $this->input->post('department_id'),
                            'employee_id' => $this->input->post('employee_id') );
            //check for uniqueness

            //  exit();

            $this->usersmodel->update_user($id, $data);

            $_SESSION['sucess_message'] = 'User Successfully Updated.';

            redirect(base_url().'admin/users');
        } else {
            if (!isset($user_details['username'])) {
                $user_details['username'] = '';
            }
            if (!isset($user_details['password'])) {
                $user_details['password'] = '';
            }

            $data['form_username'] = array(
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'readonly' => 'readonly',
                'required class' => 'form-control',
                            'value' => $this->form_validation->set_value('username', $user_details['username']),
                );
            $data['form_password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'required class' => 'form-control',
                             'class' => 'form-control parsley-validated',
                            'value' => $this->form_validation->set_value('password', $user_details['password']),
                );
            $data['form_confirmpassword'] = array(
                'name' => 'confirmpassword',
                'id' => 'confirmpassword',
                'type' => 'password',
                'required class' => 'form-control',
                            'parsley-equalto' => '#password',
                             'class' => 'form-control parsley-validated',
                            'value' => $this->form_validation->set_value('password', $user_details['password']),
                );
             $rolr_obj = new Role();
            $data['modules'] = $rolr_obj->viewRole();
        }

        $this->load->view('header');
        $this->load->view('user_edit', $data);
        $this->load->view('footer');
    }

    public function delete($id = 0)
    {
        $comand = '';

        if ($_POST) {
            $id = $_POST['id']; //echo $amenity_id;exit;
            $comand = $_POST['del'];
 $this->usersmodel->delete_user($id);
            if ($comand == 'Yes') {
                $this->usersmodel->delete_user($id);
                $_SESSION['sucess_message'] = 'User Successfully Deleted.';

                redirect(base_url().'admin/users/index');
            } else {
                redirect(base_url().'admin/users/index');
            }
        }
        if (isset($id)) {
            $users_details = $this->usersmodel->getSingleUser($id);
            $data['id'] = $id;

        //var_dump();exit;
        } else {
            $data['message_error'] = 'Invalid User ';
            // exit;
        }
        if (empty($users_details)) {
            $data['message_error'] = 'The details of this User could not be retrieved';
            // exit;
        }
        if (!isset($users_details)) {
            $users_details['username'] = '';
        }

        $data['name'] = $users_details['username'];

        $this->load->view('header', $data);
        $this->load->view('user_delete', $data);
        $this->load->view('footer');
    }

    public function adduser()
    {
        $this->form_validation->set_rules('username', 'username', 'required|xss_clean');
        $this->form_validation->set_rules('group', 'group', 'required|xss_clean');
        $this->form_validation->set_rules('department_id', 'department_id', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

        $data['group'] = $this->usersmodel->getallGroup();
        $data['department'] = $this->departmentmodel->getAllDepartment();
        //$data['department'] = $this->programmemodel->fetchallprogramme();
        $data['modules'] = $this->role->fetchAllModule();
        $data['employeelist'] = $this->settingsmodel->employee_list();
        //var_dump($data['employeelist']);exit;

        if ($this->form_validation->run() == true) {
            $pass = $this->input->post('password');

            if ($this->input->post('password') != $this->input->post('confirmpassword')) {
                $data['message_error'] = 'The Password does not match';

                //send error message to the index through session variable cos of redirection
                $_SESSION['message_error'] = $data['message_error'];

                redirect(base_url().'admin/users/');
            }

            $data = array('username' => $this->input->post('username'),
                            'password' => md5($pass),
                            'group_id' => $this->input->post('group'),
                            'employee_id' => $this->input->post('employee_id'),
                            'prog_id' => $this->input->post('programme_id'),
                            'fac_id' => $this->input->post('faculty_id'),
                            'dept_id' => $this->input->post('department_id'), );
            //check for uniqueness

            $status = $this->usersmodel->uniqueUser($this->input->post('username'));
            //var_dump($status);

            if (!$status) {
                $data['message_error'] = 'The User you are trying to add already exit';

                //send error message to the index through session variable cos of redirection
                $_SESSION['message_error'] = $data['message_error'];

                redirect(base_url().'admin/users/');
            }

            $this->usersmodel->insert_user($data);

            $_SESSION['sucess_message'] = 'User Successfully Added.';

            redirect(base_url().'admin/users');
        } else {
            $data['form_username'] = array(
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'readonly' => 'readonly',
                'required class' => 'form-control',
                );
            $data['form_password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'required class' => 'form-control',
                             'class' => 'form-control parsley-validated',
                );
            $data['form_confirmpassword'] = array(
                'name' => 'confirmpassword',
                'id' => 'confirmpassword',
                'type' => 'password',
                'required class' => 'form-control',
                            'parsley-equalto' => '#password',
                             'class' => 'form-control parsley-validated',
                );
$rolr_obj = new Role();
            $data['modules'] = $rolr_obj->viewRole();
        }

        $this->load->view('header');
        $this->load->view('adduser', $data);
        $this->load->view('footer');
    }

    public function changepassword()
    {
        $this->form_validation->set_rules('old', 'old', 'required|xss_clean');
        $this->form_validation->set_rules('confirmpassword', 'confirmpassword', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
        if ($this->form_validation->run() == true) {
            $pass = $this->input->post('password');
            $old = $this->input->post('old');
            $user_id = ($_SESSION['login_detal']->id);

            if ($this->input->post('password') != $this->input->post('confirmpassword')) {
                $data['message_error'] = 'The Password does not match';
                //send error message to the index through session variable cos of redirection
                $_SESSION['message_error'] = $data['message_error'];
                redirect(base_url().'admin/users/changepassword?message='.$data['message_error']);
            }

            $data = array('password' => md5($pass));
            //check for uniqueness
            $update = $this->usersmodel->update_password($data, $user_id, $old);
            // var_dump($update);exit;
            if ($update <= 0) {
                redirect(base_url().'admin/users/changepassword?message=Invalid access');
            }
            $_SESSION['sucess_message'] = 'Password Changed.';
            redirect(base_url().'admin/users/changepassword?sucess=Password Changed');
        } else {
            $data['form_old'] = array(
                          'name' => 'old',
                          'id' => 'old',
                          'type' => 'password',
                          'required class' => 'form-control',
                          );
            $data['form_password'] = array(
                          'name' => 'password',
                          'id' => 'password',
                          'type' => 'password',
                          'required class' => 'form-control',
                               'class' => 'form-control parsley-validated',
                          );
            $data['form_confirmpassword'] = array(
                          'name' => 'confirmpassword',
                          'id' => 'confirmpassword',
                          'type' => 'password',
                          'required class' => 'form-control',
                              'parsley-equalto' => '#password',
                               'class' => 'form-control parsley-validated',
                          );

            $data['modules'] = (new Role)->viewRole();
        }

        $this->load->view('header');
        $this->load->view('change_password', $data);
        $this->load->view('footer');
    }

    public function getUsername()
    {
        $username = '';
        $status = false;
         if ($_POST) {
            $resp = $this->usersmodel->getUsername($_POST['id']);
        if ($resp) {
            $status = true;
          $username = $resp->work_email;
        }
        echo json_encode(
              array(
                'status' => $resp,
                'username' => $username
              )
            );
    }
    }
}
