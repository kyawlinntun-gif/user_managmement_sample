<?php view('auth.layouts.header', ['title' => 'User Management Sample | Login Page']); ?>
<div class="container position-sticky z-index-sticky top-0">
  <div class="row">
    <div class="col-12">
      <?php view('auth.layouts.nav'); ?>
    </div>
  </div>
</div>
<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom">
            <?php if(isset($_SESSION['fail'])): ?>
              <div class="alert alert-danger text-white mt-4 mx-3"><?= $_SESSION['fail']; ?></div>
              <?php unset($_SESSION['fail']); ?>
            <?php endif; ?>
            <div class="card-body">
              <form role="form" class="text-start" method="POST" action="/login">
                <div class="input-group input-group-outline my-3">
                  <input type="email" class="form-control" name="email" placeholder="Email"
                    <?php if (isset($_SESSION['email'])): ?>
                      value="<?= $_SESSION['email']; ?>"
                      <?php unset($_SESSION['email']) ?>
                    <?php endif; ?>>
                </div>
                <?php if (getValidationError('email', 'login')): ?>
                  <span class="alert alert-danger form-control" role="alert">
                    <?= getValidationError('email', 'login'); ?>
                    <?php unset($_SESSION['errors']['login']['email']); ?>
                  </span>
                <?php endif; ?>
                <div class="input-group input-group-outline mb-3">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <?php if (getValidationError('password', 'login')): ?>
                  <span class="alert alert-danger form-control" role="alert">
                    <?= getValidationError('password', 'login'); ?>
                    <?php unset($_SESSION['errors']['login']['password']); ?>
                  </span>
                <?php endif; ?>
                <!-- <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div> -->
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                </div>
                <p class="mt-4 text-sm text-center">
                  Don't have an account?
                  <a href="/register" class="text-primary text-gradient font-weight-bold">Sign up</a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100">
      <div class="container">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-12 col-md-6 my-auto">
            <div class="copyright text-center text-sm text-white text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              made with <i class="fa fa-heart" aria-hidden="true"></i> by
              <a href="https://www.creative-tim.com" class="font-weight-bold text-white" target="_blank">Kyaw Linn Tun</a>
              for a better web.
            </div>
          </div>
          <div class="col-12 col-md-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="#" class="nav-link text-white" target="_blank">Kyaw Linn Tun</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link text-white" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link text-white" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-white" target="_blank">License</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
</main>
<?php view('auth.layouts.footer'); ?>