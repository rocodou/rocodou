<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Hesaplar extends MY_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        ifPermissions('muhasebe_raporlar');

        $this->page_data['page']->title = 'Genel Raporlar';
        $this->page_data['page']->menu = 'raporlar';
        $this->load->view('hesaplar/raporlar', $this->page_data);


    }

    function raporlar()
    {
        ifPermissions('muhasebe_raporlar');

        $this->page_data['page']->title = 'Genel Raporlar';
        $this->page_data['page']->menu = 'raporlar';
        $this->load->view('hesaplar/raporlar', $this->page_data);

    }

    function rapor_ayrinti()
    {
        ifPermissions('muhasebe_raporlar');

        $this->page_data['page']->title = 'CH Ayrıntıları';
        $this->page_data['page']->menu = 'raporlar';
        $this->load->view('hesaplar/rapor_ayrinti', $this->page_data);

    }

    function not_ekle()
    {
        ifPermissions('muhasebe_raporlar');

        $this->page_data['page']->title = 'Not Ekleme';
        $this->page_data['page']->menu = 'raporlar';
        $this->load->view('hesaplar/not_ekle_view', $this->page_data);

    }

    function musteri_bilgi_guncelleme()
    {
        ifPermissions('muhasebe_raporlar');

        $this->page_data['page']->title = 'Müşteri Bilgi Güncelleme';
        $this->page_data['page']->menu = 'musteri_bilgi_guncelleme';
        $this->load->view('hesaplar/musteri_bilgi_guncelleme', $this->page_data);

    }

    function arama_ekle()
    {
        ifPermissions('muhasebe_raporlar');
        $this->page_data['page']->title = 'Aramalar Tahsilat Ekranı';
        $this->page_data['page']->menu = 'aramalar_tahsilat';
        $this->load->view('hesaplar/aramalar_create', $this->page_data);

    }
}