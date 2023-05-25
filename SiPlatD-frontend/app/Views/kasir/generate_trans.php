<?php

$this->extend('template/template_kasir');

?>
<?= $this->section('content'); ?>
<!-- Batas template admin -->
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start" style="margin-bottom: 1cm;">
                                <div>
                                    <h3 class="fw-bold">Transaction Data</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover datatab">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Item Total</th>
                                            <th>Price Total</th>
                                            <th>Created at</th>
                                            <th>Cashier</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $api_url = 'http://localhost:3000/transactions';
                                        $curl_handle = curl_init();
                                        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                                        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                                        $curl_data = curl_exec($curl_handle);
                                        curl_close($curl_handle);
                                        $response_data = json_decode($curl_data);
                                        
                                        foreach ($response_data as $transaksi):
                                            
                                            $date = $transaksi->created_at;
                                            $day = substr($date,8,2);
                                            $month = substr($date,5,2);
                                            $year = substr($date,0,4);
                                            $createdDate = $day."/".$month."/".$year;
                                        ?>
                                        <tr>
                                            <td><?= $transaksi->product->name ?></td>
                                            <td><?= $transaksi->item_total ?></td>
                                            <td><?= number_format($transaksi->price_total, 0, ",", ".") ?></td>
                                            <td><?= $createdDate ?></td>
                                            <td><?= $transaksi->cashier->firstName ?></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('home/delete_transaction?id='.$transaksi->id.'') ?>"><i class="mdi mdi-delete"></i></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <!-- <tr>
                                            <td>Kaos Polos</td>
                                            <td>Misty</td>
                                            <td>Combed</td>
                                            <td>12/10/2022</td>
                                            <td>16/10/2022</td>
                                            <td><i class="mdi mdi-pencil"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-delete"></i></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <h4 class="fw-bold" style="margin-bottom: 0.5cm; margin-top: 1cm">Report Data transaksi</h4>
                                <form action="<?php echo base_url('home/generate_transaction') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" name="report_name" placeholder="Report Name">
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-group date datepicker navbar-date-picker">
                                                <span class="input-group-addon input-group-prepend border-right">
                                                    <span class="icon-calendar input-group-text calendar-icon"></span>
                                                </span>
                                                <input class="form-control" type="text" name="daterange" value="" />

                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <button class="btn btn-primary btn-sm text-white mb-0 me-0" type="submit"><i class="mdi mdi-file-document"></i>&nbsp;Create report</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add transaksi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div>
                            <label for="product-name" class="col-form-label">transaksi Name</label>
                            <input type="text" class="form-control" id="product-name">
                        </div>
                        <div>
                            <label for="category" class="col-form-label">Category</label>
                            <input type="text" class="form-control" id="category">
                        </div>
                        <div>
                            <label for="description" class="col-form-label">Description</label>
                            <input type="text" class="form-control" id="description">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>