<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Mailfunction("lekan4real07@gmail.com", "Testing mail", "Mail Body here you go");


function Mailfunction1($to, $subject, $body)
    {
        require_once 'Mail.php'; 
        $from = 'info<info@bluechiptech.biz>';
        $headers = array(
        'MIME-Version' => '1.0',
        'Content-Type' => 'text/html; charset=ISO-8859-1',
            'From' => $from,
            'To' => $to,
            'Subject' => $subject,
        );

     
        $smtp = Mail::factory('smtp', array(
                  'host' => 'bluechiptech-biz.mail.protection.outlook.com',
                  'port' => '25',
                  'auth' => false,
                  'username' => '',
                  'password' => '',
              ));

        $mail = $smtp->send($to, $headers, $body);
        

        if (PEAR::isError($mail)) {
            return  serialize($mail->getMessage());
        }else{
            return  true;
        }
    }


  function Mailfunction101($to, $subject, $content)
    {
  
       // $CI =& get_instance();

        $CI->load->library('email');

//SMTP & mail configuration
$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => 'bluechiptech-biz.mail.protection.outlook.com',
    'smtp_port' => 25,
    'smtp_user' => '',
    'smtp_pass' => '',
    'mailtype'  => 'html',
    'smtp_crypto' => 'tls',
    'charset'   => 'utf-8',
    'secure'=>false
);
$CI->email->initialize($config);
$CI->email->set_mailtype("html");
$CI->email->set_newline("\r\n");

$CI->email->to($to);
$CI->email->from('info@bluechiptech.biz','Bluewatch');
$CI->email->subject($subject);
$CI->email->message($content);

//Send email
$resp = $CI->email->send(false);
//var_dump($resp );exit;

if(!$resp){
//echo($CI->email->print_debugger());exit;
return false;
}

return true;
    }



 function Mailfunction12($to, $subject, $body)
    {
        
         $url = 'email-smtp.eu-west-1.amazonaws.com';
         //$url = MAILAPI;
         $data['phone'] = '07030657010';
         $data['password'] = '07030657010';
         $data['mail_from'] = 'jjamiu@bluechiptech.biz';
         $data['mail_to'] = $to;
         $data['mail_body'] = $body;
         $data['mail_subject'] = $subject;
        //var_dump($data);
        if (ALLOW_SEND_MAIL === true) {
            send_mail1($to, $subject, $body);
        } 
    }

     function callSendAPI($method, $url, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        $payload = json_encode($data);

        if ($data) {
            //  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'Content-Type : application/x-www-form-urlencoded',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
    var_dump(curl_error($curl));
}
        if (!$result) {
        exit;
            return false;
        }
        curl_close($curl);
        var_dump($result);exit;
        

        return $result;
    }


    function send_mail1($to, $subject, $content)
    {
  
        $CI =& get_instance();

        $CI->load->library('email');

//SMTP & mail configuration
$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => 'email-smtp.eu-west-1.amazonaws.com',
    'smtp_port' => 587,
     'smtp_user' => 'AKIAZEH6L3ZIQZPUMRMO',
    'smtp_pass' => 'BFScZCYwPw2+YmSPqC/uGeDS1DbzBywaSxoREq9kZy+j',
    'mailtype'  => 'html',
    'smtp_crypto' => 'tls',
    'charset'   => 'utf-8'
);
$CI->email->initialize($config);
$CI->email->set_mailtype("html");
$CI->email->set_newline("\r\n");

$CI->email->to($to);
$CI->email->from('agbadeyanka@bluechiptech.biz','Bluewatch');
$CI->email->subject($subject);
$CI->email->message($content);

//Send email
$resp = $CI->email->send(false);

if(!$resp){
//var_dump($CI->email->print_debugger());
return false;
}

return true;
    }

