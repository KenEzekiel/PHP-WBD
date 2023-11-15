<div>
    <div class="premium-div">
        <h2>Become a premium member now!</h2>
        <div class="list">
            <h3>Benefits</h3>
            <hr>
            <br>
            <ul class="bullets">
                <li> > Create your own watchlist from your favorite movies!</li>
                <li> > See other users' recommendations in their watchlists!</li>
                <li> > Share your watchlists to the world!</li>
            </ul>
        </div>

    </div>
    <div class='message'>
        <p>
            <?php
            if (isset($msg)) {
                echo "<br><p>$msg</p><br>";
            }
            ?>
        </p>
    </div>
    <div class='button-container'>
        <? if ($registered == false) {
            echo "
                <form method='post'>
                    <input type='hidden' name='action' value='register'>
                    <button class='button' type='submit'>Register now!</button>
                </form>
                ";
        } else {
            echo "
            <form method='post'>
                <input type='hidden' name='action' value='cancel'>
                <button class='button-delete-update' type='submit'>Cancel Registration</button>
            </form>
                ";
        }  ?>
    </div>
</div>