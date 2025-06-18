<?php 
    function simpleMarkdown($text) {
    $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text); // **gras**
    $text = preg_replace('/\_(.*?)\_/', '<em>$1</em>', $text); // _italique_
    $text = preg_replace('/\# (.*?)\n/', '<h1>$1</h1>', $text); // # Titre
    return nl2br($text); // sauts de ligne HTML
}
$markdownText = "
    # 🇯🇵 Japon

Le **Japon** est un pays insulaire situé en Asie de l'Est, composé de plus de 6 800 îles.

## 📍 Informations clés

- **Capitale** : Tokyo  
- **Langue officielle** : Japonais  
- **Monnaie** : Yen (¥)  
- **Population** : Environ 125 millions d'habitants

## 🌸 Culture

Le Japon est réputé pour sa culture riche et ancienne. On y trouve :

- Le *sumo*, sport traditionnel
- Les **mangas** et **animés** qui ont conquis le monde
- La cérémonie du thé et les arts comme l’**ikebana** (art floral)

## 🍣 Gastronomie

Quelques spécialités culinaires :

- Sushi 🍣
- Ramen 🍜
- Okonomiyaki 🥘

## 🌋 Faits intéressants

> Le mont Fuji, volcan emblématique du Japon, est considéré comme un lieu sacré.

---

_Tu veux que je t’en fasse un sur ton pays ou un autre que tu aimes ?_ 🌍

"; // Remplacez par le chemin de votre fichier Markdown
echo simpleMarkdown($markdownText);
echo uniqid();
?>