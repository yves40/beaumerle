<?php 




?>

<!--
    home.php

    Jan 27 2022     Initial
    Jan 31 2022     Loss of animation and some css debugging
    Feb 01 2022     Loss of animation and some css debugging flex work                    
    Feb 02 2022     Start work on images selector
    Feb 03 2022     Work on images selector
    Feb 04 2022     Work on images selector
    Feb 06 2022     Separate JS file
    Feb 10 2022     Play with google map
    Feb 17 2022     Fix a typo
    Feb 18 2022     Start work on B3's requests
    Feb 20 2022     Dynamic catalog
    Feb 25 2022     Work on preview box
    Apr 30 2022     JQuery.
    May 08 2022     JQuery..
    May 11 2022     JQuery..and fontawesome upgrade with my own kit
    May 22 2022     WIP on top bar and logo sizing
    May 23 2022     Add some data on gallery selection buttons
    May 24 2022     Fix g-weight, g-length, g-tranchant missing IDs
                    Local jquery lib. Solve initialization problems ?
    Jul 27 2022     Migrate to WAMP: 1
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" >
        <script src="jquery.min.js"></script>
        <script src="script.js"></script>
        <script src="lang.js"></script>
        <script src="https://kit.fontawesome.com/a33a97f757.js" crossorigin="anonymous"></script>        
        <title>Atelier du beau Merle</title>
    </head>
    <body>
        <!-- The header section -->
        <section class="menu">
            <nav>
                <div id="thelogo">
                    <a id="logo"><img src="/images/BeauMerle.png" alt=""></a>
                </div>
                <div class="nav-links" id="navLinks">   
                <i class="fas fa-times" ></i>
                <ul id="menuentries">
                    <li><a id="a-hometext" >HOME</a></li>
                    <li><a id="a-models" >PRODUCTS</a></li>
                    <li><a id="a-contacts" >CONTACTS</a></li>
                    <li><span id="a-french"></span> | <span id="a-english"></span></li>
                </ul>
            </div>
                <i class="fas fa-bars"></i>
            </nav>
        </section>
        <section class="info" id="info">
                <h1 id="h1-sitetitle" >Atelier Beau Merle</h1>
                <p id="p-title" >Impliquée depuis 2 siècles dans la fabrication des meilleurs
                couteaux, notre entreprise perpétue la tradition
                de création de modèles mondialement reconnus pour leur qualité et leur esthétique.
                Leur solidité n'a d'égal que leur parfaite adéquation avec une utilisation  
                quotidienne pour les besoins les plus variés.
                </p>
        </section>
        <!-- The products -->
        <section class="products" id="products">
            <!-- Now the catalog section with dynamic images -->
            <div class="row.centered">
                <button id="opengallery">Voir le Catalogue</button>
            </div>
            <div class="items hide" id="itemsmenu">
                <span id="s-tous" action="tous" class="item">Tous</span>
                <span id="s-collection"  action="collection" class="item ">Collection</span>
                <span id="s-cuisine" action="cuisine" class="item ">Cuisine</span>
                <span id="s-serie" action="serie" class="item " >Série</span>
            </div>
            <div id="dynamicgallery" class="gallery"></div>
            <div class="row.centered">
                <button id="closegallery">Fermer</button>
            </div>
        </section>
        <!-- The contacts -->
        <section class="contacts" id="contacts">
            <h1 id="h1-contacts" >Contacts</h1>
            <div>
                <p id="p-contactslist"> Ingénieur Concepteur Réalisateur : ratoon@free.fr <br>
                    Directrice collection et Marketing : labaronne@free.fr <br>
                    Directeur export : barbilec@free.fr <br>
                    Directeur financier : letono@free.fr <br>
                    Directeur relations secteur public: bintoule@free.fr <br>
                    Chauffeur d'estafette livraison : yves@free.fr <br>
                </p>
            </div>
        </section>
        <!-- Footer  -->
        <section class="footer">
            <h4 id="h4-qui">Qui sommes nous ?</h4>
            <p id="p-qui">Notre équipe de 11 artisans compagnons totalise 162 années d'expérience 
                dans la création de modèles uniques et originaux. Titulaires de nombreux 
                prix dans les salons de couteaux d'art du monde entier, nous avons à 
                coeur de perpétrer l'excellence transmise par 8 générations de maitres 
                couteliers Français, Italiens, Allemands, Péruviens, Japonais, et...Martiens ! 
            </p>
            <p id="p-copyright">Made by Reco DEV International Corporation</p>
            <p><i class="fa-solid fa-heart"></i></p>
        </section>
        <!-- fullscreen img preview box -->
        <div class="preview-box">
            <div class="details">
                <div class="section1">
                    <span id="label"></span>
                    <span id="model"></span>
                    <span id="price"></span>
                    <span id="dimensions">
                        <span id="g-weight"></span>
                        <span id="g-length"></span>
                        <span id="g-tranchant"></span>
                    </span>
                    <span id="manche"></span>
                </div>
                <div class="section2">
                    <span class="icon fa fa-times"></span>
                </div>
            </div>
            <div class="image-box"><img src="" alt="" /></div>
        </div>
        <div class="shadow"></div>
      </body>
</html>
