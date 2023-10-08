<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='/public/css/navbar.css'>
  <link rel='stylesheet' href='/public/css/home.css'>
  <link rel='stylesheet' href='/public/css/styles.css'>
  <link rel='stylesheet' href='/public/css/filmList.css'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <!-- <link rel="stylesheet" href="public/css/lib.css">
  <link rel="stylesheet" href="public/css/shared.css">
  <link rel="stylesheet" href="public/css/home.css"> -->
  <title>Letterpaw</title>
</head>

<body class='text'>
  <nav class='navbar'>
    <div class='logo'>
      <a href="/">
        <img src='/public/assets/logo.svg' alt='logo' width="45" height="45" draggable='false' />
      </a>
      <h1>letterpaw</h1>
    </div>
    <ul class='nav-links menu'>
      <li class='menu-item' id='home'><a href='/'>Home</a></li>
      <li class='menu-item'><a href='/films'>Films</a></li>

      <?php

      use app\Request;

      if (!isset($_SESSION['user_id'])) {
        if (Request::getURL() != "/login") {
          echo "<li class='menu-item'><a href='/login'>Sign In</a></li>";
        }
        if (Request::getURL() != "/register") {
          echo "<button class='reg-button'><a href='/register'>Register</a></button>";
        }
      } else {
        if ($_SESSION['role'] == 'admin') {
          echo "<li class='menu-item'><a href='/user-dashboard'>Users</a></li>";
        }
        $username = $_SESSION['username'];
        echo "<p class='profile'><a href='/profile'> <img src='/public/assets/person.svg' alt='user logo' width='43.2' height='20.7'></img> <span>$username</span></a></p>";
        echo "<button class='logout-button'><a href='/logout'>Logout</a></button>";
      }
      ?>

    </ul>

  </nav>

  <main>
    <div class="content">
      <?= $__content ?>
    </div>
  </main>


</body>

</html>