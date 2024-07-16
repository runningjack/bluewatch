<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Settings extends MX_Controller
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

        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
    }

    public function _example_output($output = null)
    {
        $this->load->view('example.php', (array) $output);
    }

    public function finyear()
    {
        $data['sucess_message'] = null;
        $data['message_error'] = null;
        if ($_POST) {
            extract($_POST);
            $data = array('year' => $finyear, 'start_month' => $start_month);
            $resp = $this->settingsmodel->updateFinYear($data);

            if ($resp) {
                $_SESSION['finacial_year'] = (object)$data;
                $data['sucess_message'] = 'Finacial year update was successful';

            }else{
                $data['message_error'] = 'Error Occured, Please try again';
            }
        }

         $this->load->view('header');
        $this->load->view('finyearSettings', $data);
        $this->load->view('footer');
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

    public function projectcategory()
    {

        $this->load->view('header');
        $user_id = $_SESSION['login_detal']->id;
        //exit;
        
        //var_dump($employee_select);exit;

        $this->crud->columns('id','name');
        $this->crud->add_fields('name');
        $this->crud->edit_fields('name');
        $this->crud->required_fields('name');
        $this->crud->display_as('name', 'Project Category Name');

        $this->crud->set_subject('Project Category');
        //$this->crud->field_type('name', 'text');

        //$this->crud->set_relation('team_project_id', 'projects', 'name');
        //$this->crud->set_relation('team_member', 'employees', 'first_name');

        //$this->crud->unset_delete();
        // $this->crud->unset_read();
        // $this->crud->unset_clone();

        $this->crud->set_table('projectcategory');

        $output = $this->crud->render();
        $output->extra = '<h3>Project Category</h3>';
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function department()
    {

        $this->load->view('header');
        $user_id = $_SESSION['login_detal']->id;
        //exit;
        $update_id = $this->uri->segment(5);
        $employee_select = $this->settingsmodel->getDepartmentEmployee($update_id);
        $expense_line_select = $this->settingsmodel->getOperationalExpenses();
        //var_dump($employee_select);exit;

        $this->crud->columns('department_name', 'department_description', 'hod', 'opex');
        $this->crud->add_fields('department_name', 'department_description', 'opex');
        $this->crud->edit_fields('department_name','department_description','hod', 'opex');
        $this->crud->required_fields('department_name');
        $this->crud->display_as('department_name', 'Department Name')
                 ->display_as('department_description', 'Department Description')
                 ->display_as('hod', 'HOD')
                 ->display_as('opex', 'Operational Expenses');

        $this->crud->set_subject('Department Manager');
        $this->crud->field_type('department_description', 'text');
        $this->crud->unset_texteditor('department_description');
        $this->crud->field_type('hod', 'dropdown', $employee_select);
        $this->crud->field_type('opex', 'multiselect', $expense_line_select);

        //$this->crud->set_relation('team_project_id', 'projects', 'name');
        //$this->crud->set_relation('team_member', 'employees', 'first_name');

        //$this->crud->unset_delete();
        $this->crud->unset_read();
        $this->crud->unset_clone();

        $this->crud->set_table('department');

        $output = $this->crud->render();
        $output->extra = '<h3>Department</h3>';
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function companystructure()
    {
        $this->load->view('header');

        $employees_multiselect = $this->settingsmodel->getEmployee();
        $country_select = $this->settingsmodel->getCountry();
        $parent_list = $this->settingsmodel->structure();

        $this->crud->columns('code','title', 'description', 'address', 'type', 'country', 'timezone', 'heads', 'parent');
        $this->crud->required_fields('title');
        $this->crud->required_fields('code','heads', 'timezone', 'description', 'type', 'country', 'title');
        $this->crud->display_as('code', 'Code')
                 ->display_as('title', 'Name')
                 ->display_as('description', 'Details')
                 ->display_as('address', 'Address')
                 ->display_as('type', 'Type')
                 ->display_as('country', 'Country')
                 ->display_as('timezone', 'Time Zone')
                 ->display_as('heads', 'Head of Dept.')
                 ->display_as('parent', 'Parent');
        $this->crud->set_subject('Company Structure');
        $this->crud->set_relation('type', 'companytype', 'type');
        $this->crud->set_relation('timezone', 'timezones', 'details');
        //$this->crud->set_relation('country','country','name');
        $this->crud->field_type('heads', 'multiselect', $employees_multiselect);
        $this->crud->field_type('country', 'dropdown', $country_select);
        $this->crud->field_type('parent', 'dropdown', $parent_list);
        //$this->crud->unset_delete();
        //$this->crud->unset_edit();
        //$this->crud->unset_clone();

        $this->crud->set_table('companystructures');

        $output = $this->crud->render();
        $output->extra = '<h3>Organization Structure</h3>';
        // $data['output'] = $output;

        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function client()
    {
      //  die("ff");
         
        $this->load->view('header');
        //$this->config->load('grocery_crud');
       // $this->config->set_item('grocery_crud_default_per_page', 10);
        $output1 = $this->loadclients();
        $js_files = $output1->js_files;
        $css_files = $output1->css_files;

        $data = array(
                'js_files' => $js_files,
                'css_files' => $css_files,
                'output1' => $output1->output,
                'title1' => 'Clients',
                'title2' => 'Projects',
                'title3' => 'Employee Projects',
        );


        //$this->load->view('client', $data);
        $this->load->view('home', $output1);
        
        $this->load->view('footer'); 
    }


    public function revenuehead()
    {
        $this->load->view('header');
        $this->config->load('grocery_crud');
        $this->config->set_item('grocery_crud_dialog_forms', true);
        $this->config->set_item('grocery_crud_default_per_page', 10);
        $output1 = $this->loadRevenueHead();
        $js_files = $output1->js_files;
        $css_files = $output1->css_files;

        $data = array(
                'js_files' => $js_files,
                'css_files' => $css_files,
                'output1' => $output1->output,
                'title1' => 'Clients',
                'title2' => 'Projects',
                'title3' => 'Employee Projects',
        );

        //$this->load->view('client', $data);
        $this->load->view('home', $output1);
        $this->load->view('footer');
    }




    public function training()
    {
        $this->load->view('header');
        $this->config->load('grocery_crud');
        $this->config->set_item('grocery_crud_dialog_forms', true);
        $this->config->set_item('grocery_crud_default_per_page', 10);
        $output1 = $this->courses();
        $js_files = $output1->js_files;
        $css_files = $output1->css_files;

        $data = array(
                'js_files' => $js_files,
                'css_files' => $css_files,
                'output1' => $output1->output,
                'title1' => 'Courses',
                'title2' => 'Training Sessions',
                'title3' => 'Employee Projects',
        );

        $this->load->view('training', $data);
        $this->load->view('footer');
    }

    public function leavesettings()
    {  //loadLeaves
        $this->load->view('header');
        $this->config->load('grocery_crud');
        $this->config->set_item('grocery_crud_dialog_forms', true);
        $this->config->set_item('grocery_crud_default_per_page', 10);
        $output1 = $this->loadLeaves();
        $js_files = $output1->js_files;
        $css_files = $output1->css_files;

        $data = array(
                'js_files' => $js_files,
                'css_files' => $css_files,
                'output1' => $output1->output,
                'title1' => 'Leave Types',
                'title2' => 'Leave Period',
                'title3' => 'Work Week',
                'title4' => 'Holidays',
                'title5' => 'Leave Rules',
                'title6' => 'Paid Time Off',
                'title7' => 'Manage Leave Group',
                'title8' => 'Leave Group',
                'title9' => 'Employee Leave List',
        );

        $this->load->view('leavesettings', $data);
        $this->load->view('footer');
    }

    public function employeeproject()
    {
        $this->crud = new grocery_CRUD();
        $employee_select = $this->settingsmodel->getEmployee();
        $project_select = $this->settingsmodel->getProject();

        $this->crud->columns('employee', 'project', 'date_start', 'date_end', 'status', 'details');
        $this->crud->required_fields('employee', 'project'.'details');

        $this->crud->display_as('name', 'Name')
                   ->display_as('project', 'Project')
                   ->display_as('details', 'Details');
        $this->crud->field_type('employee', 'dropdown', $employee_select);
        $this->crud->field_type('project', 'dropdown', $project_select);

        $this->crud->unset_clone();
        $this->crud->unset_edit_fields('date_start');
        $this->crud->unset_edit_fields('date_end');
        $this->crud->unset_edit_fields('status');
        $this->crud->set_subject('Employee Projects');
        $this->crud->set_table('employeeprojects');
        $output = $this->crud->render();
        $output->extra = '<h3>Employee Projects</h3>';
        $this->_example_output($output);
    }

    public function loadLeaves()
    {
        $this->crud = new grocery_CRUD();
        $percentage = array('10' => '10%', '15' => '15%', '20' => '20%', '25' => '25%', '30' => '30%', '40' => '40%',
                            '50' => '50%', '60' => '60%', '70' => '70%', '80' => '80%', '90' => '90%', '100' => '100%', );
        $leavegroup = $this->settingsmodel->getLeaveGroup();
        $this->crud->columns('name', 'supervisor_leave_assign', 'employee_can_apply', 'apply_beyond_current', 'leave_accrue', 'carried_forward', 'default_per_year', 'carried_forward_percentage', 'carried_forward_leave_availability', 'propotionate_on_joined_date', 'send_notification_emails', 'leave_group', 'max_carried_forward_amount');
        $this->crud->required_fields('name', 'supervisor_leave_assign', 'employee_can_apply', 'apply_beyond_current', 'leave_accrue', 'carried_forward', 'default_per_year', 'carried_forward_leave_availability', 'propotionate_on_joined_date', 'send_notification_emails', 'max_carried_forward_amount');
        $this->crud->display_as('name', 'Leave Name')
                   ->display_as('supervisor_leave_assign', 'Admin can assign leave to employees')
                   ->display_as('employee_can_apply', 'Employees can apply for this leave type')
                   ->display_as('apply_beyond_current', 'Employees can apply beyond the current leave balance')
                   ->display_as('leave_accrue', 'Leave Accrue Enabled')
                   ->display_as('carried_forward', 'Leave Carried Forward')
                   ->display_as('default_per_year', 'Leaves Per Leave Period')
                   ->display_as('carried_forward_percentage', 'Percentage of Leaves Carried Forward')
                   ->display_as('carried_forward_leave_availability', 'Carried Forward Leave Availability Period')
                   ->display_as('propotionate_on_joined_date', 'Proportionate leaves on Joined Date')
                   ->display_as('send_notification_emails', 'Send Notification Emails')
                   ->display_as('leave_group', 'Leave Group')
                   ->display_as('max_carried_forward_amount', 'Leave Color')
                   ;
        $this->crud->field_type('carried_forward_percentage', 'dropdown', $percentage);
        if (count($leavegroup) > 0) {
            $this->crud->field_type('leave_group', 'dropdown', $leavegroup);
        }
        //    $this->crud->unset_edit_fields('created');clien
        //  $this->crud->unset_clone();
        $this->crud->set_subject('Leave Types');
        $this->crud->set_table('leavetypes');
        $output = $this->crud->render();
        $output->extra = '<h3>Leave Types</h3>';

        return $output;
    }


    public function loadRevenueHead()
    {
        $this->crud = new grocery_CRUD();

        $this->crud->columns('revenue_head', 'revenue_description');
        $this->crud->required_fields('revenue_head');
        $this->crud->display_as('revenue_head', 'Revenue Head')
                   ->display_as('revenue_description', 'Revenue Description');
 
        $this->crud->unset_clone();
        $this->crud->set_subject('Revenues Head');
        $this->crud->set_table('revenue_head');
        $output = $this->crud->render();
        $output->extra = '<h3>Revenues Head</h3>';

        return $output;
    }

    public function loadclients()
    {
        $this->crud = new grocery_CRUD();
         
//, 'first_contact_date'
//->display_as('first_contact_date', 'First Contact Date')
       $this->crud->columns('name', 'details', 'address', 'contact_number', 'contact_email', 'company_url', 'status');
        $this->crud->required_fields('name', 'status');
        $this->crud->display_as('name', 'Name')
                    ->display_as('details', 'Details')
                   ->display_as('address', 'Address')
                   ->display_as('contact_number', 'Contact Number')
                   ->display_as('contact_email', 'Contact Email')
                   ->display_as('company_url', 'Company URL')
                   ->display_as('status', 'Status');
                   

        $this->crud->unset_edit_fields('created');
        $this->crud->unset_edit_fields('first_contact_date');
        $this->crud->unset_clone();
        $this->crud->set_subject('Client');
        $this->crud->set_table('clients');
        $output = $this->crud->render();
        $output->extra = '<h3>Clients</h3>';
        /*echo'<style>     
                #first_contact_date_field_box {
                    display: none;
                  }      
                #created_field_box  {
                    display: none;
                  }      
            </style>';
            */

        return $output;
    }

    public function format_num($value, $row)
    {
        return number_format($value, 0);
    }

    // public function allprojecttasks()
    // {
    //     $employee_id = $_SESSION['login_detal']->employee_id;
    //     $project_select = $this->settingsmodel->getProjectByprojectManager($employee_id);
    //     //Var_dump( $project_select); exit;

    //     $this->load->view('header');
    //     $this->crud = new grocery_CRUD();
    //     ////$this->crud->set_theme('datatables');
    //     $this->crud->columns('project_id', 'task_name', 'duration', 'start_date', 'end_date');
    //     $this->crud->required_fields('task_name', 'duration', 'start_date', 'end_date');
    //     $this->crud->display_as('project_id', 'Project')
    //                ->display_as('task_name', 'Task Name')
    //                ->display_as('duration', 'Duration (In days)')
    //                ->display_as('start_date', 'Start Date')
    //                ->display_as('end_date', 'End Date');
    //     $this->crud->field_type('project_id', 'dropdown', $project_select);
    //     $this->crud->field_type('duration', 'integer', 0);
    //     $this->crud->field_type('end_date', 'date');
    //     $this->crud->field_type('start_date', 'date');

    //     $this->crud->order_by('id','desc');
        
    //     $this->crud->set_subject('Project Timeline');
    //     $this->crud->set_table('project_tasks');
    //    // $this->crud->set_relation('project_id', 'projects', 'name');
    //     $output = $this->crud->render();
    //     $output->extra = '<h3>All Projects Timeline</h3> <button type="button" data-toggle="modal" data-target="#uploadtask" class="btn btn-primary" id="importtask">Import CSV</button>
    //     <a href="' . base_url().'admin/settings/download' .'" class="btn btn-default">Download Template</a>';
    //     $this->load->view('home', $output);
    //     $this->load->view('footer');
    // }

    // public function download(){
    //     $this->load->helper('download');
    //     $data = file_get_contents('exp_files/timeline.csv');
    //     force_download('TimelineTemplate.csv', $data);
            
    // }

    public function projecttask($id)
    {
        $employee_id = $_SESSION['login_detal']->employee_id;
        $project_select = $this->settingsmodel->getProjectByprojectManager($employee_id);
        //Var_dump( $project_select); exit;

        $this->load->view('header');
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
        $this->crud->columns('project_id', 'task_name', 'duration', 'start_date', 'end_date');
        $this->crud->required_fields('task_name', 'duration', 'start_date', 'end_date');
        $this->crud->display_as('project_id', 'Project')
                   ->display_as('task_name', 'Task Name')
                   ->display_as('duration', 'Duration (In days)')
                   ->display_as('start_date', 'Start Date')
                   ->display_as('end_date', 'End Date');
        $this->crud->field_type('project_id', 'dropdown', $project_select);
        $this->crud->field_type('duration', 'integer', 0);
        $this->crud->field_type('end_date', 'date');
        $this->crud->field_type('start_date', 'date');
        
        $this->crud->set_subject('Project Timeline');
        $this->crud->where('project_id', $id );
        $this->crud->set_table('project_tasks');
       // $this->crud->set_relation('project_id', 'projects', 'name');
        $output = $this->crud->render();
        $output->extra = '<h3>Project Timeline</h3> ';
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    // public function uploadExcel()
	// {
    //     if(empty($_FILES['fileURL']['name']))
    //     {
    //         $this->session->set_flashdata('error', "Please select a file");
    //         redirect('admin/settings/projecttask');
    //     } 
    //     $arr_file = explode('.', $_FILES['fileURL']['name']);
    //     $extension = end($arr_file);
    //     if(( $extension == 'csv') ){
    //         if(!empty($_FILES['fileURL']['name']))
    //         {
    //             $file = $_FILES['fileURL']['tmp_name'];
    //             $handle = fopen($file, "r");
    //             $c = 0;//
    //             while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
    //             {
    //                 if($c==0){
    //                     if((string)$filesop[0]!="Project Name" || (string)$filesop[1]!="Task Name" || (string)$filesop[2]!="Duration" || (string)$filesop[3]!="Start Date(dd/mm/yyyy)" || (string)$filesop[4]!="End Date(dd/mm/yyyy)" ){
    //                         $this->session->set_flashdata('error', " Check uploaded CSV format");
    //                         redirect('admin/settings/allprojecttasks');
    //                     }
    //                 }

    //                 if($c<>0){					//SKIP THE FIRST ROW
    //                     $project =  $this->settingsmodel->getPojectByName((string)$filesop[0]);
    //                     $project_id = $project['id'];
    //                     $task_name = (string)$filesop[1];
    //                     $duration = (string)$filesop[2];
    //                     $start_date = strtotime(str_replace('/', '-', (string)$filesop[3]));
    //                     $start_date = date('Y-m-d',$start_date );
    //                     $end_date = strtotime(str_replace('/', '-', (string)$filesop[4]));
    //                     $end_date = date('Y-m-d',$end_date );
    //                     //Var_dump($start_date, $end_date); exit;
                        
    //                     $savecsv =$this->settingsmodel->ProjectTimeline($project_id, $task_name, $duration, (string)$start_date, (string)$end_date);
    //                     if($savecsv == true){
    //                         $this->session->set_flashdata('success', "CSV Imported Successfully");
    //                     }
    //                     else{
    //                         $this->session->set_flashdata('error', " Check uploaded CSV format");
    //                     }
                        
    //                 }
    //                 $c = $c + 1;
    //             }
    //             // $this->session->set_flashdata('success', " Import Sucessfully" );
    //             redirect('admin/settings/allprojecttasks');
                    
    //         }
    //     }
    //     else{
    //         $this->session->set_flashdata('error', "Extension not accepted. Only accepts CSV".  $extension);
    //         redirect('admin/settings/projecttask');
    //     }

        
    // }

    public function projects()
    {
        $this->load->view('header');
        $this->crud = new grocery_CRUD();
        $clients = $this->settingsmodel->getClients();
        $project_categories = $this->settingsmodel->getProjectCategories();
        $employee_select = $this->settingsmodel->getEmployee();

        $this->crud->columns('name','project_code', 'client', 'details', 'status','project_category', 'project_manager', 'budget_amount', 'start_date', 'end_date','actual_end_date');
        $this->crud->required_fields('name', 'status','start_date', 'project_category','end_date','budget_amount','project_manager','client');
        $this->crud->display_as('name', 'Name')
                   ->display_as('project_code', 'Project Code')
                   ->display_as('client', 'Client')
                   ->display_as('details', 'Details')
                   ->display_as('status', 'Status')
                   ->display_as('project_category', 'Project Category')
                   ->display_as('project_manager', 'Project Manager')
                   ->display_as('budget_amount', 'Budgeted Amount')
                   ->display_as('start_date', 'Begins at')
                   ->display_as('end_date', 'Ends at')
                   ->display_as('actual_end_date', 'Actual End Date');

        
        $this->crud->callback_column('budget_amount', array($this, 'format_num'));
      /*   $this->crud->callback_add_field('end_date', function () {
       return '<input type="date" value="" id="end_date"  name="end_date"> 
        (Must be 5days after start date or greater)'
        
        ;
    }); */

 /*           $this->crud->callback_edit_field('end_date', function ($value, $primary_key = null) {
        return '<input type="date" value="'.date($value).'" id="end_date"  name="end_date" readonly> (Must be 5days after start date or greater)';
    });

          $this->crud->callback_add_field('start_date', function () {
        return '<input type="date" value="" id="start_date"  name="start_date">';
    });
            $this->crud->callback_edit_field('start_date', function ($value, $primary_key = null) {
        return '<input type="date" value="'.date($value).'" id="start_date"  name="start_date" readonly>';
    });
        $this->crud->unset_edit_fields('created');
        $this->crud->unset_add_fields('actual_end_date'); */


        $this->crud->field_type('budget_amount', 'integer', 0);
        $this->crud->field_type('start_date', 'date');
        $this->crud->field_type('project_code', 'hidden');
        $this->crud->field_type('end_date', 'date');
        $this->crud->field_type('actual_end_date', 'date');
        $this->crud->field_type('project_manager', 'multiselect', $employee_select);
        $this->crud->field_type('client', 'dropdown', $clients);
        $this->crud->field_type('project_category', 'multiselect', $project_categories);
        $this->crud->unset_clone();
        $this->crud->set_subject('Project');
        $this->crud->set_table('projects');

        $this->crud->add_action('Project Timeline', base_url('bootstrap/images/bubble-tail.PNG'), 'admin/settings/projecttask'.$id);
        $this->crud->callback_after_insert(array($this, 'sendProjectManagerMailNotification'));
        $this->crud->callback_after_update(array($this, 'sendProjectManagerMailNotification'));

        $output = $this->crud->render();
        $output->extra = '<h3>Projects</h3>';

        //$this->_example_output($output);
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function importProject()
	{ 
		
		if(isset($_POST["submit"]))
		{
			$file = $_FILES['file']['tmp_name'];
			$handle = fopen($file, "r");
			$c = 0;//
			while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
			{
				$fname = $filesop[0];
				$lname = $filesop[1];
				if($c<>0){					//SKIP THE FIRST ROW
					$this->Crud_model->saverecords($fname,$lname);
				}
				$c = $c + 1;
			}
			redirect('admin/settings/projects');
				
		}
	}

    public function employeetrainingsessions()
    {
        $this->crud = new grocery_CRUD();
        //  ////$this->crud->set_theme('datatables');
        $employee_select = $this->settingsmodel->getEmployee();
        $training_select = $this->settingsmodel->getTrainingSessions();
        //var_dump($courses_select);
        //exit;

        $this->crud->columns('employee', 'trainingSession', 'status');
        $this->crud->required_fields('employee', 'trainingSession', 'status');
        $this->crud->display_as('employee', 'Employee')
                   ->display_as('trainingSession', 'Training Session')
                   ->display_as('status', 'Status');
        $this->crud->unset_edit_fields('feedBack', 'proof');

        $this->crud->field_type('employee', 'dropdown', $employee_select);
        $this->crud->field_type('trainingSession', 'dropdown', $training_select);

        $this->crud->unset_clone();
        $this->crud->set_subject('Employee Training Sessions');
        $this->crud->set_table('employeetrainingsessions');
        $output = $this->crud->render();
        $output->extra = '<h3>Employee Training Sessions</h3>';
        $this->_example_output($output);
    }

    public function trainingsessions()
    {
        $this->crud = new grocery_CRUD();
        //  ////$this->crud->set_theme('datatables');
        $courses_select = $this->settingsmodel->getCourses();
        //var_dump($courses_select);
        //exit;

        $this->crud->columns('name', 'course', 'description', 'scheduled', 'dueDate', 'deliveryMethod', 'deliveryLocation', 'status', 'attendanceType', 'attachment', 'requireProof');
        $this->crud->required_fields('name', 'course', 'attendanceType', 'requireProof');
        $this->crud->display_as('name', 'Name')
                   ->display_as('course', 'Course')
                   ->display_as('description', 'Details')
                   ->display_as('scheduled', 'Scheduled Time')
                   ->display_as('dueDate', 'Assignment Due Date')
                   ->display_as('deliveryMethod', 'Delivery Method')
                   ->display_as('deliveryLocation', 'Location')
                   ->display_as('status', 'Status')
                   ->display_as('attendanceType', 'Attendance Type')
                   ->display_as('attachment', 'Attachment')
                   ->display_as('requireProof', 'Training Certificate Required');
        $this->crud->field_type('course', 'multiselect', $courses_select);
        $this->crud->set_field_upload('attachment', './files');
        // $this->crud->unset_view();
        $this->crud->unset_clone();
        $this->crud->unset_edit_fields('created', 'updated');
        $this->crud->set_subject('Training Sessions');
        $this->crud->set_table('trainingsessions');
        $output = $this->crud->render();
        $output->extra = '<h3>Training Sessions</h3>';
        $this->_example_output($output);
    }

    public function courses()
    {
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
        $employees_multiselect = $this->settingsmodel->getEmployee();
        $currency_select = $this->settingsmodel->getCurrency();
        $this->crud->columns('code', 'name', 'description', 'coordinator', 'trainer', 'trainer_infopaymentType', 'currency', 'cost', 'status');
        $this->crud->required_fields('code', 'name', 'description', 'coordinator', 'currency', 'cost', 'status');
        $this->crud->display_as('name', 'Name')
                   ->display_as('code', 'Code')
                   ->display_as('description', 'Description')
                   ->display_as('coordinator', 'Cordinator')
                   ->display_as('trainer', 'Trainer')
                   ->display_as('trainer_infopaymentType', 'Payment Type')
                   ->display_as('currency', 'Currency')
                   ->display_as('cost', 'Cost')
                   ->display_as('status', 'Status');
        $this->crud->field_type('coordinator', 'multiselect', $employees_multiselect);
        $this->crud->field_type('currency', 'multiselect', $currency_select);
        // $this->crud->unset_view();
        $this->crud->unset_clone();
        $this->crud->unset_edit_fields('created', 'updated');
        $this->crud->set_subject('Course');
        $this->crud->set_table('courses');
        $output = $this->crud->render();
        $output->extra = '<h3>Courses</h3>';

        return $output;
    }

    public function jobdetails()
    {
        $this->load->view('header');

        $this->config->load('grocery_crud');
        $this->config->set_item('grocery_crud_dialog_forms', true);
        $this->config->set_item('grocery_crud_default_per_page', 10);
        $output1 = $this->job_titles();
        //$output2 = $this->pay_grade();
        //$output3 = $this->employment_status();

        $js_files = $output1->js_files;
        $css_files = $output1->css_files;

        $data = array(
                'js_files' => $js_files,
                'css_files' => $css_files,
                'output1' => $output1->output,
            //	'output2'	=> $output2->output,
            //	'output3'	=> $output3->output,
                'title1' => 'Job Titles',
                'title2' => 'Pay Grades',
                'title3' => 'Employment Status',
        );

        $this->load->view('jobdetails', $data);
        $this->load->view('footer');
    }

    public function qualification()
    {
        $this->load->view('header');
        $this->config->load('grocery_crud');
        $this->config->set_item('grocery_crud_dialog_forms', true);
        $this->config->set_item('grocery_crud_default_per_page', 10);
        $output1 = $this->skills();
        $js_files = $output1->js_files;
        $css_files = $output1->css_files;

        $data = array(
                'js_files' => $js_files,
                'css_files' => $css_files,
                'output1' => $output1->output,
                'title1' => 'Job Titles',
                'title2' => 'Pay Grades',
                'title3' => 'Employment Status',
        );

        $this->load->view('qualification', $data);
        $this->load->view('footer');
    }

    public function education()
    {
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
        $this->crud->columns('name', 'description');
        $this->crud->required_fields('name', 'description');
        $this->crud->display_as('name', 'Name')
                   ->display_as('description', 'Description');
        $this->crud->set_subject('Education');
        $this->crud->set_table('educations');
        $output = $this->crud->render();
        $output->extra = '<h3>Education</h3>';

        $this->_example_output($output);
    }

    public function certifications()
    {
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
        $this->crud->columns('name', 'description');
        $this->crud->required_fields('name', 'description');
        $this->crud->display_as('name', 'Name')
                   ->display_as('description', 'Description');
        $this->crud->set_subject('Certifications');
        $this->crud->set_table('certifications');
        $output = $this->crud->render();
        $output->extra = '<h3>Certifications</h3>';
        $this->_example_output($output);
    }

    public function languages()
    {
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
        $this->crud->columns('name', 'description');
        $this->crud->required_fields('name', 'description');
        $this->crud->display_as('name', 'Name')
                   ->display_as('description', 'Description');
        $this->crud->set_subject('Employee Skills');
        $this->crud->set_table('languages');
        $output = $this->crud->render();
        $output->extra = '<h3>Languages</h3>';
        $this->_example_output($output);
    }

    public function skills()
    {
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
        $this->crud->columns('name', 'description');
        $this->crud->required_fields('name', 'description');
        $this->crud->display_as('name', 'Name')
                   ->display_as('description', 'Description');
        $this->crud->set_subject('Employee Skills');
        $this->crud->set_table('skills');
        $output = $this->crud->render();
        $output->extra = '<h3>Skills</h3>';
        //$this->_example_output($output);
        return $output;
    }

    public function job_titles()
    {
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
        $this->crud->columns('code', 'name', 'description', 'specification');
        $this->crud->required_fields('code', 'name', 'description', 'specification');
        $this->crud->display_as('code', 'Job Title Code')
                 ->display_as('name', 'Job Title')
                 ->display_as('description', 'Description')
                 ->display_as('specification', 'Specification');
        $this->crud->set_subject('Job Titles');

        $this->crud->set_table('jobtitles');
        $output = $this->crud->render();
        $output->extra = '<h3>Job Titles</h3>';
        //$this->_example_output($output);
        return $output;
    }

    public function pay_grade()
    {
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
        $currency_list = $this->settingsmodel->getCurrency();
        $this->crud->columns('name', 'currency', 'min_salary', 'max_salary');
        $this->crud->required_fields('name', 'currency', 'min_salary', 'max_salary');
        $this->crud->display_as('name', 'Pay Grade Name')
                 ->display_as('currency', 'Currency')
                 ->display_as('min_salary', 'Min Salary')
                 ->display_as('max_salary', 'Max Salary');
        $this->crud->set_subject('Pay Grades');
        $this->crud->field_type('currency', 'dropdown', $currency_list);
        $this->crud->set_table('paygrades');
        $output = $this->crud->render();
        $output->extra = '<h3>Pay Grades</h3>';
        // return $output;
        $this->_example_output($output);
    }

    public function employment_status()
    {
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');

        $this->crud->columns('name', 'description');
        $this->crud->required_fields('name', 'description');
        $this->crud->display_as('name', 'Pay Grade Name')
                 ->display_as('description', 'Currency');
        $this->crud->set_subject('Employment Status');
        $this->crud->set_table('employmentstatus');
        $output = $this->crud->render();
        $output->extra = '<h3>Employment Status</h3>';
        //return $output;
        $this->_example_output($output);
    }

    

    public function sendProjectManagerMailNotification($post_array,$primary_key)
    {
       
        //extract($data_details);
        $project_details = $this->settingsmodel->getSingleProject($primary_key);
        
        $project_name = $project_details['name'];

        // Sending Notification to project manager
        $project_manager = $this->settingsmodel->getEmployeeDetails( $project_details['project_manager']);

        $project_manager_fullname = $project_manager['first_name'].' '.$project_manager['last_name'];
        //$project_manager_email = 'tumininuogunsola@yahoo.com';
        $project_manager_email = $project_manager['work_email'];
        $body = 'You have been added as a Project Manager to '.$project_name .' Project';
        $subject = 'Project Manager Notification';
        $this->sendProjectManagerNotificationMail($subject, $project_manager_fullname, $body, $project_manager_email);

         //set unique project number  for project
         $unique_number ="BCP". sprintf('%010d', $project_details['id'] );
         $this->settingsmodel->setUniqueProjectNumber($primary_key, $unique_number);
        
    }

    public function sendProjectManagerNotificationMail($mail_title, $recipiant_name, $body, $to)
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
