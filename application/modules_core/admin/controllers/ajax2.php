<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ajax
 *
 * @author Gbadeyanka Abass
 */
class Ajax extends MX_Controller{
     function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('utility');
        $this->load->model('departmentmodel');
        $this->load->model('courseoptionmodel');
        $this->load->model('academycoursesmodel');
       $this->load->model('generalmodel');
       $this->load->model('subunitmodel');
       $this->load->model('transactionmodel');
    }
    function additems(){
       var_dump($_POST); 
        
    }
    
    
}

