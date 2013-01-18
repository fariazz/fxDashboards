<?php
class Task_model extends MY_Model {
    
    public $belongs_to = array('project');
    
     /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */
	function SaveForm($form_data)
	{
		$this->db->insert('tasks', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
        
        /**
         * get all with related models
         */
        function getAllWithProjects()
        {
            $this->db->select('*');
            $this->db->from('tasks');
            $this->db->join('projects', 'tasks.project_id = projects.id');
            return $this->db->get()->result_array();
        }
        
        /**
         * get all with related models
         */
        function getWithProjectsOnDate($date)
        {
            $this->db->select('*');
            $this->db->from('tasks');
            $this->db->join('projects', 'tasks.project_id = projects.id');
            $this->db->where('tasks.due_date', $date);
            return $this->db->get()->result_array();
        }
}