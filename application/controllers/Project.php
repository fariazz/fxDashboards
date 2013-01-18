<?php

class Project extends CI_Controller {
               
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('project_model');
    }	
    function index()
    {			
        $this->form_validation->set_rules('name', 'name', 'required|max_length[255]');			
        $this->form_validation->set_rules('color', 'color', 'required|max_length[255]');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        {
            echo 'complete all the required fields and enter valid data'; exit();
        }
        else // passed validation proceed to post success logic
        {
            // build array for the model

            $form_data = array(
                                'name' => set_value('name'),
                                'color' => set_value('color')
                                );

            // run insert model to write data to db

            if ($this->project_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
            {
                echo 'Your entry was saved!';
            }
            else
            {
            echo 'An error occurred saving your information. Please try again later';
            // Or whatever error handling is necessary
            }
        }
    }


    function getAll() 
    {
        $projects = $this->project_model->get_all();
        $this->load->view('_projectsList', array('projects' => $projects));

    }

}
?>