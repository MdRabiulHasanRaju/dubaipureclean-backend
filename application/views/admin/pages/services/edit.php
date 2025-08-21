<?php $this->load->view('admin/partials/header.php'); ?>
<?php $this->load->view('admin/partials/navbar.php'); ?>
<?php $this->load->view('admin/partials/sidebar.php'); ?>

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs5.min.css" rel="stylesheet">

<style>
div#msg { position: fixed; right: 0; bottom: 0; z-index: 9999; }
.img-preview { max-width: 150px; display: block; margin-top: 10px; }
</style>

<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Edit Service</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?=base_url("admin");?>">Home</a></li>
            <li class="breadcrumb-item">Service Management</li>
            <li class="breadcrumb-item active">Edit</li>
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
              <div id="msg"></div>
              <form id="serviceForm" method="post" enctype="multipart/form-data">

                <!-- Category -->
                <div class="mb-3">
                  <label for="cat_id" class="form-label">Category</label>
                  <select class="form-select" id="cat_id" name="cat_id" required>
                    <option value="">-- Select Category --</option>
                    <?php foreach($categories as $cat): ?>
                      <option value="<?= $cat->id ?>" <?= $cat->id==$service->category_id?'selected':'' ?>><?= $cat->name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <!-- Title -->
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="title" name="title" value="<?= $service->title ?>" required minlength="3">
                </div>

                <!-- Sub Title -->
                <div class="mb-3">
                  <label for="sub_title" class="form-label">Sub Title</label>
                  <input type="text" class="form-control" id="sub_title" name="sub_title" value="<?= $service->sub_title ?>">
                </div>

                <!-- Featured Image -->
                <div class="mb-3">
                  <label for="featured_image_file" class="form-label">Featured Image</label>
                  <input type="file" class="form-control" id="featured_image_file" name="featured_image_file" accept="image/*">
                  <?php if(!empty($service->featured_image)): ?>
                    <img id="featured_image_preview" src="<?= base_url("uploads/services/$service->featured_image") ?>" class="img-preview" alt="Featured Image">
                  <?php endif; ?>
                </div>

                <!-- Banner Image -->
                <div class="mb-3">
                  <label for="banner_image_file" class="form-label">Banner Image</label>
                  <input type="file" class="form-control" id="banner_image_file" name="banner_image_file" accept="image/*">
                  <?php if(!empty($service->banner_image)): ?>
                    <img id="banner_image_preview" src="<?= base_url("uploads/services/$service->banner_image") ?>" class="img-preview" alt="Banner Image">
                  <?php endif; ?>
                </div>

                <!-- Banner Video -->
                <div class="mb-3">
                  <label for="banner_video" class="form-label">Banner Video (URL)</label>
                  <input type="text" class="form-control" id="banner_video" name="banner_video" value="<?= $service->banner_video ?>">
                </div>

                <!-- Description -->
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" name="description"><?= $service->description ?></textarea>
                </div>

                <!-- Home Page -->
                <div class="mb-3">
                  <label for="home_page" class="form-label">Show on Home Page?</label>
                  <select class="form-select" id="home_page" name="home_page" required>
                    <option value="0" <?= $service->home_page==0?'selected':'' ?>>No</option>
                    <option value="1" <?= $service->home_page==1?'selected':'' ?>>Yes</option>
                  </select>
                </div>

                <!-- Position -->
                <div class="mb-3">
                  <label for="position" class="form-label">Position</label>
                  <input type="number" class="form-control" id="position" name="position" value="<?= $service->position ?>">
                </div>

                <!-- Meta Description -->
                <div class="mb-3">
                  <label for="meta_description" class="form-label">Meta Description</label>
                  <textarea class="form-control" id="meta_description" name="meta_description"><?= $service->meta_description ?></textarea>
                </div>

                <!-- Meta Keyword -->
                <div class="mb-3">
                  <label for="meta_keyword" class="form-label">Meta Keyword</label>
                  <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="<?= $service->meta_keyword ?>">
                </div>

                <!-- Meta Title -->
                <div class="mb-3">
                  <label for="meta_title" class="form-label">Meta Title</label>
                  <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $service->meta_title ?>">
                </div>

                <!-- Created By -->
                <div class="mb-3">
                  <label for="created_by" class="form-label">Created By (User ID)</label>
                  <input type="number" class="form-control" id="created_by" name="created_by" value="<?= $service->created_by ?>" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Service</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php $this->load->view('admin/partials/footer.php'); ?>

<!-- Bootstrap CSS & JS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Summernote CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

<script>
$(document).ready(function(){

  // Summernote
  $('#description').summernote({
    height: 300,
    callbacks: {
      onImageUpload: function(files) {
        for(let i = 0; i < files.length; i++){
          uploadSummernoteImage(files[i]);
        }
      },
      onMediaDelete: function(target) {
        deleteSummernoteImage(target[0].src);
      }
    }
  });

  $('#description').summernote('code', `<?= addslashes($service->description) ?>`);

  function uploadSummernoteImage(file){
    let data = new FormData();
    data.append('file', file);
    $.ajax({
      url: "<?= base_url('admin/service_admin/summernote_image'); ?>",
      type: "POST",
      data: data,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(res){
        if(res.url) $('#description').summernote('insertImage', res.url);
        else alert('Image upload failed!');
      }
    });
  }

  function deleteSummernoteImage(src){
    $.ajax({
      url: "<?= base_url('admin/service_admin/summernote_image_delete'); ?>",
      type: "POST",
      data: {src: src},
      success: function(res){ console.log(res); }
    });
  }

    // Preview Featured Image
  $('#featured_image_file').change(function(e){
    let reader = new FileReader();
    reader.onload = function(e){
      $('#featured_image_preview').attr('src', e.target.result).show();
    }
    reader.readAsDataURL(this.files[0]);
  });

  // Preview Banner Image
  $('#banner_image_file').change(function(e){
    let reader = new FileReader();
    reader.onload = function(e){
      $('#banner_image_preview').attr('src', e.target.result).show();
    }
    reader.readAsDataURL(this.files[0]);
  });

  // Form submit
  $("#serviceForm").on("submit", function(e){
    e.preventDefault();
    let descriptionHtml = $('#description').summernote('code');
    let formData = new FormData(this);
    formData.set('description', descriptionHtml);

    $.ajax({
      url: "<?= base_url('admin/service_admin/update/'.$service->id) ?>",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function(res){
        if(res.status==400){
          $("#msg").html('<div class="alert alert-danger">'+res.msg+'</div>');
        } else {
          $("#msg").html('<div class="alert alert-success">'+res.msg+'</div>');
        }
        setTimeout(function(){ $("#msg").fadeOut("slow"); },3000);
      },
      error: function(){
        $("#msg").html('<div class="alert alert-danger">Something went wrong!</div>');
        setTimeout(function(){ $("#msg").fadeOut("slow"); },3000);
      }
    });
  });

});
</script>
