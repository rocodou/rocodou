<?php
include viewPath('includes/header');
$cusinfo = $this->hesaplar_model->getCustomerInformation();

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
            <div class="col-md-6">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Müşteri Bilgileri</h3>
                    </div>
                    <div class="card-body box-profile">

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Ad Soyad</b> <a class="float-right"><strong><span class="text-black"><?php echo $cusinfo->Unvan1; ?></span></strong></a>
                            </li>
                            <li class="list-group-item">
                                <b>Hesap Kodu</b> <a class="float-right"><strong><?php echo $cusinfo->HesapKodu; ?></strong></a>
                            </li>
                            <li class="list-group-item">
                                <b>Telefon</b> <a class="float-right"><input type="email" class="form-control"
                                                                             id="exampleInputEmail1"
                                                                             aria-describedby="emailHelp"
                                                                             value="<?php echo $cusinfo->Telefon1; ?>"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Cep</b> <a class="float-right"><input type="email" class="form-control"
                                                                         id="exampleInputEmail1"
                                                                         aria-describedby="emailHelp"
                                                                         value="<?php echo $cusinfo->Telefon2; ?>"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Adres</b> <a class="float-right"><input type="email" class="form-control"
                                                                           id="exampleInputEmail1"
                                                                           aria-describedby="emailHelp"
                                                                           value="<?php echo $cusinfo->FaturaAdres1; ?>"></a>
                                </a>
                            </li>


                        </ul>

                        <a class="btn btn-primary"
                           href="<?php echo base_url("hesaplar/musteri_bilgi_guncelleme?hesap_kod=" . $this->input->get("hesapkod")); ?>"
                           role="button">İletişim Bilgilerini Güncelle</a>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!--Son kart//-->
<?php
include viewPath('includes/footer');
?>