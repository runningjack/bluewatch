<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reportManager
 *
 * @author Gbadeyanka Abass
 */
class reportManager extends MX_Controller {
    
      public function __construct() {
       
       parent::__construct();
}
function financial(){
    
  $this->load->view('header');
      $this->load->view('financialreport');
      $this->load->view('footer');    
      $this->load->model('generalmodel');
      $this->load->model('transactionmodel');
}
function room(){
    
     $this->load->view('header');
      $this->load->view('roomreport');
      $this->load->view('footer');   
}

}

?>
