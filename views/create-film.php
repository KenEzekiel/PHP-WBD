<div class="form-container">
  <h2 class="header-title">Add Film</h2>
  <p class="error-msg"><?php if (isset($errorMsg)) {
                          echo "$errorMsg";
                        } ?></p>
  <form class="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Title</label>
      <br>
      <input class="input" type="text" id="title" name="title" required>
    </div>
    <div class="form-group">
      <label for="released-year">Released Year</label>
      <br>
      <input class="input" type="text" id="released-year" name="released-year" required>
    </div>
    <div class="form-group">
      <label for="director">Director</label>
      <br>
      <input class="input" type="text" id="director" name="director" required>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <br>
      <input class="input" type="text" id="description" name="description" required>
    </div>
    <div class="form-group">
      <label for="cast">Cast</label>
      <br>
      <input class="input" type="text" id="cast" name="cast" required>
    </div>
    <div class="form-group">
      <label for="genre">Genre</label>
      <br>
      <input class="input" type="text" id="genre" name="genre" required>
    </div>
    <div class="form-group">
      <label for="image-path">Image</label>
      <br>
      <input class="input" type="file" id="image-path" name="image-path" required>
    </div>
    <div class="form-group">
      <!-- $_FILES write to disk, filesystem, masukin ke public, terus ambil path nya yang di public
    
    move_uploaded_file, echo aja attr nya si file-->
      <label for="trailer-path">Trailer</label>
      <br>
      <input class="input" type="file" id="trailer-path" name="trailer-path" required>
    </div>
    <div class="form-group">
      <button class="button" ctype="submit">Add</button>
    </div>
  </form>
</div>