
<style>
    /* ===== EXPLORATION PAGE STYLES - BALISES HTML PURES ===== */

.exploration-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    background: #ffffff;
    min-height: 100vh;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    line-height: 1.6;
    color: #2c3e50;
}

/* ===== TITRES H1 ===== */
h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a202c;
    margin: 2rem 0 1.5rem 0;
    padding-bottom: 0.75rem;
    border-bottom: 3px solid #3b82f6;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
    position: relative;
}

h1::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #3b82f6, #1d4ed8);
    border-radius: 2px;
}

/* ===== TITRES H2 ===== */
h2 {
    font-size: 2rem;
    font-weight: 600;
    color: #374151;
    margin: 2.5rem 0 1.25rem 0;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e5e7eb;
    position: relative;
    transition: all 0.3s ease;
}

h2:hover {
    color: #3b82f6;
    border-bottom-color: #3b82f6;
}

h2::before {
    content: '▶';
    color: #3b82f6;
    font-size: 0.8em;
    margin-right: 0.5rem;
    transition: transform 0.3s ease;
}

h2:hover::before {
    transform: translateX(5px);
}

/* ===== PARAGRAPHES ===== */
p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #374151;
    margin-bottom: 1.5rem;
    text-align: justify;
    text-indent: 0;
    transition: all 0.3s ease;
}

p:hover {
    color: #1f2937;
}

p:first-of-type {
    font-size: 1.2rem;
    color: #4b5563;
    font-weight: 400;
    margin-bottom: 2rem;
    padding: 1rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-left: 4px solid #3b82f6;
    border-radius: 0 8px 8px 0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

/* ===== LIENS ===== */
a {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
    position: relative;
    transition: all 0.3s ease;
    border-bottom: 1px solid transparent;
    padding: 2px 4px;
    border-radius: 4px;
}

a::before {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -2px;
    left: 50%;
    background: linear-gradient(90deg, #3b82f6, #1d4ed8);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

a:hover {
    color: #1d4ed8;
    background-color: rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
}

a:hover::before {
    width: 100%;
}

a:active {
    transform: translateY(0);
}

/* Liens externes */
a[href^="http"]::after,
a[href^="https://"]::after {
    content: ' ↗';
    font-size: 0.8em;
    color: #6b7280;
    margin-left: 2px;
}

/* ===== LISTES UL ===== */
ul {
    margin: 1.5rem 0;
    padding-left: 0;
    list-style: none;
    background: #fafbfc;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
}

ul li {
    position: relative;
    padding-left: 2rem;
    margin-bottom: 1rem;
    color: #374151;
    font-size: 1rem;
    line-height: 1.6;
    transition: all 0.3s ease;
}

ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.7rem;
    width: 8px;
    height: 8px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 50%;
    transition: all 0.3s ease;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

ul li:hover {
    color: #1f2937;
    transform: translateX(5px);
}

ul li:hover::before {
    transform: scale(1.3);
    box-shadow: 0 0 0 5px rgba(59, 130, 246, 0.3);
}

ul li:last-child {
    margin-bottom: 0;
}

/* Listes imbriquées */
ul ul {
    margin: 0.5rem 0;
    padding: 1rem;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
}

ul ul li::before {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    width: 6px;
    height: 6px;
}

/* ===== SÉPARATEURS HR ===== */
hr {
    border: none;
    height: 3px;
    margin: 3rem 0;
    background: linear-gradient(90deg, transparent 0%, #3b82f6 20%, #1d4ed8 50%, #3b82f6 80%, transparent 100%);
    border-radius: 2px;
    position: relative;
    overflow: visible;
}

hr::before {
    content: '';
    position: absolute;
    top: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 12px;
    height: 12px;
    background: #3b82f6;
    border-radius: 50%;
    box-shadow: 0 0 0 4px #ffffff, 0 0 0 6px #3b82f6;
}

hr::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.3), transparent);
    transform: translateY(-50%);
}

/* Variante de HR avec motif */
hr.dotted {
    background: none;
    height: 1px;
    border-top: 3px dotted #3b82f6;
}

hr.dotted::before {
    display: none;
}

hr.dotted::after {
    display: none;
}

/* ===== ANIMATIONS ===== */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

h1, h2, p, ul, hr, a {
    animation: fadeInUp 0.6s ease-out;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 768px) {
    .exploration-container {
        padding: 1rem;
    }
    
    h1 {
        font-size: 2rem;
        margin: 1.5rem 0 1rem 0;
    }
    
    h2 {
        font-size: 1.5rem;
        margin: 2rem 0 1rem 0;
    }
    
    p {
        font-size: 1rem;
        text-align: left;
    }
    
    p:first-of-type {
        font-size: 1.1rem;
        padding: 0.75rem;
    }
    
    ul {
        padding: 1rem;
    }
    
    ul li {
        padding-left: 1.5rem;
        font-size: 0.95rem;
    }
    
    ul li::before {
        width: 6px;
        height: 6px;
        top: 0.6rem;
    }
    
    hr {
        margin: 2rem 0;
        height: 2px;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 1.75rem;
    }
    
    h2 {
        font-size: 1.25rem;
    }
    
    p {
        font-size: 0.95rem;
        line-height: 1.6;
    }
    
    ul li {
        font-size: 0.9rem;
    }
}

/* ===== ÉTATS DE FOCUS POUR L'ACCESSIBILITÉ ===== */
a:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
    border-radius: 4px;
}

/* ===== IMPRESSION ===== */
@media print {
    h1, h2 {
        color: #000 !important;
        background: none !important;
        -webkit-text-fill-color: initial !important;
    }
    
    a {
        color: #000 !important;
        text-decoration: underline !important;
    }
    
    ul {
        background: none !important;
        box-shadow: none !important;
        border: 1px solid #ccc !important;
    }
    
    hr {
        background: #000 !important;
        height: 1px !important;
    }
    
    hr::before,
    hr::after {
        display: none !important;
    }
}

/* ===== DARK MODE (optionnel) ===== */
@media (prefers-color-scheme: dark) {
    .exploration-container {
        background: #1f2937;
        color: #f9fafb;
    }
    
    h1, h2 {
        color: #f9fafb;
    }
    
    p {
        color: #e5e7eb;
    }
    
    p:hover {
        color: #f9fafb;
    }
    
    ul {
        background: #374151;
        border-color: #4b5563;
    }
    
    ul li {
        color: #e5e7eb;
    }
    
    ul ul {
        background: #4b5563;
        border-color: #6b7280;
    }
}

</style>
<?= 
App\Controllers\App\App::App()
->Parsedown()
->text($exploration[0]['contenu_exploration']);
?>