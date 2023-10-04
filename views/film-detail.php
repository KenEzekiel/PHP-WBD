<html>
<head>
    <link rel='stylesheet' href='/public/css/film-detail.css'>
    <link rel='stylesheet' href='/public/css/styles.css'>
</head>
<body>
<div class='insert-review'>
    <h2>Write your review</h2>
    <p class='error-msg'><?php if (isset($errorMsg)) {
        echo "$errorMsg";
    } ?></p>
    <form class='review-form' method='post'>
        <div class='review-group'>
            <div class='stars'>
                <label>
                    <input type="radio" name="rating" value="1" />
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="2" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="3" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>   
                </label>
                <label>
                    <input type="radio" name="rating" value="4" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="5" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
            </div>
            <br>
            <input class='input' type='text' id='notes' name='notes' placeholder='Write review here...' required>
            <br>
            <div class='submit-btn'>
                <button type='submit'>Submit Review</button>
            </div>
        </div>
    </form>
</div>

<div class='insert-review'>
    <h2>What people say</h2>
    <?php 
    foreach ($reviews as $review) {
        $rating = $_GET['rating'];
        $notes = $_GET['notes'];
        echo $rating;
        echo $notes;
    ?>
    <form class='review-form' method='get'>
        <div class='review-group'>
            <br>
            <h2 class='input' type='text' id='notes' name='rating'></h2>
            <!-- <label name='rating'></label>
            <label name='notes'></label> -->
        </div>
    </form>
    <?php
    }
    ?>
</div>
</body>

</html>