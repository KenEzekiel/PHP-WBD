<div>
  <table class='user-list'>
    <tr>
      <th>User Id</th>
      <th>Username</th>
      <th>Email</th>
      <th>Role</th>
      <th>Actions</th>
    </tr>
    <?
    foreach ($users as $user) {
      echo
      "<tr class='user-card'>
        <td>
          $user->user_id
        </td>
        <td>
          $user->username
        </td>
        <td>
          $user->email
        </td>
        <td>
          $user->role
        </td>
        <td>
          <form method='post'>
            <input type='hidden' name='action' value='edit'>
            <input type='hidden' name='user_id' value='$user->user_id'>
            <button type='submit'>edit</button>
          </form>
        </td>
        <td>
          <form method='post'>
            <input type='hidden' name='action' value='delete'>
            <input type='hidden' name='user_id' value='$user->user_id'>
            <button type='submit'>delete</button>
          </form>
        </td>
      </tr>";
    }
    ?>

</div>
<div class="overlay">
  <div class="popup">
    <h1 class="header-title">Are you sure?</h1>
    <p class="error-msg"><?php if (isset($errorMsg)) {
                            echo "$errorMsg";
                          } ?></p>
    <p>User <?= $username ?> will be deleted forever!</p>
    <div>
      <form method='post' enctype="multipart/form-data">
        <input type='hidden' name='delete_confirm' value='yes'>
        <button type="submit" class="button-delete">Delete</button>
      </form>
      <form method='post' enctype="multipart/form-data">
        <input type='hidden' name='delete_confirm' value='no'>
        <button type="submit" class="button-cancel">Cancel</button>
      </form>
    </div>
  </div>
</div>