<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of transaction
 *
 * @author Gbadeyanka Abass
 */
class transaction extends MX_Controller{
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
        $this->load->model('generalmodel');
        $this->load->model('unitmodel');
        $this->load->model('subunitmodel'); 
        $this->load->model('transactionmodel'); 
        $this->load->model('batchmodel'); 
              
    }
    

    Public function start(){
        $transaction_id = $this->transactionmodel->generateTransaction(4);
       $batch_details  = $this->batchmodel->getcurrentbatch();
       $data['batch_details'] = $batch_details;//echo $transaction_id;exit;
        $data['tran_id'] = $transaction_id;
        $units  = $this->subunitmodel->allunit();
        $data['units'] = $units;
        
        
        
        
        $data['customer_name'] = array(
				'name'  	=> 'customer_name',
				'id'    	=> 'customer_name',
				'type'  	=> 'text',
				'required class'=> 'form-control',
                                'value'=> ''
				);
      
        $data['customer_mobile'] = array(
                                  'name'  	=> 'customer_mobile',
                                  'id'    	=> 'customer_mobile',
                                  'type'  	=> 'text',
                                  'required class'=> 'form-control',
                                  'value'=> ''
                                  );
        $data['customer_address'] = array(
                                  'name'  	=> 'customer_address',
                                  'id'    	=> 'customer_address',
                                  'type'  	=> 'text',
                                  'required class'=> 'form-control',
                                  'value'=> ''
                                  );
         $data['price'] = array(
                                  'name'  	=> 'price',
                                  'id'    	=> 'price',
                                  'type'  	=> 'decimal',
                                  'required class'=> 'form-control',
                                  'value'=> ''
                                  );
     
        
        
        
      $this->load->view('header');
      $this->load->view('starttransaction',$data);
      $this->load->view('footer');
    
    }
    
    
    public function addtransaction() {
      
          extract($_POST);
        
        $customer_mobile = $_POST['customer_mobile'];
        $customer_name = $_POST["customer_name"];
        $customer_address = $_POST["customer_address"];
        
        $temp_result = $this->transactionmodel->fetch_temp_tran($tran_id);
        $sum = 0;
       // var_dump($temp_result);
        if(!empty($temp_result)){
        foreach ($temp_result as $t){           // var_dump($t);exit;
           $details = array('customer_mobile'=>$customer_mobile,'customer_name'=>$customer_name,'customer_address'=>$customer_address,
               'unit_id'=> $t->unit_id,'trans_no'=> $t->trans_no,'quantity'=> $t->quantity,
               'weight'=> $t->weight,'total_weight'=> $t->total_weight,'total_trans_amount'=>$t->total_trans_amount);
        $id = $this->transactionmodel->insert_transaction_main($details); 
        $sum = $sum + $t->total_trans_amount;
        }
        
        $status_details = array('customer_mobile'=>$customer_mobile,'customer_address'=>$customer_address,'transaction_no'=> $tran_id,'trans_total_amount'=> $sum,
            'trans_date'=> date('Y-m-d H:i:s'),'name'=>$customer_name,'status'=>'pending');
        
        $id = $this->transactionmodel->insert_transation_status($status_details);
         $temp_result = $this->transactionmodel->fetch_main_tran($tran_id);
        $sum = 0;
     // var_dump($temp_result);exit;
        if(!empty($temp_result)){
        foreach ($temp_result as $t){           // var_dump($t);exit;
          
            $this->db->set('stock_balance', 'stock_balance-'.$t->total_weight, FALSE);
           $this->db->where('unit_id', $t->unit_id);
           $this->db->update('unit_stock_balance');
        
        }
         
        
    }
        
        $data['tran_id'] = $tran_id;
        
        redirect(base_url().'admin/transaction/successfulgeneration/'.$tran_id);
        }else{
            
         redirect(base_url().'admin/transaction/successfulgeneration/'.$tran_id);   
        }
        
    }
    
  
    function successfulgeneration($id){
      $data['tran_id'] = $id;
      
      $this->load->view('header');
      $this->load->view('successfulgeneration',$data);
      $this->load->view('footer');
        
    }
    
    
    public function commit(){
        
    $this->form_validation->set_rules('transaction_id', 'transaction_id', 'required|xss_clean');
    if (isset($_POST['fetch'])){
        //var_dump($_POST);exit;
          
        $transaction_id = $this->input->post('transaction_id');
        //$trans_deatails = $this->transactionmodel->fetch_main_tran($transaction_id);
        $trans_status = $this->transactionmodel->fetch_tran_status($transaction_id);
        
        $previous_amount = $this->transactionmodel->fetch_previous_tran_amount($transaction_id);
        //var_dump($previous_amount);exit;
      // var_dump($previous_amount["amount"]);exit;
        $data['trans_details'] = $trans_status;
        $data['trans_id'] = $transaction_id;
        $data['previous_amount'] = $previous_amount["amount"];
        $data['trans_status'] = $trans_status;
        
    }
    
    
    if (isset($_POST['reject'])){
          $status = 'rejected';
          $trans_id = $_POST["trans_id"];        
        
          $status_data = array('status'=> $status);
          $trans_status = $this->transactionmodel->update_status($trans_id, $status_data);
          $data['trans_id'] = $trans_id ;
          $data['sucess_message'] = 'Transaction Rejected' ;
         
        
    }
     if (isset($_POST['commit'])){
        // var_dump($_POST);
         $status = 'Pending';
         $tendered_amount = 0 ;
         if(isset($_POST["amount"])){ $tendered_amount = $_POST["amount"];}
        
         $amount = $_POST["amount"];
         $trans_id = $_POST["trans_id"];
         
           $status = 'Full Payment';               
         
          $details = array('trans_no'=> $trans_id,'amount'=> $tendered_amount,
            'trans_date'=> date('Y-m-d'),'trans_date_time'=> date('Y-m-d H:i:s'));          
          $trans_status = $this->transactionmodel->insert_transation_commited($details);
          $status_data = array('status'=> $status);
          $trans_status = $this->transactionmodel->update_status($trans_id, $status_data);
          $data['trans_id'] = $trans_id ;
          $data['sucess_message'] = 'Transaction Process is Successful' ;
         
        
    }
    
    
    
    
        
         $data['form_transaction_id'] = array(
                                  'name'  	=> 'transaction_id',
                                  'id'    	=> 'transaction_id',
                                  'type'  	=> 'text',
                                  'required class'=> 'form-control',
                                  'value'=> ''
                                  );
      $this->load->view('header');
      $this->load->view('commit',$data);
      $this->load->view('footer');    
        
        
    }
    
    public function status(){
        
    $this->form_validation->set_rules('transaction_id', 'transaction_id', 'required|xss_clean');
    if (isset($_POST['fetch'])){
        //var_dump($_POST);exit;
          
        $transaction_id = $this->input->post('transaction_id');
        //$trans_deatails = $this->transactionmodel->fetch_main_tran($transaction_id);
        $trans_status = $this->transactionmodel->fetch_tran_status($transaction_id);
        
        $previous_amount = $this->transactionmodel->fetch_previous_tran_amount($transaction_id);
        //var_dump($previous_amount);exit;
      // var_dump($previous_amount["amount"]);exit;
        $data['trans_details'] = $trans_status;
        $data['trans_id'] = $transaction_id;
        $data['previous_amount'] = $previous_amount["amount"];
        $data['trans_status'] = $trans_status;
        
    }
    
    
    if (isset($_POST['reject'])){
          $status = 'rejected';
          $trans_id = $_POST["trans_id"];        
        
          $status_data = array('status'=> $status);
          $trans_status = $this->transactionmodel->update_status($trans_id, $status_data);
          $data['trans_id'] = $trans_id ;
          $data['sucess_message'] = 'Transaction Rejected' ;
         
        
    }
     if (isset($_POST['commit'])){
         $status = 'Pending';
         $tendered_amount = 0 ;
         if(isset($_POST["tendered_amount"])){ $tendered_amount = $_POST["tendered_amount"];}
        
         $amount = $_POST["amount"];
         $trans_id = $_POST["trans_id"];
         
           $status = 'Full Payment';               
         
          $details = array('trans_no'=> $trans_id,'amount'=> $tendered_amount,
            'trans_date'=> date('Y-m-d'),'trans_date_time'=> date('Y-m-d H:i:s'));          
          $trans_status = $this->transactionmodel->insert_transation_commited($details);
          $status_data = array('status'=> $status);
          $trans_status = $this->transactionmodel->update_status($trans_id, $status_data);
          $data['trans_id'] = $trans_id ;
          $data['sucess_message'] = 'Transaction Process is Successful' ;
          
       
    
    
     }
    
        
         $data['form_transaction_id'] = array(
                                  'name'  	=> 'transaction_id',
                                  'id'    	=> 'transaction_id',
                                  'type'  	=> 'text',
                                  'required class'=> 'form-control',
                                  'value'=> ''
                                  );
      $this->load->view('header');
      $this->load->view('status',$data);
      $this->load->view('footer');    
        
        
    }
    
    
    
     public function verify(){
        
    $this->form_validation->set_rules('transaction_id', 'transaction_id', 'required|xss_clean');
    if (isset($_POST['fetch'])){
        //var_dump($_POST);exit;
          
        $transaction_id = $this->input->post('transaction_id');
        //$trans_deatails = $this->transactionmodel->fetch_main_tran($transaction_id);
        $trans_status = $this->transactionmodel->fetch_tran_status($transaction_id);
        
        $previous_amount = $this->transactionmodel->fetch_previous_tran_amount($transaction_id);
        //var_dump($previous_amount);exit;
      // var_dump($previous_amount["amount"]);exit;
        $data['trans_details'] = $trans_status;
        $data['trans_id'] = $transaction_id;
        $data['previous_amount'] = $previous_amount["amount"];
        
    }
    
    
    if (isset($_POST['reject'])){
          $status = 'rejected';
          $trans_id = $_POST["trans_id"];        
        
          $status_data = array('supervisor_status'=> $status);
          $trans_status = $this->transactionmodel->update_status($trans_id, $status_data);
          $data['trans_id'] = $trans_id ;
          $data['sucess_message'] = 'Transaction Rejected' ;
         
        
    }
    if (isset($_POST['approve'])){
          $status = 'approved';
          $trans_id = $_POST["trans_id"];        
        
          $status_data = array('supervisor_status'=> $status);
          $trans_status = $this->transactionmodel->update_status($trans_id, $status_data);
          $data['trans_id'] = $trans_id ;
          $data['sucess_message'] = 'Transaction Approved' ;
         
        
    }
    
    
    
        
         $data['form_transaction_id'] = array(
                                  'name'  	=> 'transaction_id',
                                  'id'    	=> 'transaction_id',
                                  'type'  	=> 'text',
                                  'required class'=> 'form-control',
                                  'value'=> ''
                                  );
      $this->load->view('header');
      $this->load->view('verify',$data);
      $this->load->view('footer');    
        
        
    }
    
    
    public function printreciept($id=0){
        
        if (($id>0)){
        //var_dump($_POST);exit;
          
        $transaction_id = $id;
        $trans_deatails = $this->transactionmodel->fetch_tran_main($transaction_id);
        $trans_status = $this->transactionmodel->fetch_tran_status($transaction_id);
        
        $previous_amount = $this->transactionmodel->fetch_previous_tran_amount($transaction_id);
        //var_dump($previous_amount);exit;
      // var_dump($previous_amount["amount"]);exit;
        $data['main_trans'] = $trans_deatails;
        $data['trans_details'] = $trans_status;
        $data['trans_id'] = $transaction_id;
        $data['previous_amount'] = $previous_amount["amount"];
        
        
        $this->load->view('printreciept',$data);
        
    }
    
    
        
        
    }
    
    
    public function edittransaction($id=0){
        $transaction_id = $id;
        $data['tran_id'] = $transaction_id;
        $units  = $this->subunitmodel->allunit();
        $data['units'] = $units;
        
        
        if (($id>0)){
        //var_dump($_POST);exit;
          
        $transaction_id = $id;
        $trans_deatails = $this->transactionmodel->fetch_tran_main($transaction_id);
        $trans_status = $this->transactionmodel->fetch_tran_status($transaction_id);
        
        $previous_amount = $this->transactionmodel->fetch_previous_tran_amount($transaction_id);
        //var_dump($previous_amount);exit;
     //  var_dump($trans_deatails["unit_id"]);exit;
        $data['main_trans'] = $trans_deatails;
        $data['trans_details'] = $trans_status;
        $data['trans_id'] = $transaction_id;
        $data['previous_amount'] = $previous_amount["amount"];
        
        
        $data['first_name'] = array(
				'name'  	=> 'first_name',
				'id'    	=> 'first_name',
				'type'  	=> 'text',
				'required class'=> 'form-control',
                                'value'=> $trans_deatails["first_name"]
				);
      
        $data['middle_name'] = array(
                                  'name'  	=> 'middle_name',
                                  'id'    	=> 'middle_name',
                                  'type'  	=> 'text',
                                  'required class'=> 'form-control',
                                  'value'=> $trans_deatails["middle_name"]
                                  );
        $data['last_name'] = array(
                                  'name'  	=> 'last_name',
                                  'id'    	=> 'last_name',
                                  'type'  	=> 'text',
                                  'required class'=> 'form-control',
                                  'value'=> $trans_deatails["last_name"]
                                  );
        $data['passport_no'] = array(
                                  'name'  	=> 'passport_no',
                                  'id'    	=> 'passport_no',
                                  'type'  	=> 'text',
                                  'required class' => 'form-control',
                                  'value'=> $trans_deatails["passport_number"],
                                  );
        $data['amount'] = array(
                                  'name'  	=> 'amount',
                                  'id'    	=> 'amount',
                                  'type'  	=> 'number',
                                  'required class'=> 'form-control',
                                   'value' => $trans_deatails["trans_amount"]
                                  
                                  );
       
        
        
        
      $this->load->view('header');
      $this->load->view('edittransaction',$data);
      $this->load->view('footer');
        
        
    }
    
    
        
        
    }
    
     public function editupdate() {
      
         if(isset($_POST)){
        extract($_POST);
      //  var_dump($_POST);exit;
       
           $details = array('first_name'=> $first_name,'last_name'=> $last_name,
            'trans_date'=> DATE('Y-m-d H:i:s'),'middle_name'=>  $middle_name,'gender'=> $gender,
            'trans_no'=> $tran_id,'passport_number'=> $passport_no,
                'trans_amount'=> $amount,'unit_id'=> $payment_id,
               'payment_duedate'=> date ( 'Y-m-j' , strtotime ( '5 weekdays' ) ));
           
        $id = $this->transactionmodel->update_transaction_main($tran_id,$details); 
        //$sum = $sum + $t->total_trans_amount;
       // echo date ( 'Y-m-j' , strtotime ( '5 weekdays' ) );exit;
        $full_name = $first_name.' '.$middle_name.' '.$last_name;
        $status_details = array('transaction_no'=> $tran_id,'trans_total_amount'=> $amount,
            'trans_date'=> date('Y-m-d H:i:s'),'payment_duedate'=> date ( 'Y-m-j' , strtotime ( '5 weekdays' ) ),'name'=>$full_name,'status'=>'pending');
        
        $id = $this->transactionmodel->update_transation_status($tran_id,$status_details);
        
        $data['tran_id'] = $tran_id;
         redirect(base_url().'admin/report/pending/');
        }else{
            
          redirect(base_url().'admin/transaction/successfulgeneration/'.$tran_id);   
        }
        
    }
    
}

?>
