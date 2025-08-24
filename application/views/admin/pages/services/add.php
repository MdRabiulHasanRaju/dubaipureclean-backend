<?php $this->load->view('admin/partials/header.php'); ?>
<?php $this->load->view('admin/partials/navbar.php'); ?>
<?php $this->load->view('admin/partials/sidebar.php'); ?>

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs5.min.css" rel="stylesheet">

<style>
  div#msg {
    position: fixed;
    right: 0;
    bottom: 0;
    z-index: 9999;
  }
  img.preview-img{
    max-height: 150px;
    margin-top: 10px;
  }
</style>

<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Add New Service</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?=base_url("admin");?>">Home</a></li>
            <li class="breadcrumb-item">Service Management</li>
            <li class="breadcrumb-item active">Add</li>
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
                      <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                    <?php endforeach; ?>
                  </select>
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
                  <label for="featured_image_file" class="form-label">Featured Image</label>
                  <input type="file" class="form-control" id="featured_image_file" name="featured_image_file" accept="image/*">
                  <img id="featured_image_preview" class="preview-img" style="display:none;">
                </div>

                <!-- Banner Image -->
                <div class="mb-3">
                  <label for="banner_image_file" class="form-label">Banner Image</label>
                  <input type="file" class="form-control" id="banner_image_file" name="banner_image_file" accept="image/*">
                  <img id="banner_image_preview" class="preview-img" style="display:none;">
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
                  <label for="home_page" class="form-label">Show on Home Page?</label>
                  <select class="form-select" id="home_page" name="home_page" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
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

<!-- Bootstrap CSS & JS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Summernote CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

<script>
$(document).ready(function(){

  // Init Summernote
  $('#description').summernote({
    height: 300,
    placeholder: 'Write description here...',
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
      ['fontname', ['fontname']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph', 'height']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video', 'hr']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ],
    callbacks: {
      onImageUpload: function(files) {
        for(let i=0; i < files.length; i++){
          uploadSummernoteImage(files[i]);
        }
      },
      onMediaDelete: function(target) {
        deleteSummernoteImage(target[0].src);
      }
    }
  });

  // Image upload handler
  function uploadSummernoteImage(file){
    let data = new FormData();
    data.append("file", file);
    $.ajax({
      url: "<?= base_url('admin/service_admin/summernote_image'); ?>",
      type: "POST",
      data: data,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(res){
        if(res.url){
          $('#description').summernote('insertImage', res.url);
        } else { alert('Image upload failed!'); }
      },
      error: function(){ alert('Something went wrong during upload.'); }
    });
  }

  // Delete Summernote image
  function deleteSummernoteImage(src){
    $.ajax({
      url: "<?= base_url('admin/service_admin/summernote_image_delete'); ?>",
      type: "POST",
      data: {src: src},
      success: function(res){ console.log(res); },
      error: function(){ console.log("Failed to delete image: "+src); }
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

  // AJAX form submit with file upload
  $("#serviceForm").on("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);
    formData.set('description', $('#description').summernote('code'));

    $.ajax({
      url: "<?= base_url('admin/service_admin/add') ?>",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(res){
        if(res.status == 400){
          $("#msg").html('<div class="alert alert-danger">'+res.msg+'</div>');
        } else {
          $("#msg").html('<div class="alert alert-success">Service Added Successfully!</div>');
          $("#serviceForm")[0].reset();
          $('#description').summernote('reset');
          $('#featured_image_preview, #banner_image_preview').hide();
        }

        setTimeout(function(){
          $("#msg").fadeOut("slow", function(){ $(this).html("").show(); });
        }, 3000);
      },
      error: function(){
        $("#msg").html('<div class="alert alert-danger">Something went wrong!</div>');
        setTimeout(function(){
          $("#msg").fadeOut("slow", function(){ $(this).html("").show(); });
        }, 3000);
      }
    });
  });

});
</script>
