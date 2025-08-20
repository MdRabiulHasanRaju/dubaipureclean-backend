<?php $this->load->view('admin/partials/header.php'); ?>
<?php $this->load->view('admin/partials/navbar.php'); ?>
<?php $this->load->view('admin/partials/sidebar.php'); ?>
      <main class="app-main">

        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Add New Service</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="<?=base_url("admin");?>">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Service Management</li>
                  <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">




<div class="card shadow-lg rounded-4">
    <div class="card-body">
      <form action="<?= base_url('admin/service_admin/add') ?>" method="post">

        <!-- Category -->
        <div class="mb-3">
          <label for="cat_id" class="form-label">Category ID</label>
          <input type="number" class="form-control" id="cat_id" name="cat_id" required>
        </div>

        <!-- Title -->
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" required minlength="3">
        </div>

        <!-- Sub Title -->
        <div class="mb-3">
          <label for="sub_title" class="form-label">Sub Title</label>
          <input type="text" class="form-control" id="sub_title" name="sub_title">
        </div>

        <!-- Featured Image -->
        <div class="mb-3">
          <label for="featured_image" class="form-label">Featured Image (URL)</label>
          <input type="text" class="form-control" id="featured_image" name="featured_image">
        </div>

        <!-- Banner Image -->
        <div class="mb-3">
          <label for="banner_image" class="form-label">Banner Image (URL)</label>
          <input type="text" class="form-control" id="banner_image" name="banner_image">
        </div>

        <!-- Banner Video -->
        <div class="mb-3">
          <label for="banner_video" class="form-label">Banner Video (URL)</label>
          <input type="text" class="form-control" id="banner_video" name="banner_video">
        </div>

        <!-- Description -->
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <!-- Home Page -->
        <div class="mb-3">
          <label for="home_page" class="form-label">Home Page (0 or 1)</label>
          <input type="number" class="form-control" id="home_page" name="home_page" value="0">
        </div>

        <!-- Position -->
        <div class="mb-3">
          <label for="position" class="form-label">Position</label>
          <input type="number" class="form-control" id="position" name="position">
        </div>

        <!-- Meta Description -->
        <div class="mb-3">
          <label for="meta_description" class="form-label">Meta Description</label>
          <textarea class="form-control" id="meta_description" name="meta_description"></textarea>
        </div>

        <!-- Meta Keyword -->
        <div class="mb-3">
          <label for="meta_keyword" class="form-label">Meta Keyword</label>
          <input type="text" class="form-control" id="meta_keyword" name="meta_keyword">
        </div>

        <!-- Meta Title -->
        <div class="mb-3">
          <label for="meta_title" class="form-label">Meta Title</label>
          <input type="text" class="form-control" id="meta_title" name="meta_title">
        </div>

        <!-- Created By -->
        <div class="mb-3">
          <label for="created_by" class="form-label">Created By (User ID)</label>
          <input type="number" class="form-control" id="created_by" name="created_by" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Save Service</button>
      </form>
    </div>
  </div>





                </div>
            </div>
          </div>
        </div>

      </main>
<?php $this->load->view('admin/partials/footer.php'); ?>