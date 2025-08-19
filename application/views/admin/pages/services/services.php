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
                    <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">Services</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
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
                            <a href="" class="btn btn-success btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm">Delete</a>
                          </td>
                        </tr>
                        <?php $i++; } ?>
                        
                       
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                  </div>
                </div>

            </div>
          </div>
        </div>

      </main>
<?php $this->load->view('admin/partials/footer.php'); ?>