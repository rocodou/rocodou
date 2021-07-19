<?php
include viewPath('includes/header');
$cusinfo = $this->hesaplar_model->getCustomerInformation();
$calls = $this->hesaplar_model->getCallRecords();
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

?>


    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Aramalar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Simple Tables</li>
                </ol>
            </div>
        </div>
        <div class="row">


            <!--        İLk card//-->
            <div class="col-md-4" style="height:400px">

                <div class="card card-primary card-outline" >
                    <div class="card-header">
                        <h3 class="card-title">Müşteri Bilgileri</h3>
                    </div>
                    <div class="card-body box-profile">

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Ad Soyad</b> <a class="float-right"><?php echo $cusinfo->Unvan1; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Hesap Kodu</b> <a class="float-right"><?php echo $cusinfo->HesapKodu; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Telefon</b> <a class="float-right"><?php echo $cusinfo->Telefon1; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Adres</b> <a class="float-right"><?php echo $cusinfo->FaturaAdres1; ?>
                                    - <?php echo $cusinfo->FaturaAdres2; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Cep</b> <a class="float-right"><?php echo $cusinfo->Telefon2; ?></a>
                            </li>

                        </ul>

                        <a class="btn btn-primary"
                           href="<?php echo base_url("hesaplar/musteri_bilgi_guncelleme?hesapkod=" . $this->input->get("hesapkod")); ?>"
                           role="button">İletişim Bilgilerini Güncelle</a>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!--Son kart//-->

            <!-- Arama Kayıtları//-->
            <div class="col-md-8"  style="height:400px" >

                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Arama Kayıt Listesi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >
                        <table class="table table-bordered">
                            <thead>
                            <tr>

                                <th style="width: 180px">Arama Zamanı</th>
                                <th>İlerleyiş</th>
                                <th style="width: 220px">Vade Tarihi</th>
                                <th style="width: 210px">Arayan Kişi</th>
                            </tr>
                            </thead>
                            <tr>
                            <tr>
                                <td>28/12/2020</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-danger">55%</span></td>
                            </tr>
                            <?php
                            foreach ($calls->result() as $row) {
                                ?>
                                <tr>
                                    <td><?php echo date('H:i - d/m/Y ', strtotime($row->date)); ?></td>
                                    <td><?php echo $row->account_name; ?></td>
                                    <td><?php echo date('d/m/Y ', strtotime($row->maturity_date)); ?></td>
                                    <td><?php echo $row->caller_user; ?></td>
                                </tr>


                            <?php } ?>


                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Arama Kayıtları Bitiş//-->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="bg-purple card-header  color-palette ">
                        <h3 class="card-title">HESAP ÖZETİ </h3>


                    </div>
                    <!-- /.card-header -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="bg-purple card-header  color-palette ">
                                    <h3 class="card-title">Raporlar </h3>

                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    YIL SEÇİNİZ
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php
                                                    foreach ($account_year as $key => $value) {
                                                        echo '<a class="dropdown-item" href="' . base_url() . 'raporlar/not_ekle?source=MUHASEBE6' . $value . '&hesapkod=' . $this->input->get("hesapkod") . '">' . $key . '</a>' . "\n";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->


                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="bg-purple disabled color-palette"> Hesap Kodu</th>
                                        <th class="bg-purple disabled color-palette"> Açıklama</th>
                                        <th class="bg-purple disabled color-palette"> Tarih</th>
                                        <th class="bg-purple disabled color-palette"> Borç</th>
                                        <th class="bg-purple disabled color-palette"> Alacak</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $query = $this->hesaplar_model->get_account_details();
                                    foreach ($query->result() as $row) {
                                        $toplam_borc += $row->borc;
                                        $toplam_alacak += $row->alacak;
                                        $toplam_bakiye = $toplam_borc - $toplam_alacak;
                                        $hesap_adi = $row->HesapAd;

                                        ?>
                                        <tr>
                                            <td class="highlight"><?php echo $row->HesapKod; ?></td>
                                            <td><a href="#"></a><?php echo $row->Aciklama; ?></td>
                                            <td><?php echo convertd($row->Tarih); ?></td>
                                            <td class="danger"><span
                                                        class="text-danger">- <?php echo money_f($row->alacak); ?></span>
                                            </td>
                                            <td class="success"><span
                                                        class="text-success">+ <?php echo money_f($row->borc); ?> </span>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="highlight"></td>
                                        <td></td>
                                        <td><strong> Satır Toplamları : </strong></td>
                                        <td class="success"><span
                                                    class="text-danger"><strong><?php echo money_f($toplam_borc); ?></strong></span>
                                        </td>
                                        <td class="success"><span
                                                    class="text-success"><strong><?php echo money_f($toplam_alacak); ?></strong></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center border border-danger">
                                    <strong>Toplam ALACAK :<span
                                                class="text-danger"> <?php echo money_f($toplam_bakiye); ?>
                                    </strong></span></div>
                            </div>
                            <!-- /.card-body -->
                            <div class="btn-group pull-right">
                                <button onclick="goBack()" type="button" class="btn btn-block bg-gradient-success"> &lt;
                                    Geri
                                </button>
                            </div>
                        </div>

                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include viewPath('includes/footer'); ?>