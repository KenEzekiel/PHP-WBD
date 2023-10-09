<div>
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

    <div class="film-card-container" id="film-card-list">
        <?php
        if (isset($data['films'])) {
            foreach ($data['films'] as $film) {
                echo "<div class='film-card'>
                    <a href='/film-details?film_id=$film->film_id'>
                    <div class='film-image' style='background-image: url($film->image_path);'></div>
                    <div class='film-title'> $film->title </div>
                    </a>
                </div>";
            }
        }
        ?>
    </div>

    <div class="pagination">
        <button id="prev-page">Previous</button>
        <?php
        $totalPages = $data['total_page'];
        $currentPage = $_GET['page'] ?? 1;

        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i' id='current-page' class='page-number " . ($i == $currentPage ? 'active' : '') . "'>$i</a>";
        }
        ?>
        <button id="next-page">Next</button>
    </div>
    <script defer src="/public/js/httpClient.js"></script>
    <script defer src="/public/js/utils.js"></script>
    <script defer src="/public/js/filmList.js"></script>
</div>