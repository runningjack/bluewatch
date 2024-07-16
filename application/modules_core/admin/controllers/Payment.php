<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment
 *
 * @author Gbadeyanka Abass
 */
class Payment extends MX_Controller {
    
    
       function __construct()
    {
       
        parent::__construct();
        
        $this->load->model('programmemodel');         
        $this->load->model('feesitemsmodel');
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
        $this->load->model('levelmodel');
        $this->load->model('academycoursesmodel');
        $this->load->model('facultymodel'); 
        $this->load->model('departmentmodel'); 
         $this->load->model('levelmodel');
         $this->load->model('semestermodel');
         $this->load->model('curriculummodel');
         $this->load->model('courseoptionmodel');
         $this->load->model('generalmodel');
         $this->load->model('sessionmodel');
        
               
    }
    
    
      public function index()
    {
               
        
   if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/payment/index';
    $config['total_rows'] = $this->db->count_all('fee_item');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    //load the model and get results
    
    //$data['results'] = $this->programmemodel->getallprogramme($config['per_page'],$page);
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $feesitems_details = $this->feesitemsmodel->getallfeesitems($config['per_page'],$page);
   // var_dump($programme_details);exit;
    
     $data['results'] = $feesitems_details;
     $this->load->view('header');
      $this->load->view('feeitemsindex',$data);
      $this->load->view('footer');
    }

    public function addfeeitem()
    {
         $this->form_validation->set_rules('feeitem', 'feeitem', 'required|xss_clean');
    
         
      if ($this->form_validation->run() == true){
          
        $feeitem = $this->input->post('feeitem');
        $status = $this->input->post('status');
       // var_dump($programme);exit;
        $details = array('fee_name'=> $feeitem,'category'=> $status);
        $fee_id = $this->feesitemsmodel->insert_feesitems($details);
         redirect(base_url().'admin/payment/index');
         
      }
          
      
      
      
      $data['form_feeitem'] = array(
				'name'  	=> 'feeitem',
				'id'    	=> 'feeitem',
				'type'  	=> 'text',
                                'size'  	=> '30',
				'required class'=> 'form-control',
				);
      
      
    $this->load->view('header');
      $this->load->view('addfeeitem',$data);
      $this->load->view('footer');
    
           
           
           
    }
    
    
    
    

    public function editfeeitem($id=0)
    {
     
       $this->form_validation->set_rules('feeitem', 'feeitem', 'required|xss_clean');
      
            if(isset($id)){ 
          
            $feeitem_details = $this->feesitemsmodel->getSinglefeesitems($id);
            $data['id']  =   $id;//print_r($guest_details);exit;
             $data['feeitem_details']  =  $feeitem_details;
            //var_dump();exit;
        }else{
            $data['message_error'] = 'Invalid Items';    
             // exit;
        }
        if(empty($feeitem_details)){
           $data['message_error'] = 'The full details of this Items could not be retrieved';
          // exit;
        }
        
        
         
      if ($this->form_validation->run() == true){
	 $feeitem = $this->input->post('feeitem');
       // var_dump($programme);exit;
         $status = $this->input->post('status');
        $details = array('fee_name'=> $feeitem,'category'=> $status);
        $fee_id = $this->feesitemsmodel->update_feesitems($id,$details);
         redirect(base_url().'admin/payment/index');
         
        
          
      }
    if(isset($feeitem_details["fee_name"])){$feeitem_details= $feeitem_details["fee_name"];}
    else{$feeitem_details='';}
      
      $data['form_feeitem'] = array(
				'name'  	=> 'feeitem',
				'id'    	=> 'feeitem',
				'type'  	=> 'text',
				'required class'=> 'form-control',
                               'value'=> $feeitem_details
				);
      $data['status'] = $feeitem_details["status"];
      $this->load->view('header');
      $this->load->view('editfeeitem',$data);
      $this->load->view('footer');
    }

    public function deletefeeitem($id=0)
    {
 $comand = '';
        
       if ($_POST)
		{		
			$id = $_POST['id']; //echo $amenity_id;exit;
                        $comand = $_POST['del'];
                      
	if($comand=='Yes'){	
			$this->feesitemsmodel->delete_feesitems($id);
			$_SESSION['sucess_message']= "Item Successfully Deleted.";
			
			
                         redirect(base_url().'admin/payment/index'); 
                }else{redirect(base_url().'admin/payment/index'); }
                
                 }
                     if(isset($id)){ 
          
                        $item_details = $this->feesitemsmodel->getSinglefeesitems($id);
                        $data['id']  =   $id;
                        
                            //var_dump();exit;
                        }else{
                            $data['message_error'] = 'Invalid Item ';    
                             // exit;
                        }
                        if(empty($item_details)){
                           $data['message_error'] = 'The details of this Item could not be retrieved';
                          // exit;
                        }
                        if(!isset($item_details)){$item_details["fee_name"]='';}
                        
                        
                        $data['name'] = $item_details["fee_name"];
                        
                  
       
    
    
     $this->load->view('header');
      $this->load->view('deletefeeitem',$data);
      $this->load->view('footer');
    
    }

    public function viewamount($id=0)
    {
    
         if(isset($id)){ 
          
            $feeitem_amount_details = $this->feesitemsmodel->getAmountListByItem($id);
            $data['id']  =   $id;//var_dump($feeitem_amount_details);exit;
             $data['feeitem_details']  =  $feeitem_amount_details;
            //var_dump();exit;
        }else{
            $data['message_error'] = 'Invalid Items';    
             // exit;
        }
        if(empty($feeitem_amount_details)){
           $data['message_error'] = 'The full details of this Items could not be retrieved';
          // exit;
        }
      $data['results'] = $feeitem_amount_details;
      $this->load->view('header');
      $this->load->view('feeitemamountdetails',$data);
      $this->load->view('footer');
        
        
        
    }

    public function setamount()
    {
      $fac = $this->facultymodel->fetchallfaculty();     
      
      $data['fac'] = $fac;
      $items = $this->feesitemsmodel->fetchallfeesitems();
      $data['items'] = $items;
     
      $level = $this->levelmodel->getalllevel(); 
    
     $data['level'] = $level;
     
     $semester = $this->semestermodel->getallsemester(); 
    
     $data['semester'] = $semester;
     
     $state= $this->generalmodel->getallstate(); 
    
     $data['state'] = $state;
     
     $programme= $this->generalmodel->getallprog(); 
    
     $data['programme'] = $programme;
     
     $entry_mode= $this->generalmodel->allentrymode();
     $data['entry_mode'] = $entry_mode;
     
     $session = $this->sessionmodel->getallsession();
     $data['session'] = $session;
     
     if(isset($_POST['submit'])){
         extract($_POST);
         //var_dump($_POST);die();
         
         $flag = $this->feesitemsmodel->uniqueamount($_POST);
         //var_dump($flag);die();
        if($flag){
         $details = array('fee_item_id'=> $item_id,
                          'amount'=> $amount,
                          'session'=> $session,
                           'program'=> $programme,
                          'faculty'=> $faculty_id,
                           'department'=> $department_id,
                          'department_option'=> $dept_option,
                          'level'=> $level_id,
                            'entry_year'=> $entry_year,
                           'prog_type'=> $programme_type,
                           'student_type'=> $student_type,
                            'entry_mode'=> $entry_mode,
                           'nationality'=> $nationality,
                             'state'=> $state);
     
        $fee_id = $this->feesitemsmodel->insert_feeitemamount($details);
        $_SESSION['sucess_message']= "Amount Successfully Added.";
        redirect(base_url().'admin/payment/index'); 
         
     }else{
         
      $_SESSION['message_error']= "We could not update the settings because Settings already exit.";   
         redirect(base_url().'admin/payment/index'); 
     }
     }
       
      $this->load->view('header');
      $this->load->view('setamount',$data);
      $this->load->view('footer');   
    }

    public function checkfee()
    {
     $fac = $this->facultymodel->fetchallfaculty();     
      
      $data['fac'] = $fac;
      $items = $this->feesitemsmodel->fetchallfeesitems();
      $data['items'] = $items;
     
      $level = $this->levelmodel->getalllevel(); 
    
     $data['level'] = $level;
     
     $semester = $this->semestermodel->getallsemester(); 
    
     $data['semester'] = $semester;
     
     $state= $this->generalmodel->getallstate(); 
    
     $data['state'] = $state;
     
     $programme= $this->generalmodel->getallprog(); 
    
     $data['programme'] = $programme;
     
     $entry_mode= $this->generalmodel->allentrymode();
     $data['entry_mode'] = $entry_mode;
     
     $session = $this->sessionmodel->getallsession();
     $data['session'] = $session;
     if(isset($_POST['submit'])){
     extract($_POST);
     //echo var_dump($_POST);
     $amounts = $this->feesitemsmodel->CheckFees($session,$programme,$faculty_id,$department_id,$dept_option,$level_id,$entry_year,
             $programme_type,$student_type,$entry_mode,$nationality,$state);
     $data['amounts'] = $amounts;
     }
    
     
     
      $this->load->view('header');
      $this->load->view('checkfee',$data);
      $this->load->view('footer'); 
       
    }

    public function deleteAmountAction()
    {
         if ($this->getRequest()->isPost()) {
    $del = $this->getRequest()->getPost('del');
    if ($del == 'Yes') {
     $id = $this->_getAllParams();
      $id = (int)($id ["id"]);
      $query = new Gab_Class_Database();
      $query->deleteRow('fee_item_settings', 'settings_id', $id);
    
         }
       $this->_helper->redirector('index');
      } 
    }

    public function checkFeeAction()
    {
       $util = new Gab_Class_Utility;
       $values = $this->_getAllParams();
        
        $fees = $util->getFeesItems();
        $this->view->fees = $fees;        
        
        $state = $util->getState();
        $this->view->state = $state;
        
        $session = $util->getSession();
        $this->view->session = $session;
        
        $term = $util->getTerm();
        $this->view->term = $term;
        
        $prog = $util->getProgram();
        $this->view->prog =  $prog;
        
        $class = $util->getClass();
        $this->view->class = $class;
        
        $class_op = $util->getClassOption();
        $this->view->class_op = $class_op;
        
        if ($this->getRequest()->isPost()) {   
           $values = $this->_getAllParams(); //var_dump($values); exit;
           
           $class = $values['class'];
           
           $gender = $values['gender'];
           $session = $values['session'];
           $term = $values['term'];
           $state = $values['state_id'];
           $prog = $values['prog'];
           $class_op = $values['class_op'];
           
      
        
         
           $amount = $util->checkFee($class,$gender,$session,$term,$state,$prog,$class_op);
           $this->view->amount = $amount;         
        }     
        
    
    }

    public function studentAction()
    {
        
     // $parent_data = $this->property;
     
      //$p_id = $this->property->username;
    
      $util = new Gab_Class_Utility;
      $std_data =  $util->studentByParentId();
      
      $this->view->std_data = $std_data;
      
      
      
    }

    public function payAction()
    {
       $this->_helper->layout->disableLayout();
        
       $values = $this->_getAllParams();
       
       $std_id = $values['id'];
              
       $util = new Gab_Class_Utility;
       $std_data = $util->singleStudentById($std_id); 
       
       $current = $util->current();
       $all_ses = $util->session();
       $all_term = $util->term();
       
       $sess = $current['session_id'];
       $term = $current['term_id'];
  
       $amount = $util->checkFee($std_data['class_id'],
              $std_data['std_gender'],$sess,$term,
              $std_data['std_state_id'],$std_data['prog_id'],
              $std_data['class_op_id']);//var_dump($amount);
       
        $amountOptional = $util->checkFeeOptional($std_data['class_id'],
              $std_data['std_gender'],$sess,$term,
              $std_data['std_state_id'],$std_data['prog_id'],
              $std_data['class_op_id']);//var_dump($amount);
       
       
       
       $this->view->current = $current ;
       $this->view->records = $std_data ;      
       $this->view->amount = $amount;
       $this->view->amountOptional = $amountOptional;
       
       
       
       
      
       
       
       
      // var_dump($amount);
    }

    public function cardPayAction()
    {
          
        
        $values = $this->_getAllParams();
         $this->_helper->layout->disableLayout();
         $code = new Gab_Class_Generator;
         $ref = $code->randomString(10);
         $amountpaying=0;
        $values["category"] = 'full';
         $fee_id = $values["check"];
         $ids = $values["check"];
         //var_dump($ids);
        
         $amount = $values['item_amount'];
         
         $sess = $values['session'];
         $term = $values['term'];
         $id = $values['id'];
         $category = $values["category"];
         $total = $values["total"];
         $totaltopay =$total;
         //var_dump($values["partamount"]);exit;
         $partamount=$values["partamount"];
         
         
         
         if(!($partamount=='')){  
             $amountpaying = $values["partamount"];
         
             $total = $values["partamount"];
         }else{
             $total = $values["total"]; 
             $amountpaying = $total;
                          }
                          
          $mode = $values["pay_mode_eng"];
        
         
        //var_dump($total);exit;
          
          $util = new Gab_Class_Utility;
         $std_data = $util->singleStudentById($id);
        var_dump($std_data);exit;
         
         
          $update = new Gab_Class_Transaction();
          
         //var_dump($fee_id);exit;
         
         $set = $update->initilizeTrans($id,$ids, $amount, $sess, $term,$ref,$mode,$category,$total,$amountpaying);
         $previous_Payment = $update->previousPayment($id,$sess,$term);
         
         //var_dump($previous_Payment);
         
         $sql = " SELECT SUM(amount) AS total FROM transaction_record 
                  WHERE ref_id = '$ref'";//var_dump($sql);
         $query = new Gab_Class_Database;
         
         $total_due = $query->fetchSingle($sql);
        
         $sql = " SELECT amountpaying AS total FROM transaction_total 
                  WHERE ref_id = '$ref'";
         
         
         $total = $query->fetchSingle($sql);
        // if($total==''){ $total = $total_due ["total"];}
         
        // var_dump($total["total"]);
         
         
         $current = $util->current();
         $this->view->current = $current ;
         $this->view->records = $std_data ;
         $this->view->totaltopay = $total_due["total"];
         $this->view->ref = $ref;
         $total["total"] = $total_due["total"];
         $this->view->total =  $total;
         $this->view->previous_Payment =  $previous_Payment;
         $this->view->totaltopay = $total_due["total"];
         
      
        
         
        
         
         
        // echo $trans_no;
    }

    public function successAction()
    {
        $this->_helper->layout->disableLayout();        
        $values = $this->_getAllParams();
        
        $update = new Gab_Class_Transaction();
        $checker = $update->validatePin($values['pin'], $values['total']);
        if($checker == 'Good Pin'){
          
           $payment_status = $update->transUpdate($values['ref'], $values['pin']);
           $this->view->status = $payment_status;
           return 0;
            
        }else{
            
           $payment_status =  'Bad pin';
           $this->view->status = $payment_status;
           return 0;
        }
         $util = new Gab_Class_Utility;
         $std_data = $util->singleStudentById($id);
         $id = $values['id'];
         $current = $util->current();
         $this->view->current = $current ;
         $this->view->records = $std_data ;
         $this->view->ref = $ref;
         $this->view->total =  $total;
         
      
        
    }
    
     public function gensingletransAction()
    {
        
     // $parent_data = $this->property;
          $values['std_code'] = 0;
         $values['std_surname'] = '';
     if($_POST){
      //$p_id = $this->property->username;
         $values = $this->_getAllParams();
        
         //var_dump($values);
         $std_code = $values['std_code'];
         $std_surname = $values['std_surname'];
        // VAR_DUMP(($std_code==''),($std_surname==''));
         if(empty($std_code) && (empty($std_surname))){
             
              $this->view->errorMessage = "Please Enter Student Code or Surname.";
                    return;
         }
    
      $util = new Gab_Class_Utility;
      $std_data =  $util->studentForTransaction($std_code,$std_surname);
      
      $this->view->std_data = $std_data;
      
      
      
    }
    
    
    }


    
    
   public function stdtransactiondetailsAction()
    {
       $this->_helper->layout->disableLayout();
        
       $values = $this->_getAllParams();
       
       $std_id = $values['id'];
              
       $util = new Gab_Class_Utility;
       $std_data = $util->singleStudentById($std_id); 
       
       $current = $util->current();
       $all_ses = $util->session();
       $all_term = $util->term();
       
       $sess = $current['session_id'];
       $term = $current['term_id'];
  
       $amount = $util->checkFee($std_data['class_id'],
              $std_data['std_gender'],$sess,$term,
              $std_data['std_state_id'],$std_data['prog_id'],
              $std_data['class_op_id']);//var_dump($amount);
       
        $amountOptional = $util->checkFeeOptional($std_data['class_id'],
              $std_data['std_gender'],$sess,$term,
              $std_data['std_state_id'],$std_data['prog_id'],
              $std_data['class_op_id']);//var_dump($amount);
       
       
       
       $this->view->current = $current ;
       $this->view->records = $std_data ;      
       $this->view->amount = $amount;
       $this->view->amountOptional = $amountOptional;
       
       
       
       
      
       
       
       
      // var_dump($amount);
    }
    
    
    public function commiteAction(){
        
        $this->_helper->layout->disableLayout();
        
       $values = $this->_getAllParams();
       $engine = new Gab_Class_Engine();
       $std_id = $values['id'];
        $util = new Gab_Class_Utility;
       $std_data = $util->singleStudentById($std_id); 
       $this->view->records = $std_data ; 
       $current  = $util->current();//print_r($current['term'] );
        // $parent_data = $this->property;
         // $this->view->errorMessage = 'Payment Failed';
     if($_POST){
        
      //$p_id = $this->property->username;
         $values = $this->_getAllParams();
         $detals = $_SESSION["Zend_Auth"]["storage"]; 
         $std_id = $values["id"];
         $tran_date = $values["id"];
         $tran_amount = $values["amount_paid"];
         $tran_tellerno  = $values["teller_no"]; 
         $tran_teller_id = $detals->firstname. ' '.$detals->lastname;
         $tran_term = $current['term'];
         $tran_session = $current['current_session'];
         $tran_status = "Paid";
        
        // var_dump($_SESSION);
         
         
        $status = $engine->commite($std_id,$tran_date,
                $tran_amount,$tran_tellerno,$tran_teller_id,$tran_status,$tran_term,$tran_session);
        if($status){
            
             $data = array('id' =>$std_id);
            $this->view->errorMessage = 'Payment Sucessful';
              $this->_helper->redirector('commite','payment','admin',$data);
              
        }
        
         }
    
      $this->view->history = $engine->paymentHistory($std_id);
      
      
    
     
    }


    public function printAction(){
        
        
        
       $this->_helper->layout->disableLayout();
        
       $values = $this->_getAllParams();
       
       
       $std_id = $values['id'];
       $pid = $values['pid'];
       if($std_id==''||$pid==''){
           
           $this->view->errorMessage = 'Invalid Request';
           return ;
           
       }              
       $util = new Gab_Class_Utility;
       $std_data = $util->singleStudentById($std_id); 
       
       $current = $util->current();
       $all_ses = $util->session();
       $all_term = $util->term();
       
       $sess = $current['session_id'];
       $term = $current['term_id'];
  
       $amount = $util->checkFee($std_data['class_id'],
              $std_data['std_gender'],$sess,$term,
              $std_data['std_state_id'],$std_data['prog_id'],
              $std_data['class_op_id']);//var_dump($amount);
       
        $amountOptional = $util->checkFeeOptional($std_data['class_id'],
              $std_data['std_gender'],$sess,$term,
              $std_data['std_state_id'],$std_data['prog_id'],
              $std_data['class_op_id']);//var_dump($amount);
       $engine = new Gab_Class_Engine();
       
       $paymentdetails = $engine->SinglePaymentRecord($pid);
       
       $amountPaidPerTerm = $engine->TotalPaidPerTermRecord($std_id);
       
       $detals = $_SESSION["Zend_Auth"]["storage"]; 
       $tran_teller_id = $detals->firstname. ' '.$detals->lastname;
       
       $this->view->current = $current ;
       $this->view->records = $std_data ;      
       $this->view->amount = $amount;
       $this->view->amountOptional = $amountOptional;
       $this->view->paymentdetails = $paymentdetails;
       $this->view->amountPaidPerTerm = $amountPaidPerTerm;
       $this->view->tran_teller_id = $tran_teller_id;
       
       
    
     
    }

    
    public function billsAction(){
         $storage = new Zend_Auth_Storage_Session();
         $data = $storage->read(); 
         $log_id = $data->username;
         
         $data = new Gab_Class_Utility();
         
         $session = $data->session();
         $term = $data->term();
         
          //send class option to view       
        $query = new Gab_Class_Database();
        $sql = "SELECT * FROM class_option";
        $class_op= $query->fetchAss($sql); 
        $this->view->class_op = $class_op;//var_dump($group);
        $this->view->cop = $class_op;
        
         
         $subject = $data->assigned_courses($log_id);
         $this->view->assign = $subject; // action body
         
         $this->view->term = $term;
         $this->view->session = $session;   
         $this->view->subject = $subject;
         
         if ($this->getRequest()->isPost()) {   
           $values = $this->_getAllParams(); // var_dump($values);exit;
           $para = array();
           
           if(($values['session']=='')||($values['term'] =='')||($values['class_op_id']=='')){
               $error = "Non of the field should be empty";
                $this->view->errorMessage = $error;
               return $error;
           }else{
           
           $para['session'] = $values['session'];
           $para['term'] = $values['term'];
           $para['class_option'] = $values['class_op_id'];
           
           // not using ds but the clling funtio required it
           $para['subject'] = '';
           
           
            $_SESSION['search'] = $para;
                
            
            $para = $_SESSION['search'];
       
       $processor = new Gab_Class_ResultProcessor();
       $stud_data = $processor->getAllResult($para);
       
       $processor = new Gab_Class_ResultProcessor();
       $util  = new Gab_Class_Utility();
           
       $subject = $processor->getSubject($para);
     //  var_dump($stud_data);exit;
      
       $this->view->stud_data = $stud_data;
       
       $page = $this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($stud_data);
        $paginator->setItemCountPerPage(40);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator = $paginator;
       $this->view->subj = $subject;
           
            
            
             
           
           }
        
        
    }
    
    }

   public function individualbillAction(){
        
        
        
       $this->_helper->layout->disableLayout();
        
       $values = $this->_getAllParams();
       
       
       $std_id = $values['id'];
       
       if($std_id==''){
           
           $this->view->errorMessage = 'Invalid Request';
           return ;
           
       }              
       $util = new Gab_Class_Utility;
       $std_data = $util->singleStudentById($std_id); 
       
       $current = $util->current();
       $all_ses = $util->session();
       $all_term = $util->term();
       
       $sess = $current['session_id'];
       $term = $current['term_id'];
  
       $amount = $util->checkFee($std_data['class_id'],
              $std_data['std_gender'],$sess,$term,
              $std_data['std_state_id'],$std_data['prog_id'],
              $std_data['class_op_id']);//var_dump($amount);
       
        $amountOptional = $util->checkFeeOptional($std_data['class_id'],
              $std_data['std_gender'],$sess,$term,
              $std_data['std_state_id'],$std_data['prog_id'],
              $std_data['class_op_id']);//var_dump($amount);
       $engine = new Gab_Class_Engine();
       
       
       
       $amountPaidPerTerm = $engine->TotalPaidPerTermRecord($std_id);
       
     
       
       $this->view->current = $current ;
       $this->view->records = $std_data ;      
       $this->view->amount = $amount;
       $this->view->amountOptional = $amountOptional;
       
       
       
       
    
     
    }
    
       public function bulkbillsAction()
    {
         // var_dump($_SESSION);exit;
         set_time_limit(500);
         $this->_helper->layout->disableLayout();
       $para = $_SESSION['search'];
       
       $processor = new Gab_Class_ResultProcessor();
       $stud_data = $processor->getAllResult($para);
       
       $processor = new Gab_Class_ResultProcessor();
       $util  = new Gab_Class_Utility();
           
       $subject = $processor->getSubject($para);
     //  var_dump($stud_data);exit;
      
       $this->view->stud_data = $stud_data;
       
       $page = $this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($stud_data);
        $paginator->setItemCountPerPage(40);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator = $paginator;
       $this->view->subj = $subject;
    }

    
    
    
}

?>
