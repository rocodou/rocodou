<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Car_activity_model extends MY_Model
{

    public $table = 'car_activity';


    function __construct()
    {
        parent::__construct();
    }

    function add($message, $user_id = 0, $ip_address = false)
    {
        return $this->create([
            'title' => $message,
            'user' => ($user_id == 0) ? logged('id') : $user_id,
            'ip_address' => !empty($ip_address) ? $ip_address : ip_address()
        ]);
    }

    function list()
    {
        /* $query = $this->db->query("SELECT MAX(car_activity.id),
                                       car_activity.car_id AS cacid,
                                       car_activity.car_who_took,
                                       crm_own_cars.car_brand,
                                       crm_own_cars.car_model,
                                       car_activity.car_deliver_km,
                                       car_activity.car_take_km,
                                       car_activity.car_deliver_time,
                                       car_activity.car_take_time,
                                       car_activity.car_damage,
                                       car_activity.created_time,
                                       car_activity.update_time,
                                       car_activity.update_user,
                                       car_activity.create_user,
                                       car_activity.delete_user,
                                       crm_own_cars.car_plate,


                                       car_activity.delete_time
                                     FROM car_activity
                                       INNER JOIN crm_own_cars
                                         ON car_activity.car_id = crm_own_cars.id
                                     GROUP BY car_activity.car_id");
        */
        $query = $this->db->query("SELECT *FROM crm_own_cars");


        return $query;
    }

    function addCarActivity()
    {
        ifPermissions('car_manage_operation');

        postAllowed();

        $data = [
            'last_km' => post('car_deliver_km'),
            'car_take_date' => post('car_take_date'),
            'name' => post('name'),

        ];


    }

    public function updateCarActivity($id, $data = NULL)
    {
        $this->db->where('id', $id);
        $this->db->update('car_activity', $data);

    }

    public function insertCarActivity($data = null)
    {
        $this->db->insert('car_activity', $data);
        $aid = $this->db->insert_id();

        return $aid;
    }

    public function insertCarOwn($data = null)
    {
        $this->db->insert('crm_own_cars', $data);
    }

    public function updateCarOwn($id, $data = null)
    {

        $this->db->where('id', $id);
        $this->db->update('crm_own_cars', $data);

    }

    function getCarList()
    {
        $query = $this->db->query("SELECT *FROM crm_own_cars");
        return $query;
    }

    function getCarInfo($id)
    {
        $query = $this->db->where($id);
        $query = $this->db->get('crm_own_cars');

        foreach ($query->result() as $row) {
        }
        return $row;
    }

}

/* End of file Activity_model.php */
/* Location: ./application/models/Activity_model.php */