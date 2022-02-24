/*
    lang.js

    Manage languages

    Feb 20 2022     Initial
    Feb 21 2022     Modify initial load function
    Feb 22 2022     Debug. Add translations
    
*/

/*
    Place here all messages in all languages
*/


const endict = [
    // Interface 
    { "id": "#a-hometext", "text": "HOME"},
    { "id": "#a-ateliers", "text": "SHOPS"},
    { "id": "#a-contacts", "text": "CONTACTS"},
    { "id": "#a-english", "text": "ENGLISH"},
    { "id": "#a-french", "text": "FRENCH"},
    { "id": "#h1-sitetitle", "text": "Beau Merle's workshop"},
    { "id": "#p-title", "text": "Involved for 2 centuries in the manufacture of the best\
        knives, our company carries on the tradition\
        creation of models recognized worldwide for their quality and aesthetics.\
        Their solidity is matched only by their perfect suitability for use\
        daily for the most varied needs."},
    { "id": "#s-tous", "text": "All"},
    { "id": "#s-collection", "text": "Collection"},
    { "id": "#s-cuisine", "text": "Cooking"},
    { "id": "#s-serie", "text": "Series"},
    { "id": "buttonshow1", "text": "Show more"},
    { "id": "buttonshow2", "text": "Close"},
    { "id": "#h1-contacts", "text": "Contacts"},
    { "id": "#p-contactslist", "text": "Engineer Designer Producer : ratoon@free.fr <br\>\
        Marketing Strategy Director : labaronne@free.fr <br\>\
        Export director : barbilec@free.fr <br\>\
        Financial director : letono@free.fr <br\>\
        Public sector relations director: bintoule@free.fr <br\>\
        Delivery dispatch driver : yves@free.fr <br>"},
    { "id": "#h4-qui", "text": "Who are we ?"},
    { "id": "#p-qui", "text": "Our team of 11 craftsmen have a total of 162 years \
        of experience in creating unique and original models. Holders of numerous prizes \
        in art knife fairs around the world, we are committed to perpetuating the excellence \
        transmitted by 8 generations of French, Italian, German, Peruvian, \
        Japanese and... Martian master cutlers!"},
     { "id": "#p-copyright", "text": "Made by Reco DEV International Corporation" },
     { "id": "#h4-copyright", "text": "Ratoon, 2.18 RC2 : Feb 22 2022"},
     // Global strings
     { "id": "g-weight", "text": "Weight"},
     { "id": "g-length", "text": "Length"},
     { "id": "g-tranchant", "text": "Edge length"},
]

const frdict = [
    // Interface 
    { "id": "#a-hometext", "text": "HOME"},
    { "id": "#a-ateliers", "text": "ATELIERS"},
    { "id": "#a-contacts", "text": "CONTACTS"},
    { "id": "#a-english", "text": "ANGLAIS"},
    { "id": "#a-french", "text": "FRANCAIS"},
    { "id": "#h1-sitetitle", "text": "Atelier Beau Merle"},
    { "id": "#p-title", "text": "Impliquée depuis 2 siècles dans la fabrication des meilleurs\
        couteaux, notre entreprise perpétue la tradition\
        de création de modèles mondialement reconnus pour leur qualité et leur esthétique.\
        Leur solidité n'a d'égal que leur parfaite adéquation avec une utilisation\
        quotidienne pour les besoins les plus variés."},
    { "id": "#s-tous", "text": "Tous    "},
    { "id": "#s-collection", "text": "Collection"},
    { "id": "#s-cuisine", "text": "Cuisine"},
    { "id": "#s-serie", "text": "Série"},
    { "id": "buttonshow1", "text": "Plus de photos"},
    { "id": "buttonshow2", "text": "Fermer"},
    { "id": "#h1-contacts", "text": "Contacts"},
    { "id": "#p-contactslist", "text": "Ingénieur Concepteur Réalisateur : ratoon@free.fr <br\>\
        Directrice Stratégie Marketing : labaronne@free.fr <br\>\
        Directeur export : barbilec@free.fr <br\>\
        Directeur financier : letono@free.fr <br\>\
        Directeur relations secteur public: bintoule@free.fr <br\>\
        Chauffeur d'estafette livraison : yves@free.fr <br>"},
    { "id": "#h4-qui", "text": "Qui sommes nous ?"},
    { "id": "#p-qui", "text": "Notre équipe de 11 artisans compagnons totalise 162 années \
        d'expérience ans la création de modèles uniques et originaux. \
        Titulaires de nombreux prix dans les salons de couteaux d'art du monde entier, \
        nous avons à coeur de perpétrer l'excellence transmise par 8 générations \
        de maitres couteliers Français, Italiens, Allemands, Péruviens, Japonais, et...Martiens ! "},
    { "id": "#p-copyright", "text": "Réalisé par Reco DEV International Corporation" },
    { "id": "#h4-copyright", "text": "Le Rat, 2.18 RC2 : Feb 22 2022"},
     // Global strings
     { "id": "g-weight", "text": "Poids"},
     { "id": "g-length", "text": "Longueur"},
     { "id": "g-tranchant", "text": "Longueur tranchant"},
]

//------------------------------------------------------------------
// Utilities to load labels
// Hi Ratoon, you normally should not touch this part of code.
// If you do, tell me.
//------------------------------------------------------------------
// Get language
//------------------------------------------------------------------
function getLang() { return document.documentElement.getAttribute("lang"); }
//------------------------------------------------------------------
// Retrieve a specific string
//------------------------------------------------------------------
function getText(id, language = sessionStorage.getItem("pagelang")) {
    // Assign the proper dictionary
    let dictionary =  language === "en" ? endict : frdict;
    const result = dictionary.find( (label) =>  label.id === id );
    return result.text;
}
//------------------------------------------------------------------
// Called by script.js during page load and user language switching
//------------------------------------------------------------------
let element;
function loadVariableStrings(language) {
    // Assign the proper dictionary
    let dictionary =  language === "en" ? endict : frdict;
    for(let i = 0; i < dictionary.length; i++) {
        // Check this is an interface element
        if(dictionary[i].id.startsWith('#')) {
            element = document.getElementById(dictionary[i].id);
            element.innerHTML = dictionary[i].text;
        }
    }
    sessionStorage.setItem('pagelang', language);
}