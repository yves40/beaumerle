
/*
    Some code to compensate my poor css competencies

    Feb 06 20202    Initial (from index.html)
    Feb 10 20202    Play with google map (add a button to show google navigation page)
    
*/

// Standard elements
let galleryshow = false;
let mapshow = false;
const navlinks = document.getElementById("navLinks");
const thegallery = document.getElementById("thegallery");
const gomap = document.getElementById("gomap");
const themap = document.getElementById("googlemap");
const firstbutton = document.getElementById("buttonshow1");
const secondbutton = document.getElementById("buttonshow2");
const itemsmenu = document.getElementById("itemsmenu");

// --------------------------------------------------------------------------------------
//  When loading the page, set a click event on all gallery images
//  Also install the event handler for products categories buttons selection
// --------------------------------------------------------------------------------------
window.onload = () => {

    document.getElementById("buttonshow2").hidden = true;

    // Filter implementation
    const filterItem = document.querySelector(".items");
    const filterImg = document.querySelectorAll(".gallery .image");
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
    // Do not show map
    themap.style.display = "none";
    // Adding onclick attribute in all available gallery images when page loads
    for (let i = 0; i < filterImg.length; i++) {
        filterImg[i].setAttribute("onclick", "preview(this)"); 
    }
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
        firstbutton.innerText = "Voir le catalogue"
        secondbutton.hidden = true;
        thegallery.style.display = "none";
        itemsmenu.classList.add("hide");
        galleryshow = false;
    }
    else {
        firstbutton.innerText = "Fermer"
        thegallery.style.display = "flex";
        secondbutton.hidden = false;
        itemsmenu.classList.remove("hide");
        galleryshow = true;
    }
}
// --------------------------------------------------------------------------------------
function showmap() {
    if(mapshow) {
        gomap.innerText = "Où sommes nous ?"
        themap.style.display = "none";
        mapshow = false;
    }
    else {
        gomap.innerText = "Fermer"
        themap.style.display = "flex";
        mapshow = true;
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
    // Once user click on any image then remove the scroll bar of the body, 
    // so user cant scroll up or down
    document.querySelector("body").style.overflow = "hidden";
    // Get user clicked image source link
    let selectedPrevImg = element.querySelector("img").src; 
    // Get user clicked image data-name value
    let selectedImgCategory = element.getAttribute("data-name");
     // Pass the user clicked image source in preview image source
    previewImg.src = selectedPrevImg;
    // Pass user clicked data-name value in category name
    // categoryName is initialized above during page load. 
    // It selects the ".title p" of the preview box element
    categoryName.textContent = selectedImgCategory;
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
