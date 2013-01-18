<?php

/*
 * main controller
 */
class MY_Controller extends CI_Controller {
    
    //flag when redirecting to prevent footer showing
    var $redirecting = false;
    
    //data to pass to views
    var $data = array();
    
    public function __construct() {
        
        parent::__construct();
        $this->load->helper(array('url', 'form'));   
        $this->load->model('task_model');
        $this->load->model('project_model');
    } 
}
?>