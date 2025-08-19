<?php
    class Service_model extends CI_Model {
        public function save($data){
            return $this->db->insert("services",$data);
        }

        public function getData($filters=[]){
            if(!empty($filters['id'])){
                $this->db->where('id',$filters['id']);
            }
            if(!empty($filters['category_id'])){
                $this->db->where('category_id',$filters['category_id']);
            }
            return $this->db->get("services")->result();
        }

        public function getServiceCategory(){
            return $this->db->get("service_category")->result();
        }



    }
?>