<div>
    <div class="tab-container">
        <a href="/profile" class="tab active-tab" id="profile-tab" data-tab="profile">Profile</a>
        <a href="/my-favorites" class="tab" id="favorites-tab" data-tab="favorites">My Favorites</a>
        <a href="/my-reviews" class="tab" id="reviews-tab" data-tab="reviews">My Reviews</a>
    </div>

    <div id="profile-container">
        <div class="form-container">
            <h2 class="header-title">Profile</h2>
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
    </div>

    <div class="favorites-container">
        <div class="film-card-container" id="favorites-container"> </div>
    </div>

    <div class="reviews-container">
        <div class="review-card-container" id="reviews-container"> </div>
    </div>

    <script defer src="/public/js/httpClient.js"></script>
    <script defer src="/public/js/utils.js"></script>
    <script defer src="/public/js/profile.js"></script>
</div>

