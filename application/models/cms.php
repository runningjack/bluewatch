<?php

class Cms extends CI_Model{
    
   
    function __construct() {
            parent::__construct();
            $this->db_cms = $this->load->database('cms', TRUE);   
    }
            
    function findWebPages(){
            $sql = "SELECT wpc.*, COUNT(wpc1.page_ref_id) AS children
                    FROM web_pages_content wpc
                    LEFT JOIN web_pages_content wpc1 ON wpc.page_ref_id = wpc1.page_ref_index
                    WHERE wpc.page_published = 'Yes'
                    GROUP BY wpc.page_ref_id
                    ORDER BY wpc.page_ref_id";
//            $this->db->select()->from('web_pages_content')->where('page_published', 'Yes')->order_by('page_order');
//            $pages = $this->db->get();
           
           $pages =  $this->db_cms->query($sql);
           $data = $pages->result();
           
            return $data;
    }
    
    function findWebPage($id){
            $where = array('page_ref_id'=>$id, 'page_published'=>'Yes');

            $this->db_cms->select()->from('web_pages_content')->where($where)->limit(1);
            $page = $this->db_cms->get();
            if( $page->num_rows() == 1 ) {
                
                $data = $page->row();
                
                    return $data;
            }

            return '';
    }
    
    function findWebPageContent($id){
            $where = array('page_id'=>$id, 'publish'=>'yes');

            $this->db_cms->select()->from('pages_content')->where($where)->order_by('content_id');
            $page_content = $this->db_cms->get();
            
            $data = $page_content->result();
            
            return $data;
    }
    
    function findNews($id=0){
            if(empty($id)){
                    return $this->findAllNews();
            }else{
                    return $this->findSpecificNews($id);
            }
    }
    
    private function findAllNews(){
            $this->db_cms->select()->from('news_content')->where('news_published', 'yes');
            $news = $this->db_cms->get();
            return $news->result();
    }
    
    private function findSpecificNews($id){
        $where = array('news_id'=>$id, 'news_published'=>'yes');
        $this->db_cms->select()->from('news_content')->where($where)->limit(1);
        $news = $this->db_cms->get();
        return $news->row();
    }
    
    function findGalleryImages(){
        $where = array('content_album_id'=>2, 'publish'=>'yes');
        
        $this->db_cms->select()->from('album_content')->where($where);
        $gallery_images = $this->db_cms->get();
        return $gallery_images->result();
    }
    
    
        public function fetchBreadCrumb($pid)
        {
            $this -> page_id = (int) $pid;

            // PAGE ID NOT SET
            if($this->page_id == 0)
            {
                    $this -> rtnstring = 0;
                    return $this->rtnstring;	
            }else
            {	

                    $page_title = $this->getTitle($this ->page_id);//var_dump($page_title["page_ref_title"]);exit;
                   $page_title = $page_title["page_ref_title"];
                    $this->rtnstring = "<a href='".base_url()."web/page/" . $this -> page_id . "'>". $page_title . "</a>";
                    //var_dump($this->rtnstring);exit;
                    // GO AHEAD TO FETCH BREADCRUMBS
                    $bread_crumb = $this->getCrumb($this->page_id);

                    return $bread_crumb; //bread_crumb;
            }
    }

    public function getCrumb($id)
    {	
            // GET PARENT ID OF THIS PAGE (LEVEL 1)

            $continue = $id;

            while($continue != 0)
            {
                    $cur_parent_id = $this->getParentID($continue);//exit;
                  (int)$cur_parent_id = $cur_parent_id["page_ref_index"];
                  //print($cur_parent_id);
                  
                  
                   $cur_parent_title = $this->getTitle($cur_parent_id);
                  // var_dump($cur_parent_title);
                 if($cur_parent_id){
                   $cur_parent_title = $cur_parent_title["page_ref_title"];
                   // if(!empty($cur_parent_title))print_r($cur_parent_title);
            $this->rtnstring = "<a href='".base_url()."web/page/".$cur_parent_id."'>".$cur_parent_title."</a> 
            &raquo; " . $this->rtnstring;		
}
            $continue = $cur_parent_id;	
                 
            }

            return $this->rtnstring;
    }


    public function getParentID($has_par)
    {
            // FETCH PARENT ID
         // var_dump($has_par);
            
             $this->db_cms->select('page_ref_index');
    $this->db_cms->where('page_ref_id', $has_par);
    
    $query = $this->db_cms->get('web_pages_content');
    $data = $query->row_array();
     $this->db_cms->close();        
    return $data ;
    }


    public function getTitle($id)
    {  
            // FETCH PARENT TITLE
     $this->db_cms->select('page_ref_title');
    $this->db_cms->where('page_ref_id', $id);
    
    $query = $this->db_cms->get('web_pages_content');
    $data = $query->row_array();
            
     $this->db_cms->close();        
    return $data ;

    }
}

?>