function debounce(func, delay) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

document.getElementById('search-input').addEventListener('input', debounce(function() {
    const query = document.getElementById('search-input').value.trim().toLowerCase();
    const resultsContainer = document.getElementById('search-results');

    if (query.length === 0) {
        resultsContainer.innerHTML = ''; 
        return;
    }

    const params = new URLSearchParams();
    params.append('query', query);

    fetch('/posts/search', {
        method: 'POST',
        body: params,
    })
    .then(response => response.json())
    .then(data => {
        resultsContainer.innerHTML = '';
        if (data.error) {
            resultsContainer.innerHTML = `<div class="not-found"><p>${data.error}</p></div>`;
        } else if (data.length === 0) {
            resultsContainer.innerHTML = '<div class="not-found"><p>No found result.</p></div>';
        } else {
            data.forEach(d => {
                if (d.title.toLowerCase().includes(query) || 
                    d.description.toLowerCase().includes(query) || 
                    d.theme.toLowerCase().includes(query)) { // Añade esta condición para incluir el tema en la búsqueda
                    const postHtml = `
                        <div class="hoverbox">
                            <div class="box" id="results-list">
                                <a href="/users/show/id:${d.user_id}">
                                    <div class="user_card">
                                        <img src="/resources/img/user.png" alt="user" class="user-card-img">
                                        <p class="profile-card"><p>${d.username}</p></p>
                                        <p class="date">${new Date(d.created_at).toLocaleDateString()}</p> 
                                    </div>
                                </a>
                                <div class="line"></div>
                                <div class="vi">
                                    <a href="/posts/show/id:${d.id}">
                                        <div class="box" id="results-list-${d.id}">
                                            <div class="text">
                                                <h2>${d.title}</h2>
                                                <p class="text-description">${d.description}</p>
                                                <p class="text-theme"><i class="${d.theme_icon}"></i> ${d.theme}</p>
                                            </div>
                                    </a>
                                </div>
                                <center>
                                    <div class="actions">
                                        <div class="info">
                                            <a href="/posts/show/id:${d.id}">
                                                <center>
                                                    <p id="imagenDinamica"><i class='bx bx-show-alt'></i> Vision</p>
                                                </center>
                                            </a>
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>
                    `;
                    resultsContainer.innerHTML += postHtml;
                }
            });
            
        }
    })
    .catch(error => {
        console.error('Error fetching search results:', error);
    });
}, 300)); 
