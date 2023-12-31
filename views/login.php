<div class="form-container">
  <h2 class="header-title">Letterpaw</h2>
  <p class="error-msg"><?php if (isset($errorMsg)) {
                          echo "$errorMsg";
                        } ?></p>
  <form class="form" method="post">
    <div class="form-group">
      <label for="username-email">Username or Email</label>
      <br>
      <input class="input" type="text" id="username" name="username-email" placeholder="Username or Email" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <br>
      <input class="input" type="password" id="password" name="password" placeholder="Password" required>
    </div>
    <div class="form-group">
      <button class="button" ctype="submit">Log In</button>
    </div>
  </form>
  <div class="nav-here">
    <p>Don't have account yet?</p>
    <a class="text-link" href="/register">Register here</p>
  </div>
</div>