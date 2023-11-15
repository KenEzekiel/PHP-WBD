<div class='header'>
    <h1>Film List</h1>
</div>
<div class="film-page-container">
    <div class="search-filter">
        <div class="search-bar" id="search-bar">
            <input type="text" id="search-input" placeholder="Search film title or director">
        </div>

        <div class="sort-filter">
            <select id="sort-by">
                <option value="title">Sort by Title</option>
                <option value="released_year">Sort by Released Year</option>
            </select>

            <select id="sort-order">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>

            <select id="filter-genre">
                <option value="all">All Genre</option>
                <?php
                if (isset($data['genres'])) {
                    foreach ($data['genres'] as $genre) {
                        echo "<option value='$genre'>$genre</option>";
                    }
                }
                ?>
            </select>

            <select id="filter-year">
                <option value="all">All Released Year</option>
                <?php
                if (isset($data['released_years'])) {
                    foreach ($data['released_years'] as $year) {
                        echo "<option value='$year'>$year</option>";
                    }
                }
                ?>
            </select>


        </div>
        <?
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            echo "<a href='/add-film'><button class='button'>add film</button></a>";
        }
        ?>
    </div>



    <div class="film-card-container" id="film-card-list">
        <?php
        if (isset($data['films'])) {
            foreach ($data['films'] as $film) {
                echo "
                <a href='/film-details?film_id=$film->film_id'>
                <div class='film-card'>
                    
                    <div class='film-image' style='background-image: url(public/$film->image_path);'></div>
                    <div class='film-title'> $film->title </div>
                    
                </div>
                </a>";
            }
        }
        ?>
    </div>

    <div id="pagination-data" data-total-pages="<?php echo $data['total_page']; ?>">

    </div>
    <div id="pagination-container">

    </div>

    <script defer src="/public/js/httpClient.js"></script>
    <script defer src="/public/js/utils.js"></script>
    <script defer src="/public/js/filmList.js"></script>
</div>