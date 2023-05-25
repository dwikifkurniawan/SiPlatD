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
                                    <h3 class="fw-bold">User Management</h3>
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-sm text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"><i class="mdi mdi-plus"></i>Add User</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover datatab">
                                    <thead>
                                        <tr>
                                            <th>ID User</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $api_url = 'http://localhost:3000/users';
                                        $curl_handle = curl_init();
                                        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                                        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                                        $curl_data = curl_exec($curl_handle);
                                        curl_close($curl_handle);
                                        $response_data = json_decode($curl_data);
                                        foreach ($response_data as $user): 
                                        ?>
                                            <tr>
                                                <td><?= $user->id ?></td>
                                                <td><?= $user->firstName ?></td>
                                                <td><?= $user->email ?></td>
                                                <td><?= $user->username ?></td>
                                                <td><?= $user->role ?></td>
                                                <td><label class="badge badge-success"><b>Active</b></label></td>
                                                <td>
                                                    <i class="mdi mdi-pencil"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="<?php echo base_url('home/delete_user?id='.$user->id.'') ?>"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('home/create_user') ?>" method="POST">
                        <div>
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div>
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div>
                            <label for="username" class="col-form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div>
                            <label for="role" class="col-form-label">Role</label>
                            <select id="role" class="form-select" aria-label="Default select example" name="role">
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="owner">Owner</option>
                            </select>
                        </div>
                        <div>
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <!-- <div>
                            <label for="status" class="col-form-label">Status</label>
                            <input type="text" class="form-control" id="status">
                        </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>