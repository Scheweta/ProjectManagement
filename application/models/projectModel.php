<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class projectModel extends CI_Model{
   
// Count all tasks of table "task" in database for a particular user.
        public function record_count($id) {
            $query=$this->db->query("SELECT * from task where Task_id in (SELECT Task_id from member_task where member_id = $id)");
            return $query->num_rows();
        }

// Fetch data according to per_page limit.
        public function fetch_data($limit, $id,$offset) {
            $query=$this->db->query("SELECT * from task where Task_id in (SELECT Task_id from member_task where member_id = $id) limit $limit offset $offset");
            if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                    $data[] = $row;
                     }
                return $data;
                }
            return false;
        }
   
    
//Fetch all the members from the table "projectmember" in database.
       public function getMemberName(){
            $query=$this->db->query('SELECT * from projectmember');
            foreach ($query->result() as $row) {
               $data[] = $row; 
             }
            return $data;
        }
    
    
    
//Fetch the details of a particular member.   
      public function getMemberDetails($id){
           $this->load->database();
           $query=$this->db->query("SELECT * from projectmember where member_id = $id");
           foreach ($query->result() as $row) {
                      	$data[] = $row; 
           }
           return $data;
         }
    
}