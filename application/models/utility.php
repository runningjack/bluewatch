<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utility
 *
 * @author Gbadeyanka Abass
 */
class utility extends CI_Model{
    
     function __construct() {
            parent::__construct();
            $this->db = $this->load->database('default', TRUE);
            
    }
    
    function getAllCountry(){      
        
       // $this->db->limit($limit, $start);
        $query = $this->db->get("countries");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
    
    function getAllTitle(){      
        
        //$this->db->limit($limit, $start);
        $query = $this->db->get("salutation");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
    
    function getAllIDType(){      
        
     //   $this->db->limit($limit, $start);
        $query = $this->db->get("id_type");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            //var_dump($data);die();
            return $data;
        }
        return false;
    }
    
    function getVacantRoomByRoomType($roomtype_id){
        
    $this->db->select('*');
    $this->db->from('rooms');
    $this->db->where('roomtypeid', $roomtype_id);
    $this->db->where('status', 'Vacant')
    ;
    
        $query = $this->db->get();
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
        
    }
    
    function createBill($data){
 
       
       $this->db->insert('bills', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
  
        
    }
    
    
     function makeReservation($data){
 
       
       $this->db->insert('reservation', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
  
        
    }
    
     function updateReservation($id, $data){
 
       
       $this->db->where('roomid', $id);
       $this->db->update('reservation', $data);
        
    }
    
      function updateTransaction($data){
 
       
       $this->db->insert('transactions', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
  
        
    }
    
    
     function GuestBillId($id){
    $this->db->select('*');
    $this->db->where('guestid', $id);
    $this->db->where('status', 'Not Paid');
    $query = $this->db->get('bills');
    return $query->row_array();   
       
   }
   
   
   function update_transaction($id){
       $bill['bill_id']=0;
       $bill = utility::GuestBillId($id);
        //check if their is outstanding bill
        //var_dump($bill);exit; 
        if(isset($bill['bill_id'])){
            
            //delete room transaction so that we re calculate
            
        $this->delete_trans($bill['bill_id']);
        $roomRate = array();
        $roomRateCharges = array();
        $reservation_details = guestsmodel::GuestUnpaidReservationStatus($id); 
        
        //var_dump($reservation_details);exit;
      $discount =  $bill['discount']; 
      $alowed_discount = $discount;
      if($reservation_details ){ //if dear is any unpaid reservatn 
        foreach($reservation_details as $r){
            //var_dump($r->roomname);EXIT;
            
          $roomRate['checkindate'] = $r->checkinonly;
          $roomRate['checkoutdate'] = $r->checkoutonly;
          
          $roomRate['bill_id'] = $r->bill_id;
          $roomRate['roomtype'] = $r->roomtype;
          $roomRate['default_amount'] = $r->default_amount;
          $roomRate['service_charge_percentage'] = $r->service_charge_percentage;
          $roomRate['tax_percentage'] = $r->tax_percentage;
          $roomRate['discount'] = $discount;
          $transRow_details = array();
          //calculate the number of days and put days into array
          $interval = array();
          $interval =  billmodel::dateRange($roomRate['checkindate'], $roomRate['checkoutdate']);
          //var_dump($interval);exit;
         if(count($interval)){ //if their is an interval
         foreach($interval as $i){
            //$i = $interval[$i];
           //var_dump($i);exit; 
           $trans_cat = 'Debit';
           $room_rate = $r->roomname.'(Room Rate)';
              
         $amount = $r->default_amount;
         
        
        $discount= $amount*($alowed_discount/100);
        $amount_after_discount = $amount-$discount;
        $tax = $amount_after_discount*($roomRate['tax_percentage']/100);
        $service = $amount_after_discount*($roomRate['service_charge_percentage']/100);
        $tourism = $amount_after_discount*(10/100);
        $total = $amount_after_discount + $tax + $service + $tourism ;
        
        $trans_data =  array('bill_id'=> $r->bill_id,
           'details'=>$room_rate,
           'trans_cat'=> $trans_cat,
           'std_amount'=> $amount,
           'std_tax'=>$tax,
            'std_tourism'=>$tourism,
            'std_svc'=>$service,
            'trans_date'=>$i,
            'grossamount'=>$total,
            'item_id'=>'1',
            'actual_amount'=>$amount_after_discount
               );
        
        $trans_id = $this->updateTransaction($trans_data);
             
             
         }
             
         }else{
             $data['message_error'] ='wrong date Range';
             //die('wrong date Range');
             
         }
          
          
           
            
            
      }
      //close resevation check
         }else{
          $data['message_error'] = 'Their is no umpaid reservation';  
        //  die('Their is no umpaid reservation');
             //echo 'Invalid Guest';
      }
      
        
        
        }else{
            
            
			$_SESSION['error_message']= "Their is no outstanding bill.";
        }
        
       
       
   }

   
   function delete_trans($bill_id){
        
        $this->db->where('bill_id', $bill_id);
        $this->db->where('item_id', '1');
        $this->db->delete('transactions');
        
    }  
   
    
    
    function getTransaction($bill_id){
        
    $this->db->select('*');
    $this->db->where('bill_id', $bill_id);
    $this->db->order_by("trans_date", "asc"); 
    $query = $this->db->get('transactions');
   // var_dump($data);exit;
    if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            
            return $data;
        }
        return false;
    
        
        
    }
    
    
    function getOtherItems(){
        
    $this->db->select('*');
    $query = $this->db->get('details');
    
    if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    
        
        
    }

        
    
    
}

?>
