/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

function disattivaBottoneUtente() {
    "use strict";
    document.querySelector('[type="submit"]').disabled = true;
    document.querySelector('[type="submit"]').style.cursor = "default";
}

function controlloEmail(email) {
    "use strict";
    var espressione = /\S+@\S+\.\S+/;
    return espressione.test(email);
}

function attivaBottoneUtente() {
    "use strict";
    var cambioEmail = document.getElementById("cambia_email").value, cambioPassword = document.getElementById("cambia_password").value, ripetiCambioPassword = document.getElementById("ripeti_password").value;
    if (cambioEmail !== "" || (cambioPassword !== "" && ripetiCambioPassword !== "" && cambioPassword.length > 4 && ripetiCambioPassword === cambioPassword)) {
        document.querySelector('[type="submit"]').disabled = false;
        document.querySelector('[type="submit"]').style.cursor = "pointer";
    }
}

function controlloCambioEmail() {
    "use strict";
    var cambioEmail = document.getElementById("cambia_email").value, avviso = document.getElementsByClassName("avviso_cambio");
    if (cambioEmail === "") {
        avviso[0].innerHTML = "Compila questo campo";
    } else {
        if (controlloEmail(cambioEmail) === false) {
            avviso[0].innerHTML = "Inserisci una email valida";
        } else {
            avviso[0].innerHTML = "";
            attivaBottoneUtente();
        }
    }
}

function controlloCambioPassword() {
    "use strict";
    var cambioPassword = document.getElementById("cambia_password").value, avviso = document.getElementsByClassName("avviso_cambio");
    if (cambioPassword === "") {
        avviso[1].innerHTML = "Compila questo campo";
    } else {
        if (cambioPassword.length < 5) {
            avviso[1].innerHTML = "Inserisci una password lunga minimo 5 caratteri";
        } else {
            avviso[1].innerHTML = "";
            attivaBottoneUtente();
        }
    }
}

function controlloRipetiCambioPassword() {
    "use strict";
    var ripetiCambioPassword = document.getElementById("ripeti_password").value, cambioPassword = document.getElementById("cambia_password").value, avviso = document.getElementsByClassName("avviso_cambio");
    if (ripetiCambioPassword === "") {
        avviso[2].innerHTML = "Compila questo campo";
    } else {
        if (ripetiCambioPassword !== cambioPassword) {
            avviso[2].innerHTML = "Le password non combaciano";
        } else {
            avviso[2].innerHTML = "";
            attivaBottoneUtente();
        }
    }
}
