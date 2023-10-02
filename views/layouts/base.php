<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='/public/css/navbar.css'>
  <!-- <link rel="stylesheet" href="public/css/lib.css">
  <link rel="stylesheet" href="public/css/shared.css">
  <link rel="stylesheet" href="public/css/home.css"> -->
  <!-- <title>Document</title> -->
</head>

<body>
    <nav class='navbar'>
        <div class='logo' href='/'>
            <img src='/public/assets/logo.svg' alt='logo' width="45" height="45" draggable='false'/>
            <h1>Letterpaw</h1>
        </div>
        <ul class='nav-links'>
            <div class='menu'>
                <li><a href='/'>SIGN IN</a></li>
                <li><a href='/'>CREATE ACCOUNT</a></li>
                <li><a href='/'>FILMS</a></li>
                <li><a href='/'>LISTS</a></li>
                <li><a href='/'>MEMBERS</a></li>
                <li><a href='/'>JOURNAL</a></li>
            </div>
        </ul>
        <form method='get'>
        <div class='input-search'>
            <input class='' placeholder='Search...'/>
            <img src='/public/assets/search-icon.svg' alt='search icon' />
        </div>
        </form>
    </nav>

  <main>
    <h1>hai!!!</h1>
    <?= $__content ?>
  </main>

</body>

</html>