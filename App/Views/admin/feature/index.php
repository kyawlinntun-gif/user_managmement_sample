<?php
use App\Models\AdminUser;
$getPermissionForUser = new AdminUser();
?>
<?php view('admin.layouts.header', ['title' => 'User management system | All Features']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">All Features<?php if($getPermissionForUser->hasPermission($_SESSION['user_id'], 'create', 'features')): ?><a href="/admin/features/create" class="btn btn-primary ms-4">Create</a><?php endif; ?></h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <?php if(isset($_SESSION['fail'])): ?>
              <div class="alert alert-danger text-white mt-4 mx-3"><?= $_SESSION['fail']; ?></div>
              <?php unset($_SESSION['fail']); ?>
            <?php endif; ?>
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(count($features) > 0): ?>
                    <?php foreach($features as $feature): ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $feature['name']; ?></h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                          <?php if($getPermissionForUser->hasPermission($_SESSION['user_id'], 'update', 'features')): ?>
                          <a href="/admin/features/<?=$feature['id']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit role">
                            Edit
                          </a>
                          <?php endif; ?>
                          <?php if($getPermissionForUser->hasPermission($_SESSION['user_id'], 'delete', 'features')): ?>
                          <a href="#" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete feature" onclick="event.preventDefault(); document.getElementById('deleteFeature<?=$feature['id'];?>').submit();">
                            Delete
                          </a>
                          <form action="/admin/features/<?= $feature['id']; ?>/delete" method="POST" id="deleteFeature<?=$feature['id']?>">
                          </form>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php view('admin.layouts.footer'); ?>