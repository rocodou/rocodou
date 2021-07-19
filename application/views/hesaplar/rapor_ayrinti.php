<?php include viewPath('includes/header');

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

        <script>
            function goBack() {
                window.history.back();
            }
        </script>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="bg-purple card-header  color-palette ">
                        <h3 class="card-title">Raporlar <?php echo $hesap_adi; ?></h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        YIL SEÇİNİZ
                                    </button>
                                    <div class="dropdown-menu">
                                        <?php
                                        foreach ($account_year as $key => $value) {
                                            echo '<a class="dropdown-item" href="' . base_url() . 'raporlar/ch_ayrinti.php?source=MUHASEBE6' . $value . '&hesapkod='.$this->input->get("hesapkod").'">' . $key . '</a>' . "\n";
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
                            $toplam_borc +=$row->borc;
                            $toplam_alacak +=$row->alacak;
                            $toplam_bakiye= $toplam_borc - $toplam_alacak;
                            $hesap_adi=$row->HesapAd;

                            ?>
                            <tr>
                                <td class="highlight"><?php echo $row->HesapKod; ?></td>
                                <td><a href="#"></a><?php echo $row->Aciklama; ?></td>
                                <td><?php echo convertd($row->Tarih); ?></td>
                                <td class="danger"><span class="text-danger">- <?php echo  money_f($row->alacak); ?></span></td>
                                <td class="success"><span class="text-success">+ <?php echo money_f($row->borc); ?> </span></td>

                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="highlight"></td>
                            <td></td>
                            <td><strong>Satır Toplamları : </strong></td>
                            <td class="success"><span class="text-danger"><strong><?php echo money_f($toplam_borc); ?></strong></span></td>
                            <td class="success"><span class="text-success"><strong><?php echo money_f($toplam_alacak); ?></strong></span></td>
                        </tr>



                        </tbody>

                    </table>

                    <div class="alert alert-danger d-flex justify-content-center">
                        <strong>Toplam BORÇ : <?php echo money_f($toplam_bakiye); ?> </strong>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="btn-group pull-right">
                    <button onclick="goBack()" type="button" class="btn btn-block bg-gradient-success"> &lt; Geri
                    </button>
                </div>
            </div>

            <!-- /.card -->
        </div>
    </div>
    <!-- /.content-wrapper -->
<?php include viewPath('includes/footer'); ?>