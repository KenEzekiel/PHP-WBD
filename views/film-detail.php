<html>
<head>
    <link rel='stylesheet' href='/public/css/film-detail.css'>
    <link rel='stylesheet' href='/public/css/styles.css'>
</head>
<body>
<div class='insert-review'>
    <h2>Write your review</h2>
    <p class='error-msg'>
        <?php if (isset($errorMsg)) {
            echo $errorMsg;
        } ?>
    </p>
    <?php 
    if (!isset($user_review)) {
        echo '<form class="review-form" method="post">';
        echo '<div class="review-group">';
        echo '<div class="stars">';
        echo '<label>';
        echo '<input type="radio" name="rating" value="1" />';
        echo '<span class="icon">★</span>';
        echo '</label>';
        echo '<label>';
        echo '<input type="radio" name="rating" value="2" />';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '</label>';
        echo '<label>';
        echo '<input type="radio" name="rating" value="3" />';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '</label>';
        echo '<label>';
        echo '<input type="radio" name="rating" value="4" />';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '</label>';
        echo '<label>';
        echo '<input type="radio" name="rating" value="5" />';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '<span class="icon">★</span>';
        echo '</label>';
        echo '</div>';
        echo '<br>';
        echo '<input class="input" type="text" id="notes" name="notes" placeholder="Write review here..." required>';
        echo '<br>';
        echo '</div>';
        echo '<div class="submit-btn">';
        echo '<button type="submit">Submit Review</button>';
        echo '</div>';
        echo '</form>';
    } else {
        $rating = $user_review->rating;
        $notes = $user_review->notes;
        $film_id = $user_review->film_id;
        $published_time = $user_review->published_time;
        $timestamp = strtotime($published_time);
        $formatted_time = date("j F Y H:i", $timestamp);
        $user_id = $user_review->user_id;
        $username = $_SESSION['username'];
        // echo '<pre>';
        // var_dump($user_review);
        // echo '<pre>';
        echo '<form class="review-form" method="get">';
        echo '<div class="review-group">';
        echo '<div class="review-info">';
        echo '<div class="loop">';
        
        for ($i = 0; $i < 5; $i++) {
            if ($i < $rating) {
                echo '<span class="icon-rating">★</span>';
            } else {
                echo '<span class="icon-rating-non">★</span>';
            }
        }
        
        echo '</div>';
        echo '<p>by ' . $username . '</p>'; // Ubah $username sesuai kebutuhan Anda
        echo '</div>';
        echo '<h3 class="review-result">' . $notes . '</h3>';
        echo '<h3 class="time">' . $formatted_time . '</h3>';
        echo '</div>';
        echo '<div class="buttons">';
        echo '<div class="delete-btn">';
        echo '<button type="submit">Delete Review</button>';
        echo '</div>';
        echo '<div class="submit-btn">';
        echo '<button type="submit">Edit Review</button>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
    }
    ?>
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
        $username = $review->username;
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
                <p?>by <?php echo $username; ?></p>
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