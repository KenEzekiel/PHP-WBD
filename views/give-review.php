<html>
<head>
    <link rel='stylesheet' href='/public/css/give-review.css'>
</head>
<body>
    <div class="background">
        
    </div>
    <div class='card'>
        <button class='close-button' onclick="closeCard()">X</button>
        <!-- Image of the movie -->
        <div class='movie-info'>
            <button class="back-btn">
                <img src='/public/assets/back-icon.svg' width='30' height='30' />
                 BACK
            </button>
            <img src='/public/assets/placeholder-image.svg' width='20rem' height='50rem'/>
        </div>
        <!-- Main Info -->
        <div class='review'>
            <form class='input-review'>
                <div class='select-movie'>
                    <label>I WATCHED...</label>
                    <select class='select-input'>
                        <option>--Please choose a movie--</option>
                        <option>a</option>
                        <option>a</option>
                        <option>a</option>
                        <option>a</option>
                    </select>
                </div>
                <input type="text" class='write-review' placeholder='Add a review...'>
            </form>
            <label>Rating</label>
            <form class="rating">
                <label>
                    <input type="radio" name="stars" value="1" />
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="2" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="3" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>   
                </label>
                <label>
                    <input type="radio" name="stars" value="4" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="5" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
            </form>
            <div class='save-button-conf'>
            <button class='save-btn'>
                SAVE
            </button>
            </div>
            </div>
        </div>
    </div>
</body>
</html>