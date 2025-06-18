// Données des pays
const countriesData = {
    france: {
        name: "France",
        flag: "🇫🇷",
        capital: "Paris",
        population: "67 millions",
        language: "Français",
        currency: "Euro",
        geography: "La France est connue pour ses paysages variés : des plages de la Côte d'Azur aux sommets des Alpes, en passant par les châteaux de la Loire.",
        culture: "Pays de la gastronomie, de l'art et de la mode. La France est célèbre pour ses fromages, ses vins et ses monuments comme la Tour Eiffel.",
        funFact: "La France possède le plus grand nombre de fuseaux horaires au monde (12) grâce à ses territoires d'outre-mer !"
    },
    japan: {
        name: "Japon",
        flag: "🇯🇵",
        capital: "Tokyo",
        population: "125 millions",
        language: "Japonais",
        currency: "Yen",
        geography: "Archipel de 6 852 îles, le Japon est situé dans l'océan Pacifique. Le pays est très montagneux avec de nombreux volcans.",
        culture: "Mélange unique de traditions anciennes et de modernité. Connu pour les samouraïs, les geishas, les mangas, les sushis et la technologie de pointe.",
        funFact: "Le Japon compte plus de 6 800 îles, mais seulement 430 sont habitées !"
    },
    egypt: {
        name: "Égypte",
        flag: "🇪🇬",
        capital: "Le Caire",
        population: "104 millions",
        language: "Arabe",
        currency: "Livre égyptienne",
        geography: "Situé en Afrique du Nord-Est, l'Égypte est traversé par le Nil, le plus long fleuve du monde. Le désert du Sahara couvre 90% du territoire.",
        culture: "Berceau de l'une des plus anciennes civilisations. Célèbre pour les pyramides, les pharaons, les hiéroglyphes et les momies.",
        funFact: "La Grande Pyramide de Gizeh était la plus haute construction humaine pendant plus de 3 800 ans !"
    },
    brazil: {
        name: "Brésil",
        flag: "🇧🇷",
        capital: "Brasília",
        population: "215 millions",
        language: "Portugais",
        currency: "Real brésilien",
        geography: "Plus grand pays d'Amérique du Sud, le Brésil abrite la forêt amazonienne, surnommée 'le poumon de la Terre'.",
        culture: "Connu pour le carnaval de Rio, la samba, la capoeira, le football et sa diversité culturelle exceptionnelle.",
        funFact: "L'Amazonie brésilienne produit 20% de l'oxygène mondial et abrite 10% de toutes les espèces connues !"
    },
    australia: {
        name: "Australie",
        flag: "🇦🇺",
        capital: "Canberra",
        population: "26 millions",
        language: "Anglais",
        currency: "Dollar australien",
        geography: "Île-continent entourée par les océans Indien et Pacifique. Paysages variés : déserts, forêts tropicales, montagnes et côtes.",
        culture: "Culture aborigène vieille de 65 000 ans, surf, barbecue et une faune unique avec kangourous, koalas et ornithorynques.",
        funFact: "L'Australie abrite 21 des 25 serpents les plus venimeux au monde, mais les décès par morsure sont très rares !"
    },
    canada: {
        name: "Canada",
        flag: "🇨🇦",
        capital: "Ottawa",
        population: "39 millions",
        language: "Anglais et Français",
        currency: "Dollar canadien",
        geography: "Deuxième plus grand pays du monde, le Canada s'étend de l'Atlantique au Pacifique avec de vastes forêts, lacs et montagnes.",
        culture: "Connu pour sa politesse, le sirop d'érable, le hockey sur glace et sa nature préservée. Pays multiculturel et bilingue.",
        funFact: "Le Canada possède plus de lacs que le reste du monde réuni - environ 2 millions de lacs !"
    }
};

// Variables globales
let currentFactIndex = 0;
const facts = document.querySelectorAll('.fact');
const dots = document.querySelectorAll('.dot');

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    initializeCountryCards();
    initializeFactCarousel();
    startFactRotation();
});

// Gestion des cartes de pays
function initializeCountryCards() {
    const countryCards = document.querySelectorAll('.country-card');
    
    countryCards.forEach(card => {
        card.addEventListener('click', function() {
            const countryCode = this.dataset.country;
            selectCountry(countryCode);
            
            // Animation de sélection
            countryCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
        });
        
        // Effet de survol amélioré
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.05)';
        });
        
        card.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(0) scale(1)';
            }
        });
    });
}

// Affichage des informations du pays
function selectCountry(countryCode) {
    const countryInfo = document.getElementById('countryInfo');
    const data = countriesData[countryCode];
    
    if (!data) return;
    
    // Animation de sortie
    countryInfo.style.opacity = '0';
    countryInfo.style.transform = 'translateX(-20px)';
    
    setTimeout(() => {
        countryInfo.innerHTML = `
            <div class="country-details">
                <h2>${data.flag} ${data.name}</h2>
                
                <div class="info-section">
                    <h3>🏛️ Informations générales</h3>
                    <p><strong>Capitale :</strong> ${data.capital}</p>
                    <p><strong>Population :</strong> ${data.population}</p>
                    <p><strong>Langue :</strong> ${data.language}</p>
                    <p><strong>Monnaie :</strong> ${data.currency}</p>
                </div>
                
                <div class="info-section">
                    <h3>🌍 Géographie</h3>
                    <p>${data.geography}</p>
                </div>
                
                <div class="info-section">
                    <h3>🎭 Culture</h3>
                    <p>${data.culture}</p>
                </div>
                
                <div class="info-section">
                    <h3>🤔 Le savais-tu ?</h3>
                    <p>${data.funFact}</p>
                </div>
            </div>
        `;
        
        // Animation d'entrée
        countryInfo.style.opacity = '1';
        countryInfo.style.transform = 'translateX(0)';
    }, 300);
}

// Gestion du carrousel de faits
function initializeFactCarousel() {
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showFact(index);
        });
    });
}

function showFact(index) {
    // Masquer le fait actuel
    facts[currentFactIndex].classList.remove('active');
    dots[currentFactIndex].classList.remove('active');
    
    // Afficher le nouveau fait
    currentFactIndex = index;
    facts[currentFactIndex].classList.add('active');
    dots[currentFactIndex].classList.add('active');
}

function nextFact() {
    const nextIndex = (currentFactIndex + 1) % facts.length;
    showFact(nextIndex);
}

function startFactRotation() {
    setInterval(nextFact, 4000); // Changer toutes les 4 secondes
}

// Effets visuels supplémentaires
function createFloatingElements() {
    const container = document.querySelector('.container');
    
    for (let i = 0; i < 5; i++) {
        const element = document.createElement('div');
        element.className = 'floating-element';
        element.style.cssText = `
            position: absolute;
            width: 4px;
            height: 4px;
            background: #8b5cf6;
            border-radius: 50%;
            opacity: 0.6;
            animation: float ${3 + Math.random() * 4}s ease-in-out infinite;
            left: ${Math.random() * 100}%;
            top: ${Math.random() * 100}%;
            z-index: -1;
        `;
        container.appendChild(element);
    }
}

// Animation de flottement pour les éléments décoratifs
const floatingAnimation = `
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-10px) rotate(120deg); }
        66% { transform: translateY(5px) rotate(240deg); }
    }
`;

// Ajouter l'animation CSS
const style = document.createElement('style');
style.textContent = floatingAnimation;
document.head.appendChild(style);

// Créer les éléments flottants
createFloatingElements();

// Effet de parallaxe léger au scroll
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallaxElements = document.querySelectorAll('.country-card, .fact-icon');
    
    parallaxElements.forEach((element, index) => {
        const speed = 0.5 + (index * 0.1);
        element.style.transform += ` translateY(${scrolled * speed * 0.1}px)`;
    });
});

// Messages d'encouragement aléatoires
const encouragements = [
    "Excellent choix d'explorateur ! 🌟",
    "Tu deviens un vrai globe-trotter ! ✈️",
    "Bravo, continue ton voyage ! 🗺️",
    "Quelle belle découverte ! 🎉",
    "Tu es un explorateur fantastique ! 🧭"
];

function showEncouragement() {
    const message = encouragements[Math.floor(Math.random() * encouragements.length)];
    
    const toast = document.createElement('div');
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(45deg, #8b5cf6, #a855f7);
        color: white;
        padding: 15px 20px;
        border-radius: 10px;
        font-weight: bold;
        z-index: 1000;
        animation: slideInRight 0.5s ease-out, fadeOut 0.5s ease-out 2.5s forwards;
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Afficher un encouragement lors de la sélection d'un pays
document.addEventListener('click', (e) => {
    if (e.target.closest('.country-card')) {
        setTimeout(showEncouragement, 500);
    }
});