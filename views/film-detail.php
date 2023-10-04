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
        </div>
        <div class='submit-btn'>
            <button type='submit'>Submit Review</button>
        </div>
    </form>
</div>

<div class='insert-review'>
    <h2>What people say</h2>
    <h3>
    <?php 
    foreach ($reviews as $review) {
        $rating = $review->rating;
        $notes = $review->notes;
        $film_id = $review->film_id;
        $published_time = $review->published_time;
        $timestamp = strtotime($published_time);
        $formatted_time = date("j F Y H:i", $timestamp);
        $user_id = $review->user_id;
    ?>
    </h3>
    <form class='review-form' method='get'>
        <div class='review-group'>
            <div class='review-info'>
                <div class='loop'>
                    <?php 
                    for ($i=0; $i<5; $i++) {
                        if ($i < $rating) {
                            echo '<span class="icon-rating">★</span>';
                        } else {
                            echo '<span class="icon-rating-non">★</span>';
                        }
                    }
                    ?>
                </div>
                <p?>by </p>
                <!-- <?php
                // $user = $this->service->getById($film_id);
                // $username = $user->$username;
                // $data = getById($user_id);
                // $username = $data->$username;
                // echo "<span>$username</span>"
                // Cari nama user dengan user_id
                ?></p> -->
            </div>
            <h3 class='review-result'><?php echo $notes; ?></h3>
            <h3 class='time'><?php echo $formatted_time; ?></h3>
            
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