<?php view('admin.layouts.header', ['title' => 'All Posts / Create post']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">All Posts / Create post</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="row">
              <div class="col-md-6 offset-md-2">
              <form role="form" method="POST" action="/admin/posts/create" enctype="multipart/form-data">
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Post Name" value="<?= isset($_SESSION['post_create']['post_name']) ? $_SESSION['post_create']['post_name']  : ''; ?>" name="post_name">
                  </div>
                  <?php if (getValidationError('post_name', 'post_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('post_name', 'post_create'); ?>
                      <?php unset($_SESSION['errors']['post_create']['post_name']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <textarea name="description" id="description" class="form-control" placeholder="Description"><?= isset($_SESSION['post_create']['description']) ? $_SESSION['post_create']['description']  : ''; ?></textarea>
                  </div>
                  <?php if (getValidationError('description', 'post_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('description', 'post_create'); ?>
                      <?php unset($_SESSION['errors']['post_create']['description']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="file" name="image" id="image" class="form-control">
                    <?php unset($_SESSION['post_create']); ?>
                  </div>
                  <?php if (getValidationError('image', 'post_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('image', 'post_create'); ?>
                      <?php unset($_SESSION['errors']['post_create']['image']); ?>
                    </span>
                  <?php endif; ?>
                  <div>
                    <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg mt-4 mb-0">Save</button>
                  </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php view('admin.layouts.footer'); ?>