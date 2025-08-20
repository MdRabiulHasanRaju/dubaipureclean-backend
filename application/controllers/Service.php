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


    public function getSingleService($id){
        $this->load->model('Service_model');
        $data['services'] = $this->Service_model->getData(['id'=>$id]);
        if(!$data['services']) echo json_encode(["status"=>"404","msg"=>"No Data Found!"]);
        echo json_encode($data['services']);
    }

    public function getAllService(){
        $this->load->model('Service_model');
        $data['services'] = $this->Service_model->getData();
        if(!$data['services']) echo json_encode(["status"=>"404","msg"=>"No Data Found!"]);
        echo json_encode($data['services']);
    }












}
?>