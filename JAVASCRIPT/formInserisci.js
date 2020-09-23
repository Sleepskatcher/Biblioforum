/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

function bloccoBottone() {
    "use strict";
    if (document.contains(document.getElementById("inserimento_libro"))) {
        document.getElementById("inserimento_libro").disabled = true;
        document.getElementById("inserimento_libro").style.cursor = "default";
    }
}

function attivaBottone() {
    "use strict";
    var isbn = document.getElementById("isbn").value, titolo = document.getElementById("titolo").value, trama = document.getElementById("trama").value, casaEditrice = document.getElementById("casa_editrice").value, autore = document.getElementById("autore").value;
    if (isbn !== "" && !isNaN(isbn) && isbn.length > 12 && isbn.length < 21 && titolo !== "" && trama !== "" && casaEditrice !== "" && autore !== "") {
        document.getElementById("inserimento_libro").disabled = false;
        document.getElementById("inserimento_libro").style.cursor = "pointer";
    }
}


function controlloIsbn() {
    "use strict";
    var isbn = document.getElementById("isbn").value, avviso = document.getElementsByClassName("avviso_inserisci");
    if (isbn === "") {
        avviso[0].innerHTML = "Completa questo campo";
        bloccoBottone();
    } else {
        if (isNaN(isbn)) {
            avviso[0].innerHTML = "Non hai inserito un numero!";
            bloccoBottone();
        } else {
            if (isbn.length < 13) {
                avviso[0].innerHTML = "Campo troppo corto, deve essere di 13 cifre.";
                bloccoBottone();
            } else {
                if (isbn.length > 20) {
                    avviso[0].innerHTML = "Campo troppo lungo, deve essere di massimo 20 cifre.";
                    bloccoBottone();
                } else {
                    avviso[0].innerHTML = "";
                    attivaBottone();
                }
            }
        }

    }
}

function controlloTitolo() {
    "use strict";
    var titolo = document.getElementById("titolo").value, avviso = document.getElementsByClassName("avviso_inserisci");
    if (titolo === "") {
        avviso[1].innerHTML = "Completa questo campo";
        bloccoBottone();
    } else {
        avviso[1].innerHTML = "";
        attivaBottone();
    }
}

function controlloTrama() {
    "use strict";
    var trama = document.getElementById("trama").value, avviso = document.getElementsByClassName("avviso_inserisci");
    if (trama === "") {
        avviso[2].innerHTML = "Completa questo campo";
        bloccoBottone();
    } else {
        avviso[2].innerHTML = "";
        attivaBottone();
    }
}

function controlloCasaEditrice() {
    "use strict";
    var casaEditrice = document.getElementById("casa_editrice").value, avviso = document.getElementsByClassName("avviso_inserisci");
    if (casaEditrice === "") {
        avviso[3].innerHTML = "Completa questo campo";
        bloccoBottone();
    } else {
        avviso[3].innerHTML = "";
        attivaBottone();
    }
}

function controlloAutori() {
    "use strict";
    var autore = document.getElementById("autore").value, avviso = document.getElementsByClassName("avviso_inserisci");
    if (autore === "") {
        avviso[4].innerHTML = "Completa questo campo";
        bloccoBottone();
    } else {
        avviso[4].innerHTML = "";
        attivaBottone();
    }
}

function bottoneReset() {
    "use strict";
    var avviso = document.getElementsByClassName("avviso_inserisci"), lunghezza = document.getElementsByClassName("avviso_inserisci").length, x = 0;
    for (x; x < lunghezza; x = x + 1) {
        avviso[x].innerHTML = "";
    }
}
