<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of faculty
 *
 * @author Gbadeyanka Abass
 */
class projectbudget extends MX_Controller{
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
        $this->load->model('departmentmodel');        
        $this->load->model('generalmodel');
        $this->load->model('projectbudgetmodel');
    }
    
    
public function index(){
    
     if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
    $_SESSION['message_error'] = '' ;
    $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/projectbudget/index';
    $config['total_rows'] = $this->db->count_all('projects');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    //load the model and get results
    $this->load->model('projectbudgetmodel');
    //$data['results'] = $this->facultymodel->getallfaculty($config['per_page'],$page);
    $data["links"] = $this->pagination->create_links();    
    
    $batch_details = $this->projectbudgetmodel->getallprojects($config['per_page'],$page);
    $data['results'] = $batch_details;
   
    $this->load->view('header');
    $this->load->view('projectbudgetindex',$data);
    $this->load->view('footer');
    
}


public function deleteprojectrev($header_id,$project_id)
{
        $revenue_id = $this->projectbudgetmodel->delete_project_revenue($header_id);
                
        $success_message = 'Revenue Deleted';        
        redirect(base_url().'admin/projectbudget/viewRevenueIncome/'.$project_id.'?sucess_message='.$success_message);  
              

}


public function viewRevenueIncome($id)
{
     $project_details = $this->projectbudgetmodel->getsingleprojects($id); 
     $data['project_details'] = $project_details;
     $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead(); 
     $data['getRevenueHead'] = $getRevenueHead;
     $data['project_id'] = $id;


            
     if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
     $_SESSION['sucess_message'] = '' ;
     
      //send error message to view
       if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
      $_SESSION['message_error'] = '' ;
      $this->db = $this->load->database('default', TRUE);
      $this->load->library('pagination');
      $config['base_url'] = base_url().'admin/projectbudget/viewRevenueIncome/'.$id;
      $config['total_rows'] = $this->db->where('project_id', $id)->count_all('project_revenue');
      $config['per_page'] = '50';
      $config['full_tag_open'] = '<p>';
      $config['full_tag_close'] = '</p>';
       $config["uri_segment"] = 4;
       
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
      //load the model and get results
      $this->load->model('projectbudgetmodel');
      //$data['results'] = $this->facultymodel->getallfaculty($config['per_page'],$page);
      $data["links"] = $this->pagination->create_links();    
      
      $batch_details = $this->projectbudgetmodel->getAllRevenueByProjectID($config['per_page'],$page,$id);
      $data['results'] = $batch_details;
     
      $this->load->view('header');
      $this->load->view('viewRevenueIncome',$data);
      $this->load->view('footer');
}


public function addrevenue()
{
       
        $_POST['created_by'] = $_SESSION['login_detal']->employee_id;
        $revenue_id = $this->projectbudgetmodel->insert_project_revenue($_POST);
        extract($_POST); 

        if ($revenue_id) {
                $success_message = 'Expense added';        
                redirect(base_url().'admin/projectbudget/viewRevenueIncome/'.$project_id.'?sucess_message='.$success_message);  
              } else {
                $message_error = 'Expense could not add expense Please try again';
                redirect(base_url().'admin/projectbudget/viewRevenueIncome/'.$project_id.'?message_error='.$message_error);
          
              }

}


public function add(){
    
    

     $this->form_validation->set_rules('batch_name', 'batch name', 'required|xss_clean');
    
     $this->form_validation->set_rules('batch_start', 'batch Start', 'required|xss_clean');
     $this->form_validation->set_rules('batch_end', 'batch end', 'required|xss_clean');
     
     
    
    
         
      if ($this->form_validation->run() == true){
      $batch_name = $this->input->post('batch_name');
          $batch_start = $this->input->post('batch_start');
         $batch_end = $this->input->post('batch_end');
        //var_dump($department);exit;
        $details = array('batch_name'=> $batch_name
                ,'start_date'=> $batch_start,'end_date'=> $batch_end);
        $batch_id = $this->projectbudgetmodel->insert_batch($details);
         redirect(base_url().'admin/batch/index');
            
        
          
      }
      
      
         
      $data['batch_name'] = array(
				'name'  	=> 'batch_name',
				'id'    	=> 'batch_name',
				'type'  	=> 'text',
				'required class'=> 'form-control',
                               
				);
      $data['batch_status'] = array(
				'name'  	=> 'batch_status',
				'id'    	=> 'batch_status',
				'type'  	=> 'text',
				'required class'=> 'form-control',
                               
				);

      
      
    $this->load->view('header');
      $this->load->view('addbatch',$data);
      $this->load->view('footer');
    
    
}

public function setbudget($id=0)
{
        if($id>0){
                $project_details = $this->projectbudgetmodel->getsingleprojects($id); 
                $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
                $departments = $this->departmentmodel->getAllDepartment();

                $budget = $this->projectbudgetmodel->getsingleprojectBudget($id);
                $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetails($id);
                $budget_head_by_dept = array();
                $total_allocated = 0;
                foreach($budget_details as $budgetBrk)
                {
                        $total_allocated = $total_allocated+$budgetBrk->department_budget;
                }

                foreach($departments as $dept)
                {
                        $budget_header_single_dept = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeader($id,$dept->id);
                        $budget_head_by_dept[$dept->id] = $budget_header_single_dept;
                }

            



                $data['budget'] = $budget;
                $data['total_allocated'] = $total_allocated;
                $data['budget_details'] = $budget_details;
                $data['budget_head_by_dept'] = $budget_head_by_dept;
                $data['dept'] = $departments;
                $data['project_details'] = $project_details;
                $data['getRevenueHead'] = $getRevenueHead;
                $data['budget_id'] = $id;
               // var_dump($budget);exit;
            
                $data['id'] = $id;
                $this->load->view('header');
               // var_dump($budget);exit;
                if($budget)
                {
                        $this->load->view('modifybudget',$data);
                }else
                {
                        $this->load->view('setbudget',$data);
                }
               
                $this->load->view('footer');
                $this->load->view('setbudgetscript',$data);                  
        }
        else
        {
                $this->session->set_flashdata('error', 'Invalid Request');
                redirect('admin/projectbudget');
        }

}






public function viewbudget($id=0)
{
        if($id>0){
                
                $project_details = $this->projectbudgetmodel->getsingleprojects($id); 
                $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();                 
                $departments = $this->departmentmodel->getAllDepartment();

                $budget = $this->projectbudgetmodel->getsingleprojectBudget($id);
                $budget_details = $this->projectbudgetmodel->getsingleprojectBudgetDetails($id);
                $budget_head_by_dept = array();
                $total_allocated = 0;
                foreach($budget_details as $budgetBrk)
                {
                        $total_allocated = $total_allocated+$budgetBrk->department_budget;
                }

                foreach($departments as $dept)
                {
                        $budget_header_single_dept = $this->projectbudgetmodel->getsingleprojectBudgetDetailsHeader($id,$dept->id);
                        $budget_head_by_dept[$dept->id] = $budget_header_single_dept;
                }

                $data['budget'] = $budget;
                $data['total_allocated'] = $total_allocated;
                $data['budget_details'] = $budget_details;
                $data['budget_head_by_dept'] = $budget_head_by_dept;
                $data['dept'] = $departments;
                $data['project_details'] = $project_details;
                $data['getRevenueHead'] = $getRevenueHead;
                $data['budget_id'] = $id;
            
                
                $data['id'] = $id;
                $this->load->view('header');
                $this->load->view('viewProjectbudget',$data);
                $this->load->view('footer');
                $this->load->view('setbudgetscript',$data);                  
        }
        else
        {
                $this->session->set_flashdata('error', 'Invalid Request');
                redirect('admin/projectbudget');
        }

}


public function saveprojectbudget()
{
        $getRevenueHead =  $this->projectbudgetmodel->getRevenueHead();  
        if($_POST)
        {
          extract($_POST);
        //  var_dump($_POST);exit;
          $budgetDetails = array
                                ("project_id"=>$budget_id,
                                 "project_total_budget"=>$project_total_budget);
          $this->projectbudgetmodel->delete_project_budget($budget_id);
          $this->projectbudgetmodel->delete_project_budget_detail($budget_id);
          $this->projectbudgetmodel->delete_project_budget_details_header($budget_id);


         $project_budget_details_id = $this->projectbudgetmodel->insert_projects_budget($budgetDetails);
          for($i=0;$i<count($percentage);$i++)
          {
                $single_record = array(
                                       "project_id"=>$budget_id,
                                       "department"=>$department[$i],
                                       "percentage"=>$percentage[$i],
                                       "department_budget"=>$department_budget[$i]
                                        );
                $departmentDetailsID = $this->projectbudgetmodel->insert_projects_budget_details($single_record);
               
              $sub_index = 1;
             // var_dump($_POST);
              foreach($getRevenueHead as $head)
                {
                        
                        $current_header_values = $_POST[$head->revenue_head];
 
                        $current_index = $i;
                        $r_key_value = 'percentage_'.$sub_index;
                        $single_header_record = array(
                                "percentage"=> $$r_key_value[$i],
                                "project_id"=>$budget_id,
                                "project_budget_detail_id"=>$departmentDetailsID,
                                "department"=>$department[$i],
                                "budget_amount"=>(int)($current_header_values[$i]), 
                                "budget_head"=>$head->revenue_head,
                                "budget_head_id"=>$head->revenue_head_id
                                 );
                     //   var_dump( $single_header_record);
                       $this->projectbudgetmodel->insert_project_budget_details_header($single_header_record);
                 $sub_index++;
                        
                
                 }

          }

        //  exit;

          $this->session->set_flashdata('sucess_message', 'Project Budget Updated Sucessfully');
          redirect('admin/projectbudget?sucess_message=Project Budget Updated Sucessfully');


        }else
        {
                die("Invalid access");
        }
}

public function edit($id=0){
    
    
    
     $this->form_validation->set_rules('batch_name', 'batch name', 'required|xss_clean');
    
     $this->form_validation->set_rules('batch_start', 'batch Start', 'required|xss_clean');
     $this->form_validation->set_rules('batch_end', 'batch end', 'required|xss_clean');
     
     if($id>0){
    $batch_details = $this->projectbudgetmodel->getsinglebatch($id);  
    $data['batch_details'] = $batch_details;
    $data['id'] = $id;
   
         
     }
    
    
         
      if ($this->form_validation->run() == true){
      $batch_name = $this->input->post('batch_name');
          $batch_start = $this->input->post('batch_start');
         $batch_end = $this->input->post('batch_end');
        //var_dump($department);exit;
        $details = array('batch_name'=> $batch_name
                ,'start_date'=> $batch_start,'end_date'=> $batch_end);
        $batch_id = $this->projectbudgetmodel->update_batch($id,$details);
         redirect(base_url().'admin/batch/index');
            
        
          
      }
      
      
         
      $data['batch_name'] = array(
				'name'  	=> 'batch_name',
				'id'    	=> 'batch_name',
				'type'  	=> 'text',
				'required class'=> 'form-control',
                                'value' => $batch_details['batch_name']
                               
				);
     

      
      
      $this->load->view('header');
      $this->load->view('editbatch',$data);
      $this->load->view('footer');
    
    

    
    
}

public function setascurrent($id=0){
        
     if (isset($_POST)){
        $status = 'current';      
        $details_current = array('batch_status'=> $status);
        $details_clear = array('batch_status'=> '');
        $batch_id = $this->projectbudgetmodel->clear_status('current',$details_clear);
        $batch_id = $this->projectbudgetmodel->update_batch($id,$details_current);
         redirect(base_url().'admin/batch/index');
            
        
          
      }

    
    
}


   
    
    
}

?>
