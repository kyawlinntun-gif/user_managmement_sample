<?php view('admin.layouts.header', ['title' => 'Admin Dashboard']) ?>
<?php view('admin.layouts.asidebar') ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php view('admin.layouts.navbar') ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-1">
          <div class="card">
            <div class="card-header">
              <h2>Admin Profile</h2>
            </div>
            <div class="card-body">
              <form action="#">
                <div class="mb-3">
                  <label for="name">Name:</label>
                  <input type="text" name="name" id="name" placeholder="<?= $data['name'] ?>">
                </div>
                <div class="mb-3">
                  <label for="email">Email:</label>
                  <input type="text" name="email" id="email" placeholder="<?= $data['email']; ?>">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
<?php view('admin.layouts.footer'); ?>