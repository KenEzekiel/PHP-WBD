<div class="form-container">
  <h2 class="header-title">Update User</h2>
  <p class="error-msg"><?php if (isset($errorMsg)) {
                          echo "$errorMsg";
                        } ?></p>
  <form class="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="email">Email</label>
      <br>
      <input class="input" type="text" id="email" name="email" value="<?= $email ?>" required>
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <br>
      <input class="input" type="text" id="username" name="username" value="<?= $username ?>" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <br>
      <input class="input" type="password" id="password" name="password">
    </div>
    <div class="form-group">
      <label for="confirm-password">Confirm Password</label>
      <br>
      <input class="input" type="password" id="confirm-password" name="confirm-password">
    </div>
    <div class="form-group">
      <button class="button" ctype="submit">Update</button>
    </div>
  </form>
</div>