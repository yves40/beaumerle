<?php ?>

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
    <section class="info" id="info">
            <h1 id="h1-sitetitle" >A</h1>
            <p id="p-title">A</p>
    </section>
    <!----------------------------- The products ---------------------------->
    <section class="products" id="products">
        <!-- Now the catalog section with dynamic images -->
        <div class="row.centered">
            <button id="opengallery"></button>
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
    <!---------------------------- The contacts ---------------------------->
    <section class="contacts" id="contacts">
        <h1 id="h1-contacts" ></h1>
        <div>
            <p id="p-contactslist"></p>
        </div>
    </section>
    <!----------------------------- Footer  ---------------------------->
    <section class="footer">
        <h4 id="h4-qui"></h4>
        <p id="p-qui"></p>
        <p id="p-copyright"></p>
        <p><i class="fa-solid fa-heart"></i></p>
    </section>
    <!---------------------- fullscreen img preview box ----------------->
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
