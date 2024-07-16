<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acl
 *
 * @author Gbadeyanka Abass
 */
class accesscontrollist extends MX_Controller{
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
        $this->load->model('cms');
        $this->load->model('generalmodel');
            
        
               
    }
    
    
    Public function addrole(){
         $data = array();
      $id=0;
     // $here = $this->cms->fetchBreadCrumb($id);//var_dump($here);die;
      //     $data['breadcrumbs'] = $here;
            
            $data['wrap'] = 'pagewrapper';
            $data['nav_links'] = $this->cms->findWebPages();
            
            $data['page_content'] = $this->cms->findWebPageContent($id);
            
          $this->form_validation->set_rules('role_name', 'Role Name', 'required|xss_clean');
          $this->form_validation->set_rules('role_des', 'Description', 'required|xss_clean');
          
           if ($this->form_validation->run() == true)
		{
              $status =  Role::addRole();
              if($status ){$_SESSION['success_message'] = 'Role Added Successfully';
                            }else{
                             $_SESSION['error_message'] = 'An Error Occured Role';   
                            }
               redirect(base_url().'admin/rolelist');  
                }
           
            
           $this->load->view('header');
      $this->load->view('addrole');
      $this->load->view('footer');
    }
    
    Public function rolelist(){
        
         $this->load->view('header');
      $this->load->view('viewRole');
      $this->load->view('footer');
        
    }
    
    Public function deleterole($id=0){
        $data['id'] = $id;
         $this->load->view('header');
      $this->load->view('deleteRole',$data);
      $this->load->view('footer');
        
    }
    
    
    public function editrole($id=0){
        $data['id'] = $id;
         $this->load->view('header');
      $this->load->view('editRole',$data);
      $this->load->view('footer');   
        
    }
    
    public function assignpriviledge($id=0){
        $data['id'] = $id;
        
         $this->load->view('header');
      $this->load->view('privilegde',$data);
      $this->load->view('footer');   
        
    }
    
    public function viewperm(){
       $this->load->view('header');
      $this->load->view('viewPerm');
      $this->load->view('footer');   
          
        
    }
    
    
       public function deleteperm($id=0){
           $data['id'] = $id;
       $this->load->view('header');       
      $this->load->view('deletePerm',$data);
      $this->load->view('footer');   
          
        
    }
    
    
    public function editperm($id=0){
         $data['id'] = $id;
       $this->load->view('header');       
      $this->load->view('editPerm',$data);
      $this->load->view('footer');         
    }
    
     public function addperm($id=0){
         $data['id'] = $id;
       $this->load->view('header');       
      $this->load->view('addPerm',$data);
      $this->load->view('footer');         
    }
}
