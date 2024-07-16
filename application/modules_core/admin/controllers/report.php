<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report
 *
 * @author Gbadeyanka Abass
 */
class report extends MX_Controller{
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
       // $this->load->model('cms');
        $this->load->model('generalmodel');
        $this->load->model('unitmodel');
        $this->load->model('subunitmodel');
        $this->load->model('settingsmodel');
        $this->load->model('reportmodel');   
        $this->load->model('transactionmodel');
          
    }

    public function index()
    {
      $data['exp_cat'] = '1';
       $data['filter_option'] = 'YEAR';
       $data['curr_year'] = $_SESSION['finacial_year']->year;
       $data['exp_amount'] = '';

      if ($_POST) {
       extract($_POST);
       $data['exp_cat'] = $expCat;
       $data['filter_option'] = $filtercat;
       $data['curr_year'] = $filteryear;

      } 

      $department = '';

       if (!in_array(intval($_SESSION['login_detal']->group_id), array(1,7,2,5))) {
            $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->employee_id);
            $department = $emplyee_details['department'];

           
        }
         
      $data['exp_amount'] = $this->reportmodel->getCatExpenseLineBudget($data['filter_option'], $data['curr_year'], $data['exp_cat'], $department);
      $data['cat_select'] = $this->settingsmodel->expenseCategory();
      $this->load->view('header');
      $this->load->view('report1', $data);
      $this->load->view('footer');
      $this->load->view('reportScript');
    }

    public function deptReport()
    {
        $status = true;
        $output = '';

         $department = '';

       if (!in_array(intval($_SESSION['login_detal']->group_id), array(1,7,2,5))) {
            $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->employee_id);
            $department = $emplyee_details['department'];

           
        }

      if ($_POST) {
        $expense = $this->reportmodel->getDeptExpenseLineBudget($_POST["filter"],$_POST["expense_line_id"], $_POST["year"], $department);

        if (!empty($expense)) {
          $output .= '<tr class="'.$_POST["expense_line_id"].'" style="background-color: white;"><td>&nbsp;</td></tr>';
          foreach ($expense as $m) {
              $output .= '<tr class="'.$_POST["expense_line_id"].'" style="background-color:#f8f8f8;">';
              $output .= '<td>&nbsp;</td>';
              $output .= '<td>'.$m["department_name"].'</td>';
              if ($_POST["filter"] == 'YEAR') {
                 $amount = 0.00;
                  $budget = 0.00;
                  $bal = 0.00;
                  if (!empty($m['budget'])) {
                  $budget = floatval($m['budget']);
                }
          if ($m['actual']) {
            foreach ($m['actual'] as $value) {
              if ($value->amount) {
                $amount = floatval($value->amount);
                $sumAmount += round(floatval($value->amount),2);
              } 
          $bal = $budget - round($amount,2);
           }
          $output .= '<td class="data" style="text-align: right;background-color: aliceblue;">'.number_format($budget, 2, '.', ',').'</td>';
  $output .= '<td class="data" style="text-align: right;background-color: antiquewhite;">'.number_format($amount, 2, '.', ',').'</td>';
           $output .='<td class="data" style="text-align: right;background-color: beige;">'.number_format($bal, 2, '.', ',').'</td>';
           }else{
         $amount = 0.00;
              $bal = $budget - round($amount,2);
    $output .= ' <td class="data" style="text-align: right;background-color: aliceblue;">'.number_format($budget, 2, '.', ',').'</td>';
    $output .= '<td class="data" style="text-align: right;background-color: antiquewhite;">'.number_format($amount, 2, '.', ',').'</td>';
      $output .= '<td class="data" style="text-align: right;background-color: beige;">'.number_format($bal, 2, '.', ',').'</td>';
    }
              } elseif($_POST["filter"] == 'QUARTER') {
                 $budget = 0.00;
        $qbudget = 0.00;
        $sumAmount = 0.00;
        if (!empty($m['budget'])) {
          $budget = floatval($m['budget']);
          $qbudget = round($budget/4,2);
        }
        for ($i=1; $i <= 4 ; $i++) { 
             $amount = 0.00;
            $bal = 0.00;
          if ($m['actual']) {
            foreach ($m['actual'] as $value) {
          
            if($i == $value->month){ 
              if ($value->amount) {
                $amount = floatval($value->amount);
                $sumAmount += round(floatval($value->amount),2);
              } 
            }
          $bal = $qbudget - round($amount,2);
           } 
 $output .= ' <td class="data" style="text-align: right;background-color: aliceblue;">'.number_format($qbudget, 2, '.', ',').'</td>';
    $output .= '<td class="data" style="text-align: right;background-color: antiquewhite;">'.number_format($amount, 2, '.', ',').'</td>';
      $output .= '<td class="data" style="text-align: right;background-color: beige;">'.number_format($bal, 2, '.', ',').'</td>';
         }else{
         $amount = 0.00;
              $bal = $qbudget - round($amount,2);
   $output .= ' <td class="data" style="text-align: right;background-color: aliceblue;">'.number_format($qbudget, 2, '.', ',').'</td>';
    $output .= '<td class="data" style="text-align: right;background-color: antiquewhite;">'.number_format($amount, 2, '.', ',').'</td>';
      $output .= '<td class="data" style="text-align: right;background-color: beige;">'.number_format($bal, 2, '.', ',').'</td>';
       }
        } 
      $output .= '<td class="data" style="text-align: right;background-color: aliceblue;">'.number_format($budget, 2, '.', ',').'</td>';
$output .= '<td class="data" style="text-align: right;background-color: antiquewhite;">'.number_format($sumAmount, 2, '.', ',').'</td>';
$sumbal = $budget - $sumAmount;
  $output .= '<td class="data" style="text-align: right;background-color: beige;">'.number_format($sumbal, 2, '.', ',').'</td>';
              } else{
                $month = intval(date('m'));
        $budget = 0;
        $mbudget = 0;
        $sumAmount = 0;
        if (!empty($m['budget'])) {
          $budget = floatval($m['budget']);
          $mbudget = round($budget/12,2);
        }
          for ($i=($month-2); $i <= $month ; $i++) {
            $amount = 0.00;
            $bal = 0;
          if ($m['actual']) {
            foreach ($m['actual'] as $value) {
          
            if($i == $value->month){ 
              if ($value->amount) {
                $amount = floatval($value->amount);
                $sumAmount += round(floatval($value->amount),2);
              } 
         }
          $bal = $mbudget - round($amount,2);
           } 
 $output .= ' <td class="data" style="text-align: right;background-color: aliceblue;">'.number_format($mbudget, 2, '.', ',').'</td>';
    $output .= '<td class="data" style="text-align: right;background-color: antiquewhite;">'.number_format($amount, 2, '.', ',').'</td>';
      $output .= '<td class="data" style="text-align: right;background-color: beige;">'.number_format($bal, 2, '.', ',').'</td>';
         }else{
         $amount = 0.00;
              $bal = $mbudget - round($amount,2); 
    $output .= ' <td class="data" style="text-align: right;background-color: aliceblue;">'.number_format($mbudget, 2, '.', ',').'</td>';
    $output .= '<td class="data" style="text-align: right;background-color: antiquewhite;">'.number_format($amount, 2, '.', ',').'</td>';
      $output .= '<td class="data" style="text-align: right;background-color: beige;">'.number_format($bal, 2, '.', ',').'</td>';
}
 } 
    $output .= '<td class="data" style="text-align: right;background-color: aliceblue;">'.number_format($budget, 2, '.', ',').'</td>';
$output .= '<td class="data" style="text-align: right;background-color: antiquewhite;">'.number_format($sumAmount, 2, '.', ',').'</td>';
$sumbal = $budget - $sumAmount;
  $output .= '<td class="data" style="text-align: right;background-color: beige;">'.number_format($sumbal, 2, '.', ',').'</td>';
     }
     $output .= '</tr>';
   }
   $output .= '<tr class="'.$_POST["expense_line_id"].'" style="background-color: white;"><td>&nbsp;</td></tr>';
   $status = true;
   //var_dump($output);exit;
      }
       
  
      }

      echo json_encode(array('status'=>$status, 'content'=>$output));
    }


    public function index1()
    {
      $filter = $_GET['filter']; 
      $data['filter_option'] = 'Monthly';
      $data['curr_year'] = date('Y');
      if (!empty($filter)) {
        $request = explode('-', $filter);
      $data['filter_option'] = (string)$request[0];
      $data['curr_year'] = intval($request[1]);
      }
      $data['expenseReport'] = $this->settingsmodel->getBudgetExpense();
      //var_dump($data['expenseReport'] );exit();

      $this->load->view('header');
      $this->load->view('report', $data);
      $this->load->view('footer');
      $this->load->view('reportScript');
    }
   
    public function reportbystatus(){
        
         if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/reportbystatus';
    $config['total_rows'] = $this->db->count_all('transaction_commited');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    $trans_details = $this->reportmodel->getalltransaction($config['per_page'],$page);
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
     $this->load->view('header');
      $this->load->view('reportbystatus',$data);
      $this->load->view('footer');
    
    }
     public function pending(){
         
   if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/pending';
    $config['total_rows'] = $this->db->count_all('transation_status');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $trans_details = $this->reportmodel->getAllPendingTransaction($config['per_page'],$page);
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
     $this->load->view('header');
      $this->load->view('pendingstatus',$data);
      $this->load->view('footer');
    
         
     }
     
public function rejected(){
     
         
  if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/pending';
    $config['total_rows'] = $this->db->count_all('transation_status');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $trans_details = $this->reportmodel->getAllRejectedTransaction($config['per_page'],$page);
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
     $this->load->view('header');
      $this->load->view('rejectedstatus',$data);
      $this->load->view('footer');
    
         
     }
     public function suprejected(){
     
         
            if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/suprejected';
    $config['total_rows'] = $this->db->count_all('transation_status');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $trans_details = $this->reportmodel->supRejectedTransaction($config['per_page'],$page);
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
     $this->load->view('header');
      $this->load->view('suprejectedstatus',$data);
      $this->load->view('footer');
    
         
     }
     
     
     
     
     public function transactiondetails($id){
         
        // echo $id;
         $trans_deatails = $this->transactionmodel->fetch_main_tran($id);
         $trans_status = $this->transactionmodel->fetch_tran_status($id);
         $previous_amount = $this->transactionmodel->fetch_previous_tran_amount($id);
         $data['trans_deatails'] = $trans_deatails;
         $data['trans_status'] = $trans_status;
         $data['previous_amount'] = $previous_amount;
         if(!$trans_deatails){die('Invalid Transaction');}
         $this->load->view('trasactionDetails',$data);
         
     }
     
     
     public function unitbreakdown(){
         
        
         if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
    $units  = $this->subunitmodel->allunit();
     // $units = $this->unitmodel->getallunit();var_dump($units);exit;
      
      $data['units'] = $units;
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/unitbreakdown';
    $config['total_rows'] = $this->db->count_all('transaction_main');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    
    if(isset($_POST['unit_id'])){
        //var_dump($_POST);exit();
    $trans_details = $this->reportmodel->getalltransactionByUnitSearch($config['per_page'],$page,$_POST['unit_id']);    
    }else{
    
    $trans_details = $this->reportmodel->getalltransactionByUnit($config['per_page'],$page);
    }
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
     $this->load->view('header');
      $this->load->view('unitbreakdown',$data);
      $this->load->view('footer');      
         
     }
     
     function subunitbreakdown(){
         
             if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
    $subunits  = $this->subunitmodel->allsubunit();
     // $units = $this->unitmodel->getallunit();var_dump($units);exit;
      
      $data['subunits'] = $subunits;
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/subunitbreakdown';
    $config['total_rows'] = $this->db->count_all('transaction_main');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    
    if(isset($_POST['subunit_id'])){
       // var_dump($_POST);exit();
    $trans_details = $this->reportmodel->getalltransactionBySubUnitSearch($config['per_page'],$page,$_POST['subunit_id']);    
    }else{
    
    $trans_details = $this->reportmodel->getalltransactionByUnit($config['per_page'],$page);
    }
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
     $this->load->view('header');
      $this->load->view('subunitbreakdown',$data);
      $this->load->view('footer');    
         
         
     }
     
     public function delete($id=0){
           $comand = '';
        $tran_id = $id;
       if ($_POST)
		{		
			$tran_id = $_POST['id']; 
                        $comand = $_POST['del'];
                      
                      
	if($comand=='Yes'){	
			
            
            
        $details = array('delete_status'=> 'deleted');           
        $id = $this->transactionmodel->update_transaction_main($tran_id,$details); 
        $details = array('delete_status'=> 'deleted');
        $id = $this->transactionmodel->update_transation_status($tran_id,$details);        
        $data['tran_id'] = $tran_id;
        
        
        $_SESSION['sucess_message']= "Transaction Successfully Deleted.";
			
			
                         redirect(base_url().'admin/report/pending'); 
                }else{redirect(base_url().'admin/report/pending'); }
                
                 }
                     if(isset($id)){ 
                        $transaction_id = $id ;
                        $trans_deatails = $this->transactionmodel->fetch_tran_main($transaction_id);
                        $trans_status = $this->transactionmodel->fetch_tran_status($transaction_id);
                        $previous_amount = $this->transactionmodel->fetch_previous_tran_amount($transaction_id);
              
                        $data['main_trans'] = $trans_deatails;
                        $data['trans_details'] = $trans_status;
                        $data['trans_id'] = $transaction_id;
                        $data['previous_amount'] = $previous_amount["amount"];
                        $data['id']  =   $id;
                        
                            //var_dump();exit;
                        }else{
                            $data['message_error'] = 'Invalid Transaction ';    
                             // exit;
                        }
                        if(empty($trans_deatails)){
                           $data['message_error'] = 'The details of this Transaction could not be retrieved';
                          // exit;
                        }
                       // if(!isset($trans_deatails)){$trans_deatails["unit_name"]='';}
                        
                        
                        $data['name'] = $transaction_id;
                        
                  
       
    
    
     $this->load->view('header');
      $this->load->view('deletetransaction',$data);
      $this->load->view('footer');
    

    
    
}
    
   public function rejectedtoexcel(){
     
         
            if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/pending';
    $config['total_rows'] = $this->db->count_all('transation_status');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $trans_details = $this->reportmodel->getAllRejectedTransaction($config['per_page'],$page);
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
//  var_dump(headers_list());exit;   
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

header("Content-Disposition: attachment; filename=Rejected Transaction".".xls");

//out put the table body
echo"<table border='1'>";
echo"<tbody>";
     
      $this->load->view('rejectedstatusexcel',$data);
   
   echo"</tbody>";
$ExcelData=ob_get_contents();
ob_end_clean();
echo $ExcelData; 
         
     }    
public function printrejected(){
     
         
            if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/pending';
    $config['total_rows'] = $this->db->count_all('transation_status');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $trans_details = $this->reportmodel->getAllRejectedTransaction($config['per_page'],$page);
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
//  var_dump(headers_list());exit;   
    $data['boarder'] = 1;
      echo "<script>print();</script>";
      $this->load->view('rejectedstatusexcel',$data);

         
     }    
          
 public function suprejectedtoexcel(){
     
         
            if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/suprejected';
    $config['total_rows'] = $this->db->count_all('transation_status');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $trans_details = $this->reportmodel->supRejectedTransaction($config['per_page'],$page);
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
    
      
      
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

header("Content-Disposition: attachment; filename=Rejected Transaction".".xls");

//out put the table body
echo"<table border='1'>";
echo"<tbody>";
     
    $this->load->view('suprejectedstatustoexcel',$data);
   
   echo"</tbody>";
$ExcelData=ob_get_contents();
ob_end_clean();
echo $ExcelData; 
         
     }

     public function printsuprejected(){
     
         
            if(isset($_SESSION['sucess_message'])) {$data['sucess_message'] = $_SESSION['sucess_message'];}
   $_SESSION['sucess_message'] = '' ;
   
    //send error message to view
     if(isset($_SESSION['message_error'])) {$data['message_error'] = $_SESSION['message_error'];}
   $_SESSION['message_error'] = '' ;
   $this->db = $this->load->database('default', TRUE);
    $this->load->library('pagination');
    $config['base_url'] = base_url().'admin/report/suprejected';
    $config['total_rows'] = $this->db->count_all('transation_status');
    $config['per_page'] = '50';
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
     $config["uri_segment"] = 4;
     
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	//echo $page;exit;	
    
    $data["links"] = $this->pagination->create_links();
    
    
    
    
    $trans_details = $this->reportmodel->supRejectedTransaction($config['per_page'],$page);
   // var_dump($trans_details);exit;
    
     $data['results'] = $trans_details;
$data['boarder'] = 1;
      echo "<script>print();</script>";
     
    $this->load->view('suprejectedstatustoexcel',$data);
   

     }
     
}

?>
