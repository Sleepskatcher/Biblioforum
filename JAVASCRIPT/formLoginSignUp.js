/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

function controlloEmail(email) {
    "use strict";
    var espressione = /\S+@\S+\.\S+/;
    return espressione.test(email);
}

function disattivaBottone() {
    "use strict";
    document.querySelector('[type="submit"]').disabled = true;
    document.querySelector('[type="submit"]').style.cursor = "default";
}

function abilitaBottone() {
    "use strict";
    var email = document.getElementById("email").value, usernameS = document.getElementById("usernameS").value, passwordS = document.getElementById("passwordS").value, ripetiPass = document.getElementById("ripetiPass").value;
    if (passwordS.length >= 5 && usernameS !== "" && ripetiPass === passwordS && email !== "" && controlloEmail(email) === true) {
        document.querySelector('[type="submit"]').disabled = false;
        document.querySelector('[type="submit"]').style.cursor = "pointer";
    }
}

//VALIDAZIONE ACCEDI

function validateLogUsername() {
    "use strict";
    var username = document.getElementById("username").value, password = document.getElementById("password").value, avvisi = document.getElementsByClassName("avviso_log");
    if (username === "") {
        avvisi[0].innerHTML = "Compila questo campo";
        disattivaBottone();
    } else {
        avvisi[0].innerHTML = "";
        if (password !== "") {
            document.querySelector('[type="submit"]').disabled = false;
            document.querySelector('[type="submit"]').style.cursor = "pointer";
        }
    }
}

function validateLogPassword() {
    "use strict";
    var password = document.getElementById("password").value, username = document.getElementById("username").value, avvisi = document.getElementsByClassName("avviso_log");
    if (password === "") {
        avvisi[1].innerHTML = "Compila questo campo";
        disattivaBottone();
    } else {
        avvisi[1].innerHTML = "";
        if (username !== "") {
            document.querySelector('[type="submit"]').disabled = false;
            document.querySelector('[type="submit"]').style.cursor = "pointer";
        }
    }
}

//VALIDAZIONE REGISTRATI

function validateSignUpEmail() {
    "use strict";
    var email = document.querySelector('[title="email"]').value, avvisi = document.getElementsByClassName("avviso_sign_up");
    if (email === "") {
        avvisi[0].innerHTML = "Compila questo campo";
        disattivaBottone();
    } else {
        avvisi[0].innerHTML = "";
        if (email.length < 10) {
            avvisi[0].innerHTML = "Inserisci una email da minimo 10 caratteri";
            disattivaBottone();
        } else {
            if (controlloEmail(email) === false) {
                avvisi[0].innerHTML = "Inserisci una email valida";
                disattivaBottone();
            } else {
                avvisi[0].innerHTML = "";
                abilitaBottone();
            }
        }
    }
}

function validateUsernameS() {
    "use strict";
    var usernameS = document.querySelector('[title="username"]').value, avvisi = document.getElementsByClassName("avviso_sign_up");
    if (usernameS === "") {
        avvisi[1].innerHTML = "Compila questo campo";
        disattivaBottone();
    } else {
        avvisi[1].innerHTML = "";
        abilitaBottone();
    }
}

function validatePasswordS() {
    "use strict";
    var passwordS = document.getElementById("passwordS").value, avvisi = document.getElementsByClassName("avviso_sign_up");
    if (passwordS === "") {
        avvisi[2].innerHTML = "Compila questo campo";
        disattivaBottone();
    } else {
        if (passwordS.length < 5) {
            avvisi[2].innerHTML = "Password troppo corta, inserisci una password lunga minimo cinque caratteri";
            disattivaBottone();
        } else {
            avvisi[2].innerHTML = "";
            abilitaBottone();
        }
    }
}

function validateRipetiPass() {
    "use strict";
    var ripetiPass = document.getElementById("ripetiPass").value, passwordS = document.getElementById("passwordS").value, avvisi = document.getElementsByClassName("avviso_sign_up");
    if (ripetiPass === "") {
        avvisi[3].innerHTML = "Compila questo campo";
        disattivaBottone();
    } else {
        if (ripetiPass !== passwordS) {
            avvisi[3].innerHTML = "Le password non combaciano, ricontrolla quello che hai scritto";
            disattivaBottone();
        } else {
            avvisi[3].innerHTML = "";
            abilitaBottone();
        }
    }
}
