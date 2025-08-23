    <?php
        class Service_model extends CI_Model {
            public function save($data){
                return $this->db->insert("services",$data);
            }

            public function update($id, $data){
                $this->db->where('id', $id);
                return $this->db->update("services", $data);
            }

            public function delete($id) {
                $service = $this->db->where('id', $id)->get('services')->row();
                if(!$service){ return false; }

                // 1. Featured image delete
                if(!empty($service->featured_image) && file_exists(FCPATH."uploads/services/".$service->featured_image)){
                    unlink(FCPATH."uploads/services/".$service->featured_image);
                }

                // 2. Banner image delete
                if(!empty($service->banner_image) && file_exists(FCPATH."uploads/services/".$service->banner_image)){
                    unlink(FCPATH."uploads/services/".$service->banner_image);
                }

                // 3. Summernote description images delete
                if(!empty($service->description)){
                    preg_match_all('/<img[^>]+src="([^">]+)"/i', $service->description, $matches);
                    if(!empty($matches[1])){
                        foreach($matches[1] as $imgUrl){
                            // Remove base_url() and convert to real path
                            $path = str_replace(base_url(), FCPATH, $imgUrl);
                            
                            if(strpos($path, FCPATH.'uploads/summernote/') === 0){
                                if(file_exists($path)){
                                    unlink($path);
                                }
                            }
                        }
                    }
                }

                // 4. Delete database row
                return $this->db->where('id', $id)->delete('services');
            }


            public function getData($filters=[]){
                if(!empty($filters['id'])){
                    $this->db->where('id',$filters['id']);
                }
                if(!empty($filters['category_id'])){
                    $this->db->where('category_id',$filters['category_id']);
                }
                if(!empty($filters['link'])){
                    $this->db->where('link',$filters['link']);
                }
                if(!empty($filters['home_page'])){
                    $this->db->where('home_page',$filters['home_page']);
                }
                return $this->db->get("services")->result();
            }

            public function getById($id){
                return $this->db->get_where('services', ['id' => $id])->row();
            }

            public function getServiceCategory($filters=[]){
                if(!empty($filters['id'])){
                    $this->db->where('id',$filters['id']);
                }
                return $this->db->get("service_category")->result();
            }



        }
    ?>