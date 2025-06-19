<?php
class Service extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data = [
            "Status" => 200,
            "Msg"    => "Service Api"
        ];
        echo json_encode($data);
    }
    public function add(){

        if($this->input->method()=='post'){
            http_response_code(200);
            $this->load->helper('Format');
            $this->load->model('Service_model');

            // $data = json_decode(file_get_contents('php://input'),true);

             // ===== Validation Rules =====
            $this->form_validation->set_rules('cat_id', 'Category', 'required|integer');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[3]');
            $this->form_validation->set_rules('sub_title', 'Sub Title', 'trim');
            $this->form_validation->set_rules('featured_image', 'Featured Image', 'trim');
            $this->form_validation->set_rules('banner_image', 'Banner Image', 'trim');
            $this->form_validation->set_rules('banner_video', 'Banner Video', 'trim');
            $this->form_validation->set_rules('description', 'Description', 'required|trim');
            $this->form_validation->set_rules('home_page', 'Home Page', 'integer');
            $this->form_validation->set_rules('position', 'Position', 'integer');
            $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim');
            $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'trim');
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim');
            $this->form_validation->set_rules('created_by', 'Created By', 'required|integer');

             if ($this->form_validation->run() == FALSE) {
                // $this->load->view('post_form');
                // echo json_encode(["status"=>400,"msg"=>form_error('cat_id')]);
                echo json_encode(["status"=>400,"msg"=>"Form Validation Error!"]);
                return;
            }

            $cat_id = $this->input->post('cat_id');
            $title = $this->input->post('title');
            $sub_title = $this->input->post('sub_title');
            $featured_image = $this->input->post('featured_image');
            $banner_image = $this->input->post('banner_image');
            $banner_video = $this->input->post('banner_video');
            $description = $this->input->post('description');
            $home_page = $this->input->post('home_page');
            $position = $this->input->post('position');
            $meta_description = $this->input->post('meta_description');
            $meta_keyword = $this->input->post('meta_keyword');
            $meta_title = $this->input->post('meta_title');
            $created_by = $this->input->post('created_by');

            $link = createServiceLink($title)? createServiceLink($title):'Error';

            $data = [
                'category_id' => $cat_id,
                'title' => $title,
                'sub_title' => $sub_title,
                'featured_image' => $featured_image,
                'banner_image' => $banner_image,
                'banner_video' => $banner_video,
                'description' => $description,
                'home_page' => $home_page,
                'position' => $position,
                'link' => $link,
                'meta_description' => $meta_description,
                'meta_keyword' => $meta_keyword,
                'meta_title' => $meta_title,
                'created_by' => $created_by
            ];

            $saved_data = $this->Service_model->save($data);
            echo json_encode($saved_data);
            return;
        }else{
            http_response_code(403);
            echo json_encode(["status"=>403,"msg"=>"Cannot Access This Route"]);
            return;
        }
    }


    public function get(){
        $this->load->model('Service_model');
        $data['services'] = $this->Service_model->getData(['id'=>3]);
        if(!$data['services']) echo json_encode(["status"=>"404","msg"=>"No Data Found!"]);
        echo json_encode($data['services']);
    }












}
?>