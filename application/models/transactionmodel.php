<?php

class transactionmodel extends CI_Model{
    
   
    function __construct() {
            parent::__construct();
            //$this->db_cms = $this->load->database('new_hospital', TRUE);   
    }
    
 
    public function generateTransaction($length){
        $date = date("Y/m/d");
       $details = array('generate_date'=> $date);
       $this->db->insert('generate_transaction',$details);
       $id = $this->db->insert_id();
       $id = str_pad($id, $length, "0", STR_PAD_LEFT);  
      return (isset($id)) ? $id : FALSE; 
        
    }
    
    function insert_temp_transaction($data){
       
       $this->db->insert('temp_transaction', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
   }
   
   function insert_transaction_main ($data){
       
       $this->db->insert('transaction_main', $data);
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
   }
   
    function update_transaction_main ($id,$data){
       $this->db->where('trans_no', $id);
       $this->db->where('delete_status', '0');
       $this->db->update('transaction_main', $data);
       
   }
   
   function update_transation_status ($id,$data){
       $this->db->where('transaction_no', $id);
       $this->db->where('delete_status', '0');
       $this->db->update('transation_status', $data);
       
   }
   
    function insert_transation_status ($data){
       
       $this->db->insert('transation_status', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
   }
   
   function insert_transation_commited($data){
       
       $this->db->insert('transaction_commited', $data);		
       $id = $this->db->insert_id();		
      return (isset($id)) ? $id : FALSE;
   }
   
   
   function  fetch_temp_tran($tran_id){
    
    $this->db->join('unit', 'unit.unit_id = temp_transaction.unit_id','left');
    $this->db->where('trans_no', $tran_id);
    $query = $this->db->get("temp_transaction");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;  
       
   }
   
   function  fetch_main_tran($tran_id){
    
  
   $this->db->join('transation_status', 'transation_status.transaction_no = transaction_main.trans_no','left');
   $this->db->join('unit', 'unit.unit_id = transaction_main.unit_id','left');
    $this->db->where('transaction_main.delete_status', '0');
    $this->db->where('`transaction_main.trans_no', $tran_id);
    $query = $this->db->get("transaction_main");
   
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
               // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }
            return $data;
        }
        return false;  
       
   }
   
   function update_status($id, $data)
	{
		$this->db->where('transaction_no', $id);
                $this->db->where('delete_status', '0');
		$this->db->update('transation_status', $data);
	}
        
   
   public function fetch_tran_status($trans_id){
       
    $this->db->select('*');
    $this->db->where('transaction_no', $trans_id);
    $this->db->where('`transation_status.delete_status', '0');
    $query = $this->db->get('transation_status');
    return $query->row_array(); 
   }
   
    public function fetch_tran_main($trans_id){
       
    $this->db->select('*');
    $this->db->where('trans_no', $trans_id);
    $this->db->where('delete_status', '0');
    $query = $this->db->get('transaction_main');
    return $query->row_array(); 
   }
   
   public function fetch_previous_tran_amount($trans_id){
    $this->db->select_sum('amount');
    $this->db->where('trans_no', $trans_id);
    $query = $this->db->get('transaction_commited');
    return $query->row_array();
    
   }
   
   function delete_temp($id){
        $this->db->where('trans_id', $id);
        $this->db->delete('temp_transaction');
        
    } 
    
    public function all_transaction_amount(){
    $this->db->select_sum('amount');
    $query = $this->db->get('transaction_commited');
    return $query->row_array();
    
   }
   
   
   public function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        // $words = array();
        // foreach (str_split((string) $fraction) as $number) {
            // $words[] = $dictionary[$number];
        // }
        // $string .= implode(' ', $words);
        $string .= $this->convert_number_to_words($fraction);
    }
    
    return $string;
}
}

?>