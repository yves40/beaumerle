/*
    lang.js

    Manage languages

    Feb 20 2022     Initial
    Feb 21 2022     Modify initial load function
    Feb 22 2022     Debug. Add translations
    Feb 25 2022     Untranslated copyright ( former #h4-copyright )
                    is now u-copyright
    May 08 2022     JQuery.
    May 11 2022     JQuery..must change ids : conflict with '#' sign...
    Jul 29 2022     Admin page labels
    
*/

const anylang = '{ \
    "a-english": "UK", \
    "a-french": "FR", \
    "img-logo": "/images/BeauMerle.png" }';

englishdict = '{ \
        "a-hometext": "HOME", \
        "a-knivesadmin": "Knives", \
        "a-kniveslist": "List", \
        "a-knivesnew": "New one", \
        "a-knivesedit": "Update", \
        "a-usersadmin": "Users", \
        "a-userslist": "List", \
        "a-usersnew": "New User", \
        "a-usersedit": "Manage User", \
        "a-models": "MODELS", \
        "a-contacts": "CONTACTS", \
        "a-adminmenu": "ADMINISTRATION", \
        "h1-sitetitle": "Beau Merle workshop", \
        "p-title": "Involved for 2 centuries in the manufacture of the best \
knives, our company carries on the tradition \
creation of models recognized worldwide for their quality and aesthetics. \
Their solidity is matched only by their perfect suitability for use \
daily for the most varied needs.", \
        "s-tous": "All", \
        "s-collection": "Collection", \
        "s-cuisine": "Cooking", \
        "s-serie": "Series", \
        "opengallery": "Show more", \
        "closegallery": "Close", \
        "h1-contacts": "Contacts", \
        "p-contactslist": "Engineer Designer Producer : ratoon@free.fr  \
Marketing Strategy Director : labaronne@free.fr  \
Export director : barbilec@free.fr  \
Financial director : letono@free.fr  \
Public sector relations director: bintoule@free.fr  \
Delivery dispatch driver : yves@free.fr", \
        "h4-qui": "Who are we ?", \
        "p-qui": "Our team of 11 craftsmen have a total of 162 years \
of experience in creating unique and original models. Holders of numerous prizes \
in art knife fairs around the world, we are committed to perpetuating the excellence \
transmitted by 8 generations of French, Italian, German, Peruvian, \
Japanese and... Martian master cutlers!", \
        "p-copyright": "Made by Reco DEV International Corporation" , \
        "h1-adminhome": "Administration tasks" , \
        "p-adminhome": "Manage users, knives, knives collections..." , \
        "g-weight": "Weight", \
        "g-length": "Length", \
        "g-tranchant": "Edge length" }';

frenchdict = '{ \
        "a-hometext": "HOME", \
        "a-knivesadmin": "Les couteaux", \
        "a-kniveslist": "Lister", \
        "a-knivesnew": "Ajouter", \
        "a-knivesedit": "Mettre à jour", \
        "a-usersadmin": "Les utilisateurs", \
        "a-userslist": "Lister", \
        "a-usersnew": "Ajouter", \
        "a-usersedit": "Gérer", \
        "a-models": "MODELS", \
        "a-contacts": "CONTACTS", \
        "a-adminmenu": "ADMINISTRATION", \
        "h1-sitetitle": "Atelier Beau Merle", \
        "p-title": "Impliquée depuis 2 siècles dans la fabrication des meilleurs \
couteaux, notre entreprise perpétue la tradition \
de création de modèles mondialement reconnus pour leur qualité et leur esthétique. \
Leur solidité n\'a d\'égal que leur parfaite adéquation avec une utilisation \
quotidienne pour les besoins les plus variés.", \
        "s-tous": "Tous", \
        "s-collection": "Collection", \
        "s-cuisine": "Cuisine", \
        "s-serie": "Série", \
        "opengallery": "Plus de photos", \
        "closegallery": "Fermer", \
        "h1-contacts": "Contacts", \
        "p-contactslist": "Ingénieur Concepteur Réalisateur : ratoon@free.fr , \
Directrice Stratégie Marketing : labaronne@free.fr , \
Export director : barbilec@free.fr , \
Directeur financier : letono@free.fr , \
Directeur relations secteur public: bintoule@free.fr , \
Chauffeur d\'estafette livraison : yves@free.fr", \
        "h4-qui": "Qui sommes nous ?", \
        "p-qui": "Notre équipe de 11 artisans compagnons totalise 162 années \
d\'expérience ans la création de modèles uniques et originaux. \
Titulaires de nombreux prix dans les salons de couteaux d\'art du monde entier, \
nous avons à coeur de perpétrer l\'excellence transmise par 8 générations \
de maitres couteliers Français, Italiens, Allemands, Péruviens, Japonais, et...Martiens ! ", \
        "p-copyright": "Réalisé par Reco DEV International Corporation" , \
        "h1-adminhome": "Administration" , \
        "p-adminhome": "Gestion utilisateur, couteaux, collections..." , \
        "g-weight": "Poids", \
        "g-length": "Longueur", \
        "g-tranchant": "Longueur tranchant" }';
        
let activeany = null;
let activedictionary = null;
//------------------------------------------------------------------
// Utilities to load labels
// Hi Ratoon, you normally should not touch this part of code.
// If you do, tell me.
//------------------------------------------------------------------
// Get language
//------------------------------------------------------------------
function getLang() { return document.documentElement.getAttribute("lang"); }
//------------------------------------------------------------------
// Get an element label
//------------------------------------------------------------------
function getText(id, language = sessionStorage.getItem("pagelang")) {
    result = activedictionary[id];
    if ( result ) {
        return result;
    }
    else {  // Not found in localized store, try in the global one
        result = activeany[id];
        if ( result )  {
            return result; 
        }
    }
    return null;
}
//------------------------------------------------------------------
// Called by script.js during page load and user language switching
//------------------------------------------------------------------
let element;
function loadVariableStrings(language) {
    activeany = JSON.parse(anylang);        // Unlocalized strings
    // Assign the proper dictionary
    if(language === "en") {
        activedictionary = JSON.parse(englishdict);
    }
    else {
        activedictionary = JSON.parse(frenchdict);
    }
    // Load all id's text data
    let textsrc = null;
    $('[id]').each( (index, element) => {        
        if(textsrc = getText(element.id, language)) {
            // Check element type to assess which attribute should be updated
            if($(element).is("span")) {
                $(element).text(textsrc);   // Element is a span tag
                return true;
            }
            if($(element).is("img")) {
                $(element).attr('src', textsrc);
                return true;
            }
            if($(element).is("p")) {
                $(element).text(textsrc);
                return true;
            }
            if($(element).is("h1")) {
                $(element).text(textsrc);
                return true;
            }
            if($(element).is("button")) {
                $(element).text(textsrc);
                return true;
            }
            if($(element).is("a")) {
                $(element).text(textsrc);
                return true;
            }        
            $(element).text(textsrc);
        }
    })
    // Set language in session
    sessionStorage.setItem('pagelang', language);
    return;
}
