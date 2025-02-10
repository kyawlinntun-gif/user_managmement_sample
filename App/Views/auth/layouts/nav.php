<!-- Navbar -->
<nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
  <div class="container-fluid ps-2 pe-0">
    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="/">
      User management sample
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav nav-right">
        <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']): ?>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="/admin">
              <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="#" onclick="event.preventDefault(); document.getElementById('logoutAdminUser').submit();">
              <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
              Sign out
            </a>
            </a>
            <form action="/logout" method="POST" id="logoutAdminUser" class="d-none">
            </form>
          </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link me-2" href="/register">
            <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
            Sign Up
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="/login">
            <i class="fas fa-key opacity-6 text-dark me-1"></i>
            Sign In
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->