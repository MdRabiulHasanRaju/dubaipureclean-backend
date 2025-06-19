<?php
    class Service_model extends CI_Model {
        public function save($data){
            return $this->db->insert("services",$data);
        }

        public function getData($filters=[]){
            if(!empty($filters['id'])){
                $this->db->where('id',$filters['id']);
            }
            return $this->db->get("services")->result();
        }



    }
?>