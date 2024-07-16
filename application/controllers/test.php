<?php

class Test extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		//$this->load->library('zend','Zend/Barcode/Barcode');
               
	}

	function index()
	{
              $this->load->library('zend');
    $this->zend->load('Zend/Barcode');
    $test = Zend_Barcode::draw('ean8', 'image', array('text' => '1234565'), array());
    var_dump($test);
    imagejpeg($test, 'barcode.jpg', 100);
 
	}
}
?>