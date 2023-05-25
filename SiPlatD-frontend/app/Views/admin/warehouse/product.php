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
                                    <h3 class="fw-bold">Data Product</h3>
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-sm text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"><i class="mdi mdi-plus"></i>Add Product</button>
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
                                            <td>
                                                <a
                                                data-id="<?= $product->id ?>"
                                                data-name="<?= $product->name ?>"
                                                data-description="<?= $product->description ?>"
                                                data-type="<?= $product->category ?>"
                                                data-price="<?= $product->price ?>"
                                                data-material="<?= $product->material_id ?>"
                                                data-stock_quantity="<?= $product->stock_quantity ?>"
                                                data-bs-toggle="modal" data-bs-target="#editProduct" class="open-editProduct" href="#editProduct"><i class="mdi mdi-pencil"></i>
                                                </a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="<?php echo base_url('home/delete_product?id='.$product->id.'') ?>"><i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Kaos Polos</td>
                                            <td>-</td>
                                            <td>50.000</td>
                                            <td>Twotone</td>
                                            <td>Katun mix PE</td>
                                            <td>22/10/2022</td>
                                            <td>112</td>
                                            <td><i class="mdi mdi-pencil"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-delete"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Kaos Polos</td>
                                            <td>-</td>
                                            <td>540.000</td>
                                            <td>Misty</td>
                                            <td>Combed</td>
                                            <td>12/10/2022</td>
                                            <td>70</td>
                                            <td><i class="mdi mdi-pencil"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-delete"></i></td>
                                        </tr> -->
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <h4 class="fw-bold" style="margin-bottom: 0.5cm; margin-top: 1cm">Report Data Product</h4>
                                <form action="<?php echo base_url('home/generate_product') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="report-name" placeholder="Report Name" name="">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('home/create_product') ?>" method="POST">
                        <div>
                            <label for="product-name" class="col-form-label">Product Name</label>
                            <input type="text" class="form-control" id="product-name" name="product">
                        </div>
                        <div>
                            <label for="description" class="col-form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div>
                            <label for="price" class="col-form-label">price</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div>
                            <label for="type" class="col-form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="category">
                        </div>
                        <div>
                            <label for="material" class="col-form-label">Material</label>
                            <select id="material" class="form-select" aria-label="Default select example" name="material">
                                <?php 
                                $api_url = 'http://localhost:3000/materials';
                                $curl_handle = curl_init();
                                curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                                $curl_data = curl_exec($curl_handle);
                                curl_close($curl_handle);
                                $response_data = json_decode($curl_data);
                                foreach ($response_data as $material):
                                ?>
                                <option value=<?= $material->id ?>><?= $material->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="in_stock" class="col-form-label">In stock</label>
                            <input type="number" class="form-control" id="in_stock" name="stock_quantity">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT -->
    <div class="modal fade" id="editProduct" aria-labelledby="editProduct" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('home/edit_product') ?>" method="POST">
                        <div>
                            <label for="product-name" class="col-form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="product">
                        </div>
                        <div>
                            <label for="description" class="col-form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div>
                            <label for="price" class="col-form-label">price</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div>
                            <label for="type" class="col-form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="category">
                        </div>
                        <div>
                            <label for="material" class="col-form-label">Material</label>
                            <select id="material_id" class="form-select" aria-label="Default select example" name="material">
                                <?php 
                                $api_url = 'http://localhost:3000/materials';
                                $curl_handle = curl_init();
                                curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                                $curl_data = curl_exec($curl_handle);
                                curl_close($curl_handle);
                                $response_data = json_decode($curl_data);
                                foreach ($response_data as $material):
                                ?>
                                <option value=<?= $material->id ?>><?= $material->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="in_stock" class="col-form-label">In stock</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity">
                        </div>
                        <div>
                            <input type="hidden" class="form-control" id="id" name="id">
                        </div>
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