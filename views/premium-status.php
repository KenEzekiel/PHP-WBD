<?php if (isset($_SESSION['role']) and $_SESSION['role'] == 'admin') { ?>
    <!-- ADMIN USERS -->
    <div class='premium-status-admin'>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($data["premium_users"])) foreach($data["premium_users"] as $user) { ?>
                    <tr>
                        <td><?php echo $user->userEmail; ?></td>
                        <td>
                            <?php if($user->premiumStatus == "ACCEPTED") { ?>
                                <form method="post" action="/cancel-premium">
                                    <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                                    <button type="submit">Cancel Premium</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        <br><p>Pending Users</p><br>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($data["pending_users"])) { ?>
                    <?php var_dump($data["pending_users"]); ?>
                    <?php if(is_array($data["pending_users"])) foreach($data["pending_users"] as $user) { ?>
                        <tr>
                            <td><?php echo $user->userEmail; ?></td>
                            <td>
                                <?php if($user->premiumStatus == "PENDING") { ?>
                                    <form method="post" action="/approve-premium">
                                        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                                        <button type="submit">Accept Premium</button>
                                    </form>
                                    <form method="post" action="/reject-premium">
                                        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                                        <button type="submit">Reject Premium</button>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } unset($data["pending_users"]);?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <!-- REGULAR USERS -->
    <div class='premium-status'>
        <h2 id="goBack"><a class='back-button' href="/films"><?php echo "< Films" ?></a></h2>
        <h1>Premium Status<h1>
        <br>
        <p>Current: <?php $result = $data["userStatus"]; echo $result;?></p>
        <br>
        <p>Click <a href="/premium-status">here</a> to refresh the page.</p>
        <?php if(isset($data["premiumCancelMessage"])) { ?>
            <p><?php echo $data["premiumCancelMessage"]; unset($data["premiumCancelMessage"]);?></p>
        <?php } ?>
        <?php 
        if($result == "REJECTED" || $result == "UNREGISTERED") { ?>
            <form method="post" action="/register-premium">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Register for Premium</button>
            </form>
        <?php } elseif($result == "PENDING") { ?>
            <div class="pending">
                <p>Your request is pending. Please wait for the admin to approve your request.</p>
                <p>Click <a href="/premium-status">here</a> to refresh the page.</p>
            </div>
        <?php } elseif($result == "ACCEPTED") { ?>
            <form method="post" action="/cancel-premium">
                <button type="submit">Cancel Premium</button>
            </form>
        <?php } ?>
    </div>
<?php } ?>