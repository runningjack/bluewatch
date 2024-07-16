<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Description of accessControl
 *
 * @author Gbadeyanka Abass
 */
class accesscontrol extends MX_Controller{
     function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('accessControlModel');
       $this->load->model('generalmodel');
       $this->load->model('settingsmodel');
       $this->load->model('usersModel');

       //
    }
  
 
 
 
 function checkLDAPLogin($user, $password)
    {
        $ldap_host = 'ldaps://ldap.bluechiptech.biz';
        $ldap_port = '636';
        $ldap_dn = "dc=bluechiptech,dc=biz";
        $managerDN = "CN=user_hrms, OU=AADDC Users ,DC=Bluechiptech, DC=BIZ";
        $managerPassword = "P4ssw0rdAbass12349$";

        // connect to active directory
        if (empty($ldap_port)) {
            $ldap_port = 389;
        }

        $ldap = ldap_connect($ldap_host, intval($ldap_port));

       
        

        if (!$ldap) {
             die("Could not connect to LDAP Server");
        } 
        
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        // verify user and password 
        $bind = @ldap_bind($ldap, $managerDN, $managerPassword);
       
         
       if ($bind) {
            $userFilterStr = '(mail={})'; 
            $filter = str_replace("{}", $user, $userFilterStr);   //"(uid=" . $user . ")";
            $result = ldap_search($ldap, $ldap_dn, $filter);  
           }
        if (!$result) {
                exit("Unable to search LDAP server");
            }
        $entries = ldap_get_entries($ldap, $result);
        
        
        if (empty($entries) || !isset($entries[0]) || !isset($entries[0]['dn'])) {
                return false;
            }
            //$bind = @ldap_bind($ldap, $entries[0]['dn'], $password);
            $bind = @ldap_bind($ldap, $entries[0]["cn"][0], $password); 
            ldap_unbind($ldap);

            if ($bind) {
                //var_dump(new IceResponse(IceResponse::SUCCESS, $entries[0]));exit;
                //return new IceResponse(IceResponse::SUCCESS, $entries[0]);
                return $entries[0];
            } else {
               // return new IceResponse(IceResponse::ERROR, "Invalid user");
                return false;
            }
       
       
       
       } 


 function ms_login()
 {
 
   $url = $this->input->get('url');
   
   $data = array();
   //This method will have the credentials validation
   $this->load->library('form_validation');
   if(!isset($_SESSION['samlNameId']))
   {
     $data['check_database'] = 'Invalid Authentication'; 

   }else
   {
     $username = $_SESSION['samlNameId'];
     $result =  $this->accessControlModel->loginEmail($username);
       if(!$result){ 
              $employee = $this->settingsmodel->getEmployeeByEmail($username);
              $record["employee_id"] = $employee[0]->employee_id;
              $record["username"] = $username;
             $this->usersModel->insert_user($record);
             $result =  $this->accessControlModel->loginEmail($username);
                
           }

               $result = $result[0];

               setcookie('login_detal',serialize($result), time() + (86400 * 120), "/");
               setcookie('user', $result->username, time() + (86400 * 120), "/");
               setcookie('usersalt',$result->username.MD5('salt0123'), time() + (86400 * 120), "/");
               setcookie('user_id',$result->user_id, time() + (86400 * 120), "/");
               setcookie('group_id',$result->group_id, time() + (86400 * 120), "/"); 
               $_SESSION['login_detal'] = $result;
               $_SESSION['user'] = $result->username;
               $_SESSION['usersalt'] = $result->username.MD5('salt0123');
               $_SESSION['user_id'] = $result->user_id;
               $_SESSION['prog_id'] = $result->prog_id;
               $_SESSION['fac_id'] = $result->fac_id;
               $_SESSION['dept_id'] = $result->department;
               $_SESSION['group_id'] = $result->group_id; 
               $_SESSION['finacial_year'] = $this->checkSetFinYear(); 
 
               if($url == ""){
                redirect(base_url('admin/index')); 
               }
               redirect(base_url(). $url); 
              
          


   }
   

   
   $this->load->view('login_view',$data);


 }

 
 function verifylogin()
 {
 
   $url = $this->input->get('url');
   if($_SESSION['user_id'] != NULL){
      if ($url) {
        redirect(base_url($url));
      }else{
        redirect(base_url('admin/index'));
      }
   }
   
   $data = array();
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');


   if($this->form_validation->run() == TRUE)
   {
    
     //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
   $password = $this->input->post('password');
   $url = $this->input->post('url');
   
   //if($username=='admin'){
   if($username=='admin' || $username=='aseraphin@bluechiptech.biz' || $username=='teamlead' || $username=='kamar' || $username=='udoka' || $username=='agbadeyanka@bluechiptech.biz' || $username=='finance' || $username=='director1' || $username=='az@bluechiptech.biz' || $username=='oakinsoyinu@bluechiptech.biz' || $username=='puromi-owu@bluechiptech.biz' || $username=='msule@bluechiptech.biz' || $username=='cuwuilekhue@bluechiptech.biz' || $username=='ioshinowo@bluechiptech.biz' || $username=='oakinsanya@bluechiptech.biz' || $username=='oakinsanya@bluechiptech.biz' || $username=='bafolabi@bluechiptech.biz'){
  
           $result =  $this->accessControlModel->login($username, $password);
           if(!$result){ 
             $data['check_database'] = 'Invalid username or password';   
           }else{
               
               $result = $result[0];
               $_SESSION['login_detal'] = $result;
               $_SESSION['user'] = $result->username;
               $_SESSION['usersalt'] = $result->username.MD5('salt0123');
               $_SESSION['user_id'] = $result->user_id;
               $_SESSION['prog_id'] = $result->prog_id;
               $_SESSION['fac_id'] = $result->fac_id;
               $_SESSION['dept_id'] = $result->department;
               $_SESSION['group_id'] = $result->group_id; 
               $_SESSION['finacial_year'] = $this->checkSetFinYear(); 
               if($url == ""){
                redirect(base_url('admin/index')); 
               }
               redirect(base_url(). $url); 
              
           }
    }else{
 
     $ldap_response = $this->checkLDAPLogin($username,$password);
     if($ldap_response){
     //setcookie('loginDetails',$ldap_response, time() + (86400 * 120), "/");
     //setcookie('username',$username, time() + (86400 * 120), "/");
     $result =  $this->accessControlModel->loginEmail($username);
  //  var_dump($ldap_response);exit; 
     $result = $result[0];
     setcookie('login_detal',serialize($result), time() + (86400 * 120), "/");
     setcookie('user', $result->username, time() + (86400 * 120), "/");
     setcookie('usersalt',$result->username.MD5('salt0123'), time() + (86400 * 120), "/");
     setcookie('user_id',$result->user_id, time() + (86400 * 120), "/");
     setcookie('group_id',$result->group_id, time() + (86400 * 120), "/"); 
               $_SESSION['login_detal'] = $result;
               $_SESSION['user'] = $result->username;
               $_SESSION['usersalt'] = $result->username.MD5('salt0123');
               $_SESSION['user_id'] = $result->user_id;
               $_SESSION['prog_id'] = $result->prog_id;
               $_SESSION['fac_id'] = $result->fac_id;
               $_SESSION['dept_id'] = $result->department;
               $_SESSION['group_id'] = $result->group_id; 
               $_SESSION['finacial_year'] = $this->checkSetFinYear(); 

               if($url == ""){
                redirect(base_url('admin/index')); 
               }
               redirect(base_url(). $url);
     }else{
      
       $data['check_database'] = 'Invalid username or password';
     
     }
     
  }
  
     
  
   }
   
   $this->load->view('login_view',$data);


 }

 public function checkSetFinYear()
 {
   $finyear = $this->generalmodel->getFinyear();

   $finYearr = $finyear->year;
   $finStartMonth = $finyear->start_month;

   $newStartDate = $finStartMonth."-".(intval($finYearr)+1);
    $checkDate = date('F-Y');

  if ($checkDate == $newStartDate) {
    $data = array('year' => intval($finYearr)+1);
    $resp = $this->generalmodel->setFinYear($data);

    if ($resp) {
      //send mail for new finacial year
    }
  }

  $finyear = $this->generalmodel->getFinyear();

  return $finyear;

 }
 
  function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('admin/accesscontrol/verifylogin', 'refresh');
 }
    
    
}

?>
