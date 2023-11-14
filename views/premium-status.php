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