<?php view('admin.layouts.header', ['title' => 'All Posts / Edit post']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">All Posts / Edit post</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="row">
              <div class="col-md-6 offset-md-2">
              <form role="form" method="POST" action="/admin/posts/<?= $post['post_id'] ?>" enctype="multipart/form-data">
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Post Name" value="<?= isset($_SESSION['post_update']['post_name']) ? $_SESSION['post_update']['post_name']  : $post['post_name']; ?>" name="post_name">
                  </div>
                  <?php if (getValidationError('post_name', 'post_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('post_name', 'post_update'); ?>
                      <?php unset($_SESSION['errors']['post_update']['post_name']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <textarea name="description" id="description" class="form-control" placeholder="Description"><?= isset($_SESSION['post_update']['description']) ? $_SESSION['post_update']['description']  : $post['description']; ?></textarea>
                  </div>
                  <?php if (getValidationError('description', 'post_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('description', 'post_update'); ?>
                      <?php unset($_SESSION['errors']['post_update']['description']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <img src="<?= isset($post['image']) ? '/assets/upload/' . $post['image'] : ''; ?>" alt="<?= $post['image'] ?>">
                    <?php unset($_SESSION['post_update']); ?>
                  </div>
                  <div>
                    <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg mt-4 mb-0">update</button>
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