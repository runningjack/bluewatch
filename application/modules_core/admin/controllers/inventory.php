<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of unit
 *
 * @author Gbadeyanka Abass
 */
class inventory extends MX_Controller{
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
       // $this->load->model('cms');
        $this->load->model('subunitmodel');
        $this->load->model('generalmodel');
        $this->load->model('utitlitymodel');
            
        
               
    }
    
    
    Public function index(){
        
        
          if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/inventory/index';
    $config['total_rows'] = $this->db->count_all('order');
    $config['per_page'] = '10';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    //$data['results'] = $this->facultymodel->getallfaculty($config['per_page'],$page);
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $order_details = $this->utitlitymodel->getallforpagination('order',$config['per_page'], $page);
   // var_dump($faculty_details);exit;
    
     $data['results'] = $order_details;
     $this->load->view('header');
      $this->load->view('orderindex',$data);
      $this->load->view('footer');
    
    }
    
    
    
    Public function  neworder(){
        
        
         $this->form_validation->set_rules('orderDate', 'Date', 'required|xss_clean');
         $this->form_validation->set_rules('totalNumberOfBird', 'Total Number of Bird', 'required|xss_clean');
         $this->form_validation->set_rules('totalWeight', 'Total Weight', 'required|xss_clean');
         $this->form_validation->set_rules('supplierName', 'Supplier Name', 'required|xss_clean');
    
        $units  = $this->subunitmodel->allunit();
        $data['units'] = $units;
               
      if ($this->form_validation->run() == true){
          
        $orderDate = $this->input->post('orderDate');
        $totalNumberOfBird = $this->input->post('totalNumberOfBird');
        $totalWeight = $this->input->post('totalWeight');
        $supplierName = $this->input->post('supplierName');
        $unit_id     = $this->input->post('unit_id');
        
        if(isset($_SESSION["user"])){
        $created_by = $_SESSION["user"];    
        }
        
        $count_data = array('counter'=>'new');
        $count_id = $this->utitlitymodel->insert('order_count',$count_data);
        $ordercode = 'ORDER'.$count_id;
      
        $details = array('order_date'=> $orderDate,'order_code'=> $ordercode,'number_of_items'=> $totalNumberOfBird,
                         'total_weight'=> $totalWeight,'supplier_name'=> $supplierName
                             ,'created_by'=> $created_by);
        
           $this->db->set('stock_balanceb', 'stock_balance+'.$totalWeight, FALSE);
           $this->db->where('unit_id', $unit_id);
           $this->db->update('unit_stock_balance');


        
        $order_id = $this->utitlitymodel->insert('order',$details);
         redirect(base_url().'admin/inventory/index');
         
        
          
      }
      
      
      $data['orderDate'] = array(
				'name'  	=> 'orderDate',
				'id'    	=> 'orderDate',
				'type'  	=> 'text',
				'required class'=> 'form-control',
				);
      $data['totalNumberOfBird'] = array(
				'name'  	=> 'totalNumberOfBird',
				'id'    	=> 'totalNumberOfBird',
				'type'  	=> 'number',
				'required class'=> 'form-control',
				);
      $data['totalWeight'] = array(
				'name'  	=> 'totalWeight',
				'id'    	=> 'totalWeight',
				'type'  	=> 'decimal',
				'required class'=> 'form-control',
				);
     $data['supplierName'] = array(
				'name'  	=> 'supplierName',
				'id'    	=> 'supplierName',
				'type'  	=> 'text',
				'required class'=> 'form-control',
				);
      
      
    $this->load->view('header');
      $this->load->view('neworder',$data);
      $this->load->view('footer');
    }
 
    
public function orderbreakdown($id=0){
   
            if(isset($id)){ 
          
            $order_details = $this->utitlitymodel->getSingle('order','order_id',$id);
            $data['id']  =   $id;//print_r($guest_details);exit;
            $data['order_details']  =  $order_details;
            $data['order_qty'] = $this->utitlitymodel->fetch_all_order_id_pk('order_quantity','order_qty_id',$id);
            //var_dump();exit;
        }else{
            $data['message_error'] = 'Invalid Order';    
             // exit;
        }
        if(empty($order_details)){
           $data['message_error'] = 'The full details of this Order could not be retrieved';
          // exit;
        } 
        
        
        
      //$this->load->view('header');
      $this->load->view('orderbreakdown',$data);
      $this->load->view('order_js');
     // $this->load->view('footer'); 
    
} 
    
    public function edit($id=0){
    
      $this->form_validation->set_rules('unit_name', 'unit_name', 'required|xss_clean');
      $this->form_validation->set_rules('unit_code', 'unit_code', 'required|xss_clean');
      
            if(isset($id)){ 
          
            $unit_details = $this->unitmodel->getSingleUnit($id);
            $data['id']  =   $id;//print_r($guest_details);exit;
             $data['unit_details']  =  $unit_details;
            //var_dump();exit;
        }else{
            $data['message_error'] = 'Invalid Unit';    
             // exit;
        }
        if(empty($unit_details)){
           $data['message_error'] = 'The full details of this Unit could not be retrieved';
          // exit;
        }
        
        
         
      if ($this->form_validation->run() == true){
	    
        $unit_name = $this->input->post('unit_name');
        $unit_code = $this->input->post('unit_code');
       // var_dump($faculty);exit;
        $details = array('unit_name'=> $unit_name,'unit_code'=> $unit_code);
        $unit_details = $this->unitmodel->update_unit($id,$details);
         redirect(base_url().'admin/unit/index');
         
        
          
      }
    if(isset($unit_details["unit_name"])){$unit_name= $unit_details["unit_name"];}
    else{$unit_name='';}
    
     if(isset($unit_details["unit_code"])){$unit_code= $unit_details["unit_code"];}
    else{$unit_code='';}
      
      $data['form_faculty'] = array(
				'name'  	=> 'faculty',
				'id'    	=> 'faculty',
				'type'  	=> 'text',
				'required class'=> 'form-control',
                               'value'=> $unit_name
				);
      
       $data['form_unit_name'] = array(
				'name'  	=> 'unit_name',
				'id'    	=> 'unit_name',
				'type'  	=> 'text',
				'required class'=> 'form-control',
                                'value'=> $unit_name
				);
      $data['form_unit_code'] = array(
				'name'  	=> 'unit_code',
				'id'    	=> 'unit_code',
				'type'  	=> 'text',
				'required class'=> 'form-control',
                                'value'=> $unit_code
				);
    
      $this->load->view('header');
      $this->load->view('editunit',$data);
      $this->load->view('footer');
    

    
    
}


public function delete($id=0){
           $comand = '';
        
       if ($_POST)
		{		
			$room_id = $_POST['id']; //echo $amenity_id;exit;
                        $comand = $_POST['del'];
                      
	if($comand=='Yes'){	
			$this->unitmodel->delete_unit($id);
			$_SESSION['sucess_message']= "Unit Successfully Deleted.";
			
			
                         redirect(base_url().'admin/unit/index'); 
                }else{redirect(base_url().'admin/unit/index'); }
                
                 }
                     if(isset($id)){ 
          
                        $faculty_details = $this->unitmodel->getSingleUnit($id);
                        $data['id']  =   $id;
                        
                            //var_dump();exit;
                        }else{
                            $data['message_error'] = 'Invalid Unit ';    
                             // exit;
                        }
                        if(empty($faculty_details)){
                           $data['message_error'] = 'The details of this unit could not be retrieved';
                          // exit;
                        }
                        if(!isset($faculty_details)){$faculty_details["unit_name"]='';}
                        
                        
                        $data['name'] = $faculty_details["unit_name"];
                        
                  
       
    
    
     $this->load->view('header');
      $this->load->view('deleteunit',$data);
      $this->load->view('footer');
    

    
    
}

public function stockbal(){
    
     
        
          if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/inventory/index';
    $config['total_rows'] = $this->db->count_all('order');
    $config['per_page'] = '10';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    //$data['results'] = $this->facultymodel->getallfaculty($config['per_page'],$page);
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $order_details = $this->subunitmodel->getallunitbal('order',$config['per_page'], $page);
  // var_dump($order_details);exit;
    
     $data['results'] = $order_details;
     $this->load->view('header');
      $this->load->view('stockbal',$data);
      $this->load->view('footer'); 
    
    
}

    
}

?>
