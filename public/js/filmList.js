const search_bar = document.getElementById("search-input")
const sort_by = document.getElementById("sort-by")
const sort_order = document.getElementById("sort-order")
const genre = document.getElementById("filter-genre")
const released_year = document.getElementById("filter-year")
const urlParams = new URLSearchParams(window.location.search);
let currentPage = parseInt(urlParams.get('page')) || 1;
const film_cards = document.getElementById("film-card-list")
const prev_page = document.getElementById("prev-page")
const next_page = document.getElementById("next-page")

const utils = new Utils()
async function searchFilterHandler() {
    try
    {
        const httpClient = new HttpClient();
        const search = search_bar.value !== undefined ? search_bar.value : "";
        let url = `/search?q=${search_bar.value}&genre=${genre.value}&year=${released_year.value}&order=${sort_by.value}&sort=${sort_order.value}&page=${currentPage}`

        httpClient.get(url).then(
            (response) => {
                console.log(response)
                if (response.status === 200) {
                    const responseData = response.data;
                    updateFilmCards(responseData['films']);
                } else {
                    console.error("Error:", response);
                }
            }
        )
    } catch (e)
    {
        console.error("Error: ", e)
    }
}

function updateFilmCards(films) {
    film_cards.innerHTML = ""

    film_cards.innerHTML = films.map((film) => `
        <div class='film-card'>
            <div class='film-image' style='background-image: url(${film.image_path});'></div>
            <div class='film-title'>${film.title}</div>
        </div>
    `).join('');
}


search_bar.addEventListener('change', utils.debounce(searchFilterHandler, 300));
sort_by.addEventListener('change', utils.debounce(searchFilterHandler, 300));
sort_order.addEventListener('change', utils.debounce(searchFilterHandler, 300));
genre.addEventListener('change', utils.debounce(searchFilterHandler, 300));
released_year.addEventListener('change', utils.debounce(searchFilterHandler, 300));
prev_page.addEventListener('click', utils.debounce(searchFilterHandler, 300));
next_page.addEventListener('click', utils.debounce(searchFilterHandler, 300));