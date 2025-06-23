class MusicSearch extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
        this.shadowRoot.innerHTML = `
            <style>
                .Search-Container{
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 20px;
                }
                .search-input{
                    background: transparent;
                    background-size: 400% 400%; 
                    backdrop-filter: blur(10px);         
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    box-shadow: 0 8px 20px 0 rgba(0,0,0,0.37);
                    width: 300px;
                    padding: 10px 15px;
                    font-size: 16px;
                    border-radius: 25px;
                    outline: none;
                    transition: all 0.3s ease;
                    color: white;
                }
                .search-input:focus {
                    border-color: #6c5f8d;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                }
                @media (max-width: 768px) {
                    .search-input {
                        width: 90%; /* Occupy most of the screen width */
                    }
                }
            </style>
            <div class="Search-Container">
                <input type="text" class="search-input" placeholder="Search Artists" />
            </div>
            <div id="search-results"></div>
        `;
        this.searchInput = this.shadowRoot.querySelector('.search-input');
        this.searchResults = this.shadowRoot.querySelector('#search-results');

        this.searchInput.addEventListener('input', () => this.searchMusic(this.searchInput.value));
    }

    searchMusic(query) {
        if (query.trim() !== "") {
            fetch(`search_artist.php?query=${encodeURIComponent(query)}`)
                .then(response => response.text())
                .then(data => {
                    this.searchResults.innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        } else {
            this.searchResults.innerHTML = "";
        }
    }
}

customElements.define('music-search', MusicSearch);
