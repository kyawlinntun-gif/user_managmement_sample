<?php view('admin.layouts.header', ['title' => 'User management sample | Edit admin user']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">All Admin Users / Edit admin user</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="row">
              <div class="col-md-6 offset-md-2">
                <?php if(isset($_SESSION['fail'])): ?>
                  <div class="alert alert-danger text-white mt-4 mx-3"><?= $_SESSION['fail']; ?></div>
                  <?php unset($_SESSION['fail']); ?>
                <?php endif; ?>
                <?php if(isset($admin_user)): ?>
                <form role="form" method="POST" action="/admin/users/<?= $admin_user['id']; ?>">
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Name" value="<?= isset($_SESSION['user_update']['name']) ? $_SESSION['user_update']['name']  : $admin_user['name']; ?>" name="name">
                  </div>
                  <?php if (getValidationError('name', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('name', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['name']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Username" value="<?= isset($_SESSION['user_update']['username']) ? $_SESSION['user_update']['username']  : $admin_user['username']; ?>" name="username">
                  </div>
                  <?php if (getValidationError('username', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('username', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['username']); ?>
                    </span>
                  <?php endif; ?>
                  <h5>Roles</h5>
                  <div class="form-check">
                  <?php foreach ($roles as $role) : ?>
                    <label>
                        <input type="radio" name="role_id" value="<?= $role['id'] ?>" <?= $role['id'] == $admin_user['role_id'] ? 'checked' : ''; ?> required> <?= $role['name']; ?>
                    </label>
                  <?php endforeach; ?>
                  </div>
                  <?php if (getValidationError('role_id', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('role_id', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['role_id']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Phone" value="<?= isset($_SESSION['user_update']['phone']) ? $_SESSION['user_update']['phone']  : $admin_user['phone']; ?>" name="phone">
                  </div>
                  <?php if (getValidationError('phone', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('phone', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['phone']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="email" placeholder="Email" class="form-control" value="<?= isset($_SESSION['user_update']['email']) ? $_SESSION['user_update']['email'] : $admin_user['email']; ?>" name="email">
                  </div>
                  <?php if (getValidationError('email', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('email', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['email']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <textarea name="address" id="address" placeholder="Please enter address" class="form-control"><?= isset($_SESSION['user_update']['address']) ? $_SESSION['user_update']['address'] : $admin_user['address']; ?></textarea>
                  </div>
                  <?php if (getValidationError('address', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('address', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['address']); ?>
                    </span>
                  <?php endif; ?>
                  <h5>Gender</h2>
                  <div class="form-check">
                    <label>
                        <input type="radio" name="gender" value="1" <?= $admin_user['gender'] == 1 ? 'checked' : ''; ?> required> Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="0" <?= $admin_user['gender'] == 0 ? 'checked' : ''; ?> required> Female
                    </label>
                  </div>
                  <?php if (getValidationError('gender', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('gender', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['gender']); ?>
                    </span>
                  <?php endif; ?>
                  <h5>Active</h5>
                  <div class="form-check">
                    <label>
                        <input type="radio" name="is_active" value="1" <?= $admin_user['is_active'] == 1 ? 'checked' : ''; ?> required> Active
                    </label>
                    <label>
                        <input type="radio" name="is_active" value="0" <?= $admin_user['is_active'] == 0 ? 'checked' : ''; ?> required> Not Active
                    </label>
                  </div>
                  <?php if (getValidationError('is_active', 'user_update')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('is_active', 'user_update'); ?>
                      <?php unset($_SESSION['errors']['user_update']['is_active']); ?>
                    </span>
                  <?php endif; ?>
                  <?php unset($_SESSION['user_update']); ?>
                  <div>
                    <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg mt-4 mb-0">Update</button>
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