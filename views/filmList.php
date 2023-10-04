<div>
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Search film title or director">
    </div>

    <div class="sort-filter">
        <select id="sort-by">
            <option value="title">Sort by Title</option>
            <option value="released-year">Sort by Released Year</option>
        </select>

        <select id="sort-order">
            <option value="ascending">Ascending</option>
            <option value="descending">Descending</option>
        </select>

        <select id="filter-genre">
            <option value="" disabled selected>Choose Genre</option>
            <?php
            if (isset($data['genres']))
            {
                foreach ($data['genres'] as $genre) {
                    echo "<option value='$genre'>$genre</option>";
                }
            }
            ?>
        </select>

        <select id="filter-year">
            <option value="" disabled selected>Choose Released Year</option>
            <?php
            if (isset($data['released_years']))
            {
                foreach ($data['released_years'] as $year) {
                    echo "<option value='$year'>$year</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="film-card-container">
        <?php
        if (isset($data['films']))
        {
            foreach ($data['films'] as $film) {
                echo "<div class='film-card'>
                    <div class='film-image' style='background-image: url($film->image_path);'></div>
                    <div class='film-title'> $film->title </div>
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
    <script></script>
</div>