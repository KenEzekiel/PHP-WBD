<div class='details'>
    <h2 id="goBack"><a class='back-button' href="/films"><?php echo "< Films" ?></a></h2>
    <div id="filmDetails">
        <div class='media'>
            <img id="poster" src="<?php echo "public/" . $film->image_path ?>" alt="<?php echo $film->title ?> Poster">
            <video id="trailer" controls>
                <source src="<?php echo "public/" . $film->trailer_path ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <div class='card'>
            <div class='title-header'>
                <h1 id="title"><?php echo $film->title ?></h1>
                <button>
                    <image id='fav' src="/public/assets/favorite.svg"></image>
                </button>
            </div>

            <h2><?php echo "$film->released_year | Directed by $film->director | $film->genre" ?></h2>
            <div id="cast">
                <h3 id="castTitle">Cast: </h3>
                <p><?php echo $film->cast ?></p>
            </div>
            <p><?php echo $film->description ?></p>
        </div>

        <a id='link' href=<?= '/review?film_id=' . $film->film_id ?>>
            <h1>Reviews ></h1>
        </a>
    </div>
</div>