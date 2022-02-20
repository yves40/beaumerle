/*
    lang.js

    Manage languages

    Feb 20 2022     Initial
    
*/

let lang = document.documentElement.getAttribute("lang");

function loadVariableStrings() {
    const hometext = document.getElementById("#hometext");
    hometext.innerHTML = getString(hometext.getAttribute("textid"));
    const ateliers = document.getElementById("#ateliers");
    ateliers.innerHTML = getString(ateliers.getAttribute("textid"));
    const contacts = document.getElementById("#contacts");
    contacts.innerHTML = getString(contacts.getAttribute("textid"));
    const sitetitle = document.getElementById("#sitetitle");
    sitetitle.innerHTML = getString(sitetitle.getAttribute("textid"));
    const ptitle = document.getElementById("#ptitle");
    ptitle.innerHTML = getString(ptitle.getAttribute("textid"));
}


function getString(stringid) {
    // Get the initial page language, depending ont he browser config
    let textobject;
    switch(lang) {
        case "en":  textobject = en.find(textelement => textelement.textid === stringid);  
                    break;
        case "fr":  textobject = fr.find(textelement => textelement.textid === stringid);  
                    break;
    }
    if(textobject)
        return textobject.text;
    else
        return "Unknown text";
}

/*
    Place here all messages in all languages
*/

const en = [
    { "textid": "a-home", "text": "HOME"},
    { "textid": "a-ateliers", "text": "SHOPS"},
    { "textid": "a-contacts", "text": "CONTACTS"},
    { "textid": "h1-sitetitle", "text": "Beau Merle's workshop"},
    { "textid": "p-title", "text": "We're ze best in the knives worl..."}
]

const fr = [
    { "textid": "a-home", "text": "HOME"},
    { "textid": "a-ateliers", "text": "ATELIERS"},
    { "textid": "a-contacts", "text": "CONTACTS"},
    { "textid": "h1-sitetitle", "text": "Atelier Beau Merle"},
    { "textid": "p-title", "text": "Impliquée depuis 2 siècles dans la fabrication des meilleurs\
        couteaux, notre entreprise perpétue la tradition\
        de création de modèles mondialement reconnus pour leur qualité et leur esthétique.\
        Leur solidité n'a d'égal que leur parfaite adéquation avec une utilisation\
        quotidienne pour les besoins les plus variés."}
]
