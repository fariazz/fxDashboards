<?php

class Dashboard extends MY_Controller {
    
    public function index() {                                
        $this->load->view('dashboard', $this->data);
    }    
    
    public function getDays() {
        $days = $this->_getDaysBetweenTwoDates( $this->input->post('startDate'),  $this->input->post('endDate'));
        
        foreach($days as $day) {
            //@TODO load tasks for that day
            $tasks = array();
            
            $this->load->view('_dayBlock', array('day' => $day, 'tasks' => $tasks));
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