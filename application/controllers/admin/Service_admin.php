<?php
class Service_admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Service_model');
    }

    public function index(){
        $this->load->view('admin/index');
    }
    public function services($catId){
        $data['services'] = $this->Service_model->getData(['category_id'=>$catId]);
        $this->load->view('admin/pages/services/services', $data);
    }
}
?>