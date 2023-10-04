<div>
  <h1>
    HOME <?php

          if (isset($Msg)) {
            echo "<p>$Msg</p>";
          }

          if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] == "admin") {
              echo "<br> Hi, Admin!";
            } else {
              echo "<br> Hi, User!";
            }
          }
          ?>
  </h1>
  <div>
    <?php

    use app\Request;

    if (isset($_SESSION['user_id']) and !(Request::getURL() == "/")) {
      echo "<br> <a href=\"/\">To Home</a>";
    }
    ?>
  </div>
</div>