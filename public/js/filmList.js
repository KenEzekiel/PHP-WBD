const search_bar = document.getElementById("search-input");
const sort_by = document.getElementById("sort-by");
const sort_order = document.getElementById("sort-order");
const genre = document.getElementById("filter-genre");
const released_year = document.getElementById("filter-year");
const urlParams = new URLSearchParams(window.location.search);
const paginationData = document.getElementById("pagination-data");
let totalPageCount = paginationData.getAttribute("data-total-pages");
let currentPage = parseInt(urlParams.get("page")) || 1;
const film_cards = document.getElementById("film-card-list");

const utils = new Utils();
async function searchFilterHandler() {
  try {
    const httpClient = new HttpClient();
    const search = search_bar.value !== undefined ? search_bar.value : "";
    let url = `/search?q=${search_bar.value}&genre=${genre.value}&year=${released_year.value}&order=${sort_by.value}&sort=${sort_order.value}&page=${currentPage}`;

    httpClient.get(url).then((response) => {
      console.log(response);
      if (response.status === 200) {
        const responseData = response.data;
        updateFilmCards(responseData["films"]);
        totalPageCount = responseData["total_page"];
        generatePaginationLinks();
      } else {
        console.error("Error:", response);
      }
    });
  } catch (e) {
    console.error("Error: ", e);
  }
}

function generatePaginationLinks() {
  console.log(totalPageCount);
  const paginationContainer = document.getElementById("pagination-container");
  paginationContainer.innerHTML = "";

  const maxVisiblePages = 8; // Set the maximum number of visible pages
  const halfVisiblePages = Math.floor(maxVisiblePages / 2);

  let startPage = Math.max(currentPage - halfVisiblePages, 1);
  let endPage = Math.min(startPage + maxVisiblePages - 1, totalPageCount);

  if (endPage - startPage + 1 < maxVisiblePages) {
    startPage = Math.max(endPage - maxVisiblePages + 1, 1);
  }

  if (startPage > 1) {
    const firstPageLink = createPageLink(1, "First");
    paginationContainer.appendChild(firstPageLink);

    const ellipsis = createEllipsis();
    paginationContainer.appendChild(ellipsis);
  }

  for (let i = startPage; i <= endPage; i++) {
    const pageLink = createPageLink(i);
    paginationContainer.appendChild(pageLink);
  }

  if (endPage < totalPageCount) {
    const ellipsis = createEllipsis();
    paginationContainer.appendChild(ellipsis);

    const lastPageLink = createPageLink(totalPageCount, "Last");
    paginationContainer.appendChild(lastPageLink);
  }
}

function createPageLink(pageNumber, text = "") {
  const pageLink = document.createElement("a");
  pageLink.setAttribute("class", "page-number");
  pageLink.textContent = text || pageNumber;
  pageLink.href = `?page=${pageNumber}`;
  pageLink.classList.add("page-number");

  if (pageNumber === currentPage) {
    pageLink.setAttribute("class", "page-number active");
  }

  pageLink.addEventListener("click", (e) => {
    e.preventDefault();
    currentPage = pageNumber;
    searchFilterHandler();
  });

  return pageLink;
}

function createEllipsis() {
  const ellipsis = document.createElement("span");
  ellipsis.textContent = "...";
  ellipsis.classList.add("ellipsis");
  return ellipsis;
}

function updateFilmCards(films) {
  film_cards.innerHTML = "";

  film_cards.innerHTML = films
    .map(
      (film) => `
      <a href='/film-details?film_id=${film.film_id}'>
        <div class='film-card'>
            <div class='film-image' style="background-image: url('public/${film.image_path}');"></div>
            <div class='film-title'>${film.title}</div>
        </div>
      </a>
    `
    )
    .join("");
}

for (let i = 1; i <= totalPageCount; i++) {
  const pageLink = document.getElementById(`page-${i}`);
  if (pageLink) {
    pageLink.addEventListener("click", (e) => {
      e.preventDefault();
      currentPage = i;
      searchFilterHandler();
    });
  }
}

search_bar.addEventListener("input", utils.debounce(searchFilterHandler, 300));
sort_by.addEventListener("change", utils.debounce(searchFilterHandler, 300));
sort_order.addEventListener("change", utils.debounce(searchFilterHandler, 300));
genre.addEventListener("change", utils.debounce(searchFilterHandler, 300));
released_year.addEventListener(
  "change",
  utils.debounce(searchFilterHandler, 300)
);
generatePaginationLinks();
