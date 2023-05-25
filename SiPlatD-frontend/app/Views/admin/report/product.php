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
                                    <h3 class="fw-bold">Report Product</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover datatab">
                                    <thead>
                                        <tr>
                                            <th>Name Report</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Monthly</td>
                                            <td>22/9/2022</td>
                                            <td>22/10/2022</td>
                                            <td><i class="mdi mdi-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-printer"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Yearly</td>
                                            <td>22/9/2021</td>
                                            <td>22/10/2022</td>
                                            <td><i class="mdi mdi-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-printer"></i></td>
                                        </tr>
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