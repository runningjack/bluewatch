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
class batch extends MX_Controller{
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
        $this->load->model('departmentmodel');
        $this->load->model('facultymodel'); 
        $this->load->model('generalmodel');
        $this->load->model('batchmodel');
    }
    
    
public function index(){
    
     if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/batch/index';
    $config['total_rows'] = $this->db->count_all('batch');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    //load the model and get results
    $this->load->model('batchmodel');
    //$data['results'] = $this->facultymodel->getallfaculty($config['per_page'],$page);
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $batch_details = $this->batchmodel->getallbatch($config['per_page'],$page);
   // var_dump($faculty_details);exit;
    
     $data['results'] = $batch_details;
     $this->load->view('header');
      $this->load->view('batchindex',$data);
      $this->load->view('footer');
    
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
        $batch_id = $this->batchmodel->insert_batch($details);
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


public function edit($id=0){
    
    
    
     $this->form_validation->set_rules('batch_name', 'batch name', 'required|xss_clean');
    
     $this->form_validation->set_rules('batch_start', 'batch Start', 'required|xss_clean');
     $this->form_validation->set_rules('batch_end', 'batch end', 'required|xss_clean');
     
     if($id>0){
    $batch_details = $this->batchmodel->getsinglebatch($id);  
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
        $batch_id = $this->batchmodel->update_batch($id,$details);
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
        $batch_id = $this->batchmodel->clear_status('current',$details_clear);
        $batch_id = $this->batchmodel->update_batch($id,$details_current);
         redirect(base_url().'admin/batch/index');
            
        
          
      }

    
    
}


   
    
    
}

?>
