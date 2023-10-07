<h2 id="goBack"><a href="/films"><?php echo "Go back to films" ?></a></h2>
<div id="filmDetails">
    <img id="poster" src="<?php echo "public/" . $film->image_path?>" alt="<?php echo $film->title?> Poster">
    <video controls>
        <source src="<?php echo "public/" . $film->trailer_path?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <h1 id="title"><?php echo $film->title?></h1>
    <h2><?php echo "$film->released_year | Directed by $film->director | $film->genre"?></h2>
    <h3>Cast: <?php echo $film->cast?></h3>
    <p><?php echo $film->description?></p>

    <h1 id="peopleComment">What people say<h1>
</div>