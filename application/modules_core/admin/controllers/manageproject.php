<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Manageproject extends MX_Controller
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
        $this->load->model('departmentmodel');
        $this->load->model('generalmodel');
        /*  $this->load->model('unitmodel');*/
          $this->load->model('buaexpensemodel');
          $this->load->model('utitlitymodel');
        $this->load->model('settingsmodel');

        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
    }

    public function update_role($project_role,$project_id,$employee)
    {
          $data =  array("project_role_id"=>$project_role);
          $this->settingsmodel->update_project_role($data,$project_id,$employee);
          redirect(base_url("admin/manageproject/manageprojectteam/".$project_id.'?success=Project role assign successfully'));


    }

    public function removeTeamMember($employee_id,$project_id)
    {

        $project_role_exit = $this->settingsmodel->GetProjectRoleSingle($project_id,$employee_id);
      
        unset($project_role_exit->id);
        $this->settingsmodel->deleted_project_tasks($project_role_exit);
        $this->settingsmodel->delete_tasks_by_user($project_id,$employee_id);
        redirect(base_url("admin/manageproject/manageprojectteam/".$project_id.'?success=Resources is removed successfully'));

        // var_dump($project_role_exit);

    }
    public function loadRoleByDepartment()
    {
     //   var_dump($_GET);
      // $employee_details =  $this->settingsmodel->getEmployeeDetails($_POST['employee_id']);
      $projectRoles = $this->settingsmodel->getProjectRoles();
      echo form_dropdown('employee_id', $projectRoles,'','required="" class=" select2" id="employee_id"'); 
        

    }

    public function saveProjectRole()
    {
        extract($_POST); 
        $project_role_exit = $this->settingsmodel->GetProjectRole($project_id,$employee_id);
//send mail
        $emplyee_details = $this->settingsmodel->getEmployeeDetails((int)$employee_id);
        $department = $emplyee_details['department'];

        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_useable = $employee_fullname;
        // $employee_email = 'tumininuogunsola@yahoo.com';
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        $project_team_details = $this->settingsmodel->getProjectDetails($_POST['project_id']);
        //$project_details = $this->settingsmodel->getProjectManagerDetails($project_id);
        // $data['results'] = $this->utitlitymodel->getProjectManagerproject($project_id);
        // var_dump($$project_details);exit;

        $subject = 'Project Team Member Notification';
        $body = 'You have been added as a Team Member to <strong>'.$project_team_details["team_name"] .'</strong> Project
            <br/> Kindly contact your Project Manager '.$project_manager_fullname. ' and Team Lead '. $team_lead_fullname. ' for more information';
           // var_dump($body);exit;
        $this->sendTeamNotificationMail($subject, $employee_fullname, $body, $employee_email);
        $this->sendWorkOrder($project_id);

        if($project_role_exit)
        {

            $this->session->set_flashdata('success', "Resources is already in the project list");
            redirect(base_url("admin/manageproject/manageprojectteam/".$project_id.'?error=Resources is already in the project list'));

        }else{ 
            $data = array("project_id"=>$project_id, 
                       "assigned_to"=>$employee_id, 
                       "project_role_id"=>$project_role_id );
                  
                       $this->settingsmodel->insert_project_tasks($data);
                       $this->session->set_flashdata('success', "Resources is added to project successfully");
                       redirect(base_url("admin/manageproject/manageprojectteam/".$project_id.'?success=Resources is added to project successfully'));

        }    
        
    }

    public function sendWorkOrder($project_id)
    {
        $project_resource_role = $this->settingsmodel->GetProjectResource($project_id);
        $allpartment = $this->departmentmodel->getAllDepartment();
        $project_team_details = $this->settingsmodel->getProjectDetails($project_id);
        $project_name = $project_team_details['name'];
        $data['project_name'] = $project_name;
        $project_manager = $this->settingsmodel->getEmployeeDetails(  $project_team_details['team_project_manager']);
        $data['project_manager_fullname'] = $project_manager['first_name'].' '.$project_manager['last_name'];

        foreach($allpartment as $dept)
        {
            
            $current_department = $dept->title;
            $data['current_department'] = $current_department;
            $resource_by_department = $this->settingsmodel->GetProjectResourceByDepartment($project_id,$dept->id);
            $data['resource'] = $resource_by_department;
            $hod = $this->buaexpensemodel->getHod($dept->id);
            $hod_fullname = $hod['first_name'].' '.$hod['last_name'];
            $work_email = $hod['work_email'];
            
            $mail = $this->load->view('work_order', $data, TRUE);
            $subject = 'Statement of work';
            if(count($resource_by_department)>0)
            {
            $this->sendTeamNotificationMail($subject, $hod_fullname, $mail, $work_email);
            }
            

           // var_dump($resource_by_department);
           // exit;

        }



    }
 
   
    public function manageprojectteam($project_id)
    {
        
              
        $projectRoles = $this->settingsmodel->getProjectRoles();
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();
        $data['project_details'] = $this->settingsmodel->getProjectManagerDetails($project_id);
       
        $data['project_id'] = $project_id;
        $data['projectRoles'] = $projectRoles;
        
        
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
        $project_resource_role = $this->settingsmodel->GetProjectResource($project_id);
        //var_dump($project_resource_role );exit;
        $data['results'] = $project_resource_role;
 
        $this->load->view('header');
        $this->load->view('ProjectTeamTeam', $data);
        $this->load->view('footer');
     }

    // public function ProjectTeam()
    // {
    //     $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        
    //     $data['task_status'] = $this->settingsmodel->taskStatus();
        
    //     //send success message to view
    //     if (isset($_SESSION['sucess_message'])) {
    //         $data['sucess_message'] = $_SESSION['sucess_message'];
    //     }
    //     $_SESSION['sucess_message'] = '';

    //     //send error message to view
    //     if (isset($_SESSION['message_error'])) {
    //         $data['message_error'] = $_SESSION['message_error'];
    //     }
    //     $_SESSION['message_error'] = '';
    //     $this->db = $this->load->database('default', true);
     
    //     $data['results'] = $this->utitlitymodel->getteamleadproject($_SESSION['login_detal']->id);
 
    //     $this->load->view('header');
    //     $this->load->view('ProjectTeam', $data);
    //     $this->load->view('footer');
    // }

    public function ProjectTeam()
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
     
        $data['results'] = $this->utitlitymodel->getteamleadproject($_SESSION['login_detal']->id);

        $data['results'] = $this->utitlitymodel->getProjectManagerproject($_SESSION['login_detal']->id);
 
        $this->load->view('header');
        $this->load->view('ProjectTeam', $data);
        $this->load->view('footer');
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
        $data['id'] = $id;
        $this->load->view('header');
        $this->load->view('test', $data);
        $this->load->view('footer');
    }

    public function projectroles()
    {

        $this->load->view('header');

        $this->crud->columns('name');
        $this->crud->add_fields('name');
        $this->crud->edit_fields('name');
        $this->crud->required_fields('name');
        $this->crud->display_as('name', 'Role Name');

        $this->crud->set_subject('Project Roles');
        $this->crud->unset_read();
        $this->crud->unset_clone();

        $this->crud->set_table('project_roles');

        $output = $this->crud->render();
        $output->extra = '<h3>Project Roles</h3>';
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function projectroletask()
    {

        $this->load->view('header');

        $this->crud->columns('role_id', 'task_name');
        $this->crud->add_fields('role_id', 'task_name');
        $this->crud->edit_fields('role_id', 'task_name');
        $this->crud->required_fields('role_id', 'task_name');
        $this->crud->display_as('role_id', 'Role')->display_as('task_name', 'Task');

        $roles = $this->settingsmodel->getProjectRoles();
        $this->crud->field_type('role_id', 'dropdown', $roles);

        $this->crud->set_subject('Project Task');
        $this->crud->unset_read();
        $this->crud->unset_clone();

        $this->crud->set_table('project_role_task');

        $output = $this->crud->render();
        $output->extra = '<h3>Project Task</h3>';
        $this->load->view('home', $output);
        $this->load->view('footer');
    }



    // public function tasks()
    // {
    //     $this->load->view('header');
    //     $user_id = $_SESSION['login_detal']->id;
    //     $employee_id = $_SESSION['login_detal']->employee_id;
    //     //exit;

    //     $project_select = $this->settingsmodel->getProjectByprojectManager($employee_id);
    //     //$project_select = $this->settingsmodel->getProjectByteamLead($employee_id);
    //    // var_dump($project_select);exit;

    //     $this->crud->columns('project_id', 'task_name', 'task_description', 'assigned_to');
    //     $this->crud->required_fields('task_name', 'project_id', 'assigned_to');
    //     $this->crud->display_as('task_name', 'Task Name')
    //              ->display_as('project_id', 'Project Name')
    //              ->display_as('assigned_to', 'Assigned To')
    //              ->display_as('task_description', 'Describe Task'); 

    //     $all_mem = array();
    //     $all_mem[0] = "All Members";
        
    //     $this->crud->field_type('assigned_to', 'multiselect', array_merge($all_mem, $employee_select));
    //     $this->crud->set_relation('assigned_to', 'employees', 'last_name');
        
    //     $this->crud->where('task_owner', $user_id);
    //     $this->crud->field_type('task_owner', 'hidden', $user_id);
    //     $this->crud->set_subject('Project Task');
    //     //$this->crud->field_type('project_id', 'dropdown', $project_select);
    //     //$this->crud->set_relation('project_id', 'projects', 'name');
    //     $this->crud->field_type('project_id', 'dropdown', $project_select);
        

    //     //$this->crud->unset_delete();
    //     //$this->crud->unset_edit();
    //     //$this->crud->unset_clone();

    //     $this->crud->set_table('tasks');

    //     $output = $this->crud->render();
    //     $output->extra = '<h3>Project Task Manager</h3> <button type="button" data-toggle="modal" data-target="#uploadfile" class="btn btn-primary" id="import">Import CSV</button>';
    //     $this->load->view('home', $output);
    //     $this->load->view('footer');
    // }

    public function tasks(){
        $user_id = $_SESSION['login_detal']->id;
        $employee_id = $_SESSION['login_detal']->employee_id;

        $project_select = $this->settingsmodel->getProjectByManager($employee_id);
        $project_id = array();
        foreach ($project_select as $key => $value) {
            $project_id[] = $value->id;
        }
        //var_dump($project_id);exit; 
        $data['projects'] =  $project_select;

        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users';
        $config['total_rows'] = $this->settingsmodel->getProTasksCount(); // $this->db->count_all('users');
        $config['per_page'] = '1000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;  //echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $project_select = 
        $data['results'] =  $this->settingsmodel->getProTasksFilter($config['per_page'], $page, $project_id);
        //$data['results'] = $this->utitlitymodel->getprojectscdo($config['per_page'], $page);
        ///var_dump($data['results']); exit;
        $data['links'] = $this->pagination->create_links();

        if($_POST){
            extract($_POST);
            $task_owner =$user_id;
            if($project_id==""|| $task_name=="" || $assigned_to==""){
                $this->session->set_flashdata('error', "Please fill all fields");
                return;
            }
            //Var_dump($project_id, $task_name, $task_description,$task_owner, $assigned_to); exit; 
            $savecsv = $this->settingsmodel->saveTask($project_id, $task_name, $task_description,$task_owner, $assigned_to);
            if($savecsv == true){
                $project_team_details = $this->settingsmodel->getProjectDetails($project_id);
                $project_name = $project_team_details['name'];
                $project_manager = $this->settingsmodel->getEmployeeDetails(  $project_team_details['team_project_manager']);
                $project_manager_fullname = $project_manager['first_name'].' '.$project_manager['last_name'];

                $member = $this->settingsmodel->getEmployeeDetails( $assigned_to);
                $member_fullname = $member['first_name'].' '.$member['last_name'];
                // $team_lead_email = 'tumininuogunsola@yahoo.com';
                $member_email = $member['work_email'];
                $body = 'You have been assigned the following task in '.$project_name .' Project. <br/>
                <b>Task :</b>'.$task_name.'<br/>
                <b>Task Description :</b>'.$task_name.'<br/>
                <br/> Kindly contact your Project Manager '. $project_manager_fullname . ' for more information';
                $subject = 'Task Assigned Notification';
                $this->sendTeamNotificationMail($subject, $member_fullname, $body, $member_email);

                $this->session->set_flashdata('success', " Task added Sucessfully");
                redirect(base_url("admin/manageproject/tasks"));
            }
            else{
                $this->session->set_flashdata('error', " Error adding task");
            }
        }
        $this->load->view('header');
        $this->load->view('projecttask', $data);
        $this->load->view('footer');
    }

    public function edittask($id){
        $employee_id = $_SESSION['login_detal']->employee_id;

        $project_select = $this->settingsmodel->getProjectByManager($employee_id);
        $data['projects'] =  $project_select;
        $data['task'] = $this->settingsmodel->getSingleTask($id);
        // Var_dump( $data['task']); exit;
        if($_POST){
            extract($_POST);
            $task_owner =$user_id;
            // if($project_id==""|| $task_name=="" || $assigned_to==""){
            //     $this->session->set_flashdata('error', "Please fill all fields");
            //     return;
            // }
           //Var_dump($project_id, $task_name, $task_description,$task_owner, $assigned_to); exit; 
           $edittask = $this->settingsmodel->editTask($id,$project_id, $task_name, $task_description,$task_owner, $assigned_to);
            if($edittask == true){
                $this->session->set_flashdata('success', " Task Updated Sucessfully");
                redirect(base_url("admin/manageproject/tasks"));
            }
            else{
                $this->session->set_flashdata('error', " Error updating task");
            }
        }
        $this->load->view('header');
        $this->load->view('edittask', $data);
        $this->load->view('footer');
    }

    public function deletetask($id){
        $deletetask = $this->settingsmodel->deleteTask($id);
        if($deletetask == true){
            $this->session->set_flashdata('success', " Task deleted Sucessfully");
            redirect(base_url("admin/manageproject/tasks"));
        }
        else{
            $this->session->set_flashdata('error', " Error deleting task");
        }
    }

    public function download(){
        $this->load->helper('download');
        $data = file_get_contents('exp_files/Task.csv');
        force_download('TaskTemplate.csv', $data);
            
    }

    public function team()
    {
        $this->load->view('header');
        $user_id = $_SESSION['login_detal']->employee_id;
         
        $employee_select = $this->settingsmodel->getEmployee();
        $project_select = $this->settingsmodel->getProjectByprojectManager($user_id);

        $this->crud->columns('team_name', 'team_description', 'team_lead', 'team_member', 'team_project_id');
        $this->crud->required_fields('team_name', 'team_description', 'team_member', 'team_project_id');
        $this->crud->display_as('team_name', 'Team Name')
                 ->display_as('team_description', 'Team Description')
                 ->display_as('team_member', 'Team Members')
                 ->display_as('team_project_id', 'Project Name')
                 ->display_as('team_lead', 'Project Team Lead');

        $this->crud->where('team_project_manager', $user_id);
        $this->crud->field_type('team_project_manager', 'hidden', $user_id);
        $this->crud->set_subject('Team Manager');
        $this->crud->field_type('team_project_id', 'dropdown', (!count($project_select)) ? ['' => "No project found"] : $project_select);
        $this->crud->field_type('team_member', 'multiselect', $employee_select);
        $this->crud->field_type('team_lead', 'multiselect', $employee_select);

        $this->crud->order_by('team_id','desc');

        $this->crud->callback_after_insert(array($this, 'sendTeamMemberMailNotification'));
        $this->crud->callback_after_update(array($this, 'sendTeamMemberMailNotification'));

        //$this->crud->set_relation('team_project_id', 'projects', 'name');
        //$this->crud->set_relation('team_member', 'employees', 'first_name');

        //$this->crud->unset_delete();
        //$this->crud->unset_edit();
        //$this->crud->unset_clone();

        $this->crud->set_table('project_team');

        $output = $this->crud->render();
        $output->extra = '<h3>Project Team Manager</h3>';
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function uploadExcel()
	{
        if(empty($_FILES['fileURL']['name']))
        {
            $this->session->set_flashdata('error', "Please select a file");
            redirect('admin/manageproject/tasks');
        } 
        $arr_file = explode('.', $_FILES['fileURL']['name']);
        $extension = end($arr_file);
        if(( $extension == 'csv') ){
            if(!empty($_FILES['fileURL']['name']))
            {
                $file = $_FILES['fileURL']['tmp_name'];
                $handle = fopen($file, "r");
                $c = 0;//
                while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                {
                    
                    // Var_dump((string)$filesop[3]);
                    // exit();

                    //echo "valueeeee". $project_id. $task_name. $task_desc. $task_owner. $assigned_to;

                    if($c<>0){					//SKIP THE FIRST ROW
                        $project =  $this->settingsmodel->getPojectByName((string)$filesop[0]);
                        $project_id = $project['id'];
                        $task_name = (string)$filesop[1];
                        $task_name = $this->settingsmodel->getProjectTaskByName($task_name);
                        //var_dump($task_name->id); exit;
                        $task_desc = (string)$filesop[2];
                        
                        $employee =  $this->settingsmodel->getEmployeeByName((string)$filesop[3]);
                        $task_owner = $employee['id'] ;

                        $assigned_employee =  $this->settingsmodel->getEmployeeByName((string)$filesop[4]);
                        $start_date = $filesop[5];
                        $end_date =  $filesop[6];

                        $assigned_to =  $assigned_employee['id'];
                        $savecsv = $this->settingsmodel->saveTask($project_id, $task_name->id, $task_desc,$task_owner, $assigned_to);
                        if($savecsv == true){
                            $this->session->set_flashdata('success', " Import Sucessfully");
                        }
                        else{
                            $this->session->set_flashdata('error', " Check uploaded CSV format");
                        }
                    }
                    $c = $c + 1;
                }
                // $this->session->set_flashdata('success', " Import Sucessfully" );
                redirect('admin/manageproject/tasks');
                    
            }
        }
        else{
            $this->session->set_flashdata('error', "Extension not accepted. Only accepts CSV".  $extension);
            redirect('admin/manageproject/tasks');
        }

        
    }



    public function allprojecttasks()
    {
        $this->load->library('ajax_grocery_CRUD');
        $employee_id = $_SESSION['login_detal']->employee_id;
        $project_select = $this->settingsmodel->getProjectByprojectManager($employee_id);
        $employee_select = $this->settingsmodel->getEmployee();
      //  print_r();exit;
        
        $this->load->view('header');
        $crud = new ajax_grocery_CRUD();
        ////$this->crud->set_theme('datatables');
        $crud->columns('project_id','assigned_to','project_role_id','task_id','start_date', 'end_date');
        $crud->required_fields('project_id','assigned_to','project_role_id','task_id', 'start_date', 'end_date');
        $crud->display_as('project_id', 'Project')
        ->display_as('assigned_to', 'Assigned To')
        ->display_as('project_role_id', 'Role')
                   ->display_as('task_id', 'Task')
                   ->display_as('start_date', 'Start Date')
                   ->display_as('end_date', 'End Date');
        $crud->field_type('project_id', 'dropdown', $project_select);
        $crud->field_type('assigned_to', 'dropdown', $employee_select);
        $crud->field_type('end_date', 'date');
        $crud->field_type('start_date', 'date');
        //$this->db->where_in('project_id', array_keys($project_select));
      $crud->unset_read();
        $crud->unset_clone();

        $crud->order_by('id','desc');
        
        $crud->set_subject('Project Timeline');
        $crud->set_table('project_tasks');

        $crud->set_relation('project_role_id','project_roles','name');
        $crud->set_relation('task_id','project_role_task','task_name');

//this is the specific line that specifies the relation.
// 'ad_state_id' is the field (drop down) that depends on the field 'ad_country_id' (also drop down).
// 's_country_id' is the foreign key field on the state table that specifies state's country
        $crud->set_relation_dependency('task_id','project_role_id','role_id');


        $output = $crud->render();
        $output->extra = '<h3>All Projects Timeline</h3>';

    //    $output->extra = '<h3>All Projects Timeline</h3> <button type="button" data-toggle="modal" data-target="#uploadtask" class="btn btn-primary" id="importtask">Import CSV</button>
    //     <a href="' . base_url().'admin/manageproject/downloadtimeline' .'" class="btn btn-default">Download Template</a>';
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function downloadtimeline(){
        $this->load->helper('download');
        $data = file_get_contents('exp_files/timeline.csv');
        force_download('TimelineTemplate.csv', $data);
            
    }

    public function uploadTimelineExcel()
	{
        if(empty($_FILES['fileURL']['name']))
        {
            $this->session->set_flashdata('error', "Please select a file");
            redirect('admin/manageproject/allprojecttasks');
        } 
        $arr_file = explode('.', $_FILES['fileURL']['name']);
        $extension = end($arr_file);
        if(( $extension == 'csv') ){
            if(!empty($_FILES['fileURL']['name']))
            {
                $file = $_FILES['fileURL']['tmp_name'];
                $handle = fopen($file, "r");
                $c = 0;//
                while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                {
                    //var_dump((string)$filesop[1]); exit;
                    if($c==0){
                        if((string)$filesop[0]!="Project Name" || (string)$filesop[1]!="Task Name" || (string)$filesop[2]!="Duration (days)" || (string)$filesop[3]!="Start Date(dd/mm/yyyy)" || (string)$filesop[4]!="End date (dd/mm/yyyy)" ){
                            $this->session->set_flashdata('error', " Check uploadedsss CSV format");
                            redirect('admin/manageproject/allprojecttasks');
                        }
                    }

                    if($c<>0){					//SKIP THE FIRST ROW
                        $project =  $this->settingsmodel->getPojectByName((string)$filesop[0]);
                        $project_id = $project['id'];
                        $task_name = (string)$filesop[1];
                        $duration = (string)$filesop[2];
                        $start_date = strtotime(str_replace('/', '-', (string)$filesop[3]));
                        $start_date = date('Y-m-d',$start_date );
                        $end_date = strtotime(str_replace('/', '-', (string)$filesop[4]));
                        $end_date = date('Y-m-d',$end_date );
                        //Var_dump($start_date, $end_date); exit;
                        
                        $savecsv =$this->settingsmodel->ProjectTimeline($project_id, $task_name, $duration, (string)$start_date, (string)$end_date);
                        if($savecsv == true){
                            $this->session->set_flashdata('success', "CSV Imported Successfully");
                        }
                        else{
                            $this->session->set_flashdata('error', " Check uploaded CSV format");
                        }
                        
                    }
                    $c = $c + 1;
                }
                // $this->session->set_flashdata('success', " Import Sucessfully" );
                redirect('admin/manageproject/allprojecttasks');
                    
            }
        }
        else{
            $this->session->set_flashdata('error', $extension . " Extension not accepted. Only accepts CSV");
            redirect('admin/manageproject/allprojecttasks');
        }

        
    }

    public function assignedtask(){
        $employee_id = $_SESSION['login_detal']->employee_id;

        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users';
        $config['total_rows'] = $this->settingsmodel->getStaffProTasksCount($employee_id); // $this->db->count_all('users');
        $config['per_page'] = '1000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;  //echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $project_select = 
        $data['results'] =  $this->settingsmodel->getStaffProjectTask($config['per_page'], $page, $employee_id );
        //Var_dump($data['results']); exit;
        $data['links'] = $this->pagination->create_links();

    
        $this->load->view('header');
        $this->load->view('assignedtask', $data);
        $this->load->view('footer'); 
    }
    
    public function checkFileValidation($string){
        $file_mimes = array('text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
          );
    
          if(isset($_FILES['fileURL']['name'])) {
                $arr_file = explode('.', $_FILES['fileURL']['name']);
                $extension = end($arr_file);
            if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)){
                return true;
            }else{
                $this->form_validation->set_message('checkFileValidation', 'File format not supported.');
                return false;
            }
        }else{
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
      }

    public function sendTeamMemberMailNotification($post_array,$primary_key)
    {
        //extract($data_details);
        $project_team_details = $this->settingsmodel->getProjectDetails($primary_key);
        $project_name = $project_team_details['name'];

        $project_manager = $this->settingsmodel->getEmployeeDetails(  $project_team_details['team_project_manager']);
        $project_manager_fullname = $project_manager['first_name'].' '.$project_manager['last_name'];
        
        // Sending Notification to team lead
        $team_lead = $this->settingsmodel->getEmployeeDetails( $project_team_details['team_lead']);

        $team_lead_fullname = $team_lead['first_name'].' '.$team_lead['last_name'];
        // $team_lead_email = 'tumininuogunsola@yahoo.com';
        $team_lead_email = $team_lead['work_email'];
        $body = 'You have been added as a Team Lead to '.$project_name .' Project
        <br/> Kindly contact your Project Manager '. $project_manager_fullname . ' for more information';
        $subject = 'Project Team Lead Notification';
        $this->sendTeamNotificationMail($subject, $team_lead_fullname, $body, $team_lead_email);

        //sending mail to team members
        $team_members = explode(',', $project_team_details['team_member']);
        if(count($team_members) > 0){
            foreach($team_members as $id)
            {
                $emplyee_details = $this->settingsmodel->getEmployeeDetails((int)$id);
                $department = $emplyee_details['department'];

                $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
                $employee_fullname_useable = $employee_fullname;
                // $employee_email = 'tumininuogunsola@yahoo.com';
                $employee_email = $emplyee_details['work_email'];
                $recipiant_name = $employee_fullname;
                $subject = 'Project Team Member Notification';
                $body = 'You have been added as a Team Member to '.$project_name .' Project
                    <br/> Kindly contact your Project Manager '.$project_manager_fullname. ' and Team Lead '. $team_lead_fullname. ' for more information';
                $this->sendTeamNotificationMail($subject, $employee_fullname, $body, $employee_email);
            }
        }
        
    }

    public function sendTeamNotificationMail($mail_title, $recipiant_name, $body, $to)
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
