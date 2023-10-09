const tabs = document.querySelectorAll('.tab');

tabs.forEach(tab => {
    tab.addEventListener('click', (e) => {
        e.preventDefault();
        const tabName = tab.getAttribute('data-tab');
        setActiveTab(tabName);
        loadTabContent(tabName);
    });
});

function handleTabClick(event) {
    if (!event.target.classList.contains('tab')) return;

    event.preventDefault();

    const tabName = event.target.getAttribute('data-tab');
    setActiveTab(tabName);
    loadTabContent(tabName);
}

function setActiveTab(tabName) {
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active-tab');
    });
    const activeTab = document.querySelector(`[data-tab="${tabName}"]`);
    activeTab.classList.add('active-tab');
}

// Get content containers
const profileContainer = document.getElementById("profile-container");
const favoritesContainer = document.getElementById("favorites-container");
const reviewsContainer = document.getElementById("reviews-container");

// Function to show/hide containers based on tab clicks
function showProfile() {
    profileContainer.style.display = "block";
    favoritesContainer.style.display = "none";
    reviewsContainer.style.display = "none";
}

function showFavorites() {
    profileContainer.style.display = "none";
    favoritesContainer.style.display = "flex";
    reviewsContainer.style.display = "none";
}

function showReviews() {
    profileContainer.style.display = "none";
    favoritesContainer.style.display = "none";
    reviewsContainer.style.display = "block";
}

async function userFavAndReviewHandler(link) {
    try
    {
        const httpClient = new HttpClient();
        httpClient.get(link).then(
            (response) => {
                if (response.status === 200) {
                    const responseData = response.data;
                    if (link === "/my-favorites")
                    {
                        updateFavorites(responseData['films'])
                    }
                    else if (link === "/my-reviews")
                    {
                        updateReviews(responseData['reviews'], responseData['username'])
                    }
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

function updateFavorites(films) {
    favoritesContainer.innerHTML = ""

    favoritesContainer.innerHTML = films.map((film) => `
        <div class='film-card'>
            <div class='film-image'></div>
            <div class='film-title'>${film.title}</div>
        </div>
    `).join('');
}

function updateReviews(reviews, username) {
    reviewsContainer.innerHTML = '';

    for (const review of reviews) {
        const { rating, notes, published_time} = review;
        const timestamp = Date.parse(published_time);
        const formatted_time = new Date(timestamp).toLocaleString('en-US', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric'
        });

        const reviewElement = document.createElement('div');
        reviewElement.classList.add('review');

        reviewElement.innerHTML = `
            <form class='review-form'>
                <div class='review-group'>
                    <div class='review-info'>
                        <div class='loop'>
                            ${getRatingStars(rating)}
                        </div>
                        <p>by ${username}</p>
                    </div>
                    <h3 class='review-result'>${notes}</h3>
                    <h3 class='time'>${formatted_time}</h3>
                </div>
            </form>
        `;

        reviewsContainer.appendChild(reviewElement);
    }
}

function getRatingStars(rating) {
    let stars = '';
    for (let i = 0; i < 5; i++) {
        stars += `<span class="icon-rating ${i < rating ? 'active' : ''}">★</span>`;
    }
    return stars;
}

async function loadTabContent(tabName) {
    switch (tabName) {
        case 'profile':
            showProfile();
            break;
        case 'favorites':
            await userFavAndReviewHandler("/my-favorites");
            showFavorites();
            break;
        case 'reviews':
            await userFavAndReviewHandler("/my-reviews");
            showReviews();
            break;
        default:
            break;
    }
}

// Initially load the content for the active tab
const initialActiveTab = document.querySelector('.active-tab');
const initialTabName = initialActiveTab.getAttribute('data-tab');
loadTabContent(initialTabName);