<?php
$session = session();
$user = $session->get('user');
if ($user == 'admin') {
  $this->extend('template/template_admin');
} else {
  $this->extend('template/template_owner');
}
// $selectedId = "";
?>
<?= $this->section('content'); ?>
<!-- Batas template admin -->
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="row flex-grow">
          <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
              <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start" style="margin-bottom: 0.5cm;">
                  <div>
                    <h3 class="fw-bold">Product Manufactur</h3>
                  </div>
                  <div>
                    <button class="btn btn-primary btn-sm text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"><i class="mdi mdi-plus"></i>Add Manufacture Product</button>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover datatab">
                    <thead>
                      <tr>
                        <th>Product name</th>
                        <th>Type</th>
                        <th>Material</th>
                        <th>Qty</th>
                        <th>Date Production</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      session();
                      $api_url = 'http://localhost:3000/manufactures';
                      $curl_handle = curl_init();
                      curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                      curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                      $curl_data = curl_exec($curl_handle);
                      curl_close($curl_handle);
                      $response_data = json_decode($curl_data);

                      
                      
                      foreach ($response_data as $manufacture):
                          $api_url2 = 'http://localhost:3000/materials/'.$manufacture->material_id;
                          $curl_handle = curl_init();
                          curl_setopt($curl_handle, CURLOPT_URL, $api_url2);
                          curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                          $curl_data = curl_exec($curl_handle);
                          curl_close($curl_handle);
                          $response = json_decode($curl_data);
                          $material = $response->name;

                          $date = $manufacture->createdAt;
                          $day = substr($date,8,2);
                          $month = substr($date,5,2);
                          $year = substr($date,0,4);
                          $changedDate = $day."/".$month."/".$year;
                      ?>
                      <tr>
                        <td><?= $manufacture->product->name ?></td>
                        <td><?= $manufacture->type ?></td>
                        <td><?= $material ?></td>
                        <td><?= $manufacture->quantity ?></td>
                        <td><?= $changedDate ?></td>
                        <?php if ($manufacture->status == "Sewing"){ ?>
                          <td><label class="badge badge-warning"><b>Sewing</b></label></td>
                        <?php } else if($manufacture->status == "Done") { ?>
                          <td><label class="badge badge-success"><b>Done</b></label></td>
                        <?php } else if($manufacture->status == "Cutting") { ?>
                          <td><label class="badge badge-dark"><b>Cutting</b></label></td>
                        <?php } else if($manufacture->status == "Printing") { ?>
                          <td><label class="badge badge-warning"><b>Printing</b></label></td>
                        <?php } else if($manufacture->status == "Packing") { ?>
                          <td><label class="badge badge-info"><b>Packing</b></label></td>
                          <?php } else if($manufacture->status == "Canceled") { ?>
                        <td><label class="badge badge-danger"><b>Canceled</b></label></td>
                        <?php } ?>
                        
                        <td>
                          <a
                          data-id="<?= $manufacture->id ?>"
                          data-product_id="<?= $manufacture->product->id ?>"
                          data-type="<?= $manufacture->type ?>"
                          data-material_id="<?= $manufacture->material_id ?>"
                          data-status="<?= $manufacture->status ?>"
                          data-quantity="<?= $manufacture->quantity ?>"
                          data-bs-toggle="modal" data-bs-target="#editSelectedID" class="open-editSelectedID" href="#editSelectedID"><i class="mdi mdi-pencil"></i></a>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="<?php echo base_url('home/delete_manufacture?id='.$manufacture->id.'') ?>"><i class="mdi mdi-delete"></i></a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                      <!-- <tr>
                        <td>Kaos Polos</td>
                        <td>Long sleeve</td>
                        <td>Combed</td>
                        <td>150</td>
                        <td>12/10/2022</td>
                        <td><label class="badge badge-info"><b>Packing</b></label></td>
                        <td><i class="mdi mdi-pencil"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-delete"></i></td>
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
  <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Manufacture Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('home/create_manufacture') ?>" method="POST">
            <div>
              <label for="product" class="col-form-label">Product</label>
              <?php
              // print($selectedId);
              // $api_url = "http://localhost:3000/manufactures/{$_SESSION['selectedID']}";
              // $curl_handle = curl_init();
              // curl_setopt($curl_handle, CURLOPT_URL, $api_url);
              // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
              // $curl_data = curl_exec($curl_handle);
              // curl_close($curl_handle);
              // $resp_material = json_decode($curl_data);
              ?>
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
            <div>
              <label for="type" class="col-form-label">Type</label>
              <input type="text" class="form-control" id="type" name="type">
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
              <label for="date-production" class="col-form-label">Date Production</label>
              <input type="date" class="form-control" id="date-production" name="date">
            </div>
            <div>
              <label for="status" class="col-form-label">Status</label>
              <select id="status" class="form-select" aria-label="Default select example" name="status">
                <option value="Cutting">Cutting</option>
                <option value="Printing">Printing</option>
                <option value="Sewing">Sewing</option>
                <option value="Packing">Packing</option>
                <option value="Done">Done</option>
              </select>
            </div>
            <div>
                <label for="quantity" class="col-form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" >Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- edit -->
  <div class="modal fade" id="editSelectedID" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit Manufacture Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('home/edit_manufacture') ?>" method="POST">
            <div>
              <label for="product" class="col-form-label">Product</label>
              <select id="product_id" class="form-select" aria-label="Default select example" name="product">
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
            <div>
              <label for="type" class="col-form-label">Type</label>
              <input type="text" class="form-control" id="type" name="type">
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
              <label for="status" class="col-form-label">Status</label>
              <select id="status" class="form-select" aria-label="Default select example" name="status">
                <option value="Cutting">Cutting</option>
                <option value="Printing">Printing</option>
                <option value="Sewing">Sewing</option>
                <option value="Packing">Packing</option>
                <option value="Done">Done</option>
              </select>
            </div>
            <div>
                <label for="quantity" class="col-form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <div>
                <input type="hidden" class="form-control" id="selectedID" name="selectedID">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" >Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?= $this->endSection(); ?>