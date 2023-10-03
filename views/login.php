<div class="form-container">
  <h2 class="header-title">Login</h2>
  <p class="error-msg"><?php if (isset($errorMsg)) {
                          echo "$errorMsg";
                        } ?></p>
  <form class="form" method="post">
    <div class="form-group">
      <label for="username-email">Username or Email</label>
      <br>
      <input class="input" type="text" id="username" name="username-email" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <br>
      <input class="input" type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
      <button class="button" ctype="submit">Login</button>
    </div>
  </form>
</div>