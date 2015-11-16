<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    
    

         public function initiate(){
            $this->load->helper('url'); 
            $this->load->model('projectModel');
            $this->load->library('pagination');
            $this->load->database();
         }
          
	public function index(){
           $this->initiate();
           $data['names'] = $this->projectModel->getMemberName();
           $data['tasks'] = false;
           $data['member'] = false;
           $this->load->view('employeeDetails' , $data );
	}
        
        public function getTaskDetails(){
            $this->initiate();
            $id=$this->uri->segment(3);
            $data['names'] = $this->projectModel->getMemberName();
            $data['member'] = $this->projectModel->getMemberDetails($id);
              
            $config = array();
            $config["base_url"] = base_url() . "index.php/Welcome/getTaskDetails/".$id;
            $total_row = $this->projectModel->record_count($id);
            $config['total_rows'] = $total_row;
            $config['per_page'] = 5;
            $config['use_page_numbers'] = FALSE;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = '<span class="glyphicon glyphicon-chevron-right"></span>';
            $config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left"></span>';
            $config['uri_segment'] = 4;
            $config['display_pages'] = FALSE;
            $this->pagination->initialize($config);
            if($this->uri->segment(4)){
                $page = ($this->uri->segment(4)) ;
            }
            else{
                $page = 0;
            }
            $data['tasks'] = $this->projectModel->fetch_data($config['per_page'], $id,$page);
            $str_links = $this->pagination->create_links();
            $data['links'] = explode('&nbsp;',$str_links );
            $this->load->view('employeeDetails' , $data );
	}
        
        public function setting(){
             $this->load->view('Settings');
        }
        
       
}
