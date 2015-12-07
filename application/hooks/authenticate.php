<?php 
class Authenticate
{

    private $CI;

    function __construct()
    {    	
        $this->CI =& get_instance();      
        if(!isset($this->CI->session)){  //Check if session lib is loaded or not
              $this->CI->load->library('session');  //If not loaded, then load it here
        }
    }
   function loginCheck()
   {
   		if(!$this->CI->session->userdata('logged_in') && $this->CI->router->fetch_class() == 'admin'){
   			redirect(base_url().'admin');
   		}       
    }
}