<?php view('auth.layouts.header', ['title' => 'User management sample | Home page']); ?>
<div class="container position-sticky z-index-sticky top-0">
  <div class="home">
    <div class="row">
      <div class="col-12">
        <?php view('auth.layouts.nav'); ?>
        <?php if(count($products) > 0): ?>
          <?php foreach($products as $product): ?>
          <div class="card">
            <img src="<?= assets('/assets/upload/') . $product['image'] ?>" alt="<?= $product['name'] ?>">
            <h3><?= $product['name']; ?></h3>
            <p><?= $product['description'] ?></p>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php view('auth.layouts.footer'); ?>