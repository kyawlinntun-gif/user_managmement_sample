<?php view('admin.layouts.header', ['title' => 'User management sample | Create admin user']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">All Admin Users / Create admin user</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="row">
              <div class="col-md-6 offset-md-2">
              <?php if(isset($_SESSION['fail'])): ?>
                <div class="alert alert-danger text-white mt-4 mx-3"><?= $_SESSION['fail']; ?></div>
                <?php unset($_SESSION['fail']); ?>
              <?php endif; ?>
                <form role="form" method="POST" action="/admin/users/create">
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Name" value="<?= isset($_SESSION['user_create']['name']) ? $_SESSION['user_create']['name']  : ''; ?>" name="name">
                  </div>
                  <?php if (getValidationError('name', 'user_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('name', 'user_create'); ?>
                      <?php unset($_SESSION['errors']['user_create']['name']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Username" value="<?= isset($_SESSION['user_create']['username']) ? $_SESSION['user_create']['username']  : ''; ?>" name="username">
                  </div>
                  <?php if (getValidationError('username', 'user_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('username', 'user_create'); ?>
                      <?php unset($_SESSION['errors']['user_create']['username']); ?>
                    </span>
                  <?php endif; ?>
                  <h5>Roles</h5>
                  <div class="form-check">
                  <?php foreach ($roles as $role) : ?>
                    <label>
                        <input type="radio" name="role_id" value="<?= $role['id'] ?>" <?= isset($_SESSION['user_create']['role_id']) ?($_SESSION['user_create']['role_id'] == $role['id'] ? 'checked': '') : ''; ?>> <?= $role['name']; ?>
                    </label>
                  <?php endforeach; ?>
                  </div>
                  <?php if (getValidationError('role_id', 'user_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('role_id', 'user_create'); ?>
                      <?php unset($_SESSION['errors']['user_create']['role_id']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" placeholder="Phone" value="<?= isset($_SESSION['user_create']['phone']) ? $_SESSION['user_create']['phone']  : ''; ?>" name="phone">
                  </div>
                  <?php if (getValidationError('phone', 'user_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('phone', 'user_create'); ?>
                      <?php unset($_SESSION['errors']['user_create']['phone']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="email" placeholder="Email" class="form-control" value="<?= isset($_SESSION['user_create']['email']) ? $_SESSION['user_create']['email'] : ''; ?>" name="email">
                  </div>
                  <?php if (getValidationError('email', 'user_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('email', 'user_create'); ?>
                      <?php unset($_SESSION['errors']['user_create']['email']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <input type="password" placeholder="Password" class="form-control" name="password">
                  </div>
                  <?php if (getValidationError('password', 'user_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('password', 'user_create'); ?>
                      <?php unset($_SESSION['errors']['user_create']['password']); ?>
                    </span>
                  <?php endif; ?>
                  <div class="input-group input-group-outline mb-3">
                    <textarea name="address" id="address" placeholder="Please enter address" class="form-control"><?= isset($_SESSION['user_create']['address']) ? $_SESSION['user_create']['address'] : ''; ?></textarea>
                  </div>
                  <?php if (getValidationError('address', 'user_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('address', 'user_create'); ?>
                      <?php unset($_SESSION['errors']['user_create']['address']); ?>
                    </span>
                  <?php endif; ?>
                  <h5>Gender</h2>
                  <div class="form-check">
                    <label>
                        <input type="radio" name="gender" value="1" <?= isset($_SESSION['user_create']['gender']) ? ($_SESSION['user_create']['gender'] == 1 ? 'checked' : '') : ''; ?>> Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="0" <?= isset($_SESSION['user_create']['gender']) ? ($_SESSION['user_create']['gender'] == 0 ? 'checked' : '') : ''; ?>> Female
                    </label>
                  </div>
                  <?php if (getValidationError('gender', 'user_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('gender', 'user_create'); ?>
                      <?php unset($_SESSION['errors']['user_create']['gender']); ?>
                    </span>
                  <?php endif; ?>
                  <h5>Active</h5>
                  <div class="form-check">
                    <label>
                        <input type="radio" name="is_active" value="1" <?= isset($_SESSION['user_create']['is_active']) ? ($_SESSION['user_create']['gender'] == 1 ? 'checked' : '') : ''; ?>> Active
                    </label>
                    <label>
                        <input type="radio" name="is_active" value="0" <?= isset($_SESSION['user_create']['gender']) ? ($_SESSION['user_create']['gender'] == 0 ? 'checked' : '') : ''; ?>> Not Active
                    </label>
                  </div>
                  <?php if (getValidationError('is_active', 'user_create')): ?>
                    <span class="alert alert-danger form-control" role="alert">
                      <?= getValidationError('is_active', 'user_create'); ?>
                      <?php unset($_SESSION['errors']['user_create']['is_active']); ?>
                    </span>
                  <?php endif; ?>
                  <?php unset($_SESSION['user_create']); ?>
                  <div>
                    <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg mt-4 mb-0">Create</button>
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