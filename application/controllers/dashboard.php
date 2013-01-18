<?php

class Dashboard extends MY_Controller {
    
    public function index() {                
        $this->data['startDate'] = date_create();
        if($this->data['startDate']->format('l') != 'Monday') {
            $this->data['startDate']->modify('last monday');
        }        
        
        $this->data['endDate'] = date_create();
        if($this->data['endDate']->format('l') != 'Sunday') {
            $this->data['endDate']->modify('next sunday')->modify('next sunday');
        }        
        else {
            $this->data['endDate']->modify('next sunday');
        }
                
        $this->data['projects'] = $this->project_model->get_all();
        
        $this->load->view('dashboard', $this->data);
    }    
    
    public function getDays() {
        $days = $this->_getDaysBetweenTwoDates( $this->input->post('startDate'),  $this->input->post('endDate'));
        
        foreach($days as $day) {
            //@TODO load tasks for that day
            $this->data['tasks'] = $this->task_model->getWithProjectsOnDate($day['date']->format('Y-m-d'));       
            $this->data['day'] = $day;
            
            //var_dump($tasks); 
            
            $this->load->view('_dayBlock', $this->data);
        }
    }    
    
    /**
     * get the dates between two days
     * @param string $startDate in format Y-m-d
     * @param string $endDate in format Y-m-d
     * @return array
     * 
     */
    private function _getDaysBetweenTwoDates($startDate, $endDate) {
        $start = date_create_from_format('Y-m-d H:i:s', $startDate.' 00:00:00');
        $end = date_create_from_format('Y-m-d H:i:s', $endDate.' 00:00:00');        
        $days = array(
            array('date' => $start)
        );
        $diff = date_diff($start, $end)->days;
        
        $i = 0;
        while($diff > 0) {
            $nextDay = clone $days[$i]['date'];
            $nextDay->modify('tomorrow');
            
            $days[] = array();
            $i++;
            $days[$i] = array('date' => $nextDay);
            $diff = date_diff($nextDay, $end)->days;
        }
        return $days;        
    }
    
    
}
?>