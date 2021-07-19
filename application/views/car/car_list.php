<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Araç Yönetim Sistemi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/') ?>"><?php echo lang('home') ?></a></li>
                    <li class="breadcrumb-item active">Araç Listeleme</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th class="bg-info color-palette">ARAÇ PLAKA</th>
                    <th class="bg-info color-palette">MODEL</th>
                    <th class="bg-info color-palette">ARACI ALAN</th>
                    <th class="bg-info color-palette">KM</th>

                    <th class="bg-info color-palette">DURUM</th>
                    <th class="bg-info color-palette">İŞLEM</th>
                </tr>
                </thead>

                <?php
                $query = $this->car_activity_model->list();


                foreach ($query->result() as $row) { ?>
                    <tbody>
                    <td class="highlight text-bold text-success"><?php echo $row->car_plate; ?></td>
                    <td><?php echo $row->car_model." ".$row->car_color ; ?></td>
                    <td><?php echo $row->car_who_took; ?></td>
                    <td class="text-cyan text-bold"><?php echo $row->car_last_km; ?></td>

                    <?php if($row->car_parked==="0"){ echo "<td class=\"text-danger text-bold\">DIŞARIDA!</td>";} else {echo "<td class=\"text-success text-bold\">HAZIR!</td>";} ?>
                    <td>
                        <?php if($row->car_parked==="0"){ ?>
                        <button type="button" class="btn-sm bg-gradient-danger" data-toggle="modal"
                                data-target="#aracTeslimAlModal" data-id="<?php echo $row->id; ?>" data-car_name="<?php echo $row->car_plate." - ".$row->car_model." - ".$row->car_color ; ?>"  data-car_last_activity_id="<?php echo $row->car_last_activity_id; ?>">Teslim Al
                        </button>
                        <?php } else { ?>
                        <button type="button" class="btn-sm bg-gradient-success" data-toggle="modal"
                                data-target="#aracTeslimEtModal" data-id="<?php echo $row->id; ?>" data-car_last_km="<?php echo $row->car_last_km; ?>" data-car_name="<?php echo $row->car_plate." - ".$row->car_model." - ".$row->car_color ; ?>">Teslim ET
                        </button>
                        <?php } ?>
                    </td>
                    </tbody>
                <?php } ?>


                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->


    <div class="modal" id="aracTeslimAlModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Araç Teslim İşlemi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group row">
                            <label for="car_deliver_km" class="col-4 col-form-label">Araç KM</label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input id="car_deliver_km" name="car_deliver_km" placeholder="SON KM" type="text"
                                           class="form-control" required="required">
                                    <div class="input-group-addon append">
                                        <i class="fa fa-user-circle-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="car_take_date" class="col-4 col-form-label">Teslim Tarihi</label>
                            <div class="col-8">
                                <input id="datenow" name="car_deliver_date"
                                       type="text" data-inputmask-alias="datetime"
                                       data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="car_deliver_time" class="col-4 col-form-label">Teslim Saati</label>
                            <div class="col-8">
                                <input id="saatnow" name="car_deliver_time" placeholder="Teslim Saati"
                                        type="text" class="form-control"
                                       required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-on-danger custom-switch-off-success">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3">Araçta Hasar Var mı?</label>
                            </div>
                        </div>
                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                               data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                        <input type="hidden"   name="formtype"  type="text" value="teslimal">
                        <input type="hidden" id="id"  name="carid" type="text" value="">
                        <input type="hidden" id="car_last_activity_id"  name="car_last_activity_id" type="text" value="">



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button name="submit" type="submit" class="btn btn-danger">Aracı Teslim Al</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="aracTeslimEtModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Araç Teslim İşlemi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post">

                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Kime Teslim Ediliyor</label>
                            <div class="col-8">
                                <input id="text" name="car_who_took" type="text" aria-describedby="textHelpBlock"
                                       class="form-control">
                                <span id="textHelpBlock" class="form-text text-muted">Personel veya Amaç</span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="car_take_date" class="col-4 col-form-label">Alış Tarihi</label>
                            <div class="col-8">
                                <input id="datenow2" name="car_take_date"
                                       type="text" data-inputmask-alias="datetime"
                                       data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="car_take_time" class="col-4 col-form-label">Alış Saati</label>
                            <div class="col-8">
                                <input id="saatnow2" name="car_take_time" placeholder="Alış Saati"
                                       type="text" class="form-control"
                                       required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="car_note" class="col-4 col-form-label">Açıklama</label>
                            <div class="col-8">
                                <textarea id="car_note" name="car_note" cols="40" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <input type="hidden" id="formtype"  name="formtype" type="text" value="teslimet">
                        <input type="hidden" id="id"  name="carid" type="text" value="">
                        <input type="hidden" id="car_last_km"  name="car_last_km" type="text" value="">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button name="submit" type="submit" class="btn btn-success">Aracı Teslim ET</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<script>
    $('.modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var carid = button.data('id') // Extract info from data-* attributes
        var carname = button.data('car_name')
        var car_last_km = button.data('car_last_km')
        var car_last_activity_id = button.data('car_last_activity_id')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Seçilen Araç :  ' + carname)
        modal.find('#id').val(carid)
        modal.find('#car_last_km').val(car_last_km)
        modal.find('#car_last_activity_id').val(car_last_activity_id)
    })

</script>
<?php include viewPath('includes/footer'); ?>

