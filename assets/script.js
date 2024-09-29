const articles = [
    { title: 'The Conservation of Red Pandas', description: 'The efforts being made to protect red pandas from extinction and how you can help', image: 'animals-1852823_640.jpg' },
    { title: 'Capturing the Perfect Sunset', description: 'Tips and techniques for photographers and nature lovers alike on how to capture the perfect sunset shot in a forest setting', image: 'mountains-5946500_640.jpg' },
    { title: 'Article', description: 'Description', image: 'path/to/image3.jpg' },
    { title: 'Article', description: 'Description', image: 'path/to/image4.jpg' },
    { title: 'Article', description: 'Description', image: 'path/to/image5.jpg' },
    { title: 'Article', description: 'Description', image: 'path/to/image6.jpg' },

];

const articlesPerPage = 2;
let currentPage = 1;

function displayArticles() {
    const container = document.querySelector('.articles-container');
    const start = (currentPage - 1) * articlesPerPage;
    const end = start + articlesPerPage;
    const pageArticles = articles.slice(start, end);

    container.innerHTML = '';
    pageArticles.forEach(article => {
        const articleElement = document.createElement('article');
        articleElement.className = 'article-card';
        articleElement.innerHTML = `
            <img src="${article.image}" alt="${article.title}">
            <h3>${article.title}</h3>
            <p>${article.description}</p>
            <a href="#">Read More</a>
        `;
        container.appendChild(articleElement);
    });

    updatePagination();
}

function updatePagination() {
    const prevButton = document.getElementById('prev-page');
    const nextButton = document.getElementById('next-page');
    const currentPageSpan = document.getElementById('current-page');

    prevButton.disabled = currentPage === 1;
    nextButton.disabled = currentPage === Math.ceil(articles.length / articlesPerPage);
    currentPageSpan.textContent = `Page ${currentPage} of ${Math.ceil(articles.length / articlesPerPage)}`;
}

document.getElementById('prev-page').addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        displayArticles();
    }
});

document.getElementById('next-page').addEventListener('click', () => {
    if (currentPage < Math.ceil(articles.length / articlesPerPage)) {
        currentPage++;
        displayArticles();
    }
});

displayArticles();

document.getElementById('newsletter-form').addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    console.log(`Subscribed: ${email}`);
    alert('Thank you for subscribing!');
    document.getElementById('email').value = '';
});
