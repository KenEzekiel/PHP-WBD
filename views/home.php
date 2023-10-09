<div class='home'>
  <h1>
    letterpaw
  </h1>
  <p>write your opinion about films</p>
  <p><?php

      if (isset($_SESSION['user_id'])) {
        if ($_SESSION['role'] == "admin") {
          echo "<br> Hi, Admin!";
        } else {
          echo "<br> Hi, User!";
        }
      }
      if (isset($msg)) {
        echo "<br><br><p>$msg</p>";
      }
      ?></p>
  <div>
    <?php

    use app\Request;

    if (isset($_SESSION['user_id']) and !(Request::getURL() == "/")) {
      echo "<br> <a href=\"/\" class=\"text-link\">To Home</a>";
    }
    ?>
  </div>
</div>