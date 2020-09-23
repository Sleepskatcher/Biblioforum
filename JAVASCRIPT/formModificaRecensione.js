/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

var numeroRecensione;
var mostraRecensioni = 5;

function trovaNumero() {
    "use strict";
    var recensione = document.getElementsByClassName("modifica_recensione_utente"), x;
    for (x = 0; x < recensione.length; x = x + 1) {
        if (recensione[x] === document.activeElement) {
            numeroRecensione = x;
        }
    }
}

function controlloModificaRecensione() {
    "use strict";
    var recensione = document.getElementsByClassName("modifica_recensione_utente"), avviso = document.getElementsByClassName("avviso_modifica_recensione"), bottone = document.getElementsByClassName("bottone_modifica_recensione"), x = numeroRecensione;
    if (x !== null) {
        if (recensione[x].value.length < 30) {
            avviso[x].innerHTML = "Scrivi una recensione più lunga, devi avere almeno 30 caratteri!";
            bottone[x].disabled = true;
            bottone[x].style.cursor = "default";
        } else {
            avviso[x].innerHTML = "";
            bottone[x].disabled = false;
            bottone[x].style.cursor = "pointer";
        }
    }
}

function nascondiBottoneRecensione() {
    "use strict";
    if (!document.contains(document.getElementById("tutte_recensioni")) && document.contains(document.getElementById("mostra_altri_recensioni"))) {
        document.getElementById("mostra_altri_recensioni").style.display = "none";
    } else if (document.contains(document.getElementById("tutte_recensioni"))) {
        var commenti = document.getElementById("tutte_recensioni").children, numero = commenti.length, bottone = document.getElementById("mostra_altri_recensioni");
        if (numero <= 5) {
            bottone.style.display = "none";
        } else {
            bottone.style.display = "block";
            bottone.disabled = false;
        }
    }
}

function avvisoBottoneClickRecensione() {
    "use strict";
    if (document.contains(document.getElementById("tutte_recensioni"))) {
        var commenti = document.getElementById("tutte_recensioni").children, numero = commenti.length, avviso = "Non ci sono recensioni da mostrare", bottone = document.getElementById("mostra_altri_recensioni");
        if (mostraRecensioni >= numero) {
            bottone.innerHTML = avviso;
            bottone.title = avviso;
            bottone.disabled = true;
            bottone.style.cursor = "default";
        }
    } else {
        document.getElementById("mostra_altri").style.display = "none";
    }
}

function nascondiRecensione() {
    "use strict";
    if (document.contains(document.getElementById("tutte_recensioni"))) {
        var commenti = document.getElementById("tutte_recensioni").children, numero = commenti.length, x = 0;
        if (numero > 4) {
            for (x = 5; x !== numero; x = x + 1) {
                commenti[x].style.display = "none";
            }
        }
    } else {
        mostraRecensioni = 5;
    }
}

function mostraRecensione() {
    "use strict";
    if (document.contains(document.getElementById("tutte_recensioni"))) {
        var commenti = document.getElementById("tutte_recensioni").children, numero = commenti.length, x = mostraRecensioni;
        mostraRecensioni = mostraRecensioni + 5;
        if (mostraRecensioni > numero) {
            mostraRecensioni = numero;
        }
        if (numero > 4) {
            for (x; x !== mostraRecensioni; x = x + 1) {
                commenti[x].style.display = "block";
            }
        }
    } else {
        mostraRecensioni = 5;
    }
}
