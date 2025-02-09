<?php view('admin.layouts.header', ['title' => 'All Roles / Create role']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">All Roles / Create role</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="row">
              <div class="col-md-6 offset-md-2">
              <form role="form" method="POST" action="/admin/roles/create">
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Role Name" value="<?= isset($_SESSION['role_create']['role_name']) ? $_SESSION['role_create']['role_name']  : ''; ?>" name="role_name">
                  </div>
                  <?php if (getValidationError('role_name', 'role_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('role_name', 'role_create'); ?>
                      <?php unset($_SESSION['errors']['role_create']['role_name']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Description" value="<?= isset($_SESSION['role_create']['description']) ? $_SESSION['role_create']['description']  : ''; ?>" name="description">
                    <?php unset($_SESSION['role_create']); ?>
                  </div>
                  <?php if (getValidationError('description', 'role_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('description', 'role_create'); ?>
                      <?php unset($_SESSION['errors']['role_create']['description']); ?>
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