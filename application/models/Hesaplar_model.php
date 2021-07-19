<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hesaplar_model extends MY_Model
{
    private $otherdb;
    public $get_source_db;
    public $gethesapkod;
    public $getHesapKodArr;
    public $loggedUserID;
    public $customer_name;
    public $customer_address;
    public $customer_phone;
    public $customer_mail;
    public $customer_mobile;


    function __construct()
    {
        $this->otherdb = $this->load->database('od1', TRUE);
        $this->getURLString(); //
        $this->loggedUserID = logged('id');
        //$this->gethesapkod=$this->input->get('hesapkod', TRUE);

    }

    function getSelectedReportsInformation()
    {

        $query = $this->db->query("SELECT crm_account_code.account_code, crm_account_code.account_name FROM crm_account_code WHERE account_code = '$this->gethesapkod'");
        foreach ($query->result() as $row) {
        }
        return $row;
    }

    function getCustomerInformation()
    {
        $query = $this->otherdb->query("SELECT * FROM FINSAT6B1.FINSAT6B1.CHK WHERE HesapKodu = '$this->gethesapkod'");
        foreach ($query->result() as $row) {
        }
        return $row;
    }


    function getSetOptionValue()
    {
        $query = $this->db->query("SELECT crm_account_code.account_code, crm_account_code.account_name 
        FROM crm_account_code, users 
        WHERE users.id=$this->loggedUserID
        AND   FIND_IN_SET(crm_account_code.account_code, users.account_code)");
        foreach ($query->result_array() as $row) {
            $data[$row['account_name']] = $row['account_code'];// çok önemli kısımdır

        }
        return $data;
    }

//$this->get_source_db = "MUHASEBE6B1";
    function getURLString()
    {
        $hesapkod = $this->input->get('hesapkod', TRUE);
        $dbsource = $this->input->get('source', TRUE);
        if (empty($hesapkod) && empty($dbsource)) { //DEFAULT
            $this->getAccountCodetoArray();
            $this->get_source_db = $this->config->item('defaultDB');
        }
        if (isset($hesapkod) && empty($dbsource)) {
            $this->getAccountCodetoArray();
            $this->get_source_db = $this->config->item('defaultDB');
        } elseif (isset($hesapkod) && isset($dbsource)) {
            $this->gethesapkod = $hesapkod;
            $this->get_source_db = $dbsource;


        }

    }

    function getAccountCodetoArray()
    {
        $str = logged('account_code');

        if (strpos($str, ",")) {
            $arr = explode(',', $str);
            $this->getHesapKodArr = $arr; //getHesapKodArr Arrayı Yükler Drop Down için
            if (empty($this->input->get('hesapkod'))) {
                $this->gethesapkod = reset($arr);

            } else {
                $this->gethesapkod = $this->input->get('hesapkod');
            }// arrayın ilk elementini alır ve gethesapkod a yükler
        } else {
            $this->gethesapkod = $str; // Eğer tek hesap kod ise buraya yükler


        }


    }

    function checkHesapKodArr()
    {
        return is_array($this->getHesapKodArr);
    }


    function getStaticVars($key = NULL)
    {
        $account_year = array(
            '2012' => 'O4',
            '2013' => 'O5',
            '2014' => 'C9',
            '2015' => '8E',
            '2016' => '0D',
            '2017' => '7S',
            '2018' => '8U',
            '2019' => 'U8',
            '2020' => 'B9',
            '2021' => 'B1'
        );


    }

    function get_static_option($option)
    {


        $query = $this->db->query("SELECT * FROM crm.users WHERE id='1'");
        return $query;


    }


    function getAccountCodeUser()
    {
        $this->db->select('account_code', 'account_name');
        $this->db->get('crm_account_code');
        $this->db->where_in('account_code', explode(',', logged('account_code')));


    }

    function getListAccount()
    {
        //$this->db->query("SELECT account_code, account_name FROM crm_account_code");
        $this->db->select("account_code,account_name");
        $query = $this->db->get('crm_account_code');

        foreach ($query->result_array() as $row) {
            $data[$row['account_code']] = $row['account_name'];// çok önemli kısımdır

        }
        return $data;

    }

    function get_customers_balance_list()
    {
        $query = $this->otherdb->query("SELECT MHI.HesapKod, MHK.HesapAd,
          SUM (CASE WHEN BA ='1'THEN Tutar ELSE 0 END) as Alacak,
          SUM (CASE WHEN BA ='0'THEN Tutar ELSE 0 END) as Verecek,
          SUM (CASE WHEN BA ='0'THEN Tutar ELSE 0 END) - SUM (CASE WHEN BA ='1'THEN Tutar ELSE 0 END) as Toplam
          FROM " . $this->get_source_db . "." . $this->get_source_db . ".MHI MHI, " . $this->get_source_db . "." . $this->get_source_db . ".MHK MHK
          WHERE MHI.HesapKod = MHK.HesapKod AND ((MHI.HesapKod Like '" . $this->gethesapkod . "%'))
          GROUP BY MHI.HesapKod, MHK.HesapAd HAVING (SUM (CASE WHEN BA ='0'THEN Tutar ELSE 0 END) - SUM (CASE WHEN BA ='1'THEN Tutar ELSE 0 END) >1) ORDER BY MHK.HesapAd;
          (SELECT SUM(Tutar) as GenelAlacak FROM " . $this->get_source_db . "." . $this->get_source_db . ".MHI MHI WHERE ((MHI.HesapKod Like '" . $this->gethesapkod . "%')) AND MHI.BA ='1')
          (SELECT SUM(Tutar) as GenelVerecek FROM " . $this->get_source_db . "." . $this->get_source_db . ".MHI MHI WHERE ((MHI.HesapKod Like '" . $this->gethesapkod . "%')) AND MHI.BA ='0')");

        return $query;
    }

    function get_account_details()
    {
        $query = $this->otherdb->query("SELECT MHI.HesapKod, MHK.HesapAd,  MHI.Kod1 AS 'İş Emri',MHI.Aciklama, CASE WHEN BA ='1' THEN Tutar ELSE 0 END as borc, CASE WHEN BA ='0'THEN Tutar ELSE 0 END as alacak, convert(datetime, MHI.Tarih,103) as Tarih
        FROM " . $this->get_source_db . "." . $this->get_source_db . ".MHI MHI, " . $this->get_source_db . "." . $this->get_source_db . ".MHK MHK
        WHERE MHI.HesapKod = MHK.HesapKod AND MHI.HesapKod ='" . $this->gethesapkod . "' ORDER BY MHI.Tarih");

        return $query;
    }

    function getCallRecords()
    {
        $query = $this->db->query("SELECT * FROM crm_calls where account_code = '$this->gethesapkod'");

        return $query;
    }


}



