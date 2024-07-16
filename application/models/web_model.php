<?php

class Web_model extends CI_Model{
    
    var $upload_path = "assets/uploads/";
    var $upload_error = array('trademark_certificate'=>'', 'power_of_attorney'=>'');
    
    function __construct() {
        parent::__construct();
        $this->load->library('upload');
         $this->db = $this->load->database('cms', TRUE);
    }
    
    function get_upload_error($key = '') {
        if( !empty($key) ) {
            return $this->upload_error[$key];
        }
        return $this->upload_error;
    }
    
    function save_trademark( $trademark ) {
        
        $data = array();
        foreach( $trademark as $field => $detail ) {
            $data[$field] = $detail; 
        }
        
        if($this->db->insert('trademarks', $data)) {
            return $this->db->insert_id();
        }
        
    }
    
    
    function upload_trademark_certificate($filename, $field='trademark_certificate') {
        
        $props = array(
                    'upload_path'   => $this->upload_path . 'trademark_certificate',
                    'allowed_types' => 'jpg|pdf',
                    'overwrite'     => TRUE,
                    'file_name'     => $filename
        );
        
        $up1 = new CI_Upload($props);
        if( $up1->do_upload($field) ) {
            $uploaded_file = $up1->data();
            return $uploaded_file['file_name']; 
        }
        else {
            
            $error = $up1->display_errors('','');
            if($error == 'You did not select a file to upload.') {
                if( $this->file_previously_uploaded($filename, $field) ) { return 'Uploaded'; }
                else { 
                    $this->upload_error['trademark_certificate'] = $error;
                    return FALSE; 
                }
            }
            else {
                $this->upload_error['trademark_certificate'] = $error;
                return FALSE;  
            }
            
        }
        
    }
    
    function upload_power_of_attorney($filename, $field='power_of_attorney') {
        
        $props = array(
                    'upload_path'   => $this->upload_path . 'power_of_attorney',
                    'allowed_types' => 'jpg|pdf',
                    'overwrite'     => TRUE,
                    'file_name'     => $filename
        );
        
        $up2 = new CI_Upload($props);
        if( $up2->do_upload($field) ) {
            $uploaded_file = $up2->data();
            return $uploaded_file['file_name'];
        }
        else {
            
            $error = $up2->display_errors('','');
            if($error == 'You did not select a file to upload.') {
                if( $this->file_previously_uploaded($filename, $field) ) { return 'Uploaded'; }
                else { 
                    $this->upload_error['power_of_attorney'] = $error;
                    return FALSE; 
                    
                }
            }
            else {
                $this->upload_error['power_of_attorney'] = $error;
                return FALSE; 
            }
            
        }
        
    }
    
    function file_previously_uploaded( $filename, $folder, $types = array("pdf", "jpg") ){
        
        $path = $this->upload_path . $folder;
        $file = $path . '/' . $filename;
        
        foreach($types as $ext) {
            $_file = $file . "." . $ext;
            if(file_exists($_file) ) { return TRUE; }
        }
        
        return FALSE;
        
    }
}


?>