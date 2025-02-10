<?php
use App\Models\AdminUser;
$getPermissionForUser = new AdminUser();
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand px-4 py-3 m-0" href="/" target="_blank">
      <img src="<?= assets('/assets/img/logo-ct-dark.png'); ?>" class="navbar-brand-img" width="26" height="26" alt="main_logo">
      <span class="ms-1 text-sm text-dark"><?= isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?></span>
    </a>
  </div>
  <hr class="horizontal dark mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/admin' ? 'active bg-gradient-dark text-white' : 'text-dark'; ?>" href="/admin">
          <i class="material-symbols-rounded opacity-5">dashboard</i>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <?php if($getPermissionForUser->hasFeature($_SESSION['user_id'], 'user')): ?>
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/admin/users' ? 'active bg-gradient-dark text-white' : 'text-dark'; ?>" href="/admin/users">
          <i class="material-symbols-rounded opacity-5">group</i>
          <span class="nav-link-text ms-1">Users</span>
        </a>
      </li>
      <?php endif; ?>
      <?php if($getPermissionForUser->hasFeature($_SESSION['user_id'], 'role')): ?>
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/admin/roles' ? 'active bg-gradient-dark text-white' : 'text-dark'; ?>" href="/admin/roles">
          <i class="material-symbols-rounded opacity-5">task</i>
          <span class="nav-link-text ms-1">Roles</span>
        </a>
      </li>
      <?php endif; ?>
      <?php if($getPermissionForUser->hasFeature($_SESSION['user_id'], 'permissions')): ?>
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/admin/permissions' ? 'active bg-gradient-dark text-white' : 'text-dark'; ?>" href="/admin/permissions">
          <i class="material-symbols-rounded opacity-5">license</i>
          <span class="nav-link-text ms-1">Permissions</span>
        </a>
      </li>
      <?php endif; ?>
      <?php if($getPermissionForUser->hasFeature($_SESSION['user_id'], 'features')): ?>
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/admin/features' ? 'active bg-gradient-dark text-white' : 'text-dark'; ?>" href="/admin/features">
          <i class="material-symbols-rounded opacity-5">search</i>
          <span class="nav-link-text ms-1">Features</span>
        </a>
      </li>
      <?php endif; ?>
      <?php if($getPermissionForUser->hasFeature($_SESSION['user_id'], 'product')): ?>
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/admin/products' ? 'active bg-gradient-dark text-white' : 'text-dark'; ?>" href="/admin/products">
          <i class="material-symbols-rounded opacity-5">productivity</i>
          <span class="nav-link-text ms-1">Products</span>
        </a>
      </li>
      <?php endif; ?>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="#" onclick="event.preventDefault(); document.getElementById('logoutAdminUser').submit();">
          <i class="material-symbols-rounded opacity-5">assignment</i>
          <span class="nav-link-text ms-1">Sign Out</span>
        </a>
        </a>
        <form action="/logout" method="POST" id="logoutAdminUser" class="d-none">
        </form>
      </li>
    </ul>
  </div>
</aside>