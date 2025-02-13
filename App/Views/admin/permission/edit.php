<?php view('admin.layouts.header', ['title' => 'User management system | Edit permission']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">All Permissions / Edit permission</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="row">
              <div class="col-md-6 offset-md-2">
              <?php if(isset($_SESSION['fail'])): ?>
                <div class="alert alert-danger text-white mt-4 mx-3"><?= $_SESSION['fail']; ?></div>
                <?php unset($_SESSION['fail']); ?>
              <?php endif; ?>
              <form role="form" method="POST" action="/admin/permissions/<?= $permission['id']; ?>">
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Permission Name" value="<?= isset($_SESSION['permission_update']['permission_name']) ? $_SESSION['permission_update']['permission_name']  : $permission['name']; ?>" name="permission_name">
                  </div>
                  <?php if (getValidationError('permission_name', 'permission_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('permission_name', 'permission_update'); ?>
                      <?php unset($_SESSION['errors']['permission_update']['permission_name']); ?>
                    </span>
                  <?php endif; ?>
                  <div>
                  <h5>Features</h5>
                  <div class="form-check">
                  <?php foreach ($features as $feature) : ?>
                    <label>
                        <input type="radio" name="feature_id" value="<?= $feature['id'] ?>" <?= isset($_SESSION['permission_update']['feature_id']) ?($_SESSION['permission_update']['feature_id'] == $feature['id'] ? 'checked': '') : ($feature['id'] == $permission['feature_id'] ? 'checked' : ''); ?>> <?= $feature['name']; ?>
                    </label>
                  <?php endforeach; ?>
                  </div>
                  <?php if (getValidationError('feature_id', 'permission_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('feature_id', 'permission_update'); ?>
                      <?php unset($_SESSION['errors']['permission_update']['feature_id']); ?>
                    </span>
                  <?php endif; ?>
                  <?php unset($_SESSION['permission_update']); ?>
                    <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg mt-4 mb-0">Update</button>
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