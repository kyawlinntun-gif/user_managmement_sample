<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Post</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }
    a {
      text-decoration: none;
    }
    body {
      background-color: #f4f4f4;
      padding: 20px;
    }
    .header {
      display: flex;
      justify-content: flex-end;
      padding: 10px;
      background: #333;
    }

    .logout-btn {
      background: red;
      color: white;
      border: none;
      padding: 8px 15px;
      cursor: pointer;
      border-radius: 5px;
      font-size: 16px;
    }
    .logout-btn:hover {
      background: darkred;
    }
    .container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      /* Four cards in a row */
      gap: 20px;
      margin-top: 20px;
    }
    .card {
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 5px;
    }
    .card h3 {
      margin: 10px 0;
      font-size: 18px;
      color: #333;
    }
    .card p {
      font-size: 14px;
      color: #666;
    }
    /* Responsive */
    @media (max-width: 1024px) {
      .container {
        grid-template-columns: repeat(2, 1fr);
        /* Two cards per row on smaller screens */
      }
    }
    @media (max-width: 600px) {
      .container {
        grid-template-columns: repeat(1, 1fr);
        /* One card per row on mobile */
      }
    }
  </style>
</head>
<body>
  <div class="header">
    <a href="/logout" class="logout-btn">Logout</a href="/logout">
  </div>
  <div class="container">
    <?php if(count($posts) > 0): ?>
      <?php foreach($posts as $post): ?>
      <div class="card">
        <img src="<?= $post['image'] ?>" alt="<?= $post['post_name'] ?>">
        <h3><?= $post['post_name']; ?></h3>
        <p><?= $post['description'] ?></p>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</body>
</html>