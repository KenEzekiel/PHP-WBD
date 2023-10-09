<div class="form-container update-film">
  <h2 class="header-title">Update Film</h2>
  <p class="error-msg"><?php if (isset($errorMsg)) {
                          echo "$errorMsg";
                        } ?></p>
  <form class="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Title</label>
      <br>
      <input class="input" type="text" id="title" name="title" value="<?= $title ?>" required>
    </div>
    <div class="form-group">
      <label for="released-year">Released Year</label>
      <br>
      <input class="input" type="text" id="released-year" name="released-year" value="<?= $released_year ?>" required>
    </div>
    <div class="form-group">
      <label for="director">Director</label>
      <br>
      <input class="input" type="text" id="director" name="director" value="<?= $director ?>" required>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <br>
      <textarea class="input" type="text" id="description" name="description" required><?= $description ?></textarea>
    </div>
    <div class="form-group">
      <label for="cast">Cast</label>
      <br>
      <input class="input" type="text" id="cast" name="cast" value="<?= $cast ?>" required>
    </div>
    <div class="form-group">
      <label for="genre">Genre</label>
      <br>
      <input class="input" type="text" id="genre" name="genre" value="<?= $genre ?>" required>
    </div>
    <div class="form-group">
      <label for="image-path">Image</label>
      <br>
      <input class="input" type="file" id="image-path" name="image-path">
    </div>
    <div class="form-group">
      <label for="trailer-path">Trailer</label>
      <br>
      <input class="input" type="file" id="trailer-path" name="trailer-path">
    </div>
    <div class="form-group">
      <button class="button" ctype="submit">Update</button>
    </div>
  </form>
  <form class="form" method="post" enctype="multipart/form-data">
    <input type='hidden' name='action' value='delete'>
    <input type='hidden' name='film_id' value='$film_id'>
    <button type='submit' class='button-delete'>Delete</button>

  </form>
</div>
<div class="overlay">
  <div class="popup">
    <h1 class="header-title">Are you sure?</h1>
    <p class="error-msg"><?php if (isset($errorMsg)) {
                            echo "$errorMsg";
                          } ?></p>
    <p>Film <?= $title ?> will be deleted forever!</p>
    <div>
      <form method='post' enctype="multipart/form-data">
        <input type='hidden' name='delete_confirm' value='yes'>
        <button type="submit" class="button-delete  ">Delete</button>
      </form>
      <form method='post' enctype="multipart/form-data">
        <input type='hidden' name='delete_confirm' value='no'>
        <button type="submit" class="button-cancel">Cancel</button>
      </form>
    </div>
  </div>
</div>