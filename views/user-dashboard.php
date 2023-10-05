<div>
  <p class="error-msg"><?php if (isset($errorMsg)) {
                          echo "$errorMsg";
                        } ?></p>
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