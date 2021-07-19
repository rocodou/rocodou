<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Car extends MY_Controller
{
    public $last_id;


//todo kilometre karşılaştırması


    public function __construct()
    {
        parent::__construct();
        $this->page_data['page']->title = 'Araç Yönetimi';
        $this->page_data['page']->menu = 'arac-yonetimi';
    }

    public function index()
    {

    }

    public function save()
    {

    }

    public function list()
    {

        ifPermissions('car_manage_list');


        $this->page_data['page']->submenu = 'list';
        $this->load->view('car/car_list', $this->page_data);

        $this->save_data();


    }

    public function save_data()
    {
        $type = post('formtype'); //form tipinin type değişkenine yüklenmesi

        if ($type === 'teslimet') {
            $data = [
                'car_id' => post('carid'),
                'car_who_took' => post('car_who_took'),
                'car_take_km' => post('car_take_km'),
                'car_last_km' => post('car_last_km'),
                'car_take_date' => post('car_take_date'), //TODO bu alan mysql FORMATINA ÇEVİRİLECEK
                'car_take_time' => post('car_take_time'),// TODO Bu ALAN MYSQL FORMATINA ÇEVİRİLECEK
                'car_note' => post('car_note'),
                'car_parked' => '0',
            ];
            $this->last_id = $this->carInsertToActivity($data);
            $this->carUpdateToMainTake($data);


        } elseif ($type === "teslimal") {
            $data = [
                'car_id' => post('carid'),
                'car_last_activity_id' => post('car_last_activity_id'),
                'car_deliver_km' => post('car_deliver_km'),
                'car_deliver_date' => post('car_deliver_date'),
                'car_deliver_time' => post('car_deliver_time'),
                'car_damage' => post('car_damage'),
                'car_parked' => '1',
            ];
            $query = $this->carUpdateToActivity($data);
            $this->carUpdateToMainDeliver($data);


        }

        return $query;

    }


    public function carInsertToActivity($data = NULL)  //car_activity veritabanına ekleme yapan fonksiyon
    {
        $insertToActivityData = [
            'car_id' => $data['car_id'],
            'car_who_took' => $data['car_who_took'],
            'car_take_km' => $data['car_last_km'],
            'create_user' => logged('id'),
            'car_take_time' => date('Y-m-d H:i:s'),// TODO Bu alan DEFAULT idir lütfen Değiş
            'created_time' => date('Y-m-d H:i:s'),
            'note' => $data['car_note'],
        ];
        $query = $this->car_activity_model->insertCarActivity($insertToActivityData);


        return $query;


    }

    public function carUpdateToActivity($data = NULL)
    {
        $activityUpdateData = [
            'car_deliver_km' => $data['car_deliver_km'],
            'car_deliver_time' => date('Y-m-d H:i:s'),
            'car_damage' => $data['car_damage'],
            'update_time' => date('Y-m-d H:i:s'),
            'update_user' => logged('id'),
        ];


        $this->car_activity_model->updateCarActivity($data['car_last_activity_id'], $activityUpdateData);
    }

    public function carUpdateToMainDeliver($data = NULL)
    {

        $update = [

            'car_last_km' => $data['car_deliver_km'],
            'car_last_activity_id' => null,
            'car_parked' => '1',
            'car_who_took' => '-',

        ];

        $id = $data['car_id'];


        $this->car_activity_model->updateCarOwn($id, $update);


        $this->session->set_flashdata('alert-type', 'Başarılı');
        $this->session->set_flashdata('alert', 'Araç Teslim Alma Başarılı');

        redirect('car/list');


    }

    public function carUpdateToMainTake($data = NULL)
    {
        $update = [
            'car_parked' => '0',
            'car_who_took' => $data['car_who_took'],
            'car_last_activity_id' => $this->last_id,
        ];
        $id = $data['car_id'];


        $a = $this->car_activity_model->updateCarOwn($id, $update);


        $this->session->set_flashdata('alert-type', 'Başarılı');
        $this->session->set_flashdata('alert', 'Araç Teslim etme Başarılı');

        redirect('car/list');

    }

    public function operations()
    {
        ifPermissions('car_manage_list');
        $this->page_data['page']->submenu = 'list';
        $this->load->view('car/car_list', $this->page_data);
    }


}


?>