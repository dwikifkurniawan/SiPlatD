<?php
$session = session();
$user = $session->get('user');
if ($user == 'admin') {
    $this->extend('template/template_admin');
} else {
    $this->extend('template/template_owner');
}
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
                                    <h3 class="fw-bold">Master Data Product</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover datatab">
                                    <thead>
                                        <tr>
                                            <th>Product name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Type</th>
                                            <th>Material</th>
                                            <th>Date Production</th>
                                            <th>In stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $api_url = 'http://localhost:3000/products';
                                        $curl_handle = curl_init();
                                        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                                        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                                        $curl_data = curl_exec($curl_handle);
                                        curl_close($curl_handle);
                                        $response_data = json_decode($curl_data);
                                        
                                        foreach ($response_data as $product):
                                            $api_url2 = 'http://localhost:3000/materials/'.$product->material_id;
                                            $curl_handle = curl_init();
                                            curl_setopt($curl_handle, CURLOPT_URL, $api_url2);
                                            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                                            $curl_data = curl_exec($curl_handle);
                                            curl_close($curl_handle);
                                            $response = json_decode($curl_data);
                                            $material = $response->name;

                                            $date = $product->createdAt;
                                            $day = substr($date,8,2);
                                            $month = substr($date,5,2);
                                            $year = substr($date,0,4);
                                            $changedDate = $day."/".$month."/".$year;
                                        ?>
                                        <tr>
                                            <td><?= $product->name ?></td>
                                            <td><?= $product->description ?></td>
                                            <td><?= number_format($product->price, 0, ",", ".") ?></td>
                                            <td><?= $product->category ?></td>
                                            <td><?= $material ?></td>
                                            <td><?= $changedDate ?></td>
                                            <td><?= $product->stock_quantity ?></td>
                                            <td><i class="mdi mdi-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-printer"></i></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <!-- <tr>
                                            <td>Kaos Polos</td>
                                            <td>Twotone</td>
                                            <td>Katun mix PE</td>
                                            <td>22/10/2022</td>
                                            <td><label class="badge badge-warning"><b>Sewing</b></label></td>
                                            <td><i class="mdi mdi-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-printer"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Kaos Polos</td>
                                            <td>Misty</td>
                                            <td>Combed</td>
                                            <td>12/10/2022</td>
                                            <td><label class="badge badge-info"><b>Packing</b></label></td>
                                            <td><i class="mdi mdi-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-printer"></i></td>
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