<?php

class Calculate extends CI_Model
{

    var $alis;
    var $satis;
    var $otv = 0;
    var $kdv = 0;
    var $kam_tut;
    var $kam_yuz;
    var $plaka;
    var $bag_tutar;
    //
    var $fatura_matrahi;
    var $maliyet_son;
    var $otv_son;
    var $kdv_son;
    var $net_kar;
    var $maliyet;
    var $indirim_tutari;
    var $fatura_tutari;
    var $hesaplanacak_tutar;
    var $indirim_tutar;
    var $indirim_yuzde;
    // spanned vars
    var $net_kar_span;
    var $kar_zarar_div;


    public function __construct()
    {
        $this->alis = money_f($this->input->post('alis_fiyati'), 1);
        $this->satis = money_f($this->input->post('liste_satis_fiyati'), 1);
        $this->otv = $this->input->post('otv_tutari');
        $this->kdv = $this->input->post('kdv_tutari');
        $this->kam_tut = money_f($this->input->post('kampanya_indirimi_tutar'), 1);
        $this->kam_yuz = $this->input->post('kampanya_indirimi_yuzde');
        $this->plaka = money_f($this->input->post('plaka_masrafi'), 1);
        $this->bag_tutar = money_f($this->input->post('baglanti_tutari'), 1);
        //load function
        $this->sub_total();
        $this->carcal2();                                                                        //call carcal function
        $this->karzarar();                                                                       // Text notify

    }

    public function carcal2()
    {
        $this->otv_son = $this->hesaplanacak_tutar * ($this->otv / 100);
        $this->kdv_son = ($this->hesaplanacak_tutar + $this->otv_son) * ($this->kdv / 100);
        $this->fatura_tutari = $this->hesaplanacak_tutar + $this->kdv_son + $this->otv_son;
        $this->maliyet = $this->kdv_son + $this->otv_son + $this->alis + $this->plaka;
        $this->discount();                                                                    // Apply Discount Function
        $this->net_kar = $this->bag_tutar - $this->maliyet;

    }

    public function discount()
    {
        if (!empty($this->kam_tut) or !empty($this->kam_yuz)) {
            $discount = NULL;
            if (!empty($this->kam_tut)) {
                $discount = $this->kam_tut;
            } elseif (!empty($this->kam_yuz)) {
                $discount = ($this->maliyet) / (1 / ($this->kam_yuz / 100));
            }
            $this->maliyet = $this->maliyet - $discount;
            return $this->indirim_tutari = $discount;
        }

    }


    public function cal_result($var = null)
    {  //calculating result
        $data = $this->$var;   //call dynamicly varable
        $last = (money_f($data)); //converting money format function

        return $last;   //return converted
    }

    public function cal_result_span($var = null)
    {  //calculating result
        $data = $this->$var;   //call dynamicly varable

        return $data;   //return converted
    }

    public function sub_total()
    {
        $this->hesaplanacak_tutar = ($this->bag_tutar - $this->plaka) / (1 + ($this->kdv / 100)) / (1 + ($this->otv / 100)); // Baz Fiyat formulu
        if (!empty($this->kam_tut)) {
            $this->maliyet = ($this->maliyet) - $this->kam_tut;
        }
    }

    public function karzarar()
    {

        if ($this->net_kar < 0) {
            $status = "!!!! ZARARINA SATIŞ !!!!";
            $type = "danger";


        } elseif ($this->net_kar < 500) {
            $status = "DÜŞÜK DÜZEYDE KARLI SATIŞ";
            $type = "warning";

        } elseif ($this->net_kar > 0) {
            $status = "KARLI SATIŞ";
            $type = "success";

        }
        $alert = htmlalertdiv($status, $type);
        $this->net_kar_span = htmlalertspan($this->net_kar, $type);
        $this->kar_zarar_div = $alert;
    }


    public function post_value($var = NULL)
    {
        $value = $this->input->post($var);
        $value_text = 'value="' . $value . '"';
        return $value_text;
        // çıkarma Plaka - KDV - OTV
        // önce ötv hesaplanıyor + kdv + plaka masrafı


    }


}