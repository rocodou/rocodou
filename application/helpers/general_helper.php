<?php
function staticVars()
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

    $account_code = array(
        'TOFAŞ SATIŞ' => '120.02.12',
        'TOFAŞ SERVİS' => '120.02.01',
        'TOFAŞ ANABAYİ' => '120.02.24',
        'ISUZU SATIŞ' => '120.02.27',
        'ISUZU SERVİS' => '120.02.40',
        'T.Y.P SATIŞ' => '120.02.10',
        'BATMAN SATIŞ' => '120.02.16',
        'BATMAN SERVİS' => '120.02.17',
        'SHELL SATIŞ' => '120.02.22'

    );
    return $account_code;
}

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
function convertd($var)
{
    $newDate = date("d/m/Y", strtotime('-2 day' . $var)); //MSSQL tarih çevirme Sorunu yüzünden -2 gün çıkararak doğru tarihi elde ettik


    return $newDate;
}


function money_f($var, $var2 = NULL)
{
    $money = NULL;
    if ($var2 === 1 & !empty($var)) {
        $money = str_replace(',', '', $var);
    } elseif (!empty($var)) {
        $money = number_format($var, 2, ',', '.');
    }
    return $money;
}

function number_f($var, $var2 = NULL)
{
    $money = NULL;
    if ($var2 === 1 & !empty($var)) {
        $money = str_replace(',', '', $var);
    } elseif (!empty($var)) {
        $money = number_format($var, 2, ',', '.');
    }
    return $money;
}
function htmlTools($var = null)
{


}