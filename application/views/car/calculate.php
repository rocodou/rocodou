<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <form action="http://crm.exiplus.com/car.php" autocomplete="off" method="post">

            <div class="portlet yellow box">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Araç Seçimi
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                </div>

                <div class="portlet-body">


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ARAÇ SEÇİMİ</label>
                                <select class="select2-container form-control input-large select2me"
                                        data-placeholder="Araç Seçiniz...">
                                    <option value=""></option>
                                    <option value="AL">DOBLO CARGO S1</option>
                                    <option value="WY">DOBLO</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>OPSİYON SEÇİMİ</label>
                                <select class="select2-container form-control input-large select2me"
                                        data-placeholder="Opsiyon Seçiniz">
                                    <option value=""></option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                </select>

                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div>


            </div>

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Manuel Fiyat</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ALIŞ FİYATI</label>

                                <input type="text" class="form-control" id="alis_fiyati"
                                       name="alis_fiyati" <?php echo $this->calculate->post_value("alis_fiyati"); ?>
                                       placeholder="0.00">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>LİSTE SATIŞ FİYATI</label>
                                <input type="text" class="form-control" id="liste_satis_fiyati"
                                       name="liste_satis_fiyati" <?php echo $this->calculate->post_value("liste_satis_fiyati"); ?>
                                       placeholder="0.00">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ÖTV TUTARI</label>
                                <input type="text" class="form-control"
                                       id="otv_tutari" <?php echo $this->calculate->post_value("otv_tutari"); ?>
                                       name="otv_tutari" placeholder="%0">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>K.D.V</label>
                                <input type="text" class="form-control" id="kdv_tutari"
                                       name="kdv_tutari" <?php echo $this->calculate->post_value("kdv_tutari"); ?>
                                       value="18" placeholder="%0">
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>KAMPANYA İNDİRİMİ TUTAR BAZINDA</label>
                                <input type="text" class="form-control"
                                       id="kampanya_indirimi_tutar" <?php echo $this->calculate->post_value("kampanya_indirimi_tutar"); ?>
                                       name="kampanya_indirimi_tutar" placeholder="0.00">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>KAMPANYA İNDİRİMİ %</label>
                                <input type="text" class="form-control"
                                       id="kampanya_indirimi_yuzde" <?php echo $this->calculate->post_value("kampanya_indirimi_yuzde"); ?>
                                       name="kampanya_indirimi_yuzde" placeholder="%0">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>PLAKA MASRAFI</label>
                                <input type="text" class="form-control" id="plaka_masrafi"
                                       name="plaka_masrafi" <?php echo $this->calculate->post_value("plaka_masrafi"); ?>
                                       placeholder="0.00">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SATIŞ FİYATI (BAĞLANTI TUTARI)</label>
                                <input type="text" class="form-control" id="baglanti_tutari"
                                       name="baglanti_tutari" <?php echo $this->calculate->post_value("baglanti_tutari"); ?>
                                       placeholder="0.00">
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">


                <div class="col-md-6">
                    <button type="submit" class="btn green">Hesapla</button>
                    <button type="reset" class="btn red">Formu Temizle</button>

                    <?php echo $this->calculate->cal_result_span("kar_zarar_div"); ?>


                </div>

        </form>


        <div class="col-md-6">
            <table class="table">
                <tbody>
                <tr>
                    <td><strong>ALIŞ FİYATI</strong></td>
                    <td><?php echo $this->calculate->cal_result("alis"); ?></td>
                </tr>
                <tr>
                    <td><strong>HESAPLANAN TUTAR</strong></td>
                    <td><?php echo $this->calculate->cal_result("hesaplanacak_tutar"); ?></td>
                </tr>
                <tr>
                    <td><strong>İNDİRİM</strong></td>
                    <td><?php echo $this->calculate->cal_result("indirim_tutari"); ?></td>
                </tr>
                <tr>
                    <td><strong>ÖTV TUTARI</strong></td>
                    <td><?php echo $this->calculate->cal_result("otv_son"); ?></td>
                </tr>
                <tr>
                    <td><strong> KDV TUTARI</strong></td>
                    <td><?php echo $this->calculate->cal_result("kdv_son"); ?></td>
                </tr>
                <tr>
                    <td><strong>FATURA TUTARI</strong></td>
                    <td><?php echo $this->calculate->cal_result("fatura_tutari"); ?></td>
                </tr>
                <td><strong>MALİYET</strong></td>
                <td><?php echo $this->calculate->cal_result("maliyet"); ?></td>
                </tr>
                <tr>
                    <td><strong>NET KAR</strong></td>
                    <td><?php echo $this->calculate->cal_result_span("net_kar_span"); ?></td>
                </tr>

                <tr>
                    <td><strong>SATIŞ FIYATI (BAĞLANTI TUTARI)</strong></td>
                    <td><?php echo $this->calculate->cal_result("bag_tutar"); ?></td>
                </tr>


                </tbody>
            </table>

        </div>


    </div>

    <?php


    ?>

</div>
</div>
<!-- END CONTENT -->