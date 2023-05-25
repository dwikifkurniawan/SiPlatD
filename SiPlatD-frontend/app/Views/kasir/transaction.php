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
                                    <h3 class="fw-bold">Transaction</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="fw-bold">Product</h5>
                                </div>
                                <div class="col-lg-6" style="text-align: right;">
                                    <?php 
                                    session(); 
                                    $api_url = "http://localhost:3000/users/{$_SESSION["id"]}";
                                    $curl_handle = curl_init();
                                    curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                                    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                                    $curl_data = curl_exec($curl_handle);
                                    curl_close($curl_handle);
                                    $user = json_decode($curl_data);
                                    ?>
                                    <h5>Cashier : <?= $user->firstName ?></h5>
                                </div>
                            </div>
                            <form action="<?php echo base_url('home/add_transaction') ?>" method="POST">
                                <div class="row">
                                    <div class="col-lg-3">
                                    <select id="product" class="form-select" aria-label="Default select example" name="product">
                                        <?php 
                                        $api_url = 'http://localhost:3000/products';
                                        $curl_handle = curl_init();
                                        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                                        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                                        $curl_data = curl_exec($curl_handle);
                                        curl_close($curl_handle);
                                        $response_data = json_decode($curl_data);
                                        foreach ($response_data as $product):
                                        ?>
                                        <option value=<?= $product->id ?>><?= $product->name ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <select id="type" class="form-select" aria-label="Default select example" name="type">
                                            <option value="Lengan Panjang">Lengan Panjang</option>
                                            <option value="Lengan Pendek">Lengan Pendek</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6" style="text-align: right;">
                                    <?php
                                    session();
                                    // print(json_encode($_SESSION["prod0"]));
                                    $totalprice = 0;
                                    for($i=0; $i<$_SESSION["prod"]; $i++){
                                        $totalprice = $totalprice + ($_SESSION["prod{$i}"]["price"] * $_SESSION["prod{$i}"]["amount"]);
                                    }
                                    ?>
                                        <h2 class="fw-bold">Rp. <?= number_format($totalprice, 0, ",", ".") ?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6" style="margin-top: 0.3cm;">
                                    <h5 class="fw-bold">Size</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <select id="size" class="form-select" aria-label="Default select example" name="size">
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" class="form-control" id="S" placeholder="Amount" name="amount">
                                    </div>
                                    <!-- <div class="col-lg-2">
                                        <input type="number" class="form-control" id="M" placeholder="M" name="m">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" class="form-control" id="L" placeholder="L" name="l">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" class="form-control" id="XL" placeholder="XL" name="xl">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" class="form-control" id="XXL" placeholder="XXL" name="xxl">
                                    </div> -->
                                </div>
                                <div class="row" style="margin-top: 0.5cm;">
                                    <div class="col-sm-1">
                                        <button type="submit" class="btn btn-success">Add</button>
                            </form>
                        </div>
                        <div class="col-sm-1">
                            <a href="<?php echo base_url('home/create_transaction') ?>"><button type="button" class="btn btn-warning">Pay</button></a>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name Product</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                session();
                                // print(json_encode($_SESSION));
                                for($i=0; $i<$_SESSION["prod"]; $i++):
                                ?>
                                <tr>
                                    <td><?= $_SESSION["prod{$i}"]["name"] ?></td>
                                    <td><?= $_SESSION["prod{$i}"]["type"] ?></td>
                                    <td><?= $_SESSION["prod{$i}"]["size"] ?></td>
                                    <td><?= $_SESSION["prod{$i}"]["amount"] ?></td>
                                    <td><?= number_format($_SESSION["prod{$i}"]["price"] * $_SESSION["prod{$i}"]["amount"], 0, ",", ".") ?></td>
                                    <td><a href="<?php echo base_url('home/delete_temp_transaction?id='.$i.'') ?>"><i class="mdi mdi-delete"></i></a></td>
                                </tr>
                                <?php endfor ?>
                                <!-- <tr>
                                    <td>Kaos tidak polos</td>
                                    <td>Pendek</td>
                                    <td>XXL</td>
                                    <td>1</td>
                                    <td>75.000</td>
                                    <td><i class="mdi mdi-delete"></i></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?= $this->endSection(); ?>