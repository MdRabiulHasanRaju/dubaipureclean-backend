<?php
class Service_admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('admin/auth_admin/login');
        }
        $this->load->model('Service_model');
    }

    public function index(){
        $this->load->view('admin/index');
    }

    public function services($catId){
        $data['services'] = $this->Service_model->getData(['category_id'=>$catId]);
        $this->load->view('admin/pages/services/services', $data);
    }

    public function add()
{
    $this->load->helper(['Format', 'url']);
    $this->load->model('Service_model');

    if ($this->input->method() == 'post') {
        http_response_code(200);

        // ===== Validation Rules =====
        $this->form_validation->set_rules('cat_id', 'Category', 'required|integer');
        $this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('sub_title', 'Sub Title', 'trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('home_page', 'Home Page', 'integer');
        $this->form_validation->set_rules('position', 'Position', 'integer');
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim');
        $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'trim');
        $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim');
        // $this->form_validation->set_rules('created_by', 'Created By', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(["status" => 400, "msg" => "Form Validation Error!"]);
            return;
        }

        $cat_id = $this->input->post('cat_id');
        $title = $this->input->post('title');
        $sub_title = $this->input->post('sub_title');
        $description = $this->input->post('description',false);
        $home_page = $this->input->post('home_page');
        $position = $this->input->post('position');
        $meta_description = $this->input->post('meta_description');
        $meta_keyword = $this->input->post('meta_keyword');
        $meta_title = $this->input->post('meta_title');
        $created_by = $this->session->userdata('user_id');
        $banner_video = $this->input->post('banner_video');

        // ===== Handle Featured Image Upload =====
        $featured_image = '';
        if (!empty($_FILES['featured_image_file']['name'])) {
            $config['upload_path'] = './uploads/services/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp|avif';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_featured_' . $_FILES['featured_image_file']['name'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('featured_image_file')) {
                $upload_data = $this->upload->data();
                $featured_image = $upload_data['file_name'];
            } else {
                echo json_encode(["status" => 400, "msg" => $this->upload->display_errors()]);
                return;
            }
        } else {
            $featured_image = $this->input->post('featured_image'); // if text URL is provided
        }

        // ===== Handle Banner Image Upload =====
        $banner_image = '';
        if (!empty($_FILES['banner_image_file']['name'])) {
            $config['upload_path'] = './uploads/services/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp|avif';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_banner_' . $_FILES['banner_image_file']['name'];
            $this->upload->initialize($config);
            if ($this->upload->do_upload('banner_image_file')) {
                $upload_data = $this->upload->data();
                $banner_image = $upload_data['file_name'];
            } else {
                echo json_encode(["status" => 400, "msg" => $this->upload->display_errors()]);
                return;
            }
        } else {
            $banner_image = $this->input->post('banner_image'); // if text URL is provided
        }

        // ===== Create service link =====
        $link = strtolower(createServiceLink($title)) ?: 'error';

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

        if ($saved_data) {
            echo json_encode(["status" => 200, "msg" => "Service Added Successfully!"]);
        } else {
            echo json_encode(["status" => 400, "msg" => "Failed to save service."]);
        }

    } else {
        $data['categories'] = $this->Service_model->getServiceCategory();
        $this->load->view("admin/pages/services/add", $data);
    }
}




 // Summernote image upload
    public function summernote_image() {
        header('Content-Type: application/json');

        if(isset($_FILES['file']) && $_FILES['file']['name'] != '') {

            $config['upload_path']   = './uploads/summernote/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp|avif';
            $config['max_size']      = 5120; // 2MB

            if(!is_dir($config['upload_path'])){
                mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);

            if($this->upload->do_upload('file')) {
                $data = $this->upload->data();
                $file_url = base_url('uploads/summernote/'.$data['file_name']);
                echo json_encode(['url' => $file_url]);
            } else {
                echo json_encode(['error' => $this->upload->display_errors()]);
            }

        } else {
            echo json_encode(['error' => 'No file uploaded.']);
        }
    }

    // Delete image from Summernote
    public function summernote_image_delete(){
        $src = $this->input->post('src');
        if($src){
            $file = str_replace(base_url(), FCPATH, $src);
            if(file_exists($file)){
                unlink($file);
                echo "Image deleted successfully";
            } else {
                echo "File not found";
            }
        }
    }





    public function edit($id)
    {
        $data['service'] = $this->Service_model->getById($id);
        $data['categories'] = $this->Service_model->getServiceCategory();

        if(!$data['service']){
            show_404();
        }

        $this->load->view('admin/pages/services/edit', $data);
    }


    

public function update($id)
{
    $this->load->library('form_validation');
    $this->load->helper(['file', 'url']);

    $this->form_validation->set_rules('title','Title','required|min_length[3]');
    $this->form_validation->set_rules('cat_id','Category','required');

    if($this->form_validation->run() == FALSE){
        echo json_encode(['status'=>400,'msg'=>validation_errors()]);
        return;
    }

    $this->load->model('Service_model');

    $service = $this->Service_model->getById($id);
    if(!$service){
        echo json_encode(['status'=>400,'msg'=>'Service not found!']);
        return;
    }

    // ===== Preserve old data if new data not provided =====
    $featured_image = $service->featured_image;
    if(!empty($_FILES['featured_image_file']['name'])){
        $config['upload_path']   = './uploads/services/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp|avif';
        $config['max_size']      = 2048;
        $config['file_name']     = time().'_featured_'.$_FILES['featured_image_file']['name'];
        $this->load->library('upload', $config);
        if($this->upload->do_upload('featured_image_file')){
            $upload_data = $this->upload->data();
            $featured_image = $upload_data['file_name'];
            // delete old image
            if(!empty($service->featured_image) && file_exists('./uploads/services/'.$service->featured_image)){
                unlink('./uploads/services/'.$service->featured_image);
            }
        }
    } elseif($this->input->post('featured_image') != ''){
        $featured_image = $this->input->post('featured_image'); // text URL
    }

    $banner_image = $service->banner_image;
    if(!empty($_FILES['banner_image_file']['name'])){
        $config['upload_path']   = './uploads/services/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp|avif';
        $config['max_size']      = 2048;
        $config['file_name']     = time().'_banner_'.$_FILES['banner_image_file']['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('banner_image_file')){
            $upload_data = $this->upload->data();
            $banner_image = $upload_data['file_name'];
            // delete old image
            if(!empty($service->banner_image) && file_exists('./uploads/services/'.$service->banner_image)){
                unlink('./uploads/services/'.$service->banner_image);
            }
        }
    } 
    elseif($this->input->post('banner_image') != ''){
        $banner_image = $this->input->post('banner_image'); // text URL
    }

    // Preserve other optional fields if empty
    $update_data = [
        'category_id'      => $this->input->post('cat_id') ?: $service->category_id,
        'title'            => $this->input->post('title') ?: $service->title,
        'sub_title'        => $this->input->post('sub_title') ?: $service->sub_title,
        'featured_image'   => $featured_image,
        'banner_image'     => $banner_image,
        'banner_video'     => $this->input->post('banner_video') ?: $service->banner_video,
        'description'      => $this->input->post('description', false) ?: $service->description,
        'home_page'        => $this->input->post('home_page') !== null ? $this->input->post('home_page') : $service->home_page,
        'position'         => $this->input->post('position') ?: $service->position,
        'meta_description' => $this->input->post('meta_description') ?: $service->meta_description,
        'meta_keyword'     => $this->input->post('meta_keyword') ?: $service->meta_keyword,
        'meta_title'       => $this->input->post('meta_title') ?: $service->meta_title,
    ];

    $this->Service_model->update($id, $update_data);

    echo json_encode(['status'=>200,'msg'=>'Service Updated Successfully!']);
}




public function delete($id){
    if($this->Service_model->delete($id)){
        $this->session->set_flashdata('success', 'Service Deleted Successfully!');
    } else {
        $this->session->set_flashdata('error', 'Service Not Found!');
    }

    redirect($_SERVER['HTTP_REFERER']);
}






}
?>