<?php

if (!defined('BASEPATH')) {
    ('No direct script access allowed');
}

class Projectexpense extends MX_Controller
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
        $this->load->model('projectbudgetmodel');
        $this->load->model('generalmodel');
         $this->load->model('departmentmodel');
        /*  $this->load->model('subunitmodel');
          $this->load->model('reportmodel');*/
        $this->load->model('settingsmodel');
        $this->load->model('utitlitymodel');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD();
        $this->load->model('projectexpensemodel');
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
        // var_dump($_SESSION['login_detal']);;
        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users';
        $config['total_rows'] = $this->db->count_all('employees'); // $this->db->count_all('users');
        $config['per_page'] = '1000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->settingsmodel->getAllEmployee();

        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('employeeindex', $data);
        $this->load->view('footer');
    }

    public function expenselog()
    {
        $data['employeelist'] = $this->settingsmodel->partial_employee_list();
        $data['task_status'] = $this->settingsmodel->taskStatus();
        // var_dump($data['task_status']);;

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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->projectexpensemodel->getEmployeeExpLog($config['per_page'], $page, $_SESSION['login_detal']->employee_id);
        
        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('expenselog', $data);
        $this->load->view('footer');
    }

    function report()
    {
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/';
        $config['total_rows'] = $this->utitlitymodel->getprojectscdocount(); // $this->db->count_all('users');
        $config['per_page'] = '100';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;  //echo $page;;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->projectexpensemodel->getprojectexpensereport($config['per_page'], $page);
        
        $data['links'] = $this->pagination->create_links();
        $this->load->view('header');
        $this->load->view('projectexpensereport', $data);
        $this->load->view('footer');
    }








    public function viewprojectprofitability()
    {
            
                    
                  //  $project_details = $this->projectbudgetmodel->getsingleprojects($id);
                    $data['project_all_amount'] = $this->projectbudgetmodel->sumprojectbudget();
                    $data['total_allocation'] = $this->projectbudgetmodel->allAllocatedBudget();
                   
                    $allProjects = $this->projectbudgetmodel->getAllprojectIndexed(); 
                    $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
                    $departments = $this->departmentmodel->getAllDepartment();
    
                    $budget = $this->projectbudgetmodel->getsingleprojectBudget($id);
                    $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetails($id);
                    $budget_head_by_dept = array();
                    $total_allocated = 0;
               // var_dump(isset($_POST));//exit;
                    extract($_POST);
                    if (!($this->input->server('REQUEST_METHOD') === 'POST'))
                    {
                         $start_date = "2022-01-01";
                         $end_date =  "2022-12-01";
                    }
                    //$start_date = "2022-09-1";
                    //$end_date = "2022-09-30";
                    //var_dump($start_date);exit;
    
                    foreach($allProjects as $proj)
                    {
                       // var_dump($proj);;
                            $budget_header_single_project = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeaderByProject($proj->id);
                            $budget_head_by_project[$proj->id] = $budget_header_single_project;
                    }

                    
        

                    foreach($allProjects as $proj)
                    {
                        $budget_header_single_project_percent = $this->projectbudgetmodel->ProjectBudgetDetailsHeaderByProject($proj->id);
                
                        $budget_head_by_project_percent[$proj->id] = $budget_header_single_project_percent;
                    }

                   // var_dump($budget_head_by_project_percent);;

                   
                   foreach($allProjects as $proj)
                   {
                       $getPersonnelCost = $this->projectexpensemodel->getPersonnelCostByDate($proj->id,$start_date,$end_date);
               
                       $getPersonnelCostList[$proj->id] = $getPersonnelCost;
                   }


                   
    
                    foreach($allProjects as $proj)
                    {
                            foreach($getRevenueHead as $revHeadSingle)
                            {
                                $expByProjectRevenueHead[$proj->id][$revHeadSingle->revenue_head] =  
                                $this->projectexpensemodel->getExpByRevenueHeadProjectAmountByDate($proj->id,$revHeadSingle->revenue_head,$start_date,$end_date)['amount']; 
                            }   
                            
                            $expByProjectRevenueHead[$proj->id]["personal"] =   $this->projectexpensemodel->getPersonnelCost($proj->id)['rate_cost'];
                    }
                    //var_dump($expByProjectRevenueHead);;
                    
                   $projects_recieveble =  $this->projectbudgetmodel->ProjectRecieveableIncomeAllByDate($start_date,$end_date);
                   $data['projects_recieveble'] =$projects_recieveble;
                  // var_dump( $projects_recieveble);;
    
                    $exp = $this->projectexpensemodel->getAllAmountByDate($start_date, $end_date);
                    $cost = $this->projectexpensemodel->getAllPersonnelCostDate($start_date,$end_date);
                  
                    $data['expByDeptRevenueHead'] = $expByProjectRevenueHead;
                    $data['expByProjectRevenueHead'] = $expByProjectRevenueHead;
                    $data['budget_head_by_project_percent'] = $budget_head_by_project_percent;
                    $data['budget'] = $budget;
                    $data['total_allocated'] = $total_allocated;
                    $data['budget_details'] = $budget_details;
                    $data['budget_head_by_project'] = $budget_head_by_project;
                    $data['dept'] = $departments;
                    $data['allProjects'] = $allProjects;
                    $data['getRevenueHead'] = $getRevenueHead;
                    $data['budget_id'] = $id;
                    $data['project_recognized_income'] = $this->projectbudgetmodel->getAllRecognizedIncome()['rev_amount'];
                    $data['project_expenses'] =  $exp['amount']+$cost['rate_cost'];
                    $data['getPersonnelCostList'] = $getPersonnelCostList;
    
                  
                    
                    $data['id'] = $id;
                    $this->load->view('header');
                    $this->load->view('viewprojectprofitability',$data);
                    $this->load->view('footer');
                    $this->load->view('setbudgetscript',$data);                  
            }
       



            
    public function viewprojectprofitabilityExcel()
    {
            
                    
                  //  $project_details = $this->projectbudgetmodel->getsingleprojects($id);
                    $data['project_all_amount'] = $this->projectbudgetmodel->sumprojectbudget();
                    $data['total_allocation'] = $this->projectbudgetmodel->allAllocatedBudget();
                   
                    $allProjects = $this->projectbudgetmodel->getAllprojectIndexed(); 
                    $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
                    $departments = $this->departmentmodel->getAllDepartment();
    
                    $budget = $this->projectbudgetmodel->getsingleprojectBudget($id);
                    $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetails($id);
                    $budget_head_by_dept = array();
                    $total_allocated = 0;
                    // foreach($budget_details as $budgetBrk)
                    // {
                    //         $total_allocated = $total_allocated+$budgetBrk->department_budget;
                    // }

                  // var_dump($allProjects);; 
    
                    foreach($allProjects as $proj)
                    {
                       // var_dump($proj);;
                            $budget_header_single_project = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeaderByProject($proj->id);
                            $budget_head_by_project[$proj->id] = $budget_header_single_project;
                    }

                    
        

                    foreach($allProjects as $proj)
                    {
                        $budget_header_single_project_percent = $this->projectbudgetmodel->ProjectBudgetDetailsHeaderByProject($proj->id);
                
                        $budget_head_by_project_percent[$proj->id] = $budget_header_single_project_percent;
                    }

                   // var_dump($budget_head_by_project_percent);;

                   
                   foreach($allProjects as $proj)
                   {
                       $getPersonnelCost = $this->projectexpensemodel->getPersonnelCost($proj->id);
               
                       $getPersonnelCostList[$proj->id] = $getPersonnelCost;
                   }


                   
    
                    foreach($allProjects as $proj)
                    {
                            foreach($getRevenueHead as $revHeadSingle)
                            {
                                $expByProjectRevenueHead[$proj->id][$revHeadSingle->revenue_head] =  
                                $this->projectexpensemodel->getExpByRevenueHeadProjectAmount($proj->id,$revHeadSingle->revenue_head)['amount']; 
                            }   
                            
                            $expByProjectRevenueHead[$proj->id]["personal"] =   $this->projectexpensemodel->getPersonnelCost($proj->id)['rate_cost'];
                    }
                    //var_dump($expByProjectRevenueHead);;
                    
                   $projects_recieveble =  $this->projectbudgetmodel->ProjectRecieveableIncomeAll();
                   $data['projects_recieveble'] =$projects_recieveble;
                  // var_dump( $projects_recieveble);;
    
                    $exp = $this->projectexpensemodel->getAllAmount();
                    $cost = $this->projectexpensemodel->getAllPersonnelCost();
                 //   var_dump($exp);
                   // var_dump($cost);;
                     
    
                    $data['expByDeptRevenueHead'] = $expByProjectRevenueHead;
                    $data['expByProjectRevenueHead'] = $expByProjectRevenueHead;
                    $data['budget_head_by_project_percent'] = $budget_head_by_project_percent;
                    $data['budget'] = $budget;
                    $data['total_allocated'] = $total_allocated;
                    $data['budget_details'] = $budget_details;
                    $data['budget_head_by_project'] = $budget_head_by_project;
                    $data['dept'] = $departments;
                    $data['allProjects'] = $allProjects;
                    $data['getRevenueHead'] = $getRevenueHead;
                    $data['budget_id'] = $id;
                    $data['project_recognized_income'] = $this->projectbudgetmodel->getAllRecognizedIncome()['rev_amount'];
                    $data['project_expenses'] =  $exp['amount']+$cost['rate_cost'];
                    $data['getPersonnelCostList'] = $getPersonnelCostList;
    
                  
                    
                    $data['id'] = $id;

                    ob_start();

                    //output the excel headers
                    //var_dump(headers_list());;
                
                header("Pragma: public");
                
                header("Cache-Control: no-store, no-cache, must-revalidate");
                
                header("Cache-Control: pre-check=0, post-check=0, max-age=0");
                
                header("Pragma: no-cache");
                
                header("Expires: 0");
                
                header("Content-Transfer-Encoding: none");
                
                header("Content-Type: application/vnd.ms-excel;");
                
                header("Content-type: application/x-msexcel");
                
                header("Content-Disposition: attachment; filename=Rejected Transaction".".xls");
                
                //out put the table body
                echo"<table border='1'>";
                echo"<tbody>";
                     
                $this->load->view('viewprojectprofitability',$data);
                  
                $this->load->view('setbudgetscript',$data);   
                   
                   echo"</tbody>";
                $ExcelData=ob_get_contents();
                ob_end_clean();
                echo $ExcelData; 
                    
                                
            }



    
public function viewbudgetreport($id=0)
{
        if($id>0){
                
                $project_details = $this->projectbudgetmodel->getsingleprojects($id); 
                $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
                $departments = $this->departmentmodel->getAllDepartment();

                $budget = $this->projectbudgetmodel->getsingleprojectBudget($id);
                $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetails($id);
                $budget_head_by_dept = array();
                $total_allocated = 0;

  				$exp = $this->projectexpensemodel->getAmount($id);
                foreach($departments as $dept)
                {
                        $budget_single_record = $this->projectbudgetmodel->getsingleprojectBugetByDepartment($id,$dept->id);
                        $budget_single_record_arr[$dept->id] = $budget_single_record;
                }




                foreach($budget_details as $budgetBrk)
                {
                        $total_allocated = $total_allocated+$budgetBrk->department_budget;
                }

                foreach($departments as $dept)
                {
                        $budget_header_single_dept = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeader($id,$dept->id);
                        $budget_head_by_dept[$dept->id] = $budget_header_single_dept;
                }

                foreach($departments as $dept)
                {
                	$department_budget = $this->projectbudgetmodel->getProjectDepartmentSettings($id,$dept->id);
                    if($department_budget)
                    	{
                    	$total_depart_percent = $department_budget['percentage']/100;
                         $department_amount = $exp['amount'] * $total_depart_percent;
                         $department_current_head_expense = array();

                         $percentage_revenue_head = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeader($id,$dept->id);
                         foreach ($percentage_revenue_head as  $perc) {
                         	$current_head_percent = $perc->percentage;
                         	$current_budget_head = $perc->budget_head;
                         	 $department_current_head_expense[$perc->budget_head] = $department_amount*$current_head_percent/100;
                         	//var_dump($perc);exit;
                         }
                         //var_dump($percentage_revenue_head);exit;

                      //   var_dump($department_current_head_expense);exit;

                    	}



                        foreach($getRevenueHead as $revHeadSingle)
                        {
                        	   //                          $expByDeptRevenueHead[$dept->id][$revHeadSingle->revenue_head] =  
                            // $this->projectexpensemodel->getExpByRevenueHeadDeptAmount($id,$revHeadSingle->revenue_head,$dept->id)['amount'];

                                  $expByDeptRevenueHead[$dept->id][$revHeadSingle->revenue_head] = 
                                  $department_current_head_expense[$revHeadSingle->revenue_head]; 
                          //  $this->projectexpensemodel->getExpByRevenueHeadDeptAmount($id,$revHeadSingle->revenue_head,$dept->id)['amount'];
                        }  
                        $department_current_head_expense =array();                    
                }

                //cuprit abass
           //   var_dump($expByDeptRevenueHead);
                


              
                $cost = $this->projectexpensemodel->getPersonnelCost($id);
               // var_dump( $expByDeptRevenueHead);exit;
                 

                $data['expByDeptRevenueHead'] = $expByDeptRevenueHead;
                $data['budget'] = $budget;
                $data['total_allocated'] = $total_allocated;
                $data['budget_details'] = $budget_details;
                $data['budget_head_by_dept'] = $budget_head_by_dept;
                $data['dept'] = $departments;
                $data['project_details'] = $project_details;
                $data['getRevenueHead'] = $getRevenueHead;
                $data['budget_id'] = $id;
                $data['project_recognized_income'] = $this->projectbudgetmodel->getRecognizedIncome($id)['rev_amount'];
                $data['project_expenses'] =  $exp['amount']+$cost['rate_cost'];
                $data['budget_single_record_arr'] = $budget_single_record_arr;

               
            
                
                $data['id'] = $id;
                $this->load->view('header');
                $this->load->view('viewProjectbudgetReport',$data);
                $this->load->view('footer');
                $this->load->view('setbudgetscript',$data);                  
        }
        else
        {
                $this->session->set_flashdata('error', 'Invalid Request');
                redirect('admin/projectbudget');
        }

}








//projectDepartmentProfitability


public function projectDepartmentProfitabilityExcel()
{
   
    $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
    $departments = $this->departmentmodel->getAllDepartment();
    //var_dump($_SESSION['date_filter']);exit;
    extract($_SESSION['date_filter']);

    if (!(isset($start_date)))
        {
             $start_date = "2022-01-01";
             $end_date =  "2023-12-01";
        }
    $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetailsAll();
    $budget_head_by_dept = array();
    $total_allocated = 0;
    foreach($budget_details as $budgetBrk)
    {
            $total_allocated = $total_allocated+$budgetBrk->department_budget;
    }

    foreach($departments as $dept)
    {
            $budget_header_single_dept = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeaderAll($dept->id);
            $budget_head_by_dept[$dept->id] = $budget_header_single_dept;
    }
    $allProjects = $this->projectbudgetmodel->getAllprojectIndexed(); 
    //var_dump($start_date,$end_date);exit;

    $dpeartment_recieveble =  $this->projectbudgetmodel->ProjectRecieveableIncomeAllByDate($start_date,$end_date);
    $data['dpeartment_recieveble'] = $dpeartment_recieveble;
    $expByDeptRevenueHead = array();
    $department_project_allocation = array();
    $department_project_direct_cost = array();
    $department_project_direct_personal_cost = array();
    $department_project_recievieable = array();
    foreach($departments as $dept)
    {
       //echo("department " .$dept->title ."<br>");//exit;


        foreach($allProjects as $project)
        {  
            $single_project_amount =  $this->projectexpensemodel->getExpByRevenueHeadDeptAmountByProjectByDate($project->id,$start_date,$end_date);
            $departProjectDetails = $this->projectbudgetmodel->getProjectDepartmentSettings($project->id,$dept->id);
            $department_project_amount_allocated = $departProjectDetails['department_budget'];
            $department_project_allocation[$project->id][$dept->id] = $department_project_amount_allocated;
            $department_percentage = ($departProjectDetails['percentage']); 
            $department_allocated_expense = $single_project_amount['amount']*($department_percentage/100);
            $department_project_direct_cost[$project->id][$dept->id] = $department_allocated_expense;
            $departProjectPersonalCost = $this->projectexpensemodel->getPersonnelCostByDepartmentbyDateByPorject($dept->id,$start_date,$end_date,$project->id)['rate_cost'];
            $department_project_direct_personal_cost[$project->id][$dept->id] = $departProjectPersonalCost;
            $department_allocated_recievable_amount = $dpeartment_recieveble[$project->id]*($department_percentage/100);
            $department_project_recievieable[$project->id][$dept->id] = $department_allocated_recievable_amount;
            
        
        }
                          
    }


     
    $data['recievable'] = $department_recieveable_by_revenue_header;
    $exp = $this->projectexpensemodel->getAmountAllByDate($start_date,$end_date);
    $cost = $this->projectexpensemodel->getPersonnelCostAllByDate($start_date,$end_date);
     
    $data['department_project_allocation'] = $department_project_allocation;
    $data['department_project_direct_cost'] = $department_project_direct_cost;
    $data['department_project_direct_personal_cost'] = $department_project_direct_personal_cost;
    $data['department_project_recievieable'] = $department_project_recievieable;


    $data['dept'] = $departments;
    $data['allProjects'] = $allProjects;
    $data['expByProjectPersonel'] = $expByProjectPersonel;
    $data['project_expenses'] =  $exp['amount']+$cost['rate_cost'];
    $data['is_excel'] = 1;

   
                   
                

                ob_start();

                //output the excel headers
                //var_dump(headers_list());;
            
            header("Pragma: public");
            
            header("Cache-Control: no-store, no-cache, must-revalidate");
            
            header("Cache-Control: pre-check=0, post-check=0, max-age=0");
            
            header("Pragma: no-cache");
            
            header("Expires: 0");
            
            header("Content-Transfer-Encoding: none");
            
            header("Content-Type: application/vnd.ms-excel;");
            
            header("Content-type: application/x-msexcel");
            
            header("Content-Disposition: attachment; filename=Rejected Transaction".".xls");
            
            //out put the table body
            echo"<table border='1'>";
            echo"<tbody>";
                  
            $this->load->view('projectreportprofitabilitybydept',$data);
                
           // $this->load->view('setbudgetscript',$data);     
               
               echo"</tbody>";
            $ExcelData=ob_get_contents();
            ob_end_clean();
            echo $ExcelData; 
      

}















//DEPARTMENTAL PROFITABILITY
public function projectreportprofitabilityExcel()
{
    //var_dump($_SESSION);;
    //    if($id>0){
                
                //$project_details = $this->projectbudgetmodel->getsingleprojects($id); 
              // var_dump($project_details);;
                $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
                $departments = $this->departmentmodel->getAllDepartment();

                $budget = $this->projectbudgetmodel->getsingleprojectBudget($id);
                $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetailsAll();
            //   var_dump($budget);;
                $budget_head_by_dept = array();
                $total_allocated = 0;
                foreach($budget_details as $budgetBrk)
                {
                        $total_allocated = $total_allocated+$budgetBrk->department_budget;
                }

                foreach($departments as $dept)
                {
                        $budget_header_single_dept = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeaderAll($dept->id);
                        $budget_head_by_dept[$dept->id] = $budget_header_single_dept;
                }

                foreach($departments as $dept)
                {
                        foreach($getRevenueHead as $revHeadSingle)
                        {   //echo $dept->id.'<br>';
                            $expByDeptRevenueHead[$dept->id][$revHeadSingle->revenue_head] =  
                            $this->projectexpensemodel->getExpByRevenueHeadDeptAmountAll($revHeadSingle->revenue_head,$dept->id)['amount'];
                        }                      
                }

                foreach($departments as $dept)
                {
                    $expByProjectPersonel[$dept->id]=   $this->projectexpensemodel->getPersonnelCostByDepartment($dept->id)['rate_cost'];              
                }
               


                $exp = $this->projectexpensemodel->getAmountAll();
                $cost = $this->projectexpensemodel->getPersonnelCostAll();
                 

                $data['expByDeptRevenueHead'] = $expByDeptRevenueHead;
                $data['budget'] = $budget;
                $data['total_allocated'] = $total_allocated;
                $data['budget_details'] = $budget_details;
                $data['budget_head_by_dept'] = $budget_head_by_dept;
                $data['dept'] = $departments;
                $data['expByProjectPersonel'] = $expByProjectPersonel;
               // $data['project_details'] = $project_details;
                $data['getRevenueHead'] = $getRevenueHead;
              //  $data['budget_id'] = $id;
               // $data['project_recognized_income'] = $this->projectbudgetmodel->getRecognizedIncomeAll($id)['rev_amount'];
                $data['project_expenses'] =  $exp['amount']+$cost['rate_cost'];

               
             
   
                
                

                ob_start();

                //output the excel headers
                //var_dump(headers_list());;
            
            header("Pragma: public");
            
            header("Cache-Control: no-store, no-cache, must-revalidate");
            
            header("Cache-Control: pre-check=0, post-check=0, max-age=0");
            
            header("Pragma: no-cache");
            
            header("Expires: 0");
            
            header("Content-Transfer-Encoding: none");
            
            header("Content-Type: application/vnd.ms-excel;");
            
            header("Content-type: application/x-msexcel");
            
            header("Content-Disposition: attachment; filename=Rejected Transaction".".xls");
            
            //out put the table body
            echo"<table border='1'>";
            echo"<tbody>";
                 
            $this->load->view('projectreportprofitability',$data);
                
            $this->load->view('setbudgetscript',$data);     
               
               echo"</tbody>";
            $ExcelData=ob_get_contents();
            ob_end_clean();
            echo $ExcelData; 
      

}



public function projectcostreport()
{

//     error_reporting(E_ALL);
// ini_set('display_errors', '1');
    extract($_POST);
    
    $_SESSION['date_filter'] = $_POST;
    if (!($start_date))
        {
             $start_date = "2022-01-01";
             $end_date =  "2023-12-01";
        }
    
    $departments = $this->departmentmodel->getAllDepartment();    
    $allProjects = $this->projectbudgetmodel->getAllprojectIndexed(); 
    $recieveble_by_project =  $this->projectbudgetmodel->ProjectRecieveableIncomeAllByDate($start_date,$end_date);
    $data['recieveble_by_project'] = $recieveble_by_project;
    $project_expense = array();
    $project_department_hourly_log = array();
    
    foreach($allProjects as $project)
            {  
                $project_expense[$project->id] =  $this->projectexpensemodel->getExpByRevenueHeadDeptAmountByProjectByDate($project->id,$start_date,$end_date);
                $project_hourly_logged[$project->id] =  $this->projectexpensemodel->projectHourlyLogs($project->id,$start_date,$end_date);
               // var_dump($project_hourly_logged[$project->id]);exit;
                foreach($departments as $depart)
                {        
                  $total_logged_by_depart = $this->projectexpensemodel->toatalLogedHoursByDepartment($project->id,$depart->id,$start_date,$end_date);
                  $project_department_hourly_log[$project->id][$depart->id]  = $total_logged_by_depart['hours'];

                  if(!($total_logged_by_depart['hours'] == null))
                  {
                    $project_department_personel_cost[$project->id][$depart->id] = $this->projectexpensemodel->totalpersonalCostbyDepartment($project->id,$depart->id,$start_date,$end_date,$total_logged_by_depart['hours']);
                  }else
                  {
                    $project_department_personel_cost[$project->id][$depart->id] = 0;
                  }
                  
                  
                }
            }

   // var_dump($project_department_personel_cost);exit;
 
    $data['departments'] = $departments;
    $data['allProjects'] = $allProjects;
    $data['recieveble_by_project'] = $recieveble_by_project;
    $data['project_expense'] = $project_expense;
    $data['project_hourly_logged'] = $project_hourly_logged;
    $data['project_department_hourly_log'] = $project_department_hourly_log;
    $data['project_department_personel_cost'] = $project_department_personel_cost;

                    
    //  $data['id'] = $id;
    $this->load->view('header');
    $this->load->view('projectcostreport',$data);
    $this->load->view('footer');
    $this->load->view('setbudgetscript',$data);     

}


public function projectcostreportexcel()
{

// error_reporting(E_ALL);
// ini_set('display_errors', '1');
   extract($_SESSION['date_filter']);
    
   // $_SESSION['date_filter'] = $_POST;
    if (!($start_date))
        {
             die("Date is not set");
        }
    
    $departments = $this->departmentmodel->getAllDepartment();    
    $allProjects = $this->projectbudgetmodel->getAllprojectIndexed(); 
    $recieveble_by_project =  $this->projectbudgetmodel->ProjectRecieveableIncomeAllByDate($start_date,$end_date);
    $data['recieveble_by_project'] = $recieveble_by_project;
    $project_expense = array();
    $project_department_hourly_log = array();
    
    foreach($allProjects as $project)
            {  
                $project_expense[$project->id] =  $this->projectexpensemodel->getExpByRevenueHeadDeptAmountByProjectByDate($project->id,$start_date,$end_date);
                $project_hourly_logged[$project->id] =  $this->projectexpensemodel->projectHourlyLogs($project->id,$start_date,$end_date);
               // var_dump($project_hourly_logged[$project->id]);exit;
                foreach($departments as $depart)
                {        
                  $total_logged_by_depart = $this->projectexpensemodel->toatalLogedHoursByDepartment($project->id,$depart->id,$start_date,$end_date);
                  $project_department_hourly_log[$project->id][$depart->id]  = $total_logged_by_depart['hours'];

                  if(!($total_logged_by_depart['hours'] == null))
                  {
                    $project_department_personel_cost[$project->id][$depart->id] = $this->projectexpensemodel->totalpersonalCostbyDepartment($project->id,$depart->id,$start_date,$end_date,$total_logged_by_depart['hours']);
                  }else
                  {
                    $project_department_personel_cost[$project->id][$depart->id] = 0;
                  }
                  
                  
                }
            }
 
    $data['departments'] = $departments;
    $data['allProjects'] = $allProjects;
    $data['recieveble_by_project'] = $recieveble_by_project;
    $data['project_expense'] = $project_expense;
    $data['project_hourly_logged'] = $project_hourly_logged;
    $data['project_department_hourly_log'] = $project_department_hourly_log;
    $data['project_department_personel_cost'] = $project_department_personel_cost;
    $data['hasexcel'] = 1;


    
    ob_start();

    //output the excel headers
    //var_dump(headers_list());;

header("Pragma: public");

header("Cache-Control: no-store, no-cache, must-revalidate");

header("Cache-Control: pre-check=0, post-check=0, max-age=0");

header("Pragma: no-cache");

header("Expires: 0");

header("Content-Transfer-Encoding: none");

header("Content-Type: application/vnd.ms-excel;");

header("Content-type: application/x-msexcel");

header("Content-Disposition: attachment; filename=Rejected Transaction".".xls");
$data['is_excel'] = 1;
//out put the table body
echo"<table border='1'>";
echo"<tbody>";
     
$this->load->view('projectcostreport',$data);  
   
   echo"</tbody>";
$ExcelData=ob_get_contents();
ob_end_clean();
echo $ExcelData; 
                    
 
 
  
}



//DEPARTMENTAL PROFITABILITY
public function projectDepartmentProfitabilityV2Excel()
{
  
  // error_reporting(E_ALL);
  // ini_set('display_errors', '1');

                $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
               // $departments = $this->departmentmodel->getAllDepartment();
                $departments = $this->departmentmodel->getAllHrDepartment();
                extract($_POST);
                //var_dump($_POST);exit;
                 extract($_SESSION['date_filter']);
    
               // $_SESSION['date_filter'] = $_POST;
                if (!($start_date))
                    {
                         die("Date is not set");
                    }
                           // var_dump($start_date);exit;   $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetailsAll();
                $budget_head_by_dept = array();

                
                             $budget_head_by_dept = array();
                $total_allocated = 0;
                foreach($budget_details as $budgetBrk)
                {
                        $total_allocated = $total_allocated+$budgetBrk->department_budget;
                }

                foreach($departments as $dept)
                {
                        $budget_header_single_dept = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeaderAll($dept->id);
                        $budget_head_by_dept[$dept->id] = $budget_header_single_dept;
                }
                $allProjects = $this->projectbudgetmodel->getAllprojectIndexed(); 

                $dpeartment_recieveble =  $this->projectbudgetmodel->ProjectRecieveableIncomeAllByDate($start_date,$end_date);
              // var_dump($);exit;
                $data['dpeartment_recieveble'] = $dpeartment_recieveble;
                $expByDeptRevenueHead = array();
                $department_project_allocation = array();
                $department_project_direct_cost = array();
                $department_project_direct_personal_cost = array();
                $department_project_recievieable = array();
                $project_department_hourly_log = array();

                foreach($departments as $dept)
                {
                   //echo("department " .$dept->title ."<br>");//exit;

 
                    foreach($allProjects as $project)
                    {  

                         $project_hourly_logged[$project->id] =  $this->projectexpensemodel->projectHourlyLogs($project->id,$start_date,$end_date);
                         $curr_project_total_hourLogged = $project_hourly_logged[$project->id]['amount'];
                       //  var_dump($curr_project_total_hourLogged);exit;

                         $total_logged_by_depart = 
                         $this->projectexpensemodel->toatalLogedHoursByDepartment($project->id,$dept->id,$start_date,$end_date);
                         //var_dump($total_logged_by_depart);//exit;
                        // var_dump($project->id,$dept->id);

                         $project_department_hourly_log[$project->id][$dept->id]  = $total_logged_by_depart['hours'];
                        // var_dump($project_department_hourly_log);exit;

                         $curr_dept_hr_log = $total_logged_by_depart['hours'];

                         if((int)$curr_project_total_hourLogged<=0)
                         {
                         	$unclaim_expense = $single_project_amount['amount'];
                         	$unclaim_receivable  = $dpeartment_recieveble[$project->id];
                         	// var_dump($departments);
                         	// var_dump($project->id);
                         	//  var_dump($dpeartment_recieveble[$project->id]);//exit;
                         	//  echo '<br/>';
                         }else
                         {

                         	$unclaim_expense = 0;
                         	$unclaim_receivable  = 0;

                         }



                        $single_project_amount =  $this->projectexpensemodel->getExpByRevenueHeadDeptAmountByProjectByDate($project->id,$start_date,$end_date);
                        $all_project_expense[$project->id] = $single_project_amount['amount'];

                        //Department Direct cost = department hr log/total hour  * total direct cost
                       
                         if($curr_dept_hr_log>0)
                         {
                        $curr_dept_exp_amount = 
                        $curr_dept_hr_log/$curr_project_total_hourLogged * $single_project_amount["amount"];
                        }else
                        {
                            $curr_dept_exp_amount = 0;
                        }

                        $departProjectDetails = $this->projectbudgetmodel->getProjectDepartmentSettings($project->id,$dept->id);
                        $department_project_amount_allocated = $departProjectDetails['department_budget'];
                        $department_project_allocation[$project->id][$dept->id] = $department_project_amount_allocated;
                        $department_percentage = ($departProjectDetails['percentage']); 
                        $department_allocated_expense = $single_project_amount['amount']*($department_percentage/100);
                        $department_allocated_expense =  $curr_dept_hr_log/$curr_project_total_hourLogged * $single_project_amount['amount'];
 
                         if($dept->id==10){ 


                         	$department_allocated_expense = (int)$department_allocated_expense+$unclaim_expense;  }

                        $department_project_direct_cost[$project->id][$dept->id] = $department_allocated_expense;
                        $departProjectPersonalCost = $this->projectexpensemodel->getPersonnelCostByDepartmentbyDateByPorject($dept->id,$start_date,$end_date,$project->id)['rate_cost'];
                      //   var_dump($departProjectPersonalCost);exit;

                        $department_project_direct_personal_cost[$project->id][$dept->id] = $departProjectPersonalCost;
                      //  $department_allocated_recievable_amount = $dpeartment_recieveble[$project->id]*($department_percentage/100);
                        //$department_project_recievieable[$project->id][$dept->id] = $department_allocated_recievable_amount;
                       // var_dump($curr_dept_hr_log,$curr_project_total_hourLogged,$dpeartment_recieveble[$project->id]);echo "<br/>";
                         $current_receivable =  $curr_dept_hr_log/$curr_project_total_hourLogged * $dpeartment_recieveble[$project->id];
 
                         if($dept->id==10){
                         	
                         	
                          $current_receivable = (int)$current_receivable + $unclaim_receivable;  
                          //if($project->id==61){ var_dump((int)$current_receivable);exit;}
                      }
                         

                        $department_project_recievieable[$project->id][$dept->id] =$current_receivable;

                       
                       // if($dept->id==10){ var_dump($department_project_recievieable[$project->id][$dept->id]);exit;}
                        
                    
                    }
                                      
                }

               // exit;

//die("abasaa");
                
              // var_dump($department_project_recievieable[61]);exit;
                //var_dump($dpeartment_recieveble);exit;
                $data['recievable'] = $department_recieveable_by_revenue_header;
                $exp = $this->projectexpensemodel->getAmountAllByDate($start_date,$end_date);
                $cost = $this->projectexpensemodel->getPersonnelCostAllByDate($start_date,$end_date);
                 
                $data['department_project_allocation'] = $department_project_allocation;
                $data['department_project_direct_cost'] = $department_project_direct_cost;
                $data['department_project_direct_personal_cost'] = $department_project_direct_personal_cost;
                $data['department_project_recievieable'] = $department_project_recievieable;


                $data['dept'] = $departments;
                $data['allProjects'] = $allProjects;
                $data['expByProjectPersonel'] = $expByProjectPersonel;
                $data['project_expenses'] =  $exp['amount']+$cost['rate_cost'];
 
               
                $data['project_hourly_logged'] = $project_hourly_logged;
                $data['project_department_hourly_log'] = $project_department_hourly_log;
                $data['project_receivable'] = $dpeartment_recieveble;
                $data['all_project_expense'] = $all_project_expense;
                //    var_dump($all_project_expense);exit;

                    ob_start();

    //output the excel headers
    //var_dump(headers_list());;

header("Pragma: public");

header("Cache-Control: no-store, no-cache, must-revalidate");

header("Cache-Control: pre-check=0, post-check=0, max-age=0");

header("Pragma: no-cache");

header("Expires: 0");

header("Content-Transfer-Encoding: none");

header("Content-Type: application/vnd.ms-excel;");

header("Content-type: application/x-msexcel");

header("Content-Disposition: attachment; filename=Rejected Transaction".".xls");
$data['is_excel'] = 1;
//out put the table body
echo"<table border='1'>";
echo"<tbody>";
        
              //  $this->load->view('projectreportprofitabilitybydeptV2',$data);
                 $this->load->view('projectreportprofitabilitybydeptExcel',$data);

                   echo"</tbody>";
$ExcelData=ob_get_contents();
ob_end_clean();
echo $ExcelData; 
                       
        

}




//DEPARTMENTAL PROFITABILITY
public function projectDepartmentProfitabilityV2()
{
  
  // error_reporting(E_ALL);
  // ini_set('display_errors', '1');
	echo '.';
	//exit;
ob_start();
set_time_limit(0);
                $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
               // $departments = $this->departmentmodel->getAllDepartment();
                $departments = $this->departmentmodel->getAllHrDepartment();

                extract($_POST);
                //var_dump($_POST);exit;
                $_SESSION['date_filter'] = $_POST;
                if (!($start_date))
                    {
                         $start_date = "2024-01-01";
                         $end_date =  "2024-12-01";
                    }
               // var_dump($start_date);exit; 
                             $budget_head_by_dept = array();
                $total_allocated = 0;
                foreach($budget_details as $budgetBrk)
                {
                        $total_allocated = $total_allocated+$budgetBrk->department_budget;
                }

                foreach($departments as $dept)
                {
                        $budget_header_single_dept = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeaderAll($dept->id);
                        $budget_head_by_dept[$dept->id] = $budget_header_single_dept;
                }
                $allProjects = $this->projectbudgetmodel->getAllprojectIndexed(); 

                $dpeartment_recieveble =  $this->projectbudgetmodel->ProjectRecieveableIncomeAllByDate($start_date,$end_date);
              


                $data['dpeartment_recieveble'] = $dpeartment_recieveble;
                $expByDeptRevenueHead = array();
                $department_project_allocation = array();
                $department_project_direct_cost = array();
                $department_project_direct_personal_cost = array();
                $department_project_recievieable = array();
                $project_department_hourly_log = array();

                foreach($departments as $dept)
                {
                   //echo("department " .$dept->title ."<br>");//exit;
                  
 
                    foreach($allProjects as $project)
                    {  

                         $project_hourly_logged[$project->id] =  $this->projectexpensemodel->projectHourlyLogs($project->id,$start_date,$end_date);
                         $curr_project_total_hourLogged = $project_hourly_logged[$project->id]['amount'];
                       //  var_dump($curr_project_total_hourLogged);exit;

                         $total_logged_by_depart = 
                         $this->projectexpensemodel->toatalLogedHoursByDepartment($project->id,$dept->id,$start_date,$end_date);
                         //var_dump($total_logged_by_depart);//exit;
                        // var_dump($project->id,$dept->id);

                         $project_department_hourly_log[$project->id][$dept->id]  = $total_logged_by_depart['hours'];
                        // var_dump($project_department_hourly_log);exit;

                         $curr_dept_hr_log = $total_logged_by_depart['hours'];

                         if((int)$curr_project_total_hourLogged<=0)
                         {
                         	$unclaim_expense = $single_project_amount['amount'];
                         	$unclaim_receivable  = $dpeartment_recieveble[$project->id];
                         	// var_dump($departments);
                         	// var_dump($project->id);
                         	//  var_dump($dpeartment_recieveble[$project->id]);//exit;
                         	//  echo '<br/>';
                         }else
                         {

                         	$unclaim_expense = 0;
                         	$unclaim_receivable  = 0;

                         }



                        $single_project_amount =  $this->projectexpensemodel->getExpByRevenueHeadDeptAmountByProjectByDate($project->id,$start_date,$end_date);
                        $all_project_expense[$project->id] = $single_project_amount['amount'];

                        //Department Direct cost = department hr log/total hour  * total direct cost
                       
                         if($curr_dept_hr_log>0)
                         {
                        $curr_dept_exp_amount = 
                        $curr_dept_hr_log/$curr_project_total_hourLogged * $single_project_amount["amount"];
                        }else
                        {
                            $curr_dept_exp_amount = 0;
                        }

                        $departProjectDetails = $this->projectbudgetmodel->getProjectDepartmentSettings($project->id,$dept->id);
                        $department_project_amount_allocated = $departProjectDetails['department_budget'];
                        $department_project_allocation[$project->id][$dept->id] = $department_project_amount_allocated;
                        $department_percentage = ($departProjectDetails['percentage']); 
                        $department_allocated_expense = $single_project_amount['amount']*($department_percentage/100);
                        $department_allocated_expense =  $curr_dept_hr_log/(int)$curr_project_total_hourLogged * $single_project_amount['amount'];
 
                         if($dept->id==10){ 


                         	$department_allocated_expense = (int)$department_allocated_expense+$unclaim_expense;  }

                        $department_project_direct_cost[$project->id][$dept->id] = $department_allocated_expense;
                        $departProjectPersonalCost = $this->projectexpensemodel->getPersonnelCostByDepartmentbyDateByPorject($dept->id,$start_date,$end_date,$project->id)['rate_cost'];
                      //   var_dump($departProjectPersonalCost);exit;

                        $department_project_direct_personal_cost[$project->id][$dept->id] = $departProjectPersonalCost;
                      //  $department_allocated_recievable_amount = $dpeartment_recieveble[$project->id]*($department_percentage/100);
                        //$department_project_recievieable[$project->id][$dept->id] = $department_allocated_recievable_amount;
                       // var_dump($curr_dept_hr_log,$curr_project_total_hourLogged,$dpeartment_recieveble[$project->id]);echo "<br/>";
                         $current_receivable =  $curr_dept_hr_log/(int)$curr_project_total_hourLogged * $dpeartment_recieveble[$project->id];
 
                         if($dept->id==10){
                         	
                         	
                          $current_receivable = (int)$current_receivable + (int)$unclaim_receivable;  
                          //if($project->id==61){ var_dump((int)$current_receivable);exit;}
                      }
                         

                        $department_project_recievieable[$project->id][$dept->id] =$current_receivable;

                       
                       // if($dept->id==10){ var_dump($department_project_recievieable[$project->id][$dept->id]);exit;}
                        
                    
                    }

                                 
                }
 
               // exit;

//die("abasaa");
                
              // var_dump($department_project_recievieable[61]);exit;
                //var_dump($dpeartment_recieveble);exit;
                $data['recievable'] = $department_recieveable_by_revenue_header;
                $exp = $this->projectexpensemodel->getAmountAllByDate($start_date,$end_date);
                $cost = $this->projectexpensemodel->getPersonnelCostAllByDate($start_date,$end_date);
                 
                $data['department_project_allocation'] = $department_project_allocation;
                $data['department_project_direct_cost'] = $department_project_direct_cost;
                $data['department_project_direct_personal_cost'] = $department_project_direct_personal_cost;
                $data['department_project_recievieable'] = $department_project_recievieable;


                $data['dept'] = $departments;
                $data['allProjects'] = $allProjects;
                $data['expByProjectPersonel'] = $expByProjectPersonel;
                $data['project_expenses'] =  $exp['amount']+$cost['rate_cost'];
 
               
                $data['project_hourly_logged'] = $project_hourly_logged;
                $data['project_department_hourly_log'] = $project_department_hourly_log;
                $data['project_receivable'] = $dpeartment_recieveble;
                $data['all_project_expense'] = $all_project_expense;
                //    var_dump($all_project_expense);exit;
                
              //  $data['id'] = $id;
                $this->load->view('header');
                $this->load->view('projectreportprofitabilitybydeptV2',$data);
                $this->load->view('footer');
                $this->load->view('setbudgetscript',$data);                  
        

}



//DEPARTMENTAL PROFITABILITY
public function projectDepartmentProfitability()
{
  
                $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
                $departments = $this->departmentmodel->getAllDepartment();
                extract($_POST);
                //var_dump($_POST);exit;
                $_SESSION['date_filter'] = $_POST;
                if (!($start_date))
                    {
                         $start_date = "2022-01-01";
                         $end_date =  "2023-12-01";
                    }
               // var_dump($start_date);exit; 
                $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetailsAll();
                $budget_head_by_dept = array();
                $total_allocated = 0;
                foreach($budget_details as $budgetBrk)
                {
                        $total_allocated = $total_allocated+$budgetBrk->department_budget;
                }

                foreach($departments as $dept)
                {
                        $budget_header_single_dept = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeaderAll($dept->id);
                        $budget_head_by_dept[$dept->id] = $budget_header_single_dept;
                }
                $allProjects = $this->projectbudgetmodel->getAllprojectIndexed(); 

                $dpeartment_recieveble =  $this->projectbudgetmodel->ProjectRecieveableIncomeAllByDate($start_date,$end_date);
                $data['dpeartment_recieveble'] = $dpeartment_recieveble;
                $expByDeptRevenueHead = array();
                $department_project_allocation = array();
                $department_project_direct_cost = array();
                $department_project_direct_personal_cost = array();
                $department_project_recievieable = array();
                foreach($departments as $dept)
                {
                   //echo("department " .$dept->title ."<br>");//exit;

 
                    foreach($allProjects as $project)
                    {  
                        $single_project_amount =  $this->projectexpensemodel->getExpByRevenueHeadDeptAmountByProjectByDate($project->id,$start_date,$end_date);
                        $departProjectDetails = $this->projectbudgetmodel->getProjectDepartmentSettings($project->id,$dept->id);
                        $department_project_amount_allocated = $departProjectDetails['department_budget'];
                        $department_project_allocation[$project->id][$dept->id] = $department_project_amount_allocated;
                        $department_percentage = ($departProjectDetails['percentage']); 
                        $department_allocated_expense = $single_project_amount['amount']*($department_percentage/100);
                        $department_project_direct_cost[$project->id][$dept->id] = $department_allocated_expense;
                        $departProjectPersonalCost = $this->projectexpensemodel->getPersonnelCostByDepartmentbyDateByPorject($dept->id,$start_date,$end_date,$project->id)['rate_cost'];
                        $department_project_direct_personal_cost[$project->id][$dept->id] = $departProjectPersonalCost;
                        $department_allocated_recievable_amount = $dpeartment_recieveble[$project->id]*($department_percentage/100);
                        $department_project_recievieable[$project->id][$dept->id] = $department_allocated_recievable_amount;
                        
                    
                    }
                                      
                }


                 
                $data['recievable'] = $department_recieveable_by_revenue_header;
                $exp = $this->projectexpensemodel->getAmountAllByDate($start_date,$end_date);
                $cost = $this->projectexpensemodel->getPersonnelCostAllByDate($start_date,$end_date);
                 
                $data['department_project_allocation'] = $department_project_allocation;
                $data['department_project_direct_cost'] = $department_project_direct_cost;
                $data['department_project_direct_personal_cost'] = $department_project_direct_personal_cost;
                $data['department_project_recievieable'] = $department_project_recievieable;


                $data['dept'] = $departments;
                $data['allProjects'] = $allProjects;
                $data['expByProjectPersonel'] = $expByProjectPersonel;
                $data['project_expenses'] =  $exp['amount']+$cost['rate_cost'];

               
            
                
              //  $data['id'] = $id;
                $this->load->view('header');
                $this->load->view('projectreportprofitabilitybydept',$data);
                $this->load->view('footer');
                $this->load->view('setbudgetscript',$data);                  
        

}









//DEPARTMENTAL PROFITABILITY
public function projectreportprofitability()
{
//var_dump($_SESSION);exit;
    //    if($id>0){
                
                //$project_details = $this->projectbudgetmodel->getsingleprojects($id); 
              // var_dump($project_details);;
                $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
                $departments = $this->departmentmodel->getAllDepartment();

                    extract($_POST);
                    if (!($this->input->server('REQUEST_METHOD') === 'POST'))
                    {
                         $start_date = "2022-01-01";
                         $end_date =  "2022-12-01";
                    }
              

             //   $budget = $this->projectbudgetmodel->getsingleprojectBudget($id);
                $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetailsAll();
            //   var_dump($budget);;
                $budget_head_by_dept = array();
                $total_allocated = 0;
                foreach($budget_details as $budgetBrk)
                {
                        $total_allocated = $total_allocated+$budgetBrk->department_budget;
                }

                foreach($departments as $dept)
                {
                        $budget_header_single_dept = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeaderAll($dept->id);
                        $budget_head_by_dept[$dept->id] = $budget_header_single_dept;
                }
                $allProjects = $this->projectbudgetmodel->getAllprojectIndexed(); 

                $expByDeptRevenueHead = array();
                foreach($departments as $dept)
                {
                   //echo("department " .$dept->title ."<br>");//exit;

                    foreach($allProjects as $project)
                    {
                      //  echo("Project Name : ".$project->name."<br>");
                        $single_project_amount =  $this->projectexpensemodel->getExpByRevenueHeadDeptAmountByProjectByDate($project->id,$start_date,$end_date);
                        $departProjectDetails = $this->projectbudgetmodel->getProjectDepartmentSettings($project->id,$dept->id);
                        $department_percentage = ($departProjectDetails['percentage']);
                      //  echo("Total Expense : ".$single_project_amount."<br>");
                     //   var_dump($single_project_amount);
                     //   echo("Department Parecentage : ".$department_percentage."<br>");
                        $department_allocated_amount = $single_project_amount['amount']*($department_percentage/100);
                    //    echo("department allocated amount : ".$department_allocated_amount."<br>");

                        foreach($getRevenueHead as $revHeadSingle)
                        {   //echo $dept->id.'<br>'; getExpByRevenueHeadDeptAmountByProject
                            //embed revenue head here 
                            $single_project_prop = $this->projectbudgetmodel->getProjectDepartmentBudgetRevSettings($project->id,$dept->id,$revHeadSingle->revenue_head);
                            $current_percentage = $single_project_prop['percentage']; 
                            $RevenueOnProjectByDepartment = $department_allocated_amount*($current_percentage/100);                            
                            $expByDeptRevenueHead[$dept->id][$revHeadSingle->revenue_head] =  $expByDeptRevenueHead[$dept->id][$revHeadSingle->revenue_head]+$RevenueOnProjectByDepartment;
                       //     echo("Revenue Headers : ".$revHeadSingle->revenue_head."<br>");
                        //    echo("Amount : ".$RevenueOnProjectByDepartment."<br>");
                          //  $expByDeptRevenueHead[$dept->id][$revHeadSingle->revenue_head] =  
                          //  $this->projectexpensemodel->getExpByRevenueHeadDeptAmountAll($revHeadSingle->revenue_head,$dept->id)['amount'];
                        }  
 
                    }
                 //   echo '----------------------------------------------------------------<br/>';
                    //var_dump($expByDeptRevenueHead);exit; 
                        // foreach($getRevenueHead as $revHeadSingle)
                        // {   //echo $dept->id.'<br>'; getExpByRevenueHeadDeptAmountByProject
                        //     //embed revenue head here 
                        //     $expByDeptRevenueHead[$dept->id][$revHeadSingle->revenue_head] =  
                        //     $this->projectexpensemodel->getExpByRevenueHeadDeptAmountAll($revHeadSingle->revenue_head,$dept->id)['amount'];
                       // }                      
                }
             //   exit;

                foreach($departments as $dept)
                {
                    $expByProjectPersonel[$dept->id]=   $this->projectexpensemodel->getPersonnelCostByDepartmentbyDate($dept->id,$start_date,$end_date)['rate_cost'];              
                }
                
              //  var_dump($expByDeptRevenueHead);
             //   var_dump( $expByProjectPersonel);exit;


                $dpeartment_recieveble =  $this->projectbudgetmodel->ProjectRecieveableIncomeAllByDate($start_date,$end_date);
                $data['dpeartment_recieveble'] = $dpeartment_recieveble;
               // var_dump($dpeartment_recieveble);exit;
               
                $department_recieveable_by_revenue_header = array();
                foreach($departments as $dept)
                {

                    
                    foreach($allProjects as $project)
                    {
                        $recievable_sum_by_project_by_Header =  0;  
                        $getProjectRevSettings = $this->projectbudgetmodel->getProjectRevSettings($project->id);
                        $departProjectDetails = $this->projectbudgetmodel->getProjectDepartmentSettings($project->id,$dept->id);
                        $department_percentage = ($departProjectDetails['percentage']);//exit;
                        $department_allocated_amount = $dpeartment_recieveble[$project->id]*($department_percentage/100);
                     //   var_dump($getProjectRevSettings);exit;
                        foreach($getRevenueHead as $revHeadSingle)
                        {   
                             $RevenueOnProjectByDepartment = 0;
                             $current_rev_header = $revHeadSingle->revenue_head;
                             $single_project_prop = $this->projectbudgetmodel->getProjectDepartmentBudgetRevSettings($project->id,$dept->id,$current_rev_header);
                            // var_dump($single_project_prop);
                            // echo "<br>-------------------<br>";
                             if(isset($single_project_prop['percentage']) && $single_project_prop['percentage'] > 0)
                             {
                                $current_percentage = $single_project_prop['percentage']; 
                                $project_recieveable = $dpeartment_recieveble[$project->id];
                                $current_header_percentage = $current_percentage;
                                $RevenueOnProjectByDepartment = $department_allocated_amount*($current_header_percentage/100); 
                                // echo 'project_recieveable:::'.$project_recieveable.'<br>';
                                // echo 'RevenueOnProjectByDepartment:::'.$RevenueOnProjectByDepartment.'<br>';
                                // echo 'current_percentage:::'.$current_percentage.'<br>';
                              // echo "-------------------";
                             }else
                             {
                                $RevenueOnProjectByDepartment = 0;
                             }
                            // foreach($getProjectRevSettings as $projectDetails)
                            //  {
                              
                            //     $this->projectbudgetmodel->getProjectDepartmentBudgetRevSettings($project_id,$department,$rev_head);
                            //     if($projectDetails->department==$dept->id 
                            //         && $projectDetails->budget_head==$revHeadSingle->revenue_head  
                            //         && $project->id==$projectDetails->project_id)
                            //     {
                            //         // var_dump($projectDetails->department,$dept->id 
                            //         // , $projectDetails->budget_head,$revHeadSingle->revenue_head  
                            //         // ,$project->id,$projectDetails->project_id);


                            //         $current_percentage = $projectDetails->percentage;//exit;   
                            //        // continue;                                 
                            //     }
                                 
                            //  }
                                
                                $department_recieveable_by_revenue_header[$dept->id][$current_rev_header] = $department_recieveable_by_revenue_header[$dept->id][$current_rev_header]+$RevenueOnProjectByDepartment;
                                
                        }
                       
                   
                       }
                       
                    //    if($dept->id==2)
                    //    {
                        
                    //    }
                       
                       
                }
              // exit;

              //  var_dump($department_recieveable_by_revenue_header);exit;
                $data['recievable'] = $department_recieveable_by_revenue_header;
                $exp = $this->projectexpensemodel->getAmountAllByDate($start_date,$end_date);
                $cost = $this->projectexpensemodel->getPersonnelCostAllByDate($start_date,$end_date);
                //var_dump($data['recievable']);exit;                

                $data['expByDeptRevenueHead'] = $expByDeptRevenueHead;
                $data['budget'] = $budget;
                $data['total_allocated'] = $total_allocated;
                $data['budget_details'] = $budget_details;
                $data['budget_head_by_dept'] = $budget_head_by_dept;
                $data['dept'] = $departments;
                $data['expByProjectPersonel'] = $expByProjectPersonel;
               // $data['project_details'] = $project_details;
                $data['getRevenueHead'] = $getRevenueHead;
              //  $data['budget_id'] = $id;
               // $data['project_recognized_income'] = $this->projectbudgetmodel->getRecognizedIncomeAll($id)['rev_amount'];
                $data['project_expenses'] =  $exp['amount']+$cost['rate_cost'];

               
            
                
              //  $data['id'] = $id;
                $this->load->view('header');
                $this->load->view('projectreportprofitability',$data);
                $this->load->view('footer');
                $this->load->view('setbudgetscript',$data);                  
        // }
        // else
        // {
        //         $this->session->set_flashdata('error', 'Invalid Request');
        //         redirect('admin/projectbudget');
        // }

}



    function photo($image,$display=0){
        //  var_dump(base_url('passport/'.$image));;
      // if(getimagesize(base_url('passport/'.$image)))


      if (strpos($image, 'pdf') !== false) {
        $myfilename = base_url('exp_files/pdf.jpg');
        $dmyfilename = "<img  src='$myfilename' "
        . " />";
        echo $dmyfilename;
    }else{
      if(empty($image))
          {
              $image="default.png"  ;       //if image not found this will display
           }
      $myfilename = base_url('exp_files/'.$image);
      $dir = 'exp_files/'.$image;
      $defaultfilename = base_url('exp_files/default.png');//var_dump(($myfilename));;
      if (file_exists($dir)) {
      $dmyfilename = "<img  style='inline-size:120px;block-size:120px;' src='$myfilename' "
              . " />";
        if($display==1){
          $dmyfilename = "<img  src='$myfilename' "
              . " />";
              }
      }
      else {
      $dmyfilename = "<img style='inline-size:120px;block-size:120px;' src='$defaultfilename' />";
       if($display==1){
          $dmyfilename = "<img  src='$defaultfilename' "
              . " />";
              }
      }

     echo $dmyfilename;
    }


    }

     public function deleteclaimexpense($id){

    $resp = $this->projectexpensemodel->delproexpense($id);
    if ($resp) {
      $_SESSION['success_message'] = 'Expense deleted';

    } else {
     $_SESSION['message_error'] = 'Expense could not be deleted. Please try again';

    }
    redirect(base_url('admin/projectexpense/expenselog'));
    }

    public function editclaimexpense($id)
    {
        //var_dump($_POST);;
     
        $log_id = $id;
        $data['id'] = $id;
        $data['log_details'] = $this->projectexpensemodel->getsinglelog($log_id);
        //var_dump($data['log_details']);;

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        if ($_POST) {
            $config = array(
                'upload_path' => './exp_files/',
                'allowed_types' => 'gif|jpg|png|jpeg|pdf',
                'overwrite' => FALSE,
                'max_size' => '2048', // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'encrypt_name' => TRUE
                );
            //var_dump($_FILES["userfile"]['name']);;
            if($_FILES["userfile"]['name'] != ""){

                        $new_name = time().$_FILES["userfile"]['name'];
                                
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('userfile')) {
                            //$data_record = array('upload_data' => $this->upload->data());
                            $pass = $this->upload->data();
                            extract($_POST);
                            $exp_details = array(
                                "file_name"=>$pass['file_name'],
                                "project_id"=>$project_id,
                                "exp_cat"=>$exp_cat,
                                "exp_line"=>$exp_line,
                                "log_date"=>$log_date,
                                "description"=>$description,
                                "amount"=>$amount,
                                "project_task"=>$project_task,
                                "employee_id"=>$_SESSION['login_detal']->employee_id,
                                "current_date"=>date('Y-m-d H:i:s')
                            );
                            $log_id = $this->projectexpensemodel->updateExpense($log_id,$exp_details);
                            if ($log_id) {
                                $this->sendStaffMailMotification($id,$exp_details);
                                $this->session->set_flashdata('sucess_message', 'Project Expense modified successfully');
                                redirect('admin/projectexpense/expenselog');
                            }else{
                                $data['message_error'] = 'Internal Server Error, Please try again later';
                            }
                        } else {
                           $data['message_error'] = $this->upload->display_errors();
                           // die($this->upload->display_errors());
                            //;
                        }
                    }else{

                            extract($_POST);
                            $exp_details = array(
                                "project_id"=>$project_id,
                                "project_task"=>$project_task,
                                "exp_cat"=>$exp_cat,
                                "exp_line"=>$exp_line,
                                "log_date"=>$log_date,
                                "description"=>$description,
                                "amount"=>$amount,
                                "employee_id"=>$_SESSION['login_detal']->employee_id,
                                "current_date"=>date('Y-m-d H:i:s')
                            );
                            $log_id = $this->projectexpensemodel->updateExpense($log_id,$exp_details);
                             if ($log_id) {
                                $this->sendStaffMailMotification($id,$exp_details);
                                $this->session->set_flashdata('sucess_message', 'Project Expense modified successfully');
                                redirect('admin/projectexpense/expenselog');
                            }else{
                                $data['message_error'] = 'Internal Server Error, Please try again later';
                            }

                    }
        }
        $this->load->view('editclaimexpense', $data);
        $this->load->view('footer');
    
    }

     public function genTransactionID()
    {
        
        do {
                $bytes = openssl_random_pseudo_bytes(rand(100,999));
                $hex   = substr(bin2hex($bytes),1,10);
                $response = $this->generalmodel->check_duplicate_trans($hex, 'project_exp_log');
            } while ($response == TRUE);
           
        return "BCT/EXP/PRJ".$hex;
    }

    public function claimexpense()
    {
        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getAllProjects();
       // var_dump($data['user_proj_list']);;
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        $data['getRevenueHead'] =  $this->projectbudgetmodel->getRevenueHead();   
        

        if ($_POST) {
            $config = array(
                'upload_path' => './exp_files/',
                'allowed_types' => 'gif|jpg|png|jpeg|pdf',
                'overwrite' => true,
                'max_size' => '2048', // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'encrypt_name' => TRUE
                );
            if($_FILES["userfile"]['name'] != ""){
                $new_name = time().$_FILES["userfile"]['name'];
        
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userfile')) {
                    //$data_record = array('upload_data' => $this->upload->data());
                    $pass = $this->upload->data();
                    extract($_POST);
                    $exp_details = array(
                        "file_name"=>$pass['file_name'],
                        "project_id"=>$project_id,
                        "project_task"=>$project_task,
                        'trans_id' => $this->genTransactionID(),
                        "exp_cat"=>$exp_cat,
                        "exp_line"=>$exp_line,
                        "log_date"=>$log_date,
                        "description"=>$description,
                        "amount"=>$amount,
                        "employee_id"=>$_SESSION['login_detal']->employee_id,
                        "expense_head"=>$expense_head,
                        "current_date"=>date('Y-m-d H:i:s')
                    );
                   
                    $log_id = $this->projectexpensemodel->logProjectExpense($exp_details);
                    if ($log_id) {
                        $this->sendStaffMailMotification($log_id,$exp_details);
                        $data['sucess_message'] = 'Project Expense logged successfully';
                        $_POST = array();
                    }else{
                        $data['message_error'] = 'Internal Server Error, Please try again later';
                    }
                    
                } 
                else {
                    $data['message_error'] = $this->upload->display_errors();
                // die($this->upload->display_errors());
                // ;
                }

            }
            else{
                extract($_POST);
                    $exp_details = array(
                        "file_name"=> 'default.jpg',
                        "project_id"=>$project_id,
                        "project_task"=>$project_task,
                        'trans_id' => $this->genTransactionID(),
                        "exp_cat"=>$exp_cat,
                        "exp_line"=>$exp_line,
                        "log_date"=>$log_date,
                        "description"=>$description,
                        "amount"=>$amount,
                        "employee_id"=>$_SESSION['login_detal']->employee_id,
                        "expense_head"=>$expense_head,
                        "current_date"=>date('Y-m-d H:i:s')
                    );
                    $log_id = $this->projectexpensemodel->logProjectExpense($exp_details);
                    if ($log_id) {
                        $this->sendStaffMailMotification($log_id,$exp_details);
                        $data['sucess_message'] = 'Project Expense logged successfully';
                        $_POST = array();
                    }else{
                        $data['message_error'] = 'Internal Server Error, Please try again later';
                    }

            }
        }
        $this->load->view('claimexpense', $data);
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->projectexpensemodel->getProjExpLog($config['per_page'], $page, $_SESSION['login_detal']->employee_id);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('expenselogprojmanager', $data);
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->projectexpensemodel->getDirectorExpLog($config['per_page'], $page, $_SESSION['login_detal']->employee_id);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('expenselogdirector', $data);
        $this->load->view('footer');
    }

    public function unapprovedexpenselog()
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->projectexpensemodel->getUnappProjExpLog($config['per_page'], $page, $_SESSION['login_detal']->employee_id);
        $data['links'] = $this->pagination->create_links();
        $data["title"] = "Unapproved Employee Expense Request Log";

        $this->load->view('header');
        $this->load->view('unapprovedexpenselog', $data);
        $this->load->view('footer');
    }


    public function rejectedexpenselog()
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->projectexpensemodel->getRejectedProjExpLog($config['per_page'], $page, $_SESSION['login_detal']->employee_id);
        $data['links'] = $this->pagination->create_links();
        $data["title"] = "Rejected Employee Expense Request Log";

        $this->load->view('header');
        $this->load->view('unapprovedexpenselog', $data);
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
        $config['total_rows'] = $this->projectexpensemodel->getProjExpLogFinControlerCount(); // $this->db->count_all('users');
        $config['per_page'] = '5000';
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;;
        //load the model and get results
        $this->load->model('usersmodel');
        $data['results'] = $this->projectexpensemodel->getProjExpLogFinControler($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('expenselogfincontroller', $data);
        $this->load->view('footer');
    }


    public function dirupdate($id){

        $log_id = $id;
        $data['id'] = $id;
        $data['log_id'] = $id;
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $taskStatus = $this->settingsmodel->taskStatus();
            foreach($taskStatus as $s){
                $taskStatus_arr[$s->status_id]  = $s->status;
            }
        $data['taskStatus_arr'] = $taskStatus_arr;
        $data['log_details'] = $this->projectexpensemodel->getsinglelog($log_id);
       // var_dump($data['log_details']);;

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        $data['directors'] = $this->settingsmodel->getDirectors();
        //var_dump($data['directors']);;
        if ($_POST) {
            //$data_record = array('upload_data' => $this->upload->data());
                            extract($_POST);
                            $exp_details = array( 
                                "director_status"=>$status,
                                "director_comment"=>$comment,  
                                "director_update_date"=>date('Y-m-d H:i:s')
                            );
                            $log_id = $this->projectexpensemodel->updateExpense($id,$exp_details);
                           
                               if ($log_id) {
                    $this->session->set_flashdata('sucess_message', 'Project Expense modified successfully');
                     $this->sendStaffMailMotificationDirector($id,$exp_details);
                            redirect('admin/projectexpense/expenselogdirector');
                }else{
                    $data['message_error'] = 'Internal Server Error, Please try again later';
                }
                   
                    
        } 
            $this->load->view('dirupdate', $data);
            $this->load->view('footer');
       


    }

    public function projectfinupdate($id){

        $log_id = $id;
        $data['id'] = $id;
        $data['log_id'] = $id;
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $taskStatus = $this->settingsmodel->taskStatus();
            foreach($taskStatus as $s){
                $taskStatus_arr[$s->status_id]  = $s->status;
            }
        $data['taskStatus_arr'] = $taskStatus_arr;
        $data['log_details'] = $this->projectexpensemodel->getsinglelog($log_id);
       // var_dump($data['log_details']);;

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        $data['directors'] = $this->settingsmodel->getDirectors();
        //var_dump($data['directors']);;
        if ($_POST) {
            //$data_record = array('upload_data' => $this->upload->data());
                            extract($_POST);
                            $exp_details = array(
                                "account_controller_id"=>$_SESSION['login_detal']->employee_id,
                                "account_controller_status"=>$status,
                                "account_controller_comment"=>$comment, 
                                "account_controller_date"=>date('Y-m-d H:i:s')
                            );

                            if ($status != 5) {
                                $exp_details["asssigned_director"] = $director;
                            }
                            $log_id = $this->projectexpensemodel->updateExpense($id,$exp_details);
                           
                     if ($log_id) {
                    $this->session->set_flashdata('sucess_message', 'Project Expense modified successfully');
                    $this->sendStaffMailMotificationFinController($id,$exp_details);
                            redirect('admin/projectexpense/expenselogfincont');
                }else{
                    $data['message_error'] = 'Internal Server Error, Please try again later';
                }
                    
        } 
            $this->load->view('finControllereditclaimexpense', $data);
            $this->load->view('footer');
        


    }





    public function projectmanagerupdate($id){
       // var_dump($id);;

        $log_id = $id;
        $data['log_id'] = $log_id;
        $data['id'] = $id;
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $data['log_details'] = $this->projectexpensemodel->getsinglelog($log_id);
      // var_dump($data['log_details']);;

        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();

        if ($_POST) {
                            //$data_record = array('upload_data' => $this->upload->data());
                            extract($_POST);
                            $exp_details = array(
                                "project_manager_id"=>$_SESSION['login_detal']->employee_id,
                                "project_manager_status"=>$status,
                                "project_manager_comment"=>$comment, 
                                "project_manager_update_date"=>date('Y-m-d H:i:s')
                            );
                           // var_dump($id,$exp_details);;

                            $log_id = $this->projectexpensemodel->updateExpense($id,$exp_details);
                            
                   if ($log_id) {
                    $this->session->set_flashdata('sucess_message', 'Project Expense modified successfully');
                    $this->sendStaffMailMotificationProjManeger($id,$exp_details);
                            redirect('admin/projectexpense/expenselogprojmana');
                }else{
                    $data['message_error'] = 'Internal Server Error, Please try again later';
                }
                    
        }
            $this->load->view('projManagereditclaimexpense', $data);
            $this->load->view('footer');
       

    }



    function sendStaffMailMotificationDirector($log_id,$data_details){
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach($taskStatus as $s){
            $taskStatus_arr[$s->status_id]  = $s->status;
        }
        //var_dump($taskStatus);;
        $log_details = $this->projectexpensemodel->getsinglelog($log_id);
        extract($log_details);
        extract($data_details);
       // var_dump($log_details);;
    
        

        //send maile to project manager
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($asssigned_director);
        //var_dump($emplyee_details);;
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_acc = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        
        $recipiant_name = $employee_fullname;
        $subject = 'Update Notification';
        $body = 'Your Update for request ('.$trans_id.') was successful.The finacial controller will be notify for neccessary action.';
       $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email); 
        //contruct status
     
        $pro_name = "<p><strong>Transaction ID</strong>:".$trans_id."</p><p><strong>Director Name</strong>:".$employee_fullname."</p>";
        $pro_status = "<p><strong>Director Status</strong>:".$taskStatus_arr[$director_status]."</p>";
        $pro_comment = "<p><strong>Director Comment</strong>:".$director_comment."</p>";
        $pro_amount= "<p><strong>Amount</strong>:".number_format($amount,2)."</p>"; 
        if($director_status==1){
            $pro_code= "<p><strong>Approval Code</strong>: DAPP".$log_id."</p>";   
        }else{
            $pro_code = "";
        }

        $full_details = $pro_name.$pro_status.$pro_comment.$pro_amount.$pro_code;


        $loger_details = $this->settingsmodel->getEmployeeDetails($employee_id);
        $loger_fullname = $loger_details['first_name'].' '.$loger_details['last_name'];

         //send mail to employee that logged the details
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($account_controller_id);
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_useable = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];

        $recipiant_name = $employee_fullname;           
        $body = $employee_fullname_acc.' just update expense request status you sent to him.<br>
        Below is the full details '.$full_details.'<br/> You can use the link below to view status<br/>
        <a href="'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/status/'.$log_id).'"> Update Status </a>';
        $subject = $loger_fullname.'request log update.';
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $employee_email);

 
 


}


    
    function sendStaffMailMotificationFinController($log_id,$data_details){
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach($taskStatus as $s){
            $taskStatus_arr[$s->status_id]  = $s->status;
        }
        //var_dump($taskStatus);;
        $log_details = $this->projectexpensemodel->getsinglelog($log_id);
        extract($log_details);
        extract($data_details);
       // var_dump($log_details);;
    
        

        //send maile to project manager
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($account_controller_id);
        //var_dump($emplyee_details);;
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_acc = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;
        $subject = 'Approval Notification Notification';
        $body = 'Your approval/rejection Update for request ('.$trans_id.') was successful.
         <br/> You can use the link below to track the progress<br/><a href="'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/status/'.$log_id).'"> View Log Status</>';
       $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email); 
        //contruct status
        $details_cat = "<p><strong>Transaction ID </strong>: ".$trans_id."</p><p><strong>Expense Category </strong>:".$expense_category_name."</p>";
        $details_line = "<p><strong>Expense Category </strong>: ".$expense_line_name."</p>";
        $details_amt = "<p><strong>Requested Amount </strong>: ".number_format($amount,2)."</p>";
        $pro_name = "<p><strong>Project Manager Name </strong>: ".$employee_fullname."</p>";
        $pro_status = "<p><strong>Project Manager Status</strong>: ".$taskStatus_arr[$project_manager_status]."</p>";
        $pro_comment = "<p><strong>Project Manager Name</strong>: ".$project_manager_comment."</p>"; 
        $full_details = $details_cat.$details_line.$details_amt.$pro_name.$pro_status.$pro_comment;

         //send mail to employee that logged the details
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($employee_id);
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_fullname_useable = $employee_fullname;
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname;           
        $body = $employee_fullname_acc.' just update your expense request status <br>
        Below is the full details '.$full_details.'<br/> You can use the link below to view status<br/>'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/status/'.$log_id);
        $subject = $employee_fullname_useable.' update your expense request log.';
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $employee_email);


         //send mail to Director
                 
        $emplyee_details = $this->settingsmodel->getEmployeeDetails($asssigned_director);
        //var_dump($emplyee_details);;
        $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
        $employee_email = $emplyee_details['work_email'];
        $recipiant_name = $employee_fullname; 
         
        $body = $employee_fullname_acc.' just forward expense request of '.$employee_fullname_useable.' for approval.<br>
        Below is the full details '.$full_details.'<br/> You can use the link below to approve/reject the request<br/><a href="'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/dirupdate/'.$log_id).'">Approve/Reject Request</a>';
        $subject = $employee_fullname_useable.' expense request approval';
        $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $employee_email);
 


}



    function sendStaffMailMotificationProjManeger($log_id,$data_details){
            $taskStatus = $this->settingsmodel->taskStatus();
            foreach($taskStatus as $s){
                $taskStatus_arr[$s->status_id]  = $s->status;
            }
            //var_dump($taskStatus);;
            $log_details = $this->projectexpensemodel->getsinglelog($log_id);
            extract($log_details);

            extract($data_details);
            //send maile to project manager
            $emplyee_details = $this->settingsmodel->getEmployeeDetails($project_manager_id);
            //var_dump($emplyee_details);;
            $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
            $employee_fullname_useable = $employee_fullname;
            $employee_email = $emplyee_details['work_email'];
            $recipiant_name = $employee_fullname;
            $subject = 'Approval Notification Notification';
            $body = 'Your approval/rejection Update for request ('.$trans_id.') was successful.
             <br/> You can use the link below to track the progress<br/><a href="'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/status/'.$log_id).'"> View Log Status</>';
            $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email); 
            //contruct status
            $details_cat = "<p><strong>Transaction ID</strong>: ".$trans_id."</p><p><strong>Expense Category </strong>:".$expense_category_name."</p>";
            $details_line = "<p><strong>Expense Category </strong>: ".$expense_line_name."</p>";
            $details_amt = "<p><strong>Requested Amount </strong>: ".number_format($amount,2)."</p>";
            $pro_name = "<p><strong>Project Manager Name </strong>: ".$employee_fullname."</p>";
            $pro_status = "<p><strong>Project Manager Status</strong>: ".$taskStatus_arr[$project_manager_status]."</p>";
            $pro_comment = "<p><strong>Project Manager Name</strong>: ".$project_manager_comment."</p>"; 
            $full_details = $details_cat.$details_line.$details_amt.$pro_name.$pro_status.$pro_comment;

             //send mail to employee that logged the details
            $emplyee_details = $this->settingsmodel->getEmployeeDetails($employee_id);
            $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
           // $employee_fullname_useable = $employee_fullname;
           $employee_email = $emplyee_details['work_email'];
            $recipiant_name = $employee_fullname;           
            $body = $employee_fullname_useable.' just update your expense request status <br>
            Below is the full details '.$full_details.'<br/> You can use the link below to view status<br/>'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/status/'.$log_id);
            $subject = $employee_fullname_useable.' update your expense request log.';
            $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $employee_email);


             //send mail to financial controller/hr
            $finController = $this->settingsmodel->getFinControllerDetails(); 
            $body = $employee_fullname_useable.' just update expense request of '.$employee_fullname.'.<br>
            Below is the full details '.$full_details.'<br/> You can use the link below to approve/reject the request<br/>'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/projectfinupdate/'.$log_id);
            $subject = $employee_fullname.' expense request log update';

            foreach ($finController as $t) {
                $recipiant_name = $t->first_name.' '.$t->last_name;
                $to = $t->work_email;
                // var_dump($t);;
                $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
            }



    }

    function status($id){

        $log_id = $id;
        $data['id'] = $id;
        $data['stat'] = 'prj';
        $data['taskStatus'] = $this->settingsmodel->taskStatus();
        $data['log_details'] = $this->projectexpensemodel->getsinglelog($log_id);
        $this->load->view('header');
        $data['user_id'] = $_SESSION['login_detal']->id;
        $data['user_proj_list'] = $this->settingsmodel->getTeamProject($_SESSION['login_detal']->employee_id);
        $data['expense_cat'] = $this->settingsmodel->getexpensecat();
        $taskStatus = $this->settingsmodel->taskStatus();
        foreach($taskStatus as $s){
                $taskStatus_arr[$s->status_id]  = $s->status;
        }
        $data['taskStatus_arr'] = $taskStatus_arr;
        $this->load->view('expStatus', $data);
        $this->load->view('footer');
    }


    function sendStaffMailMotification($log_id,$data_details){
            extract($data_details);
            $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->employee_id);
            $employee_fullname = $emplyee_details['first_name'].' '.$emplyee_details['last_name'];
            $employee_fullname_useable = $employee_fullname;
            $employee_email = $emplyee_details['work_email'];
            //$employee_email = 'tumininuogunsola@yahoo.com';
            $recipiant_name = $employee_fullname;
            $subject = 'Payment Claim Notification';
            $body = 'Your payment request ('.$trans_id.') was successfully logged and waiting for approval from your project manager, You will be updated once he approved.
            <br/> You can use the link below to track the progress<br/>'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/status/'.$log_id);
            $this->sendTeamLeadTimeLogMail($subject, $employee_fullname, $body, $employee_email);
            $expense = $this->projectexpensemodel->getexpenseline($exp_line);
            
            $details_cat = "<p>Transaction ID :".$trans_id."</p><p>Expense Category :".$expense["expense_category_name"]."</p>";
            $details_line = "<p>Expense Category :".$expense["expense_line_name"]."</p>";
            $details_amt = "<p>Requested Amount :".number_format($amount,2)."</p>";
            $full_details = $details_cat.$details_line.$details_amt;

            $project_manager_details = $this->settingsmodel->getProjectManagerDetails($project_id);
            $project_managers = $project_manager_details['project_manager']; 
            $project_managers_details = $this->settingsmodel->getProjectTeamLeads($project_managers);
            $body = $employee_fullname_useable.' Just logged an expense request. Please note that this is waiting for your approval.<br>
            Below is the request details'.$full_details.'<br/> You can use the link below to approve/reject the request<br/>'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/projectmanagerupdate/'.$log_id);
            $subject = $employee_fullname.' expense request log';

            foreach ($project_managers_details as $t) {
                $recipiant_name = $t->first_name.' '.$t->last_name;
                $to = $t->work_email;
                // var_dump($t);;
                $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $to);
            }

            //send mail to team lead
            $project_details = $this->settingsmodel-> getTeamDetails($project_id);
            $team_lead = $project_details['team_lead']; 
            $team_lead_details = $this->settingsmodel->getEmployeeDetails($team_lead);
            $team_lead_fullname = $team_lead_details['first_name'].' '.$team_lead_details['last_name'];
            $team_lead_email =$team_lead_details['work_email']; 
            //$team_lead_email ="tumininuogunsola@yahoo.com";
            $body = $employee_fullname_useable.' Just logged an expense request. Please note that this is waiting for your approval.<br>
            Below is the request details'.$full_details.'<br/> You can use the link below to approve/reject the request<br/>'.base_url('admin/accesscontrol/verifylogin?url=admin/projectexpense/projectmanagerupdate/'.$log_id);
            $subject = $employee_fullname.' expense request log';

            $this->sendTeamLeadTimeLogMail($subject, $team_lead_fullname, $body, $team_lead_email);



    }



    public function sendTeamLeadTimeLogMail($mail_title, $recipiant_name, $body, $to)
    {
        $body = '<html>
    <head>
        <title>Bluechip Technology</title>
    </head>
    <body>
<table style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px; color:#757575; inline-size:600px; background-color:#fff; margin:0" bgcolor="#fff">
	<tbody>
		<tr>
            <td valign="top"></td>
            <td width="600" valign="top">
                <div style="max-inline-size:600px;display:block;margin:0 auto;padding:20px">
                    <table style="background-color:#f5f2f5; margin:0" width="598px" cellspacing="0" cellpadding="0" bgcolor="#F5F2F5">
                        <tbody>
							<tr style="margin:0">
								<td style="text-align:end;padding-inline-end:15px;padding-block-start:20px">
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
