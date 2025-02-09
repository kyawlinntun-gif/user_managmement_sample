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
              <h6 class="text-white text-capitalize ps-3">All Users</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Permission</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(count($users) > 0): ?>
                    <?php foreach($users as $user): ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= ucfirst($user['name']); ?></h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?= $user['email']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success"><?= $user['role_name'] ?></span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success"><?= $user['permission_name'] ?></span>
                        </td>
                        <td class="align-middle">
                          <a href="/admin/users/<?=$user['user_id']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                          </a>
                          <?php if($_SESSION['user_id'] !== $user['user_id']): ?>
                          <form action="/admin/users/<?= $user['user_id']; ?>/delete" method="POST">
                            <input type="submit" value="Delete" class="text-secondary font-weight-bold text-xs">
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