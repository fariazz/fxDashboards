<?php
class Lead_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    /*
     * insert an entry
     * 
     * @param array $entry
     */
    public function insertEntry($entry) {
        
        //secure data
        $entry = array_map('htmlspecialchars', $entry);                
        $this->db->insert('lead', $entry);
     }
}