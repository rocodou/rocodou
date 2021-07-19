<?php
include viewPath('includes/header');
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


$account_info = $this->hesaplar_model->getSelectedReportsInformation();
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Raporlar
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><?php echo lang('home'); ?></a></li>
                    <li class="breadcrumb-item active"><?php echo lang('dashboard'); ?> v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="bg-info card-header  color-palette ">
                    <h3 class="card-title"><span
                                class="font-weight-light"><?php echo $account_info->account_code; ?></span>
                        <span class="font-weight-bold"> | <?php echo $account_info->account_name; ?></span>
                    </h3>

                    <div class="card-tools">
                        <?php if ($this->hesaplar_model->checkHesapKodArr() === TRUE) { ?>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning dropdown-toggle "
                                            data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        HESAP SEÇİNİZ
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php
                                        $accountSet = $this->hesaplar_model->getSetOptionValue();
                                        foreach ($accountSet as $key => $value) {
                                            echo '<a class="dropdown-item" href="' . base_url() . 'raporlar?hesapkod=' . $value . '">' . $key . '</a>' . "\n";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <!-- /.card-header -->


                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th class="bg-info disabled color-palette">HESAP KODU</th>
                            <th class="bg-info disabled color-palette">HESAP ADI</th>
                            <th class="bg-info disabled color-palette">BORÇ</th>
                            <th class="bg-info disabled color-palette">ALACAK</th>
                            <th class="bg-info disabled color-palette">BAKİYE</th>
                            <th class="bg-info disabled color-palette">DURUM</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php //$this->load->model('totalsum');

                        $query = $this->hesaplar_model->get_customers_balance_list();

                        $genelbakiye = NULL;
                        $genelverecek = NULL;
                        $genelalacak = NULL;


                        foreach ($query->result() as $row) {
                            echo '<tr>';
                            echo '<td class="highlight">' . $row->HesapKod . '</td>' . "\n";
                            echo '<td> <a href="raporlar/not_ekle?hesapkod=' . $row->HesapKod . '&source=' . $this->hesaplar_model->get_source_db . '">' . $row->HesapAd . '</a></td>' . "\n";
                            echo '<td><span class="text-danger">' . money_f($row->Verecek) . '</span></td>' . "\n";
                            echo '<td><span class="text-success">' . money_f($row->Alacak) . '</span></td>' . "\n";
                            echo '<td><span class="text-orange  text-bold">' . money_f($row->Toplam) . '</span></td>' . "\n";
                            echo '<td><a href="raporlar/not_ekle?hesapkod=' . $row->HesapKod . '&source=' . $this->hesaplar_model->get_source_db . '">Görüntüle </a> </td>' . "\n";
                            echo '</tr>' . "\n";
                            $genelalacak += $row->Alacak;
                            $genelverecek += $row->Verecek;
                            $genelbakiye += $row->Toplam;
                        }

                        //echo 'Total Results: ' . $query->num_rows();

                        ?>
                        <tr class="p-3 mb-2 bg-info text-white">

                            <td class="highlight"></td>
                            <td>
                                <div class="text-right"><strong>Toplamlar :</strong></div>
                            </td>
                            <td class="danger"><span
                                        class="font-weight-bold"><?php echo money_f($genelalacak); ?></span></td>
                            <td class="success"><span
                                        class="font-weight-bold"><?php echo money_f($genelverecek); ?></span></td>
                            <td class="warning"><span
                                        class="font-weight-bold"><?php echo money_f($genelbakiye); ?></span></td>
                            <td class="highlight"></td>

                        </tr>


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<?php include viewPath('includes/footer'); ?>
