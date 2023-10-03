<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='/public/css/navbar.css'>
  <link rel='stylesheet' href='/public/css/styles.css'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <!-- <link rel="stylesheet" href="public/css/lib.css">
  <link rel="stylesheet" href="public/css/shared.css">
  <link rel="stylesheet" href="public/css/home.css"> -->
  <!-- <title>Document</title> -->
</head>

<body class='text'>
  <nav class='navbar'>
    <div class='logo'>
      <a href="/">
        <img src='/public/assets/logo.svg' alt='logo' width="45" height="45" draggable='false' />
      </a>
      <h1>Letterpaw</h1>
    </div>
    <ul class='nav-links'>
      <div class='menu'>
        <?php

        use app\Request;

        if (!isset($_SESSION['user_id'])) {
          if (Request::getURL() != "/login") {
            echo "<li><a href='/login'>Sign In  </a></li>";
          }
          if (Request::getURL() != "/register") {
            echo "<li><a href='/register'>Register</a></li>";
          }
        } else {
          $username = $_SESSION['username'];
          echo "<li><a href='/'>$username</a></li>";
          echo "<li><a href='/logout'>LOG OUT</a></li>";
        }
        ?>
        <li><a href='/'>Films</a></li>
        <li><a href='/'>Lists</a></li>
        <li><a href='/'>Members</a></li>
        <li><a href='/'>Journal</a></li>
      </div>
    </ul>
    <form method='get'>
      <div class='input-search'>
        <input class='' placeholder='Search...' />
        <img src='/public/assets/search-icon.svg' alt='search icon' />
      </div>
    </form>
  </nav>

  <main>
    <div class="content">
      <?= $__content ?>
    </div>
  </main>


</body>

</html>