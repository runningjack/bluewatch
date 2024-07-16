<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller {
    
    function __construct() {
        
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('cms');
            $this->load->model('web_model');
        
    }
    
    function index() {
        
            $webpage = $this->cms->findWebPage( 1 );
            $data['title'] = $webpage->page_ref_title;
            $data['wrap'] = 'homewrapper';
            $data['nav_links'] = $this->cms->findWebPages();
            $data['ticker_news'] = $this->cms->findNews();
            $data['show'] = array('slide', 'quicklinks');
            
            $this->load->view('header', $data);
            $this->load->view('slide');
            $this->load->view('container');
            $this->load->view('footer');
        
    }
    
    private function page_not_found() {
            $this->load->view('page_not_found');
    }
    
    
    function page( $id = 0 ) {
        
            $webpage = $this->cms->findWebPage( $id );
            if( !$webpage ) {
                    return $this->page_not_found();
            }
           $here = $this->cms->fetchBreadCrumb($id);//var_dump($here);die;
           $data['breadcrumbs'] = $here;
            $data['title'] = $webpage->page_ref_title;
            $data['wrap'] = 'pagewrapper';
            $data['nav_links'] = $this->cms->findWebPages();
            $data['ticker_news'] = $this->cms->findNews();
            $data['page_id'] = $id;
            $data['page_name'] = $webpage->page_ref_name;
            $data['page_title'] = $webpage->page_ref_title;
            $data['page_desc'] = $webpage->page_ref_desc;
            $data['page_content'] = $this->cms->findWebPageContent($id);
            $data['show'] = array('quicklinks');
            $page_pics = array('1'=>'slide1.jpg', '1'=>'slide2.jpg', '1'=>'slide3.jpg', '1'=>'slide4.jpg',
                '1'=>'slide5.jpg');
            $data['page_pic'] =  $page_pics;
            
//var_dump( $data['page_content']);
            $this->load->view('header', $data);
            $this->load->view('page', $data);
            //$this->load->view('footer');
        
    }
    
    function news( $id = 0 ) {
        
            $news = !empty($id) ? $this->cms->findNews($id) : $this->cms->findNews();
            if( !$news ) {
                    return $this->page_not_found();
            }

            $data['title'] = is_array($news) ? "Events" : $news->news_title;
            $data['wrap'] = 'pagewrapper';
            $data['nav_links'] = $this->cms->findWebPages();
            $data['ticker_news'] = $this->cms->findNews();
            $data['page_id'] = $id;
            $data['news'] = $news;
            $data['page_title'] = "Events";
            $data['show'] = array();
            

            $this->load->view('header', $data);
            $this->load->view('news');
            $this->load->view('footer');
        
    }
    
    function contact( $msg = '') {
        
        $captchaerror = FALSE;
        
        $this->load->helper('recaptchalib');
        
        if( $this->input->post('send_message')) {
            $privatekey = "6LfM7-YSAAAAAMuy9JGWt-UZ7qWaa051yp82Uw-5";
            $resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

            //confirm captcha
            if (!$resp->is_valid) {
                    //die ("The reCAPTCHA wasn't entered correctly. Go back and try it again. (reCAPTCHA said: " . $resp->error . ")");
                    $captchaerror = true; $error = true;
            }
        }
	
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('tel', 'Name', 'trim');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        
        if( $this->form_validation->run() === FALSE || $captchaerror === TRUE ) {
            
            $id = 4;
            $webpage = $this->cms->findWebPage( 4 );
            $data['webpage_title'] = $webpage->page_ref_title;
            $data['page_id'] = $id;
            $data['page_name'] = $webpage->page_ref_name;
            $data['page_title'] = $webpage->page_ref_title;
            $data['page_desc'] = $webpage->page_ref_desc;
            $data['page_content'] = $this->cms->findWebPageContent($id);
            $data['pages'] = $this->cms->findWebPages();
            $data['msg'] = $msg;

            $this->load->view('header', $data);
            $this->load->view('contact');
            $this->load->view('footer');
            
        }
        else {
            
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $tel = $this->input->post('tel');
            $department = $this->input->post('department');
            $message = $this->input->post('message');
            $msg = "Fullname: $name
                    \n Email: $email
                    \n Telephone: $tel
                    \n Attention: $department
                    \n Message: $message";

            $mail['from'] = 'info@upperlinkinc.com';
            $mail['to'] = $email;
            $mail['subject'] = "Website contact from Upperlink Inc : $name";
            $mail['message'] = $msg;
            
            $this->send_mail($mail);
            
            $this->redirect( 'contact', '1');
            
        }
    }
    
    private function redirect($method, $msg='') {
        $msg = url_title($msg);
        redirect( base_url("web/$method/$msg"));
    }
    
    private function send_mail($mail) {
        
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        
        extract($mail); // $from, $to, $subject, $message
        
        $_message = "<html><body>" . $message . "</body></html>";
        
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($_message);
        
        return $this->email->send();
    }
}

?>
