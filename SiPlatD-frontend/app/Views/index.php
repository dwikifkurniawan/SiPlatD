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
        <div class="row">
          <div class="col-lg-8 d-flex flex-column">
            <div class="row flex-grow">
              <div class="col-md-6 col-lg-12 grid-margin stretch-card">

                <div class="card-body">
                  <h3 class="fw-bold" style="margin-bottom :1cm;">Fullfilment Warehouse</h3>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="circle-progress-width">
                          <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                        </div>
                        <div style="margin-left:15px">
                          <p class="text-small mb-2">Material PE</p>
                          <h4 class="mb-0 fw-bold">26%</h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="circle-progress-width">
                          <div id="visitperday" class="progressbar-js-circle pr-2"></div>
                        </div>
                        <div style="margin-left:15px">
                          <p class="text-small mb-2">Material Combed 24S</p>
                          <h4 class="mb-0 fw-bold">21%</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        
        <div class="row flex-grow">
          <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
              <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start" style="margin-bottom: 0.5cm;">
                  <div>
                    <h3 class="fw-bold">Hasil Penjualan Hari Ini</h3>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                        <th><?php echo date("d/m/Y") ?></th>
                        <?php
                          $api_url = 'http://localhost:3000/transactions';
                          $curl_handle = curl_init();
                          curl_setopt($curl_handle, CURLOPT_URL, $api_url);
                          curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                          $curl_data = curl_exec($curl_handle);
                          curl_close($curl_handle);
                          $response_data = json_decode($curl_data);
          
                          $income = 0;
                          $now = date("d/m/Y");

                          foreach ($response_data as $transaction):
                            $date = $transaction->created_at;
                            $day = substr($date,8,2);
                            $month = substr($date,5,2);
                            $year = substr($date,0,4);
                            $createdDate = $day."/".$month."/".$year;
                            if($now == $createdDate){
                              $income += $transaction->price_total;
                            }
                          endforeach;
                        ?>
                        <th>
                            <td>Rp. <?php echo number_format($income, 0, ",", ".") ?></td>
                        </th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row flex-grow">
          <div class="col-6 grid-margin stretch-card">
            <div class="card card-rounded">
              <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start" style="margin-bottom: 0.5cm;">
                  <div>
                    <h3 class="fw-bold">Material</h3>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover datatab">
                    <thead>
                      <tr>
                        <th>Nama Material</th>
                        <th>Qty</th>
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
                          // $date = $product->createdAt;
                          //   $day = substr($date,8,2);
                          //   $month = substr($date,5,2);
                          //   $year = substr($date,0,4);
                          //   $changedDate = $day."/".$month."/".$year;
                            ?>
                        <tr>
                            <td><?= $material->name ?></td>
                            <td><?= $material->quantity ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <!-- </div> -->

        <!-- <div class="row flex-grow"> -->
          <div class="col-6 grid-margin stretch-card">
            <div class="card card-rounded">
              <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start" style="margin-bottom: 0.5cm;">
                  <div>
                    <h3 class="fw-bold">Produk</h3>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover datatab">
                    <thead>
                      <tr>
                        <th>Product name</th>
                        <th>Qty</th>
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
                          // $date = $product->createdAt;
                          //   $day = substr($date,8,2);
                          //   $month = substr($date,5,2);
                          //   $year = substr($date,0,4);
                          //   $changedDate = $day."/".$month."/".$year;
                            ?>
                        <tr>
                            <td><?= $product->name ?></td>
                            <td><?= $product->stock_quantity ?></td>
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
  </div>
</div>
</div>
<?= $this->endSection(); ?>