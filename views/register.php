<div class="form-container">
  <h2 class="header-title">Register</h2>
  <p class="error-msg"><?php if (isset($errorMsg)) {
                          echo "$errorMsg";
                        } ?></p>
  <form class="form" method="post">
    <div class="form-group">
      <label for="username">Username</label>
      <br>
      <input class="input" type="text" id="username" name="username" placeholder="Username" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <br>
      <input class="input" type="text" id="email" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <br>
      <input class="input" type="password" id="password" name="password" placeholder="Password" required>
    </div>
    <div class="form-group">
      <label for="confirm-password">Confirm Password</label>
      <br>
      <input class="input" type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
    </div>
    <div class="form-group">
      <button class="button" type="submit">Register</button>
    </div>
  </form>
  <div class="nav-here">
    <p>Already have an account?</p>
    <a class="text-link" href="/login">Log In here</p>
  </div>
</div>