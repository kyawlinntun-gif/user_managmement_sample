<?php

use App\Models\AdminUser;

 view('admin.layouts.header', ['title' => 'Admin Dashboard']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header text-center"><h3>Manage Setting</h3></div>
          <div class="card-body">
            <form action="/admin/update-all" method="POST">
              <?php foreach($admin_users as $admin_user): ?>
                <h5>
                  <?= $admin_user['admin_user_name'] ?> 
                  (Role: 
                  <select name="roles[<?= $admin_user['admin_user_id'] ?>]">
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>" <?= ($admin_user['role_id'] == $role['id']) ? 'selected' : '' ?>>
                            <?= $role['name'] ?>
                        </option>
                    <?php endforeach; ?>
                  </select>)
              </h5>
              <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                  <tr>
                      <th>Feature</th>
                      <th>Permissions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($features as $feature): ?>
                    <tr>
                        <td>
                          <?php 
                            $featureChecked = false;
                            $adminUserModel = new AdminUser();
                            $admin_user_permissions = $adminUserModel->getAdminUsersPermissions();
                            $userPermissions = [];
                            foreach($admin_user_permissions as $user) {
                              $userPermissions[$user['admin_user_id']][] = $user['permission_id'];
                            }
                            foreach ($permissions as $permission) {
                              if ($permission['feature_id'] == $feature['id'] && in_array($permission['id'], $userPermissions[$admin_user['admin_user_id']] ?? [])) {
                                $featureChecked = true;
                                break;
                              }
                            }
                            ?>
                          <label>
                              <input type="checkbox" class="feature-checkbox" 
                                    name="features[<?= $admin_user['admin_user_id'] ?>][]" 
                                    value="<?= $feature['id'] ?>"
                                    <?= $featureChecked ? 'checked' : '' ?> data-user="<?= $admin_user['admin_user_id'] ?>">
                              <?= $feature['name'] ?>
                          </label>
                        </td>
                        <td>
                            <?php foreach ($permissions as $permission): ?>
                                <?php if ($permission['feature_id'] === $feature['id']): ?>
                                    <label>
                                        <input type="checkbox" class="permission-checkbox" 
                                              name="permissions[<?= $admin_user['admin_user_id'] ?>][]" 
                                              value="<?= $permission['id'] ?>"
                                              <?= in_array($permission['id'], $userPermissions[$admin_user['admin_user_id']] ?? []) ? 'checked' : '' ?>
                                              data-feature="<?= $feature['id']; ?>" data-user="<?= $admin_user['admin_user_id'] ?>">
                                        <?= $permission['name'] ?>
                                    </label>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <hr>
              <?php endforeach; ?>
              <button type="submit">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".feature-checkbox").forEach(featureCheckbox => {
      featureCheckbox.addEventListener("change", function() {
        let userId = this.dataset.user;
        document.querySelectorAll(`.permission-checkbox[data-user='${userId}'][data-feature='${this.value}']`).forEach(permissionCheckbox => {
          permissionCheckbox.checked = this.checked;
        });
      });
    });
  });
</script>
<?php view('admin.layouts.footer'); ?>