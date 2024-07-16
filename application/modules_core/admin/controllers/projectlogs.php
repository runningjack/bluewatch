<?php

#ini_set('display_errors', '1');
#ini_set('display_startup_errors', '1');
#error_reporting(E_ALL);

//
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Projectlogs extends MX_Controller
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
         $this->load->model('departmentmodel');
        /*  $this->load->model('subunitmodel');
          $this->load->model('reportmodel');*/
        $this->load->model('projectbudgetmodel');
        $this->load->model('settingsmodel');
        $this->load->model('utitlitymodel');
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

    public function offices()
    {
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    public function timelogbydepartmentexcel()
    {
 

         $project_select = $this->projectbudgetmodel->getAllprojectIndexed();
         $departments = $this->departmentmodel->getAllHrDepartment();

       //  var_dump($_SESSION['department_project_log']); exit; 
         $department_project_log = array();
       


            ob_start();

            header("Pragma: public");

            header("Cache-Control: no-store, no-cache, must-revalidate");

            header("Cache-Control: pre-check=0, post-check=0, max-age=0");

            header("Pragma: no-cache");

            header("Expires: 0");

            header("Content-Transfer-Encoding: none");

            header("Content-Type: application/vnd.ms-excel;");

            header("Content-type: application/x-msexcel");

            header("Content-Disposition: attachment; filename=Department Activity Log" . ".xls");

            //out put the table body
            echo "<table border='1'>";
            echo "<tbody>";

            $department_project_log =  $_SESSION['department_project_log'] ;
 
            $data['department_project_log'] = $department_project_log;
            $data['project_select'] = $project_select;
            $data['departments'] = $departments;
           // var_dump($data['department_project_log']);exit; 

            $this->load->view('timelogbydepartmentexcel', $data);

            echo "</tbody>";
            $ExcelData = ob_get_contents();
            ob_end_clean();
            echo $ExcelData;
                 
    }


    public function timelogbydepartment()
    {
    	 $project_select = $this->projectbudgetmodel->getAllprojectIndexed();
         $departments = $this->departmentmodel->getAllHrDepartment();

        // var_dump($_POST);//exit; 
         $department_project_log = array();
         if($_POST)
         {
            $depart_id = $_POST['department'];
            $_SESSION['depart_id'] = $depart_id;
            foreach ($project_select as $key => $value) 
            {
                   $department_project_log[$value->id] = $this->settingsmodel->logByProjectGroupWeeks($depart_id,$value->id);
            }
         }
          
       
    	$_SESSION['department_project_log']  = $department_project_log;
        $data['department_project_log'] = $department_project_log;

        $data['project_select'] = $project_select;
        $data['departments'] = $departments;

        $this->load->view('header');
        $this->load->view('timelogbydepartment', $data);
        $this->load->view('footer');
    }

    public function index()
    {
        $data['id'] = $id;
        $this->load->view('header');
        $this->load->view('test', $data);
        $this->load->view('footer');
    }

    public function tasks()
    {
        $this->load->view('header');
        $user_id = $_SESSION['login_detal']->id;
        //exit;

        $project_select = $this->settingsmodel->getProject();

        $this->crud->columns('project_id', 'task_name', 'task_description');
        $this->crud->required_fields('task_name', 'project_id');
        $this->crud->display_as('task_name', 'Task Name')
            ->display_as('project_id', 'Project Name')
            ->display_as('task_description', 'Describe Task');

        $this->crud->where('task_owner', $user_id);
        $this->crud->field_type('task_owner', 'hidden', $user_id);
        $this->crud->set_subject('Project Task');
        $this->crud->field_type('project_id', 'dropdown', $project_select);
        $this->crud->set_relation('project_id', 'projects', 'name');

        //$this->crud->unset_delete();
        //$this->crud->unset_edit();
        //$this->crud->unset_clone();

        $this->crud->set_table('tasks');

        $output = $this->crud->render();
        $output->extra = '<h3>Project Task Manager</h3>';
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function activities()
    {
        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $employee_id = $_SESSION['login_detal']->id;
        //$data['user_proj_list'] = $this->settingsmodel->getTeamProject($employee_id);

        $data['calendar'] = $this->showCalendar(date('Y'), date('m'));
        $this->load->view('activitieslogs', $data);
        $this->load->view('footer');
    }

    public function showCalendar($year, $month)
    {
        $prefs['template'] = '

        {table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{next_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td>{/cal_cell_start_other}

        {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
';

        $prefs = array(
            'start_day' => 'monday',
            'month_type' => 'long',
            'day_type' => 'short',
            'show_other_days' => true,
            'show_next_prev' => true,
        );

        $prefs['template'] = array(
            'heading_previous_cell' => '<th class="prev_sign"><a href="javascript:void(0);" onclick="prevMonth()">&lt;&lt;</a>',
            'heading_next_cell' => '<th class="next_sign"><a href="javascript:void(0);" onclick="nextMonth()">&gt;&gt;</a>',
            'cal_cell_start_today' => '<td class="today">',
            'cal_cell_start_other' => '<td class="other-month">'
        );
        $this->load->library('calendar', $prefs);

        return $this->calendar->generate($year, $month);
    }

    public function newMonth()
    {
        if ($_POST) {
            $curr_date = preg_split('@[\s+　]@u', trim($_POST['curr_date']));
            //var_dump($curr_date);exit();
            $year = intval($curr_date[1]);
            $month = (string) $curr_date[0];
            $date = date_parse($month);
            $month = intval($date['month']);
            if ($_POST['status'] == 'next') {
                $year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));
                $month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
            } elseif ($_POST['status'] == 'prev') {
                $year = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
                $month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
            }

            //var_dump($year.'-'.$month);exit();
            $response = $this->showCalendar($year, $month);
            echo json_encode($response);
        }
    }

    public function logNewActivities()
    {
        $data['user_id'] = $_SESSION['login_detal']->id;
        $employee_id = $_SESSION['login_detal']->employee_id;
        // var_dump($employee_id);exit;
        $mon = new DateTime($_POST['week']);
        $convertedDate = date('Y-m-d', strtotime('Sunday this week', strtotime($_POST['week'])));
        $sun = new DateTime($convertedDate);

        $firstDay = $mon->format('Y-m-d');
        $lastDay = $sun->format('Y-m-d');

        //var_dump($firstDay);exit;
        $currlastDay = date('Y-m-d', strtotime('Sunday this week', strtotime(date('Y-m-d'))));
        $convertedwks = date('Y-m-d', strtotime('Monday -2 weeks', strtotime(date('Y-m-d'))));
        $yesterday = date('Y-m-d', (strtotime('-1 day', strtotime(date('Y-m-d')))));
        //  echo '..........';
        $isdateValid = $this->isWeekend($yesterday);

        //  echo '..........';exit;
        //  var_dump($isdateValid);exit;

        // if ($convertedwks <= date('Y-m-d', strtotime($_POST['week'])) && $currlastDay >= date('Y-m-d', strtotime($_POST['week']))) {
        if ($isdateValid) {

            //if ($currlastDay >= date('Y-m-d', strtotime($_POST['week']))) {


            /*$date = new DateTime($_POST['week']);
        $mon->modify('Last Monday');
        $sun->modify('Next Sunday');
        if ($date->format('N') == 1) {
            $firstDay = date('Y-m-d');
        } else {
            $firstDay = $mon->format('Y-m-d');
        }

        if ($date->format('N') == 7) {
            $lastDay = date('Y-m-d');
        } else {
            $lastDay = $sun->format('Y-m-d');
        }*/

            // $data = $this->settingsmodel->getTeamProjectlogTest($employee_id, $firstDay, $lastDay);
            $data = $this->settingsmodel->GetResourceProject($employee_id);
            //$task = array(array('id'=> 1, 'task_name'=> 'one'), array('id'=> 2, 'task_name'=> 'two'));
            //var_dump($data);exit;

            if (!empty($data)) {

                $html = '<thead>';
                $html .= '<th></th>';
                foreach ($data as $value) {
                    //  var_dump($data);exit;
                    // if($value->task_id > 0)
                    {
                        $project_arr[] = $value->id;
                        $html .= '<th>' . $value->name . '<input type="hidden" name="projectID[]" value="' . $value->project_id . '"></th>';
                    }
                }
                $html .= '<th>Hours left</th><th>Total hours</th>';
                $html .= '</thead><tbody>';
                for ($i = 1; $i < 2; ++$i) {
                    $wk_status = '';
                    $date = new DateTime($yesterday);
                    $date->modify('+' . $i . 'day');
                    $loopdate = $date->format('Y-m-d');
                    $day_status = $this->isWeekend($loopdate);



                    if ($day_status || $loopdate > date('Y-m-d')) {
                        $wk_status = 'disabled';
                    } else {
                        $wk_status = '';
                    }



                    $date = new DateTime($yesterday);
                    $date->modify('+' . $i . 'day');
                    $loopdate = $date->format('d/m/Y');
                    $day_status = $this->isWeekend($loopdate);
                    // var_dump($day_status);
                    $html .= '<tr>';
                    //if($day_status)$html .= '<td>'.$day_status.'</td>';
                    $sum = 0;
                    $html .= '<td>' . $yesterday . '</td>';
                    foreach ($data as $value) {
                        ///  var_dump($value);exit;
                        $project_id = $project_arr[$i];
                        //var_dump($employee_id, $value->team_project_id,$loopdate);exit;
                        $date = new DateTime($yesterday);
                        $date->modify('+' . $i . 'day');
                        $format_date = $date->format('Y-m-d');


                        $single_rec = $this->settingsmodel->getsingleline($employee_id, $value->project_id, $yesterday);

                        $project_role = $this->settingsmodel->GetProjectRole($value->project_id, $employee_id);
                        //var_dump($project_role);exit;
                        $task = $this->settingsmodel->project_role_task($project_role[0]->project_role_id);

                        //$task = $this->settingsmodel->getStaffActivityProjectTaskDetailed($value->team_project_id, $employee_id);
                        //var_dump($task);//exit;project_role_task
                        $taskoption = '<option>--Select Task---</option>';
                        if (!empty($task)) {
                            foreach ($task as $tsk) {

                                $taskoption .= '<option value="' . $tsk->task_id . '">' . $tsk->task_name . '</option>';
                            }
                        }
                        // var_dump($single_rec);exit;
                        $sum = $sum + $single_rec->hours;
                        if ($taskoption != "") {
                            $html .= '<td><input ' . $wk_status . ' type="number" name="' . $yesterday . '[hour][]" onblur="checkSumHour(this)" onchange="checkSumHour(this)" onkeydown="checkSumHour(this)" onpaste="checkSumHour(this)" oninput="checkSumHour(this)" value="' . $single_rec->hours . '" min="0"  max="24" class="' . $yesterday . '" /><select name="' . $yesterday . '[task][]" class="" style="height:21px;" ' . $wk_status . '>' . $taskoption . '</select></td>';
                        }
                    }
                    if ($sum > 0) {
                        $sum = $sum;
                        $time_left = 24 - $sum;
                    } else {
                        $sum = 24;
                        $time_left = 0;
                    }
                    $html .= '<td class="hoursleft">' . $time_left . '</td>';
                    $html .= '<td class="totalhour">' . $sum . '</td>';
                    $html .= '</tr>';
                }
            } else {
                $hmtl = '';
            }
        } else {
            $hmtl = '';
        }

        //die("222");

        echo json_encode($html);
    }

    public function isWeekend($dt)
    {
        $dt1 = strtotime($dt);
        $dt2 = date("l", $dt1);
        $dt3 = strtolower($dt2);
        if (($dt3 == "saturday") || ($dt3 == "sunday")) {
            return 1;
        } else {
            return 0;
        }
    }

    public function saveNewLogActivities()
    {

        //  var_dump($_POST);exit;
        $resp = $this->settingsmodel->insert_activity($_POST);

        //$resp = true;
        if ($resp) {
            $this->submitactivity($_POST["projectID"]);
        }

        echo json_encode($resp);
    }

    public function saveteamLeadReviewLogActivities()
    {
        //var_dump($_POST);exit;
        $resp = $this->settingsmodel->save_teamlead_activity($_POST);
        //$resp = true;
        if ($resp) {
            $this->submitactivityreviewteamlead($_POST["projectID"], $_POST["userId"], $_POST["dateRange"]);
        }

        echo json_encode($resp);
    }

    public function saveReviewLogActivities()
    {
        //var_dump($_POST);
        $resp = $this->settingsmodel->save_activity($_POST);
        //$resp = true;
        if ($resp) {
            $this->submitactivityreviewprojmanager($_POST["projectID"], $_POST["userId"], $_POST["dateRange"]);
        }

        echo json_encode($resp);
    }

    public function savecdoReviewLogActivities()
    {
        // var_dump($_POST);exit;
        $resp = $this->settingsmodel->save_cdo_activity($_POST);
        // $resp = true;
        if ($resp) {
            $this->submitactivityreviewcdo($_POST["projectID"], $_POST["userId"], $_POST["dateRange"]);
        }

        echo json_encode($resp);
    }

    public function editactivity($id)
    {
        $log_id = $id;
        $data['id'] = $id;
        $data['log_details'] = $this->settingsmodel->getsinglelog($log_id);

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->id);

        $this->load->view('editactivitieslog', $data);
        $this->load->view('footer');
    }

    public function activityteamlead()
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
        // var_dump($_SESSION['login_detal']);exit;

        $data['results'] = $this->utitlitymodel->getteamleadproject($_SESSION['login_detal']->id);

        $this->load->view('header');
        $this->load->view('viewprojectactivityteamlead', $data);
        $this->load->view('footer');
    }

    // public function activityteamlead()
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
    //     // var_dump($_SESSION['login_detal']);exit;
    //     $this->db = $this->load->database('default', true);
    //     $this->load->library('pagination');
    //     $config['base_url'] = base_url().'admin/users';
    //     $config['total_rows'] = $this->utitlitymodel->getemployeetimelogcount($_SESSION['login_detal']->id); // $this->db->count_all('users');
    //     $config['per_page'] = '50';
    //     $config['full_tag_open'] = '<p>';
    //     $config['full_tag_close'] = '</p>';
    //     $config['uri_segment'] = 4;

    //     $this->pagination->initialize($config);
    //     $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;
    //     //load the model and get results
    //     $this->load->model('usersmodel');
    //     $data['results'] = $this->utitlitymodel->gettimelogteamlead($config['per_page'], $page, $_SESSION['login_detal']->id);

    //     $data['links'] = $this->pagination->create_links();

    //     $this->load->view('header');
    //     $this->load->view('activityteamlead', $data);
    //     $this->load->view('footer');
    // }

    public function activityteamprojmanagerbk()
    {
        $data['results'] = $this->utitlitymodel->getprojectsprojmanager($_SESSION['login_detal']->id);

        $this->load->view('header');
        $this->load->view('activityprojectmanager', $data);
        $this->load->view('footer');
    }

    public function activitycdo()
    {
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();

        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/users';
        $config['total_rows'] = $this->utitlitymodel->getprojectscdocount(); // $this->db->count_all('users');
        $config['per_page'] = '1000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;  //echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->utitlitymodel->getprojectscdo($config['per_page'], $page);

        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('activitycdo', $data);
        $this->load->view('footer');
    }

    public function activitylog()
    {
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();

        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/users';
        $config['total_rows'] = $this->utitlitymodel->getprojectscdocount(); // $this->db->count_all('users');
        $config['per_page'] = '1000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;  //echo $page;exit;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->utitlitymodel->getprojectscdo($config['per_page'], $page);

        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('activityfinance.php', $data);
        $this->load->view('footer');
    }

    public function projectmanagerreviewprojecttimelog($id)
    {
        $data['project_id'] = $id;
        $data['projectID'] = $id;
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();

        $data['results'] = $this->utitlitymodel->getemprojectmemebertimelog($_SESSION['login_detal']->id, $id);

        $this->load->view('header');
        $this->load->view('activityprojectmembertimelogproj', $data);
        $this->load->view('footer');
    }

    public function teamleadreviewprojecttimelog($id)
    {

        $data['task_status'] = $this->settingsmodel->taskStatus();
        $data['results'] = $this->utitlitymodel->getteamleadprojectmembers($_SESSION['login_detal']->id, $id);

        $this->load->view('header');
        $this->load->view('activityprojectmembertimelog', $data);
        $this->load->view('footer');
    }

    public function projectmanagerviewproject()
    {
        $data['task_status'] = $this->settingsmodel->taskStatus();

        $data['results'] = $this->utitlitymodel->projectmanagerviewproject($_SESSION['login_detal']->id);

        $this->load->view('header');
        $this->load->view('viewprojectactivityprojmanager', $data);
        $this->load->view('footer');
    }

    public function cdoviewproject()
    {
        $data['task_status'] = $this->settingsmodel->taskStatus();

        $data['results'] = $this->utitlitymodel->cdoviewproject();

        $this->load->view('header');
        $this->load->view('viewprojectactivitycdo', $data);
        $this->load->view('footer');
    }

    public function reviewallprojecttimelog($id)
    {
        if (!isset($id)) {
            die('Invalid request');
        }
        $data['project_id'] = $id;
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();

        $data['results'] = $this->utitlitymodel->getcdoprojectmemebertimelog($id);

        $this->load->view('header');
        $this->load->view('activitycdomembertimelog', $data);
        $this->load->view('footer');
    }

    public function financereviewprojecttimelog($id)
    {
        if (!isset($id)) {
            die('Invalid request');
        }
        $data['project_id'] = $id;
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();

        $data['results'] = $this->utitlitymodel->getfinanceprojectmemebertimelog($id);

        $this->load->view('header');
        $this->load->view('activityfinancemembertimelog', $data);
        $this->load->view('footer');
    }

    public function reviewlogActivities()
    {
        $data['user_id'] = $_SESSION['login_detal']->id;
        $employee_id = $_SESSION['login_detal']->id;

        if (!empty($_POST['date_range'])) {
            extract($_POST);
            if ($state == 'next') {

                $dates = explode(',', $date_range);
                $startdate = new DateTime((string)$dates[0]);
                $startdate->modify('+7 day');
                $firstDay = $startdate->format('Y-m-d');

                $enddate = new DateTime((string)$dates[1]);
                $enddate->modify('+7 day');
                $lastDay = $enddate->format('Y-m-d');
            } else {

                $dates = explode(',', $date_range);
                $startdate = new DateTime((string)$dates[0]);
                $startdate->modify('-7 day');
                $firstDay = $startdate->format('Y-m-d');

                $enddate = new DateTime((string)$dates[1]);
                $enddate->modify('-7 day');
                $lastDay = $enddate->format('Y-m-d');
            }
        } else {

            $mon = new DateTime();
            $sun = new DateTime();
            $date = new DateTime();
            $mon->modify('Last Monday');
            $sun->modify('Next Sunday');
            if ($date->format('N') == 1) {
                $firstDay = date('Y-m-d');
            } else {
                $firstDay = $mon->format('Y-m-d');
            }

            if ($date->format('N') == 7) {
                $lastDay = date('Y-m-d');
            } else {
                $lastDay = $sun->format('Y-m-d');
            }
        }
        //getTeamProjectlogByProjectId



        $data = $this->settingsmodel->getTeamProjectlog($_POST['member_id'], $firstDay, $lastDay);


        //   var_dump($data);exit;
        $countproject = count($data);
        $html = '<thead>';
        $html .= '<th></th>';
        foreach ($data as $value) {
            $edit = '';
            if ($employee_id == $value->team_lead) {
                $edit = '<input type="hidden" name="projectID[]" value="' . $value->team_project_id . '">';
            }
            $html .= '<th>' . $value->name . '' . $edit . '</th>';
        }
        $html .= '<th>Hours left</th><th>Total hours</th>';
        $html .= '</thead><tbody>';

        for ($i = 0; $i < 7; ++$i) {
            $date = new DateTime($firstDay);
            $date->modify('+' . $i . 'day');
            $loopdate = $date->format('d/m/Y');
            $loopdate1 = $date->format('Y-m-d');

            $html .= '<tr>';
            $html .= '<td>' . $loopdate . '</td>';
            $datelog = $this->settingsmodel->getmemberprojecttimelog($_POST['member_id'], $loopdate1);
            $sumHours = 0;
            $l = 0;
            foreach ($data as $value) {
                // var_dump($data[0]->team_project_id);exit;
                $project_id = $data[$l]->team_project_id;
                $datelog = $this->settingsmodel->getmemberprojecttimelogByProjectId($project_id, $_POST['member_id'], $loopdate1);
                $sumHours += intval($datelog[0]->hours);
                if ($datelog[0]->hours > 0) {
                    $html .= '<td class="center">' . $datelog[0]->hours . ' (' . $datelog[0]->project_task . ')</td>';
                } else {
                    $html .= '<td class="center">&nbsp;</td>';
                }
                $l++;
            }


            /* if ($datelog) {

                 foreach ($datelog as $row) {
                     $sumHours += intval($row->hours);
                     $html .= '<td class="center">' . $row->hours . ' (' . $row->project_task . ')</td>';
                 }
                
            } else {
                foreach ($data as $value) {
                    $html .= '<td class="center">***&nbsp;</td>';
                }
            }*/



            $html .= '<td>' . (24 - $sumHours) . '</td>';
            $html .= '<td>' . $sumHours . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tr><td>&nbsp;</td>';
        $dateRange = $firstDay . ',' . $lastDay;
        $sumhours = 0;
        foreach ($data as $value) {
            $totalproj = $this->settingsmodel->totalhours($_POST['member_id'], $value->team_project_id, $firstDay, $lastDay);
            $teamLeadhour = $this->settingsmodel->getteamleadhours($_POST['member_id'], $value->team_project_id, $dateRange);
            $edit = '<input type="hidden" name="otherteamLeadhour[]" value="' . $totalproj['hours'] . '">';
            $class = 'otherProj';
            $dbhour = '';
            $dbcomment = '';
            if (!empty($teamLeadhour)) {
                $dbhour = $teamLeadhour['teamlead_hour'];
                $dbcomment = $teamLeadhour['teamlead_comment'];
                if (empty($dbhour)) {
                    $sumhours += intval($totalproj['hours']);
                } else {
                    $sumhours += intval($dbhour);
                }
                $updatevalue = '<input type="hidden" name="updateproject[]" value="' . $value->team_project_id . '">';
            } else {
                $sumhours += intval($totalproj['hours']);
                $updatevalue = '';
            }

            if ($employee_id == $value->team_lead) {
                $edit = 'Hours: <br/><input type="number" name="teamLeadhour[]" onblur="SumHour(this)" onchange="SumHour(this)" onkeydown="SumHour(this)" onpaste="SumHour(this)" oninput="SumHour(this)" class="teamLeadhour" value="' . $dbhour . '"><br/><br/>Comment:<br/><textarea name="teamLeadcomment[]">' . $dbcomment . '</textarea>' . $updatevalue;
                $class = '';
            }

            $html .= '<td class="' . $class . '"><p>' . $totalproj['hours'] . '</p> <br/>' . $edit . '</td>';
        }
        $totalhours = $this->settingsmodel->totalprojhours($_POST['member_id'], $firstDay, $lastDay);
        $html .= '<td class="hoursleft">' . ((24 * 7) - intval($totalhours['hours'])) . '&nbsp;&nbsp;<span class="projhoursleft">' . ((24 * 7) - $sumhours) . '</span></td>';
        $html .= '<td class="totalhour">' . $totalhours['hours'] . '&nbsp;&nbsp;<span class="projtotalhour">' . $sumhours . '</span></td>';
        $html .= '</tr>';

        echo json_encode(array('content' => $html, 'user_id' => $_POST['member_id'], 'dateRange' => $dateRange));
    }

    public function projmanagerreviewlogActivities()
    {
        $data['user_id'] = $_SESSION['login_detal']->id;
        $employee_id = $_SESSION['login_detal']->id;

        if (!empty($_POST['date_range'])) {
            extract($_POST);
            if ($state == 'next') {

                $dates = explode(',', $date_range);
                $startdate = new DateTime((string)$dates[0]);
                $startdate->modify('+7 day');
                $firstDay = $startdate->format('Y-m-d');

                $enddate = new DateTime((string)$dates[1]);
                $enddate->modify('+7 day');
                $lastDay = $enddate->format('Y-m-d');
            } else {

                $dates = explode(',', $date_range);
                $startdate = new DateTime((string)$dates[0]);
                $startdate->modify('-7 day');
                $firstDay = $startdate->format('Y-m-d');

                $enddate = new DateTime((string)$dates[1]);
                $enddate->modify('-7 day');
                $lastDay = $enddate->format('Y-m-d');
            }
        } else {

            $mon = new DateTime();
            $sun = new DateTime();
            $date = new DateTime();
            $mon->modify('Last Monday');
            $sun->modify('Next Sunday');
            if ($date->format('N') == 1) {
                $firstDay = date('Y-m-d');
            } else {
                $firstDay = $mon->format('Y-m-d');
            }

            if ($date->format('N') == 7) {
                $lastDay = date('Y-m-d');
            } else {
                $lastDay = $sun->format('Y-m-d');
            }
        }

        $data = $this->settingsmodel->getTeamProjectlog($_POST['member_id'], $firstDay, $lastDay);
        //var_dump($_POST);exit;
        if ($_POST['projectID'] != "") {
            $data = $this->settingsmodel->getTeamProjectlogByProjectId($_POST['projectID'], $_POST['member_id'], $firstDay, $lastDay);
        } else {
            $data = $this->settingsmodel->getTeamProjectlog($_POST['member_id'], $firstDay, $lastDay);
        }

        $countproject = count($data);
        $html = '<thead>';
        $html .= '<th></th>';
        foreach ($data as $value) {
            $edit = '';
            if ($employee_id == $value->project_manager) {
                $edit = '<input type="hidden" name="projectID[]" value="' . $value->team_project_id . '">';
            }
            $html .= '<th>' . $value->name . '' . $edit . '</th>';
        }
        $html .= '<th>Hours left</th><th>Total hours</th>';
        $html .= '</thead><tbody>';
        for ($i = 0; $i < 7; ++$i) {
            $date = new DateTime($firstDay);
            $date->modify('+' . $i . 'day');
            $loopdate = $date->format('d/m/Y');
            $loopdate1 = $date->format('Y-m-d');

            $html .= '<tr>';
            $html .= '<td>' . $loopdate . '</td>';
            $datelog = $this->settingsmodel->getmemberprojecttimelog($_POST['member_id'], $loopdate1);
            $sumHours = 0;

            $current_task_done = $this->settingsmodel->getmemberprojecttimelogByProject($_POST['member_id'], $loopdate1, $value->project_id);
            // var_dump($current_task_done);exit;
            if ($current_task_done) {
                $html .= '<td class="center"><table class="table table-bordered">
                 <thead><tr><th>Task</th><th>Hrs</th><th>Approved Hrs</th><th>Approve</th> <th>Proj Mgr Status</th></tr><thead>
                 <tbody>
                 ';
                foreach ($current_task_done as $row) {
                    //var_dump($row);
                    if ($row->project_manager_status) {
                        $proj_mgr_status = "A";
                        $checked = "checked";
                    } else {
                        $checked = "";
                        $proj_mgr_status = "N";
                    }
                    $sumHours += intval($row->hours);
                    $html .= '<tr><td>' . $row->project_task . '</td>';
                    $html .= '<td>' . $row->hours . '</td>';
                    $html .= '<td><input style="width: 50px;" type="number" width="2" name="approved_hour_id[' . $row->activity_id . ']" value="' . $row->hours . '" min="0"></td>';
                    $html .= '<td><input type="checkbox" ' . $checked . ' name="approved_task_id[]" value="' . $row->activity_id . '"></td>';

                    $html .= '<td>' . $proj_mgr_status . '</td>';

                    $html .= '</tr>';
                    // $html .= $row->hours ;                       
                }
                $html .= '</tboad></table></td>';
            } else {
                // foreach ($data as $value) {
                $html .= '<td class="center">&nbsp;</td>';
                // }
            }

            // if ($datelog) {
            //     foreach ($datelog as $row) {
            //         $sumHours += intval($row->hours);
            //         $html .= '<td class="center">' . $row->hours . ' (' . $row->project_task . ')</td>';
            //     }
            // } else {
            //     foreach ($data as $value) {
            //         $html .= '<td class="center">&nbsp;</td>';
            //     }
            // }



            $html .= '<td>' . (24 - $sumHours) . '</td>';
            $html .= '<td>' . $sumHours . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tr><td>&nbsp;</td>';
        $dateRange = $firstDay . ',' . $lastDay;
        $sumhours = 0;
        $teamsumhours = 0;
        foreach ($data as $value) {
            $totalproj = $this->settingsmodel->totalhours($_POST['member_id'], $value->team_project_id, $firstDay, $lastDay);
            $projManagerhour = $this->settingsmodel->getprojmanagerhours($_POST['member_id'], $value->team_project_id, $dateRange);

            $edit = '<input type="hidden" name="otherprojManagerhour[]" value="' . $totalproj['hours'] . '">';
            $class = 'otherProj';
            $dbhour = '';
            $teamdbhour = '';
            $dbcomment = '';
            if (!empty($projManagerhour)) {
                $dbhour = $projManagerhour['project_manager_hour'];
                $dbcomment = $projManagerhour['project_manager_comment'];
                $teamdbhour = $projManagerhour['teamlead_hour'];
                if (empty($dbhour)) {
                    $sumhours += intval($totalproj['hours']);
                } else {
                    $sumhours += intval($dbhour);
                }

                if (empty($teamdbhour)) {
                    $teamsumhours += intval($totalproj['hours']);
                    $teamdbhour = '-';
                } else {
                    $teamsumhours += intval($teamdbhour);
                }

                $updatevalue = '<input type="hidden" name="updateproject[]" value="' . $value->team_project_id . '">';
            } else {
                $sumhours += intval($totalproj['hours']);
                $teamsumhours += intval($totalproj['hours']);
                $updatevalue = '';
            }

            if ($employee_id == $value->team_project_manager) {
                $edit = 'Hour: <br/><input type="number" name="projManagerhour[]" onblur="SumHour(this)" onchange="SumHour(this)" onkeydown="SumHour(this)" onpaste="SumHour(this)" oninput="SumHour(this)" class="projManagerhour" value="' . $dbhour . '"><br/><br/>Comment:<br/><textarea name="projManagercomment[]">' . $dbcomment . '</textarea>' . $updatevalue;
                $class = '';
            }

            $html .= '<td class="' . $class . '"><p><span class="userhour">' . $totalproj['hours'] . '</span>&nbsp;&nbsp<span class="teamhour">' . $teamdbhour . '</span>&nbsp;&nbsp<span class="projhour">' . $dbhour . '</span></p>' . $edit . '</td>';
        }
        $totalhours = $this->settingsmodel->totalprojhours($_POST['member_id'], $firstDay, $lastDay);
        $html .= '<td class="hoursleft">' . ((24 * 7) - intval($totalhours['hours'])) . '&nbsp;&nbsp;<span class="teamhoursleft">' . ((24 * 7) - $teamsumhours) . '</span>&nbsp;&nbsp;<span class="projhoursleft">' . ((24 * 7) - $sumhours) . '</span></td>';
        $html .= '<td class="totalhour">' . $totalhours['hours'] . '&nbsp;&nbsp;<span class="teamtotalhour">' . $teamsumhours . '</span>&nbsp;&nbsp;<span class="projtotalhour">' . $sumhours . '</span></td>';
        $html .= '</tr>';

        echo json_encode(array('content' => $html, 'user_id' => $_POST['member_id'], 'dateRange' => $dateRange));
    }

    public function cdoreviewlogActivities()
    {
        $data['user_id'] = $_SESSION['login_detal']->id;
        $employee_id = $_SESSION['login_detal']->id;

        $mon = new DateTime();
        $sun = new DateTime();
        $date = new DateTime();
        $mon->modify('Last Monday');
        $sun->modify('Next Sunday');
        if ($date->format('N') == 1) {
            $firstDay = date('Y-m-d');
        } else {
            $firstDay = $mon->format('Y-m-d');
        }

        if ($date->format('N') == 7) {
            $lastDay = date('Y-m-d');
        } else {
            $lastDay = $sun->format('Y-m-d');
        }

        $data = $this->settingsmodel->getTeamProjectlog($_POST['member_id'], $firstDay, $lastDay);
        $countproject = count($data);
        $project_list = $data;
        //var_dump($project_list);exit;
        $html = '<thead>';
        $html .= '<th></th>';
        foreach ($data as $value) {
            $edit = '<input type="hidden" name="projectID[]" value="' . $value->project_id . '">';

            $html .= '<th>' . $value->name . '' . $edit . '</th>';
        }
        $html .= '<th>Hours left</th><th>Total hours</th>';
        $html .= '</thead><tbody>';
        for ($i = 0; $i < 7; ++$i) {
            $date = new DateTime($firstDay);
            $date->modify('+' . $i . 'day');
            $loopdate = $date->format('d/m/Y');
            $loopdate1 = $date->format('Y-m-d');

            $html .= '<tr>';
            $html .= '<td>' . $loopdate . '</td>';
            $datelog = $this->settingsmodel->getmemberprojecttimelog($_POST['member_id'], $loopdate1);
            $sumHours = 0;
            foreach ($project_list as $value) {
                //loop through projects
                $current_task_done = $this->settingsmodel->getmemberprojecttimelogByProject($_POST['member_id'], $loopdate1, $value->project_id);

                if ($current_task_done) {
                    $html .= '<td class="center"><table class="table table-bordered">
                    <thead><tr><th>Task</th><th>Hrs</th><th>Approved Hrs</th><th>Approve</th> <th>Proj Mgr Status</th></tr><thead>
                    <tbody>
                    ';
                    foreach ($current_task_done as $row) {
                        //var_dump($row);
                        if ($row->project_manager_status) {
                            $proj_mgr_status = "A";
                            $checked = "checked";
                        } else {
                            $checked = "";
                            $proj_mgr_status = "N";
                        }
                        $sumHours += intval($row->hours);
                        $html .= '<tr><td>' . $row->project_task . '</td>';
                        $html .= '<td>' . $row->hours . '</td>';
                        $html .= '<td>
                        <input   type="hidden"   name="approved_hour_arr[]"  value="' . $row->activity_id . '" min="0">
                        <input style="width: 50px;" type="number" width="2" class="approved_hour_id" name="approved_hour_id[]" record_index="' . $row->activity_id . '" value="' . $row->hours . '" min="0"></td>';
                        $html .= '<td><input type="checkbox" ' . $checked . ' name="approved_task_id[]" value="' . $row->activity_id . '"></td>';

                        $html .= '<td>' . $proj_mgr_status . '</td>';

                        $html .= '</tr>';
                        // $html .= $row->hours ;                       
                    }
                    $html .= '</tboad></table></td>';
                } else {
                    // foreach ($data as $value) {
                    $html .= '<td class="center">&nbsp;</td>';
                    // }
                }

                //      if ($datelog) {
                //     foreach ($datelog as $row) {
                //         $sumHours += intval($row->hours);
                //         $html .= '<td class="center">' . $row->hours . ' (' . $row->project_task . ')*</td>';
                //     }
                // }

                // else {
                //     foreach ($data as $value) {
                //         $html .= '<td class="center">&nbsp;</td>';
                //     }
                // }


            }





            $html .= '<td>' . (24 - $sumHours) . '</td>';
            $html .= '<td>' . $sumHours . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tr><td>&nbsp;</td>';
        $dateRange = $firstDay . ',' . $lastDay;
        $sumhours = 0;
        $projsumhours = 0;
        $teamsumhours = 0;
        foreach ($data as $value) {
            $totalproj = $this->settingsmodel->totalhours($_POST['member_id'], $value->team_project_id, $firstDay, $lastDay);
            $projManagerhour = $this->settingsmodel->getcdohours($_POST['member_id'], $value->team_project_id, $dateRange);
            $edit = '<input type="hidden" name="otherprojManagerhour[]" value="' . $totalproj['hours'] . '">';
            $class = 'otherProj';
            $dbhour = '';
            $projdbhour = '';
            $teamdbhour = '';
            $dbcomment = '';
            if (!empty($projManagerhour)) {
                $dbhour = $projManagerhour['cdo_hour'];
                $dbcomment = $projManagerhour['cdo_comment'];
                $projdbhour = $projManagerhour['project_manager_hour'];
                $teamdbhour = $projManagerhour['teamlead_hour'];
                if (empty($dbhour)) {
                    $sumhours += intval($totalproj['hours']);
                } else {
                    $sumhours += intval($dbhour);
                }
                if (empty($projdbhour)) {
                    $projsumhours += intval($totalproj['hours']);
                    $projdbhour = '-';
                } else {
                    $projsumhours += intval($projdbhour);
                }

                if (empty($teamdbhour)) {
                    $teamsumhours += intval($totalproj['hours']);
                    $teamdbhour = '-';
                } else {
                    $teamsumhours += intval($teamdbhour);
                }
                $updatevalue = '<input type="hidden" name="updateproject[]" value="' . $value->team_project_id . '">';
            } else {
                $sumhours += intval($totalproj['hours']);
                $projsumhours += intval($totalproj['hours']);
                $teamsumhours += intval($totalproj['hours']);
                $updatevalue = '';
            }
            if (empty($projdbhour)) {
                $projdbhour = '-';
            }

            if (empty($teamdbhour)) {
                $teamdbhour = '-';
            }
            if ($_SESSION['login_detal']->group_id == '7') {
                $edit = '';
                if (empty($dbhour)) {
                    $dbhour = '-';
                }
            } else {
                $edit = 'Hour: <br/><input type="number" name="projManagerhour[]" onblur="SumHour(this)" onchange="SumHour(this)" onkeydown="SumHour(this)" onpaste="SumHour(this)" oninput="SumHour(this)" class="projManagerhour" value="' . $dbhour . '"><br/><br/>Comment:<br/><textarea name="projManagercomment[]">' . $dbcomment . '</textarea>' . $updatevalue;
                $class = '';
            }

            $html .= '<td class="' . $class . '"><p><span class="userhour">' . $totalproj['hours'] . '</span>&nbsp;&nbsp<span class="teamhour">' . $teamdbhour . '</span>&nbsp;&nbsp<span class="projhour">' . $projdbhour . '</span>&nbsp;&nbsp<span class="cdofhour">' . $dbhour . '</span></p>' . $edit . '</td>';
        }
        $totalhours = $this->settingsmodel->totalprojhours($_POST['member_id'], $firstDay, $lastDay);
        $html .= '<td class="hoursleft">' . ((24 * 7) - intval($totalhours['hours'])) . '&nbsp;&nbsp;<span class="teamhoursleft">' . ((24 * 7) - $teamsumhours) . '</span>&nbsp;&nbsp;<span class="projhoursleft">' . ((24 * 7) - $projsumhours) . '</span>&nbsp;&nbsp;<span class="cdohoursleft">' . ((24 * 7) - $sumhours) . '</span></td>';
        $html .= '<td class="totalhour">' . $totalhours['hours'] . '&nbsp;&nbsp;<span class="teamtotalhour">' . $teamsumhours . '</span>&nbsp;&nbsp;<span class="projtotalhour">' . $projsumhours . '</span>&nbsp;&nbsp;<span class="cdototalhour">' . $sumhours . '</span></td>';
        $html .= '</tr>';

        echo json_encode(array('content' => $html, 'user_id' => $_POST['member_id'], 'dateRange' => $dateRange));
    }


    public function continueTimelog()
    {

        $all_project = array();

        $employee_id = $_SESSION['login_detal']->id;
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->id);
        $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
        $employee_fullname_useable = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        

        $all_time_log =  $this->settingsmodel->getAllDayTemptLog($employee_id);
        //var_dump($_SESSION['login_detal']->id);exit;
        // var_dump($all_time_log);exit();



        foreach ($all_time_log as $log_time) {
            $day_hourly_summary =  $this->settingsmodel->getSumByDay($employee_id, $log_time->log_date);
            $to_be_hours = $day_hourly_summary[0]->hours + (int)$log_time->hours;
            if ($_SESSION['login_detal']->id == 18) {

            }


            if ($to_be_hours > 16) {

                redirect('admin/projectlogs/multiactivity?error=You can not log more than 16hours in a date ' . $log_time->log_date);
            }
            //var_dump($day_hourly_summary[0]->hours);exit;
            if ($to_be_hours > 16) {

                redirect('admin/projectlogs/multiactivity?error=You can not log more than 16hours in a date ' . $log_time->log_date);
            }

  

            $record = array(
                "employee_id" => $employee_id,
                "project_id" => $log_time->project_id,
                "project_task" => $log_time->project_task,
                "log_date" => $log_time->log_date,
                "hours" => $log_time->hours,
                "comment"=>$log_time->comment
            );
        //      if($_SESSION['login_detal']->id==235)
        // {
        //     var_dump($record);exit;
        // }
         
            $all_project[$log_time->project_id] = $log_time->project_id;
            $project_role = $this->settingsmodel->add_single_activities($record);
         //   var_dump( $record);exit;//abass
        }
     
        //remove all temp logs
      if(count($all_project)>0){
        $projects = $this->settingsmodel->getProjectWIthManagers($all_project);
         // var_dump($all_project);exit;
        foreach($projects as $project)
        {
        	// var_dump($all_project);
         //    var_dump($project->first_name);exit;
            $body = "$employee_fullname  has logged an activity on project $project->name , please log in to your profile to approve.";
            //var_dump($body);exit;
            $subject = 'Activity Log'; 
            $this->sendTeamLeadTimeLogMail($subject, $project->first_name, $body, $project->work_email);

        }
        //var_dump($projects);exit;
        $this->settingsmodel->delete_temp_activity_by_employee($employee_id);
        redirect('admin/projectlogs/activityindex?success=Activity Successfully Loggged');
    }else
    {
        redirect('admin/projectlogs/activityindex?success=No pending log activity');
    }
        //  var_dump($all_time_log);exit;

    }

    public function removecomment()
    {
        //die("*****");
        extract($_POST);
        $employee_id = $_SESSION['login_detal']->id;
        $this->settingsmodel->delete_temp_activity($comment_id);
        $record['all_logs'] = $this->settingsmodel->getTempEmployeelog($employee_id);
       // var_dump($employee_id);exit;
        $display = $this->load->view('log_preview', $record, true);
        $response['display']  = $display;
        echo json_encode($response);
    }

    public function multiactivity()
    {

        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();
        $employee_id = $_SESSION['login_detal']->id; //exit;
        $getCustomers =  $this->settingsmodel->getCustomers();
        $data['customers'] = $getCustomers;


        $data['project_list'] = $this->settingsmodel->GetResourceProject($employee_id);
        //var_dump( $data['project_list']);exit;

        //send success message to view
        if (isset($_SESSION['sucess_message'])) {
            $data['sucess_message'] = $_SESSION['sucess_message'];
        }
        $_SESSION['sucess_message'] = '';

        //send error message to view
        if (isset($_SESSION['message_error'])) {
            $data['message_error'] = $_SESSION['message_error'];
        }


        $data['all_logs'] = $this->settingsmodel->getTempEmployeelog($employee_id);


        $this->load->view('header');
        $this->load->view('multiactivity', $data);
        $this->load->view('footer');
    }


    public function activityteamprojmanager()
    {
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();
        $employee_id = $_SESSION['login_detal']->id; //exit;
      //  var_dump($_SESSION);exit;
        $getCustomers =  $this->settingsmodel->getCustomers();
        $data['customers'] = $getCustomers;
        $data['project_list'] = $this->settingsmodel->getProjectByprojectManager($employee_id);
        //var_dump($data['project_list']);exit;
      
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
        $data['results'] = $this->utitlitymodel->getemployeetimelogGroupBydateByProjectManager($_SESSION['login_detal']->id, $data['project_list']);
      

        $this->load->view('header');
        $this->load->view('projectmanageractivityindex', $data);
        $this->load->view('footer');
    }


    public function update_project_log()
    {
        
        if($_POST)
        {
            extract($_POST); 
            $now = date('Y-m-d H:i:s');
            $record = array(
                "project_manager_comment"=>$mgr_comment,
                "project_manager_status"=>$status,
                "date_approved"=>$now,
                );
                $this->utitlitymodel->update("activities", "activity_id", $record_id, $record);
                
                $project_details = $this->settingsmodel->getTeamByID($project_id);
                $project_manager = $project_details->project_manager;
               

                $emplyee_details = $this->settingsmodel->getEmployeeDetails($employee_id);
              //  var_dump($emplyee_details);exit;
                $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
                $employee_fullname_useable = $employee_fullname;
                $employee_email = $emplyee_details['work_email'];
                $recipiant_name = $employee_fullname;

                $body = "$employee_fullname  Your actitivity log for project  $project_details->name is $status. Please login to review";
                $subject = 'Activity Log'; 
              //  echo $body;
               // var_dump($employee_email);exit;
               
                $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);
       

        }
    }


    public function update_hour_log()
    {
        
        if($_POST)
        {
            extract($_POST); 
            $now = date('Y-m-d H:i:s');
            $response['status'] = true;
            $record = array(
                "hours"=>$hours
                );
                $this->utitlitymodel->update("activities", "activity_id", $record_id, $record);
                
                $project_details = $this->settingsmodel->getTeamByID($project_id);
                $project_manager = $project_details->project_manager;
              //  var_dump($employee_id, $log_date);
                $day_hourly_summary =  $this->settingsmodel->getSumByDay($employee_id, $log_date);
                //var_dump($day_hourly_summary);
                $to_be_hours = $day_hourly_summary[0]->hours + (int)$time;
                if ($_SESSION['login_detal']->id == 18) {
        
                    //    $response['error'] = "Total Hour per day should not be more than 18 hours";
                }
                //    var_dump($to_be_hours);exit;
        
                if ($to_be_hours > 16) {
        
                    $response['status'] = false;
                    $response['error'] = 'You can not log more than 16hours in a date ' . $date;
                    echo json_encode($response);die();
                }
                //var_dump($day_hourly_summary[0]->hours);exit;
                if ($to_be_hours > 16) {
                    $response['status'] = false;
                    $response['error'] = 'You can not log more than 16hours in a date ' . $date;
                    echo json_encode($response);die();
                }

                

                
                $emplyee_details = $this->settingsmodel->getEmployeeDetails($project_manager);
                $project_mg_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
                $project_mg_fullname_useable = $employee_fullname;
                $project_mg_email = $emplyee_details['work_email'];
                $project_mg_name = $employee_fullname;

                $emplyee_details = $this->settingsmodel->getEmployeeDetails($employee_id);
                $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
                $employee_fullname_useable = $employee_fullname;
                $employee_email = $emplyee_details['work_email'];
                $recipiant_name = $employee_fullname;

                $body = "$recipiant_name  has update hourly activity on project  $project_details->name . Hour was change to $hours . Please login to review";
                $subject = 'Activity Log';                 
                $this->sendTeamLeadTimeLogMail($subject, $project_mg_name, $body, $project_mg_email);
                echo json_encode($response);die();
       

        }
    }



    public function activityindex()
    {
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();
        $employee_id = $_SESSION['login_detal']->id; //exit;
        $getCustomers =  $this->settingsmodel->getCustomers();
        $data['customers'] = $getCustomers;


        $data['project_list'] = $this->settingsmodel->GetResourceProject($employee_id);
        //var_dump( $data['project_list']);exit;

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
       // var_dump($_POST);//exit;
        
        $data['results'] = $this->utitlitymodel->getemployeetimelogGroupBydate($_SESSION['login_detal']->id, $data['project_list']);
      

        $this->load->view('header');
        $this->load->view('activityindex', $data);
        $this->load->view('footer');
    }
    
    
    
    
    
    
        
        public function usageReportByDeptData($depart_id,$start_date,$end_date)
    {
    
     
 
        $data['activeUserCount']  = $this->settingsmodel->active_user_count($start_date, $end_date);
        $data['hourly_sum'] = $this->settingsmodel->hourly_sum($start_date, $end_date);
        $data['assign_role'] = $this->settingsmodel->assign_role();
        $data['project_count'] = $this->settingsmodel->project_count();
        $departments = $this->settingsmodel->getAllDepartmentHr();
        $holidays = $this->settingsmodel->get_holidays($start_date,$end_date);
        $holiday_date = array();
       
        $holiday_dates = [];
        foreach ($holidays as $day) {
            $holiday_dates[] = $day->holiday_date;
        }
         
         $holiday_string = $holiday_dates;
        
        $dept = $this->settingsmodel->getDepartByID($depart_id);
 
    $staffNumber = $this->settingsmodel->departmentStaffCount($depart_id);
       //    die($staffNumber) ;
       
       if($holidays)
       {
       
       
    
            $single_record['department'] = $dept;
            $single_record['hours'] = $this->settingsmodel->usablilityCheckLogByDepartRemoveHolidays($depart_id, $start_date, $end_date,$holiday_string)->hours;
            $single_record['approved_hours'] = $this->settingsmodel->usablilityCheckApprovedLogByDepartMinusHoliday($depart_id, $start_date, $end_date,$holiday_string)->hours;
            $single_record['rejectd_hours'] = $this->settingsmodel->usablilityCheckRejectedLogByDepartMinusHoliday($depart_id, $start_date, $end_date,$holiday_string)->hours;
            
            
            $single_record['staff_count'] = $this->settingsmodel->usablilityCheckLogByDepartMinusHoliday($depart_id, $start_date, $end_date,$holiday_string)->staff_count;
            
            $single_record['number_of_days'] = $this->settingsmodel->getNumberofDays($depart_id, $start_date, $end_date,$holiday_string)->number_of_days;
           // var_dump( $single_record['number_of_days']);exit;

            $department_records[] = $single_record;
            $data['number_of_days'] = $single_record['number_of_days'];
   
        
       
       
       }else{
       
        
            $single_record['department'] = $dept;
            $single_record['hours'] = $this->settingsmodel->usablilityCheckLogByDepart($depart_id, $start_date, $end_date)->hours;
            $single_record['approved_hours'] = $this->settingsmodel->usablilityCheckApprovedLogByDepart($depart_id, $start_date, $end_date)->hours;
            $single_record['rejectd_hours'] = $this->settingsmodel->usablilityCheckRejectedLogByDepart($depart_id, $start_date, $end_date)->hours;
            
            
            $single_record['staff_count'] = $this->settingsmodel->usablilityCheckLogByDepart($depart_id, $start_date, $end_date)->staff_count;
           
            $department_records[] = $single_record;
       
        
        }
        // unset($_SESSION['start_date']);
        // unset($_SESSION['end_date']);

        //var_dump($department_records);//exit;
        $data['getAllDepartment'] = $department_records; //$this->settingsmodel->getAllDepartment();

      

        //var_dump($department_records);exit;
        $data['holidays'] = $holidays;
        $data['new_dept'] = $dept;
        $data['staffNumber'] = $staffNumber;

        return $data;
    }
    
    
        public function usageReportByDept($depart_id)
    {
    
     
      
        $start_date = $_SESSION['start_date'];
        $end_date = $_SESSION['end_date'];

        $data['activeUserCount']  = $this->settingsmodel->active_user_count($start_date, $end_date);
        $data['hourly_sum'] = $this->settingsmodel->hourly_sum($start_date, $end_date);
        $data['assign_role'] = $this->settingsmodel->assign_role();
        $data['project_count'] = $this->settingsmodel->project_count();
        $departments = $this->settingsmodel->getAllDepartmentHr();
        $holidays = $this->settingsmodel->get_holidays($start_date,$end_date);
        $holiday_date = array();
       
        $holiday_dates = [];
        foreach ($holidays as $day) {
            $holiday_dates[] = $day->holiday_date;
        }
         
         $holiday_string = $holiday_dates;
        
        $dept = $this->settingsmodel->getDepartByID($depart_id);
       // var_dump($dept);exit;
       
       if($holidays)
       {
       
       
    
            $single_record['department'] = $dept;
            $single_record['hours'] = $this->settingsmodel->usablilityCheckLogByDepartRemoveHolidays($depart_id, $start_date, $end_date,$holiday_string)->hours;
            $single_record['approved_hours'] = $this->settingsmodel->usablilityCheckApprovedLogByDepartMinusHoliday($depart_id, $start_date, $end_date,$holiday_string)->hours;
            $single_record['rejectd_hours'] = $this->settingsmodel->usablilityCheckRejectedLogByDepartMinusHoliday($depart_id, $start_date, $end_date,$holiday_string)->hours;
            
            
            $single_record['staff_count'] = $this->settingsmodel->usablilityCheckLogByDepartMinusHoliday($depart_id, $start_date, $end_date,$holiday_string)->staff_count;
            
            $single_record['number_of_days'] = $this->settingsmodel->getNumberofDays($depart_id, $start_date, $end_date,$holiday_string)->number_of_days;
           // var_dump( $single_record['number_of_days']);exit;

            $department_records[] = $single_record;
            $data['number_of_days'] = $single_record['number_of_days'];
        
       
       
       }else{
       
        
            $single_record['department'] = $dept;
            $single_record['hours'] = $this->settingsmodel->usablilityCheckLogByDepart($depart_id, $start_date, $end_date)->hours;
            $single_record['approved_hours'] = $this->settingsmodel->usablilityCheckApprovedLogByDepart($depart_id, $start_date, $end_date)->hours;
            $single_record['rejectd_hours'] = $this->settingsmodel->usablilityCheckRejectedLogByDepart($depart_id, $start_date, $end_date)->hours;
            
            
            $single_record['staff_count'] = $this->settingsmodel->usablilityCheckLogByDepart($depart_id, $start_date, $end_date)->staff_count;

            $department_records[] = $single_record;
       
        
        }
        // unset($_SESSION['start_date']);
        // unset($_SESSION['end_date']);

        //var_dump($department_records);//exit;
        $data['getAllDepartment'] = $department_records; //$this->settingsmodel->getAllDepartment();



        //var_dump($department_records);exit;
        $data['holidays'] = $holidays;
        $data['new_dept'] = $dept;
        
        
         
        $firstDayOfThisMonth = new DateTime('first day of this month'); 
        $firstDayOfLastMonth = $firstDayOfThisMonth->modify('-1 month');  
        $lastDayOfLastMonth = clone $firstDayOfLastMonth;
        $lastDayOfLastMonth->modify('last day of this month');    
        // Format the dates
        $LastMonthStartDate = $firstDayOfLastMonth->format('Y-m-d');
        $LastMonthendDate = $lastDayOfLastMonth->format('Y-m-d');
        
       // Create DateTime objects for the start and end of the current month
        $startOfThisMonth = new DateTime('first day of this month');
        $endOfThisMonth = new DateTime('last day of this month');
    
        // Subtract one day from the end of this month
        $endOfThisMonth->modify('-1 day');
        
           // Format the dates to 'Y-m-d'
        $startOfThisMonthFormatted = $startOfThisMonth->format('Y-m-d');
        $endOfThisMonthFormatted = $endOfThisMonth->format('Y-m-d');
        
        $today = new DateTime('today');
        // Subtract one day from today
        $yesterday = $today->modify('-1 day');    
        // Format the date to 'Y-m-d'
        $yesterdayFormatted = $yesterday->format('Y-m-d');
        
         

        $data['lastMonthData'] = $this->usageReportByDeptData($depart_id,$LastMonthStartDate,$LastMonthendDate);
        $data['thisMonthData'] = $this->usageReportByDeptData($depart_id,$startOfThisMonthFormatted,$yesterdayFormatted);
        
        //var_dump($data['lastMonthData']);exit;

        $this->load->view('header');
        $this->load->view('usageReportByDept', $data);
        $this->load->view('footer');
    }

    public function usageReport()
    {
    
        $start_date = '2023-01-01';
        $end_date = '2023-12-12';
        $_SESSION['date_query'] = $_POST;
        //var_dump($_POST);exit;

        extract($_POST);
        $_SESSION['start_date'] = $start_date;
        $_SESSION['end_date'] = $end_date;

        $data['activeUserCount']  = $this->settingsmodel->active_user_count($start_date, $end_date);
        $data['hourly_sum'] = $this->settingsmodel->hourly_sum($start_date, $end_date);
        $data['assign_role'] = $this->settingsmodel->assign_role();
        $data['project_count'] = $this->settingsmodel->project_count();
        $departments = $this->settingsmodel->getAllDepartmentHr();
        $holidays = $this->settingsmodel->get_holidays($start_date,$end_date);
        $holiday_date = array();
        foreach ($holidays as $day) {
            $holiday_dates[] = $day->holiday_date;
        }
        
        $holiday_string = implode(',', $holiday_dates);
        $holiday_string = $holiday_dates;
       
       if($holidays)
       {
       
       
            foreach ($departments as $dept) {
            $single_record['department'] = $dept;
            $single_record['hours'] = $this->settingsmodel->usablilityCheckLogByDepartRemoveHolidays($dept->id, $start_date, $end_date,$holiday_string)->hours;
            $single_record['approved_hours'] = $this->settingsmodel->usablilityCheckApprovedLogByDepartMinusHoliday($dept->id, $start_date, $end_date,$holiday_string)->hours;
            $single_record['rejectd_hours'] = $this->settingsmodel->usablilityCheckRejectedLogByDepartMinusHoliday($dept->id, $start_date, $end_date,$holiday_string)->hours;
            
            
            $single_record['staff_count'] = $this->settingsmodel->usablilityCheckLogByDepartMinusHoliday($dept->id, $start_date, $end_date,$holiday_string)->staff_count;

            $department_records[] = $single_record;
        }
       
       
       }else{
       
        foreach ($departments as $dept) {
            $single_record['department'] = $dept;
            $single_record['hours'] = $this->settingsmodel->usablilityCheckLogByDepart($dept->id, $start_date, $end_date)->hours;
            $single_record['approved_hours'] = $this->settingsmodel->usablilityCheckApprovedLogByDepart($dept->id, $start_date, $end_date)->hours;
            $single_record['rejectd_hours'] = $this->settingsmodel->usablilityCheckRejectedLogByDepart($dept->id, $start_date, $end_date)->hours;
            
            
            $single_record['staff_count'] = $this->settingsmodel->usablilityCheckLogByDepart($dept->id, $start_date, $end_date)->staff_count;

            $department_records[] = $single_record;
        }
        
        }
        // unset($_SESSION['start_date']);
        // unset($_SESSION['end_date']);

        //var_dump($department_records);//exit;
        $data['getAllDepartment'] = $department_records; //$this->settingsmodel->getAllDepartment();



        //var_dump($department_records);exit;
        $data['holidays'] = $holidays;

        $this->load->view('header');
        $this->load->view('usageReport', $data);
        $this->load->view('footer');
    }


    public function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y')
    {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

    public function usageReportByDepartment($dept, $to_excel = 0)
    {
        extract($_SESSION['date_query']); //exit;


        $depatment_hour_list = $this->settingsmodel->usablilityCheckLogByDepartID($dept, $start_date, $end_date);
        $depatment_employee = $this->settingsmodel->AllEmployeeByDepart($dept);
        //$date_arr = $this->date_range($start_date,$end_date);
        // var_dump($start_date,$end_date);
        // var_dump($date_arr);exit;


        $period = new DatePeriod(
            new DateTime($start_date),
            new DateInterval('P1D'),
            new DateTime($end_date)
        );

        foreach ($period as $key => $value) {
            $date_list[] = $value->format('Y-m-d');
        }
        //echo $start_date.'<br>';
        //  var_dump($depatment_hour_list);exit;



        $data['date_list'] = $date_list;
        $data['depatment_hour_list'] = $depatment_hour_list;
        $data['department_employee'] = $depatment_employee;
        $data['department_id'] = $dept;

        if ($to_excel == 3) {



            ob_start();

            //output the excel headers
            //var_dump(headers_list());exit;

            header("Pragma: public");

            header("Cache-Control: no-store, no-cache, must-revalidate");

            header("Cache-Control: pre-check=0, post-check=0, max-age=0");

            header("Pragma: no-cache");

            header("Expires: 0");

            header("Content-Transfer-Encoding: none");

            header("Content-Type: application/vnd.ms-excel;");

            header("Content-type: application/x-msexcel");

            header("Content-Disposition: attachment; filename=Rejected Transaction" . ".xls");

            //out put the table body
            echo "<table border='1'>";
            echo "<tbody>";

            $this->load->view('DepartmentUsageReport', $data);

            echo "</tbody>";
            $ExcelData = ob_get_contents();
            ob_end_clean();
            echo $ExcelData;
        } else {

            $this->load->view('header');
            $this->load->view('DepartmentUsageReport', $data);
            $this->load->view('footer');
        }
    }


    public function logSingleTaskAjax()
    {

        //TODO posible validations 
        extract($_POST);
        $response['error'] = "";
        $employee_id = $_SESSION['login_detal']->id;
        if (!isset($date) || !isset($project_id) || !isset($time) || !isset($project_id)) {
            $response['error'] = "All Filed is required";
        }

        $day_hourly_summary =  $this->settingsmodel->getSumByDayTempt($employee_id, $date);

        $to_be_hours = $day_hourly_summary[0]->hours + (int)$time;
        if ($_SESSION['login_detal']->id == 18) {

            //    $response['error'] = "Total Hour per day should not be more than 18 hours";
        }
        //    var_dump($to_be_hours);exit;

        if ($to_be_hours > 16) {

            $response['error'] = 'You can not log more than 16hours in a date ' . $date;
            echo json_encode($response);die();
        }
        //var_dump($day_hourly_summary[0]->hours);exit;
        if ($to_be_hours > 16) {
            $response['error'] = 'You can not log more than 16hours in a date ' . $date;
            echo json_encode($response);die();
        }

        $record = array(
            "employee_id" => $employee_id,
            "project_id" => $project_id,
            "project_task" => $task_done,
            "log_date" => $date,
            "hours" => $time,
            "comment" => $comment

        );
        $project_role = $this->settingsmodel->add_single_temp_activities($record);
        if ($project_role) {

            $response['message'] = 'Activity logged successfully';
        } else {

            $response['message'] = 'Error while logging activity please contact admin';
        }

        $record['all_logs'] = $this->settingsmodel->getTempEmployeelog($employee_id);
        $display = $this->load->view('log_preview', $record, true);


        $response['display']  = $display;
        echo json_encode($response);
    }


    //
    public function logSingleTask()
    {
        //TODO posible validations 
        extract($_POST);
        $employee_id = $_SESSION['login_detal']->id;
        if (!isset($date) || !isset($project_id) || !isset($time) || !isset($project_id)) {
            redirect('admin/projectlogs/activityindex?error=All Filed is required');
        }

        $day_hourly_summary =  $this->settingsmodel->getSumByDay($employee_id, $date);
        $to_be_hours = $day_hourly_summary[0]->hours + (int)$time;
        if ($_SESSION['login_detal']->id == 18) {

            //	var_dump( $day_hourly_summary);//exit;

        }

        if ($to_be_hours > 16) {

            redirect('admin/projectlogs/activityindex?error=You can not log more than 16hours in a date ' . $date);
        }
        //var_dump($day_hourly_summary[0]->hours);exit;
        if ($to_be_hours > 16) {

            redirect('admin/projectlogs/activityindex?error=You can not log more than 16hours in a date ' . $date);
        }

        $record = array(
            "employee_id" => $employee_id,
            "project_id" => $project_id,
            "project_task" => $task_done,
            "log_date" => $date,
            "hours" => $time
        );
        $project_role = $this->settingsmodel->add_single_activities($record);
        if ($project_role) {

            redirect('admin/projectlogs/activityindex?success=Activity logged successfully');
        } else {

            redirect('admin/projectlogs/activityindex?error=Error while logging activity please contact admin');
        }
    }


    public function load_project()
    {
        $employee_id = $_SESSION['login_detal']->id;
        $project_list = $this->settingsmodel->GetResourceProjectByClient($employee_id, $_POST["customer_id"]);

        if ($project_list) {
            echo '<option value="">Select Project</option>';
            foreach ($project_list as $d) {
                echo '<option value="' . $d->proj_id . '">' . $d->name . ' </option>';
            }
        } else {

            echo '<option value="">-No Project for the selected client-</option>';
        }

        //echo '</select>';
    }




    public function load_project_task()
    {


        $employee_id = $_SESSION['login_detal']->id; //exit;

        $project_role = $this->settingsmodel->GetProjectRole($_POST["project_id"], $employee_id);
        $task = $this->settingsmodel->project_role_task($project_role[0]->project_role_id);
        // var_dump($task);exit;
        // echo '<select>';
        if ($task) {
            echo '<option value="">Select Project Task</option>';
            echo '<option value="340">Idle Time</option>';
            foreach ($task as $d) {
                echo '<option value="' . $d->task_id . '">' . $d->task_name . ' </option>';
            }
        } else {

            echo '<option value="">-No task sssign to on project-</option>';
        }

        //echo '</select>';
    }

    public function review($id)
    {
        if (!isset($id)) {
            die('Invalid request');
        }
        $data['id'] = $id;
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $data['result'] = $this->utitlitymodel->getsingleemployeetimelog($id);
        $data['project_id'] = $data['result']['project_id'];
        // var_dump($data['result']["project_id"] );exit;

        if ($_POST) {
            extract($_POST); //exit;

            $log_details = array(
                'team_lead_id' => $_SESSION['login_detal']->id,
                'team_lead_status' => $status,
                'team_lead_comment' => $comment,
            );
            $this->settingsmodel->updateactivitylog($id, $log_details);

            $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->id);
            $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
            $employee_fullname_useable = $employee_fullname;
            $employee_email = $emplyee_details['work_email'];
            $recipiant_name = $employee_fullname;
            $subject = 'Update Notification';
            $body = 'Your team lead has update your time activity log, kindly login to check the status.';
            $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);

            $team_details = $this->settingsmodel->getTeamDetails($project_id);
            $teamleads_id = $team_details['team_lead'];
            $teamleads_details = $this->settingsmodel->getProjectTeamLeads($teamleads_id);
            $body = 'You just update ' . $employee_fullname_useable . ' time activity . You will be updated if you need to take any further action.';
            $subject = $employee_fullname . ' Time activities update was successful';

            foreach ($teamleads_details as $t) {
                $recipiant_name = $t->first_name . ' ' . $t->last_name;
                $to = $t->work_email;
                $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
            }

            $project_manager_details = $this->settingsmodel->getProjectManagerDetails($project_id);
            $project_managers = $project_manager_details['project_manager']; //exit;

            $project_managers_details = $this->settingsmodel->getProjectTeamLeads($project_managers);
            $body = 'Your team lead just update ' . $employee_fullname_useable . ' time activity . Please note that this activity is waiting for your approval.';
            $subject = $employee_fullname . ' Time activitity has been updated';

            foreach ($project_managers_details as $t) {
                $recipiant_name = $t->first_name . ' ' . $t->last_name;
                $to = $t->work_email;
                // var_dump($t);exit;
                $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
            }

            redirect('admin/projectlogs/activityteamlead');
        }
        $this->load->view('header');
        $this->load->view('activityreview', $data);
        $this->load->view('footer');
    }

    public function reviewproject($id)
    {
        if (!isset($id)) {
            die('Invalid request');
        }
        $data['id'] = $id;
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $data['result'] = $this->utitlitymodel->getsingleemployeetimelog($id);
        $data['project_id'] = $data['result']['project_id'];
        //var_dump($data['result']["team_lead_id"]);exit;
        $date = date('Y-m-d H:i:s');
        if ($_POST) {
            extract($_POST); //exit;

            $log_details = array(
                'project_manager_id' => $_SESSION['login_detal']->id,
                'project_manager_status' => $status,
                'project_manager_comment' => $comment,
                'final_approved_by' => $_SESSION['login_detal']->id,
                'date_approved' => $date,
            );
            $this->settingsmodel->updateactivitylog($id, $log_details);

            $emplyee_details = $this->settingsmodel->getEmployeeDetails($data['result']['employee_id']);
            $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
            $employee_fullname_useable = $employee_fullname;
            $employee_email = $emplyee_details['work_email'];
            $recipiant_name = $employee_fullname;
            $subject = 'Update Notification';
            $body = 'Your Project Manger has update your time activity log, kindly login to check the status.';
            $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);

            $team_details = $this->settingsmodel->getTeamDetails($project_id);
            $teamleads_id = $team_details['team_lead'];
            $teamleads_details = $this->settingsmodel->getProjectTeamLeads($teamleads_id);
            $body = 'Your project manager just update ' . $employee_fullname_useable . ' time activity . Kindly login to check if it required your attention.';
            $subject = $employee_fullname . ' Time activities update was successful';

            foreach ($teamleads_details as $t) {
                $recipiant_name = $t->first_name . ' ' . $t->last_name;
                $to = $t->work_email;
                $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
            }

            $project_manager_details = $this->settingsmodel->getProjectManagerDetails($project_id);
            $project_managers = $project_manager_details['project_manager']; //exit;

            $project_managers_details = $this->settingsmodel->getProjectTeamLeads($project_managers);
            $body = 'Your just update ' . $employee_fullname_useable . ' time activity .';
            $subject = $employee_fullname . ' Time activitity has been updated';

            foreach ($project_managers_details as $t) {
                $recipiant_name = $t->first_name . ' ' . $t->last_name;
                $to = $t->work_email;
                // var_dump($t);exit;
                $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
            }

            redirect('admin/projectlogs/activityteamprojmanager');
        }
        $this->load->view('header');
        $this->load->view('activityreviewprojectmanager', $data);
        $this->load->view('footer');
    }

    public function updateactivity()
    {
        if ($_POST) {
            $project_id = $_POST['project_id'];
            $project_task = $_POST['project_task'];
            $log_date = $_POST['log_date'];
            $hours = $_POST['hours'];
            $log_id = $_POST['log_id'];
            $team_lead_id = $_POST['team_lead_id'];
            $project_manager_id = $_POST['project_manager_id'];

            $log_details = array(
                'employee_id' => $_SESSION['login_detal']->id,
                'project_id' => $project_id,
                'project_task' => $project_task,
                'log_date' => $log_date,
                'hours' => $hours,
            );

            $this->settingsmodel->updateactivitylog($log_id, $log_details);

            $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->id);
            $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
            $employee_fullname_useable = $employee_fullname;
            $employee_email = $emplyee_details['work_email'];
            $recipiant_name = $employee_fullname;
            $subject = 'Activity update was successfully';
            $body = 'Your time activity has been updated and waiting response, you will be notified once we have an update';
            $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);

            if ($team_lead_id) {
                $emplyee_details = $this->settingsmodel->getEmployeeDetails($team_lead_id);
                $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
                $employee_email = $emplyee_details['work_email'];
                $recipiant_name = $employee_fullname;
                $subject = $employee_fullname_useable . ' Activity Log was updated';
                $body = $employee_fullname_useable . ' has update a time activity for your approval. Kindly login to your profile to approve.';
                $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);
            }

            if ($project_manager_id) {
                $emplyee_details = $this->settingsmodel->getEmployeeDetails($project_manager_id);
                $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
                $employee_email = $emplyee_details['work_email'];
                $recipiant_name = $employee_fullname;
                $subject = $employee_fullname_useable . ' Activity Log was updated';
                $body = $employee_fullname_useable . ' has update a time activity for your approval. Kindly login to your profile to approve.';
                $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);
            }

            redirect('admin/projectlogs/activityindex');
        } else {
            die('Invalid Access');
        }
    }

    public function submitactivity($data)
    {
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->id);
        $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];

        $employee_email = $emplyee_details['work_email'];

        foreach ($data as $value) {
            $project_details = $this->settingsmodel->getSingleProject($value);
            $team_leads = $this->settingsmodel->getProjectTeamLeadsbyProject($value, $_SESSION['login_detal']->id);
            $project_manager_id = $project_details['project_manager'];
            $project_name = $project_details['name'];
            $project_manager_details = $this->settingsmodel->getProjectManager($project_manager_id);
            $body = $employee_fullname . ' has logged a time activity on ' . $project_name . ' for your approval. Kindly login to your profile to approve.';
            $subject = $employee_fullname . '(' . $project_name . ') Time activities log';

            foreach ($team_leads as $tl) {
                $recipiant_name = $tl['first_name'] . ' ' . $tl['last_name'];
                $to = $tl['work_email'];
                $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
            }
        }

        $recipiant_name = $employee_fullname;
        $subject = $project_name . ' Activities request logged successfully';
        $body = 'Your time activity for ' . $project_name . ' has been logged and waiting approval, you will be notified once its approved';
        $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);
    }

    public function submitactivityreviewprojmanager($projectId, $userId, $dateRange)
    {
        $project_manager_details = $this->settingsmodel->getProjectManager($_SESSION['login_detal']->id);
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($userId);
        $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
        $daterange = explode(',', $dateRange);
        $daterange = (string)$daterange[0] . ' - ' . (string)$daterange[1];


        foreach ($projectId as $value) {
            $project_details = $this->settingsmodel->getSingleProject($value);
            $project_name = $project_details['name'];

            $body = 'Your time activity for ' . $project_name . ' between ' . $daterange . ' has been reviewed by the project manager. Kindly login to your profile to view modifications made.';
            $subject = $project_name . '(' . $daterange . ') Time activities reviewed by project manager';

            $recipiant_name = $employee_fullname;
            $to = $emplyee_details['work_email'];
            $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
        }

        $recipiant_name = $project_manager_details['first_name'] . ' ' . $project_manager_details['last_name'];
        $subject = $employee_fullname . '(' . $project_name . ') Time activities reviewed';
        $body = $employee_fullname . '\'s time activities for ' . $project_name . ' between ' . $daterange . '  has been reviewed successfully by you.';
        $to = $project_manager_details['work_email'];
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
    }

    public function submitactivityreviewteamlead($projectId, $userId, $dateRange)
    {
        $project_manager_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->id);
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($userId);
        $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
        $daterange = explode(',', $dateRange);
        $daterange = (string)$daterange[0] . ' - ' . (string)$daterange[1];


        foreach ($projectId as $value) {
            $project_details = $this->settingsmodel->getSingleProject($value);
            $project_name = $project_details['name'];

            $body = 'Your time activity for ' . $project_name . ' between ' . $daterange . ' has been reviewed by the the team lead. Kindly login to your profile to view modifications made.';
            $subject = $project_name . '(' . $daterange . ') Time activities reviewed by team lead';

            $recipiant_name = $employee_fullname;
            $to = $emplyee_details['work_email'];
            $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
        }

        $recipiant_name = $project_manager_details['first_name'] . ' ' . $project_manager_details['last_name'];
        $subject = $employee_fullname . '(' . $project_name . ') Time activities reviewed';
        $body = $employee_fullname . '\'s time activities for ' . $project_name . ' between ' . $daterange . '  has been reviewed successfully by you.';
        $to = $project_manager_details['work_email'];
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
    }

    public function submitactivityreviewcdo($projectId, $userId, $dateRange)
    {
        $cdo_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->id);
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($userId);
        $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
        $daterange = explode(',', $dateRange);
        $daterange = (string)$daterange[0] . ' - ' . (string)$daterange[1];


        foreach ($projectId as $value) {
            $project_details = $this->settingsmodel->getSingleProject($value);
            $project_name = $project_details['name'];

            $body = 'Your time activity for ' . $project_name . ' between ' . $daterange . ' has been reviewed by the Chief Delivery Officer. Kindly login to your profile to view modifications made.';
            $subject = $project_name . '(' . $daterange . ') Time activities reviewed by CDO';

            $recipiant_name = $employee_fullname;
            $to = $emplyee_details['work_email'];
            $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
        }

        $recipiant_name = $cdo_details['first_name'] . ' ' . $cdo_details['last_name'];
        $subject = $employee_fullname . '(' . $project_name . ') Time activities reviewed';
        $body = $employee_fullname . '\'s time activities for ' . $project_name . ' between ' . $daterange . '  has been reviewed successfully by you.';
        $to = $cdo_details['work_email'];
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
    }

    public function submitactivitybkk()
    {
        if ($_POST) {
            $project_id = $_POST['project_id'];
            $project_task = $_POST['project_task'];
            $log_date = $_POST['log_date'];
            $hours = $_POST['hours'];

            $log_details = array(
                'employee_id' => $_SESSION['login_detal']->id,
                'project_id' => $project_id,
                'project_task' => $project_task,
                'log_date' => $log_date,
                'hours' => $hours,
            );
            $this->settingsmodel->insert_activity($log_details);

            $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->id);
            $employee_fullname = $emplyee_details['first_name'] . ' ' . $emplyee_details['last_name'];
            $employee_email = $emplyee_details['work_email'];

            $team_details = $this->settingsmodel->getTeamDetails($project_id);
            $teamleads_id = $team_details['team_lead'];
            $teamleads_details = $this->settingsmodel->getProjectTeamLeads($teamleads_id);
            $body = $employee_fullname . ' has logged a time activity for your approval. Kindly login to your profile to approve.';
            $subject = $employee_fullname . ' Time activities log';

            foreach ($teamleads_details as $t) {
                $recipiant_name = $t->first_name . ' ' . $t->last_name;
                $to = $t->work_email;
                $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
            }
            $recipiant_name = $employee_fullname;
            $subject = 'Activities request logged successfully';
            $body = 'Your time activity has been logged and waiting approval, you will be notified once its approved';
            $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);

            redirect('admin/projectlogs/activityindex');
        } else {
            die('Invalid Access');
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
                                                ' . $mail_title . '
												</td>
											</tr>
											<tr style="background-color:#fff;">
												<td style="color:#000; padding:20px" valign="top">
													<table>
														<tbody>
															<tr>
																<td>
																	Dear ' . $recipiant_name . ',
																</td>
															</tr>
															<tr>
																<td style="padding:10px 0; font-size:20px;">
                                                                ' . $body . ' 
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
