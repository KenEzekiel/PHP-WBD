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
          <div class='buttons-form'>
          <form method='post'>
            <input type='hidden' name='action' value='edit'>
            <input type='hidden' name='user_id' value='$user->user_id'>
            <button type='submit' class='button-cancel'>Edit</button>
          </form>
          <form method='post'>
            <input type='hidden' name='action' value='delete'>
            <input type='hidden' name='user_id' value='$user->user_id'>
            <button type='submit' class='button-delete'>Delete</button>
          </form>
          </div>
        </td>
      </tr>";
    }
    ?>
  </table>
</div>