<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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


    public function getSingleService($link){
        header('Access-Control-Allow-Origin: http://localhost:5173'); 
        header('Access-Control-Allow-Methods: GET'); 
        header('Access-Control-Allow-Headers: Content-Type, Authorization'); 
        $this->load->model('Service_model');
        $data['services'] = $this->Service_model->getData(['link'=>$link]);
        foreach($data as $services){
            foreach ($services as $service) {
                $cat_id = $service->category_id;
                $category_name = $this->Service_model->getServiceCategory(["id"=>$cat_id]);
                foreach($category_name as $cat_name){
                    $service->category_name = $cat_name->name;
                }
            }
            echo json_encode($services);
        }
        if(!$data['services']) echo json_encode(["status"=>"404","msg"=>"No Data Found!"]);
        // echo json_encode($data['services']);
    }

    public function getAllService(){
        header('Access-Control-Allow-Origin: http://localhost:5173'); 
        header('Access-Control-Allow-Methods: GET'); 
        header('Access-Control-Allow-Headers: Content-Type, Authorization'); 
        $this->load->model('Service_model');
        $data['services'] = $this->Service_model->getData();
        foreach($data as $services){
            foreach ($services as $service) {
                $cat_id = $service->category_id;
                $category_name = $this->Service_model->getServiceCategory(["id"=>$cat_id]);
                foreach($category_name as $cat_name){
                    $service->category_name = $cat_name->name;
                }
            }
            echo json_encode($services);
        }
        
        if(!$data['services']) echo json_encode(["status"=>"404","msg"=>"No Data Found!"]);
        // echo json_encode($data['services']);
    }

    public function getServiceCategory(){
        header('Access-Control-Allow-Origin: http://localhost:5173'); 
        header('Access-Control-Allow-Methods: GET'); 
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        $this->load->model('Service_model');
        $data['categories'] = $this->Service_model->getServiceCategory();
        echo json_encode($data['categories']);
    }

    public function servicesByCategory($catId){
        header('Access-Control-Allow-Origin: http://localhost:5173'); 
        header('Access-Control-Allow-Methods: GET'); 
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        $this->load->model('Service_model');
        $data['services'] = $this->Service_model->getData(['category_id'=>$catId]);
        echo json_encode($data['services']);
    }

    public function servicesForHomePage($home_page){
        header('Access-Control-Allow-Origin: http://localhost:5173'); 
        header('Access-Control-Allow-Methods: GET'); 
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        $this->load->model('Service_model');
        $data['services'] = $this->Service_model->getData(['home_page'=>$home_page]);
        echo json_encode($data['services']);
    }












}
?>