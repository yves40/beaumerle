
/*
    script.js

    Some code to compensate my poor css competencies

    Feb 06 2022     Initial (from index.html)
    Feb 10 2022     Play with google map (add a button to show google navigation page)
    Feb 18 2022     Remove Google map and shops ( as requested by B3 )
    Feb 20 2022     Dynamic catalog: 1
    Feb 22 2022     Debug internationalization. Change gallery images presentation
    
*/

const scriptVersion = () => {
    return "script.js, Feb 22 2022; 1.38";
}


// Global variables
let galleryshow = false;
const navlinks = document.getElementById("navLinks");
const dynamicgallery = document.getElementById("dynamicgallery");
const firstbutton = document.getElementById("buttonshow1");
const secondbutton = document.getElementById("buttonshow2");
const itemsmenu = document.getElementById("itemsmenu");
const english = document.getElementById("#a-english");
const french = document.getElementById("#a-french");
let knivescatalog = [];

// --------------------------------------------------------------------------------------
// Utility function loading a json file and returning a json object
// The file contains the knive list
// --------------------------------------------------------------------------------------
async function getJSON(path, callback) {
    return callback(
        await
        fetch(path)
        .then(function(response) {
            return response.json();
        })
        .catch(function(error) {
            console.log('Cannot load catalog.json: ' + error.message);
            return [{ "id": "000", "url": "none", "model" :"none", "label": "none" }];
        }));
}

// --------------------------------------------------------------------------------------
//  When loading the page, set a click event on all gallery images
//  Also install the event handler for products categories buttons selection
// --------------------------------------------------------------------------------------
window.onload = () => {

    // Some questions about language. The initial page lang will be the 
    // navigator's one. Then language user choice will be stored in a local
    // session. It means any other session (different tab, new window,...) will
    // not inherit from the user preference.
    let navlang = navigator.language || navigator.userLanguage;
    if(!sessionStorage.getItem("pagelang")) {
        sessionStorage.setItem('pagelang', navlang);
    }

    console.log('Navigator language ' + navlang);
    console.log('Site page language ' + sessionStorage.getItem("pagelang"));

    switchLang(sessionStorage.getItem("pagelang"));
    // Gallery buttons, a few adjustments
    document.getElementById("buttonshow1").innerText = getText("buttonshow1");
    document.getElementById("buttonshow2").hidden = true;

    // Filter implementation
    const filterItem = document.querySelector(".items");
    // Manage buttons selection events
    filterItem.onclick = (selectedItem) => {
        if (selectedItem.target.classList.contains("item")) {
            // If button is already the active one, remove the active status
            // Guess this is to avoid piling up the class  when multiple clicks occurs 
            // on an already active element
            filterItem.querySelector(".active").classList.remove("active");
            // Add that active class on user selected item
            selectedItem.target.classList.add("active"); 
            // Get data-name value of user selected item and store in a filtername variable
            let filterName = selectedItem.target.getAttribute("data-name");
            // Load the array used to activate / deactivate images in the gallery
            let filterImg = document.querySelectorAll(".gallery .image")
            filterImg.forEach((image) => {
                // If user selected item data-name value is equal to images data-name value
                // or user selected item data-name value is equal to "all"
                let filterImges = image.getAttribute("data-name");
                if (filterImges == filterName || filterName == "toutes") {
                    image.classList.remove("hide"); 
                    image.classList.add("show");
                } else {
                    image.classList.add("hide");
                    image.classList.remove("show"); 
                }
            });
        }
    }

    // Load JSON file containing all knives
    // Prepare to display the catalog on demand
    getJSON('/catalog.json', allKnives => {
        allKnives.forEach(element => {
            knivescatalog = allKnives;
            let newdiv = document.createElement("div");
            let newdiv2 = document.createElement("div");
            let newimage = document.createElement("img");
            let newdiv3 = document.createElement("div");
            let h3 = document.createElement("h3");
            newdiv3.appendChild(h3);
            h3.textContent = element.label;
            newdiv3.className = "knifelabel";

            newdiv.className = "image";
            newdiv.setAttribute("data-name", element.model);
            newimage.src = element.url;
            newimage.setAttribute("id", element.id);
            newimage.setAttribute("price", element.price);
            newimage.setAttribute("label", element.label);
            newdiv2.appendChild(newimage);
            newdiv2.appendChild(newdiv3);
            newdiv.appendChild(newdiv2);
            dynamicgallery.appendChild(newdiv);
            // Adding onclick attribute in all dynamic gallery images
            const dynamicimageslist = document.querySelectorAll(".gallery .image");
            for (let i = 0; i < dynamicimageslist.length; i++) {
                dynamicimageslist[i].setAttribute("onclick", "preview(this)"); 
            }
        })
    });
}
// --------------------------------------------------------------------------------------
function switchLang(lang) {
    if (lang) currentlang = lang;
    switch(currentlang) {       // 1st manage menu entries
        case "en":
            english.classList.add('hide');
            french.classList.remove('hide');
            break;
        case "fr":
            french.classList.add('hide');
            english.classList.remove('hide');
            break;
    }
    // Reload the page
    loadVariableStrings(lang);
}
// --------------------------------------------------------------------------------------
function showMenu() {
    navlinks.style.right = "0";
}
// --------------------------------------------------------------------------------------
function hideMenu(elementname) {
    navlinks.style.right = "-200px";
    if(elementname) {
        console.log('Scroll element ' + elementname + " to top of scoll area");
        let theelement = document.getElementById(elementname);
        theelement.scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
    }
}
// --------------------------------------------------------------------------------------
function showcatalog() {
    if(galleryshow) {
        firstbutton.innerText = getText("buttonshow1");
        secondbutton.hidden = true;
        dynamicgallery.style.display = "none";
        itemsmenu.classList.add("hide");
        galleryshow = false;
    }
    else {
        firstbutton.innerText = getText("buttonshow2");
        secondbutton.innerText = getText("buttonshow2");
        dynamicgallery.style.display = "flex";
        secondbutton.hidden = false;
        itemsmenu.classList.remove("hide");
        galleryshow = true;
    }
}
// --------------------------------------------------------------------------------------
// Fullscreen image preview function selecting all required elements
const previewBox = document.querySelector(".preview-box");
const categoryName = previewBox.querySelector(".title p");
const previewImg = previewBox.querySelector("img");
const closeIcon = previewBox.querySelectorAll(".icon");

const shadow = document.querySelector(".shadow");

function preview(element){
    // Get the knife ID from the image attribute
    // Beware not to change attributes order ( see code above )
    let knifeID = element.innerHTML.split(' ')[2].split('=')[1];
    // Get all knife details
    let selectedknife = getKnife(knifeID.replace(/\"/g, ''));
    
    // Once user click on any image then remove the scroll bar of the body, 
    // so user cant scroll up or down
    document.querySelector("body").style.overflow = "hidden";
    // Get user clicked image source link
    let selectedPrevImg = element.querySelector("img"); 
    // Get user clicked image data-name value
    let selectedImgCategory = element.getAttribute("data-name");
     // Pass the user clicked image source in preview image source
    previewImg.src = selectedPrevImg.src;
    // Pass user clicked data-name value in category name
    // categoryName is initialized above during page load. 
    // It selects the ".title p" of the preview box element
    categoryName.textContent = selectedImgCategory + ' : ' 
                            + " / " + selectedknife.label + " [ "
                            + selectedknife.price + " € ]" ;
    document.querySelector(".dimensions").textContent = 
                getText("g-length") + " " +
                selectedknife.longueur + " " +
                getText("g-tranchant") + " " +
                selectedknife.tranchant + " " + 
                getText("g-weight") + " " +
                selectedknife.poids ; 
document.querySelector(".manche").textContent = selectedknife.manche;
    // Now show the preview image box and the the light grey background
    previewBox.classList.add("show");
    shadow.classList.add("show");
    // Now just have to wait for the user to close the box
    // closeIcon elements are loaded above during page load.
    // It selects the ".icon" class elements of the preview box
    // Two of them on the preview page ; One on top, one on botom
    // Because depending on the window size, the upper one sometimes 
    // disapears from the view
    closeIcon.forEach( (icon) => {
        icon.onclick = () => {
            previewBox.classList.remove("show"); //hide the preview box
            shadow.classList.remove("show"); //hide the light grey background
            document.querySelector("body").style.overflow = "auto"; //show the scroll bar on body
        };            
    })
}
// --------------------------------------------------------------------------------------
// Retrieve a knife details from catalog.json with its ID
function getKnife(id) {
    const oneknife = knivescatalog.find( kn => kn.id === id);
    return oneknife;
}
