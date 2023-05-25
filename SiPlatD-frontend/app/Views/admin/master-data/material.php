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
                                    <h3 class="fw-bold">Master Data Material</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover datatab">
                                    <thead>
                                        <tr>
                                            <th>Material name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $api_url = 'http://localhost:3000/materials';
                                        $curl_handle = curl_init();
                                        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                                        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                                        $curl_data = curl_exec($curl_handle);
                                        curl_close($curl_handle);
                                        $response_data = json_decode($curl_data);
                                        
                                        foreach ($response_data as $material):
                                            
                                            $date = $material->createdAt;
                                            $day = substr($date,8,2);
                                            $month = substr($date,5,2);
                                            $year = substr($date,0,4);
                                            $createdDate = $day."/".$month."/".$year;

                                            $date = $material->updatedAt;
                                            $day = substr($date,8,2);
                                            $month = substr($date,5,2);
                                            $year = substr($date,0,4);
                                            $updatedDate = $day."/".$month."/".$year;
                                        ?>
                                        <tr>
                                            <td><?= $material->name ?></td>
                                            <td><?= $material->category ?></td>
                                            <td><?= $material->description ?></td>
                                            <td><?= $createdDate ?></td>
                                            <td><?= $updatedDate ?></td>
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