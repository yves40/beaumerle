
/*
    script.js

    Some code to compensate my poor css competencies

    Feb 06 2022     Initial (from index.html)
    Feb 10 2022     Play with google map (add a button to show google navigation page)
    Feb 18 2022     Remove Google map and shops ( as requested by B3 )
    Feb 20 2022     Dynamic catalog: 1
    Feb 22 2022     Debug internationalization. Change gallery images presentation
    Feb 24 2022     Gallery images presentation
    Apr 29 2022     Menu and language selection
    Apr 30 2022     JQuery.
    May 08 2022     JQuery..
    May 11 2022     JQuery...
    May 13 2022     JQuery....
    May 22 2022     JQuery.....
    May 22 2022     JQuery.....and some management of gallery selection buttons
    May 24 2022     JQuery, fade effects, and timer
                    Local jquery lib. Solve initialization problems ?
    
*/


$(document).ready( () => {

    // Global variables
    let galleryshow = false;
    let defaultimagenumber = 0;
    const fadeInDelay = 1000;
    const fadeOutDelay = 1000;
    const imagesRefreshDelay = 10000;
    let chronowatch;                    // Interval ID to manage image auto refresh

    // Set up the click machinery ;-)
    $("#a-french").click( () => { switchLang('fr');})
    $("#a-english").click( () => {switchLang('en');})
    $("#a-hometext").click( () => {hideMenu()});
    $("#a-contacts").click( () => {hideMenu("contacts")});
    $("#a-models").click( () => {hideMenu("info")});
    $(".fa-times").click( () => {hideMenu()});
    $(".fa-bars").click( () => {showMenu()});

    $("#opengallery").click( () => {showcatalog()});
    $("#closegallery").hide().click( () => {showcatalog()});

    $("#s-tous").click( () => { selectPhotos('tous')});
    $("#s-collection").click( () => {selectPhotos('collection')});
    $("#s-cuisine").click( () => {selectPhotos('cuisine')});
    $("#s-serie").click( () => {selectPhotos('serie')});

    $("#logo").click(  () => {hideMenu()});

    let knivescatalog = [];
    let totalknives = 0;
    let collection = 0;         // Used to count each knife model number
    let cuisine = 0;
    let serie = 0;

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

        checkFontAwesome();

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
        $("#opengallery").text(getText("opengallery"));
        $("#closegallery").hide();

        // Manage filter buttons selection events
        /*
        $(".item").click( (selectedItem) => {
            $(selectedItem).addClass("active");
        })*/

        // Load JSON file containing all knives
        // Prepare to display the catalog on demand
        // Display only a few knives when page loads. 
        // The number of displayed knives is defined by the defaultimagenumber constant 
        // defined globally and read from the style.css file with a variable
        defaultimagenumber = Number.parseInt(getComputedStyle(document.documentElement)
                    .getPropertyValue("--initial-photos-number"));
        $('#dynamicgallery').hide();
        let index = 0;
        getJSON('./catalog.json', allKnives => {
            knivescatalog = Object.values(allKnives);  // Save the entire catalog into an array
            knivescatalog.forEach(element => {
                ++index;
                let outerdiv = document.createElement("div");   // image + label
                let newimage = document.createElement("img");   // image
                let p = document.createElement("p");            // Label
                let h3 = document.createElement("h3");
                p.appendChild(h3);
                h3.textContent = element.label;
                p.className = "knifelabel";

                outerdiv.className = "image";
                newimage.src = element.url;
                newimage.setAttribute("id", element.id);
                newimage.setAttribute("label", element.label);
                outerdiv.appendChild(newimage);
                outerdiv.setAttribute("model", element.model);
                outerdiv.appendChild(p);
                $("#dynamicgallery").append(outerdiv);
            });
            // Adding onclick attribute in all dynamic gallery images
            $(".gallery > .image").each( (i, element) => {
                $(element).click( () => { preview($(element).find("img")) });
            });
            // Count the number of knives for each model
            $("[model]").each( (i, element) => {
                let themodel = $(element).attr('model');
                switch(themodel ) {
                    case "cuisine":
                        ++cuisine;
                        break;
                    case "collection":
                        ++collection
                        break;
                    case "serie":
                        ++serie;
                        break;
                }
            });
            totalknives = cuisine + collection + serie;
            // Manage buttons selection text
            $('#s-tous').text(getText("s-tous") + " (" + totalknives + ")");
            $('#s-collection').text(getText("s-collection") + " (" + collection + ")");
            $('#s-serie').text(getText("s-serie") + " (" + serie + ")");
            $('#s-cuisine').text(getText("s-cuisine") + " (" + cuisine + ")");
            displayRandom();
            chronowatch = setInterval(displayRandom, imagesRefreshDelay);
        });
    }
    // --------------------------------------------------------------------------------------
    // 4 models right now. "tous", "collection", "cuisine", "serie"
    function selectPhotos(model) {
        $("#dynamicgallery").fadeOut(fadeOutDelay, () => {
            $("[model]").each( (i, element) => {
                let themodel = $(element).attr('model');
                if(model === "tous") {
                    $(element).addClass("show").removeClass("hide");
                }
                else {
                    if($(element).attr('model') === model) {
                        $(element).addClass("show").removeClass("hide");
                    }
                    else {
                        $(element).addClass("hide").removeClass("show");
                    }
                }
            })
            // Manage buttons
            // In the HTML, each button carries an action attribute
            $("[action").each( (i, menuitem) => {
                if($(menuitem).attr('action') === model) {
                    $(menuitem).addClass('active');
                }
                else {
                    $(menuitem).removeClass('active');
                }
            } )
        });
        $("#dynamicgallery").fadeIn(fadeInDelay);
    }
    // --------------------------------------------------------------------------------------
    function switchLang(lang) {
        if (lang) currentlang = lang;
        switch(currentlang) {       // 1st manage menu entries
            case "en":
                $("#a-english").addClass('selected').removeClass("notselected");
                $("#a-french").addClass('notselected').removeClass("selected");
                break;
            case "fr":
                $("#a-english").addClass('notselected').removeClass("selected");
                $("#a-french").addClass('selected').removeClass("notselected");
                break;
        }
        // Reload variable text
        loadVariableStrings(lang);
        hideMenu();
    }
    // --------------------------------------------------------------------------------------
    function showMenu() {
        $(".nav-links").css('right', '0');
    }
    // --------------------------------------------------------------------------------------
    function hideMenu(elementname) {
        $(".nav-links").css('right', '-200px');
        if(elementname) {
            let offset = $("#" + elementname).offset();
            console.log(offset)
            $('html, body').animate({
                scrollTop: $("#" + elementname).offset().top
            }, 1000);
        }
        else {
            $('html, body').animate({
                scrollTop: 0,
            }, 1000);
        }
    }
    // --------------------------------------------------------------------------------------
    // This is a flip flop routine which displays or hide the gallery
    function showcatalog() {    
        if(galleryshow) {   // Close catalog
            $("#opengallery").text(getText("opengallery")); // "Show catalog"
            $("#closegallery").hide();
            $('#itemsmenu').addClass("hide");
            galleryshow = false;
            displayRandom();
            chronowatch = setInterval(displayRandom, imagesRefreshDelay);
        }
        else {  // Open catalog
            clearInterval(chronowatch);
            $("#opengallery").text(getText("closegallery")); // "Close"
            $("#closegallery").show();
            $('#itemsmenu').removeClass("hide");
            galleryshow = true;
            selectPhotos('serie');    // Choose a small gallery to start
        }
    }
    // This function displays a limited number of random photos
    function displayRandom() {
        $("#dynamicgallery").fadeOut(fadeOutDelay, () => {
            let startindex = randomIntFromInterval(0, knivescatalog.length - defaultimagenumber - 1);
            let endindex = startindex + defaultimagenumber;
            $("[model]").each( (i, theimage) => {
                if ( i >= startindex && i < endindex ) {
                    $(theimage).addClass("show").removeClass("hide");
                }
                else {
                    $(theimage).addClass("hide").removeClass("show");
                }
            })
        });
        $("#dynamicgallery").fadeIn(fadeInDelay);
    }
    // --------------------------------------------------------------------------------------
    // Fullscreen image preview function selecting all required elements
    // --------------------------------------------------------------------------------------
    function preview(knifeimage){
        // Get the knife ID
        // Get all knife details
        let selectedknife = getKnife($(knifeimage).attr("id"));
        // Once user click on any image then remove the scroll bar of the body, 
        // so user cant scroll up or down
        $("body").css("overflow", "hidden");
        // Pass the user clicked image source in preview image source
        $(".preview-box").find("img").attr("src", $(knifeimage).attr("src"));
        // Pass user clicked data-name value in category name
        // categoryName is initialized above during page load. 
        // It selects the ".title p" of the preview box element
        $("#model").text(selectedknife.model);
        $("#label").text(selectedknife.label);
        $("#price").text(selectedknife.price + " €");
        $("#dimensions").text( 
                    getText("g-length") + " " +
                    selectedknife.longueur + " " +
                    getText("g-tranchant") + " " +
                    selectedknife.tranchant + " " + 
                    getText("g-weight") + " " +
                    selectedknife.poids ); 
        $("#manche").text(selectedknife.manche);
        // Now show the preview image box and the the light grey background
        $(".preview-box").addClass("show");
        $(".shadow").addClass("show");
        // Now just have to wait for the user to close the box
        // closeIcon elements are loaded above during page load.
        // It selects the ".icon" class elements of the preview box
        // Two of them on the preview page ; One on top, one on botom
        // Because depending on the window size, the upper one sometimes 
        // disapears from the view
        $(".section2, .icon").click( () => { 
            $(".preview-box").removeClass("show"); //hide the preview box
            $(".shadow").removeClass("show"); //hide the light grey background
            $("body").css("overflow", "auto");
        });
    }
    // --------------------------------------------------------------------------------------
    // Retrieve a knife details from catalog.json with its ID
    function getKnife(id) {
        const oneknife = knivescatalog.find( kn => kn.id === id);
        return oneknife;
    }
    // --------------------------------------------------------------------------------------
    // Some Utilities
    function randomIntFromInterval(min, max) { // min and max included 
        return Math.floor(Math.random() * (max - min + 1) + min)
    }
    function checkFontAwesome() {
        var span = document.createElement('span');
        span.className = 'fas';
        span.style.display = 'none';
        document.body.insertBefore(span, document.body.firstChild);
        let thestyle = window.getComputedStyle(span, null).getPropertyValue('font-family');
        console.log(`fontAwesome detected version : ${thestyle}`);
        document.body.removeChild(span);
    }
});
