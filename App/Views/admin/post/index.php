<?php
use App\Models\User;
$user = new User();
?>
<?php view('admin.layouts.header', ['title' => 'All Posts']) ?>
<?php view('admin.layouts.asidebar') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php view('admin.layouts.navbar') ?>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">All Posts<a href="/admin/posts/create" class="btn btn-primary ms-4">Create</a></h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                <?php if ($user->hasAnyPermission(['read_posts'])): ?>
                <?php if(count($posts) > 0): ?>
                    <?php foreach($posts as $post): ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= ucfirst($post['post_name']); ?></h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?= $post['description']; ?></p>
                        </td>
                        <td>
                          <img src="<?= assets('assets/upload/' . $post['image']) ?>" alt="">
                        </td>
                        <td class="align-middle">
                          <a href="/admin/posts/<?=$post['post_id']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit post">
                            Edit
                          </a>
                          <span>
                          <?php if ($user->hasAnyPermission(['delete_posts'])): ?>
                          <form action="/admin/posts/<?= $post['post_id']; ?>/delete" method="POST">
                            <input type="submit" value="Delete" class="text-secondary font-weight-bold text-xs">
                          </form>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
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