<?php



/**
 * Description of Booking
 *
 * @author Gbadeyanka Abass
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {
    
    public function __construct() {
       
       parent::__construct();
       
            $this->load->library('form_validation');
           /* 
            $this->load->model('bookingmodel');
            $this->load->model('guestsmodel');
           
            $this->load->model('web_model');
            * */
            
             $this->load->model('cms');
            
           
             
   }
    
  function pickroom(){
      
      //$this->form_validation->set_rules('startDate', 'Check in', 'required|xss_clean');
      //$this->form_validation->set_rules('endDate', 'Check out', 'required|xss_clean');
    //  var_dump($_POST);
      $data = array();
      $id=0;
     // $here = $this->cms->fetchBreadCrumb($id);//var_dump($here);die;
      //     $data['breadcrumbs'] = $here;
            
            $data['wrap'] = 'pagewrapper';
            $data['nav_links'] = $this->cms->findWebPages();
            
            $data['page_content'] = $this->cms->findWebPageContent($id);
            
            
            
            
      if (isset($_POST['startDate'])&&isset($_POST['endDate'])&&isset($_POST['roomno']))
		{	
          
                     $data['checkin'] =  $this->input->post('startDate');
                     $data['checkout'] =  $this->input->post('endDate');
                     $data['noguest'] =  $this->input->post('roomno');
                     $this->load->model('roomtypemodel');
                      // $this->db->close();
                     $data['roomtype'] = $this->roomtypemodel->getallroomtype(100,'');
                     
                      $this->load->model('utility');
                     $data['country'] = $this->utility->getAllCountry(100,'');
                     
                    
                    
                     
                     
                }else{
                    
                     redirect(base_url().'');  
                }
     
                
          $this->load->view('header',$data);
          $this->load->view('pickroom',$data);
  }
    
  
  public function terms(){
      
      $this->load->view('terms');
      
  }
  
  
  public function bookroom(){
      $roomtype = array();
      if (($_POST['terms'])){
          
          $checkindate =  $_POST["checkindate"];
          $checkoutdate =  $_POST["checkoutdate"];
          $roomno =  $_POST["roomno"];
          $roomtype =  $_POST["roomtype"];
          $firstname =  $_POST["firstname"];
          $othername =  $_POST["othername"];
          $nationality =  $_POST["nationality"];
          $city =  $_POST["city"];
          $address =  $_POST["address"];
          $email =  $_POST["email"];
          $mobile=  $_POST["mobile"];
          $time =  $_POST["time"];
          $instruction =  $_POST["instruction"];
          
        $date = new DateTime($checkindate);
        $checkindate = $date->format('Y-m-d');
          
        $date2 = new DateTime($checkoutdate);
        $checkoutdate = $date2->format('Y-m-d');
        $curr_date = date('Y-m-d H:i:s');
          $data = array('guest_firstname'=> $firstname,
              'guest_lastname'=> $othername,
              'checkindate'=> $checkindate,
              'checkoutdate'=> $checkoutdate,
              'nationalty'=> $nationality,
              'city'=> $city,
              'address'=> $address,
              'email'=> $email,
              'mobile'=> $mobile,
              'estimated_checktime'=> $time,
              'instruction'=> $instruction,
              'status'=> 'Unconfirm',
              'book_date'=> $curr_date);
          
          $this->load->model('bookingmodel');
          $id = $this->bookingmodel->insert_booking($data);
          
          foreach($roomtype as $r){
              $room_data = array('booking_id'=> $id,
                            'room_type'=> $r);
              $this->load->model('bookingmodel');
              $this->bookingmodel->insert_room_booking($room_data);
              
          }
          
          $booking_code = 'OBK'.$id;
          $update_data = array('booking_code'=> $booking_code);
           $this->load->model('bookingmodel');
          $this->bookingmodel->update_booking($id,$update_data);
          $data['booking_code'] = $booking_code;
          $_SESSION['booking_code'] = $booking_code;
           redirect(base_url().'booking/success/'.$booking_code);   
          
      }else{
          
     redirect(base_url().'');      
      }
      
  }
  
  function success($code=''){   
      
      $data = array();
      $id=0;
      $data['wrap'] = 'pagewrapper';
      $data['nav_links'] = $this->cms->findWebPages();
      $data['page_content'] = $this->cms->findWebPageContent($id);
            
      if(isset($_POST['code'])){ $code=$_POST['code'];}else{
          
          if(isset($_SESSION['booking_code'])){$code=$_SESSION['booking_code'];
      }
            
      
      
      
      if(isset($_SESSION['booking_code'])){
      $data['status'] = $_SESSION['booking_code'] ;
      }
      
          }
      $this->load->model('bookingmodel');//echo $code;
      $details = $this->bookingmodel->getBookingByCode($code);
      $data['details'] = $details;
      if($details){
      $room_info= $this->bookingmodel->getBookingRoomsByBookingId($details["booking_id"]);
      $data['room_info'] = $room_info;      
      }
      
      
      $this->load->view('header',$data);
      $this->load->view('success',$data);
      
      
  }
  
  
  
}

?>
