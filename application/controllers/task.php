<?php

class Task extends CI_Controller {
               
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('task_model');
        $this->load->model('project_model');
    }	
    function index()
    {			
        $this->form_validation->set_rules('title', 'title', 'required|max_length[255]');			
        $this->form_validation->set_rules('description', 'description', '');			
        $this->form_validation->set_rules('due_date', 'date', '');
        $this->form_validation->set_rules('project', 'project', '');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        
        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        {
            echo 'complete all the required fields and enter valid data'; exit();
        }
        else 
        {
            $project = $this->project_model->get(set_value('project'));
            
            if(!$project)
            {
                echo 'complete all the required fields and enter valid data'; exit();
            }
            
            // build array for the model
            $form_data = array(
                                'title' => set_value('title'),
                                'description' => set_value('description'),
                                'due_date' => set_value('due_date'),
                                'project_id' => set_value('project'),
                                );

            // run insert model to write data to db

            if ($this->task_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
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
        $items = $this->task_model->getAllWithProjects();
        $this->load->view('_tasksList', array('items' => $items));
    }

}
?>
