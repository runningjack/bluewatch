<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of billmodel
 *
 * @author Gbadeyanka Abass
 */
class billmodel extends CI_Model{
    
    function __construct() {
            parent::__construct();
           $this->db = $this->load->database('default', TRUE); 
    }
    
    
    
    function dateRange($first, $last, $step = '+1 day', $format = 'Y-m-d' ) {
    $dates = array();
    $current = strtotime($first);
    $current = strtotime('+1 day', $current);
    $last = strtotime($last);
    while( $current <= $last ) {	
    $dates[] = date($format, $current);
    //echo  date($format, $current);
    $current = strtotime($step, $current);
    }
    
    //var_dump($dates);exit;
    return $dates;
    }
    
    
    
    
}

?>
