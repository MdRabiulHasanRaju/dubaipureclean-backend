<?php $this->load->view('admin/partials/header.php'); ?>
<?php $this->load->view('admin/partials/navbar.php'); ?>
<?php $this->load->view('admin/partials/sidebar.php'); ?>
      <main class="app-main">

        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 p-2">
                        <table id="myTable" class="table table-bordered">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Service Name</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i=1;
                            foreach($services as $service){?>
                            <tr class="align-middle">
                            <td><?=$i;?></td>
                            <td><?=$service->title;?></td>
                            <td>
                                <a href="<?=base_url("admin/service_admin/edit/$service->id")?>" class="btn btn-success btn-sm">Edit</a>

                                <a href="<?= base_url('admin/service_admin/delete/'.$service->id) ?>" 
                                onclick="return confirm('Are you sure you want to delete this service?')" 
                                class="btn btn-danger btn-sm">
                                Delete
                              </a>
                            </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>

      </main>
<?php $this->load->view('admin/partials/footer.php'); ?>