/*
    lang.js

    Manage languages

    Feb 20 2022     Initial
    Feb 21 2022     Modify initial load function
    
*/

/*
    Place here all messages in all languages
*/
const langVersion = () => {
    return "lang.js, Feb 21 2022; 1.05";
}


const endict = [
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
        daily for the most varied needs."}
]

const frdict = [
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
        quotidienne pour les besoins les plus variés."}
]

//------------------------------------------------------------------
// Utilities to load labels
// Hi Ratoon, you normally should not touch this part of code.
// If you do, tell me.
//------------------------------------------------------------------
// Check current language
//------------------------------------------------------------------
let lang = document.documentElement.getAttribute("lang");
//------------------------------------------------------------------
// Assign the proper dictionary
//------------------------------------------------------------------
let dictionary =  lang === "en" ? endict : frdict;
//------------------------------------------------------------------
// Get language
//------------------------------------------------------------------
function getLang() { return lang; }
//------------------------------------------------------------------
// Called by script.js during page load
//------------------------------------------------------------------
let element;
function loadVariableStrings() {
    dictionary.forEach( label => {
        element = document.getElementById(label.id);
        element.innerHTML = label.text;
    })
}
//------------------------------------------------------------------
// Change language
//------------------------------------------------------------------
function changeLanguage(chosenlang) {
    console.log('Switching to ' + chosenlang);
    document.documentElement.setAttribute('lang', chosenlang);
    //location.reload();
}
