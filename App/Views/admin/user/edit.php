<?php view('admin.layouts.header', ['title' => 'Admin Dashboard']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">All Users / Edit user</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="row">
              <div class="col-md-6 offset-md-2">
                <?php if(isset($user)): ?>
                <form role="form" method="POST" action="/admin/users/<?= $user['user_id']; ?>">
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Name" value="<?= isset($_SESSION['user_update']['name']) ? $_SESSION['user_update']['name']  : $user['name']; ?>" name="name">
                  </div>
                  <?php if (getValidationError('name', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('name', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['name']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="email" placeholder="Email" class="form-control" value="<?= isset($_SESSION['user_update']['email']) ? $_SESSION['user_update']['email'] : $user['email']; ?>" name="email">
                  </div>
                  <?php if (getValidationError('email', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('email', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['email']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <select name="role_id" id="role_id" class="form-control">
                      <?php foreach($roles as $role): ?>
                        <option value="<?= $role['role_id']; ?>" <?= (isset($_SESSION['role_id']) ? $_SESSION['role_id'] : $user['role_id']) === $role['role_id'] ? 'selected' : ''; ?>><?= $role['role_name']; ?></option>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['user_update']); ?>
                    </select>
                  </div>
                  <?php if (getValidationError('role_id', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('role_id', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['role_id']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Update</button>
                  </div>
                </form>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php view('admin.layouts.footer'); ?>