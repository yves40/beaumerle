/*
    register.js

    Aug 01 2022     Initial

*/

import { Logger } from './classes/logger.js';

$(document).ready( () => {

    const modulename = "register.js, Aug 01 2022, 1.03 ";

    let logger = new Logger();

    const frlabels = {
      h1title: 'Enregistrement',
      lfname : 'Prénom',
      llname : 'Nom',
      lemail: 'Votre email',
      lpassword: 'Votre mot de passe',
      lpasswordcheck: 'Vérification du mot de passe'
    };
    const enlabels = {
      h1title: 'Register',
      lfname: "First name",
      llname: "Last name",
      lemail: "Your email",
      lpassword: "Your password",
      lpasswordcheck: "Password check"
    };

    $("#b-registeruser").click( () => { registeruser(); }) 

    // --------------------------------------------------------------------------------------
    window.onload = () => {
      logger.debug(modulename);
      let navlang = navigator.language || navigator.userLanguage;
      if(!sessionStorage.getItem("pagelang")) {
              sessionStorage.setItem('pagelang', navlang);
      }
      if(sessionStorage.getItem("pagelang") === 'fr') {
        $("#h1title").text(frlabels.h1title);
        $("#lfname").text(frlabels.lfname);
        $("#llname").text(frlabels.llname);
        $("#lemail").text(frlabels.lemail);
        $("#lpassword").text(frlabels.lpassword);
        $("#lpasswordcheck").text(frlabels.lpasswordcheck);
      }
      else {
        $("#h1title").text(enlabels.h1title);
        $("#lfname").text(enlabels.lfname);
        $("#llname").text(enlabels.llname);
        $("#lemail").text(enlabels.lemail);
        $("#lpassword").text(enlabels.lpassword);
        $("#lpasswordcheck").text(enlabels.lpasswordcheck);
      }
  //    switchLang(sessionStorage.getItem("pagelang"));
    }
    // --------------------------------------------------------------------------------------
    function registeruser() {
      console.log('Call the register API');
    }
  });

  