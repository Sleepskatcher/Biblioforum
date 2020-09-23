/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

function bloccoBottoneModifica() {
    "use strict";
    if (document.contains(document.getElementById("conferma_modifica"))) {
        document.getElementById("conferma_modifica").disabled = true;
        document.getElementById("conferma_modifica").style.cursor = "default";
    }
}

function attivaBottoneModifica() {
    "use strict";
    var isbn = document.getElementById("isbn_modifica").value, titolo = document.getElementById("titolo_modifica").value, trama = document.getElementById("trama_modifica").value, casaEditrice = document.getElementById("casa_modifica").value, autore = document.getElementById("autori_modifica").value;
    if (isbn !== "" && !isNaN(isbn) && isbn.length > 12 && isbn.length < 21 && titolo !== "" && trama !== "" && casaEditrice !== "" && autore !== "") {
        document.getElementById("conferma_modifica").disabled = false;
        document.getElementById("conferma_modifica").style.cursor = "pointer";
    }
}

function controlloIsbnModifica() {
    "use strict";
    var isbn = document.getElementById("isbn_modifica").value, avviso = document.getElementsByClassName("avviso_modifica");
    if (isbn === "") {
        avviso[0].innerHTML = "Completa questo campo";
        bloccoBottoneModifica();
    } else {
        if (isNaN(isbn)) {
            avviso[0].innerHTML = "Non hai inserito un numero!";
            bloccoBottoneModifica();
        } else {
            if (isbn.length < 13) {
                avviso[0].innerHTML = "Campo troppo corto, deve di 13 cifre.";
                bloccoBottoneModifica();
            } else {
                if (isbn.length > 20) {
                    avviso[0].innerHTML = "Campo troppo lungo, deve di massimo 20 cifre.";
                    bloccoBottoneModifica();
                } else {
                    avviso[0].innerHTML = "";
                    attivaBottoneModifica();
                }
            }
        }

    }
}

function controlloTitoloModifica() {
    "use strict";
    var titolo = document.getElementById("titolo_modifica").value, avviso = document.getElementsByClassName("avviso_modifica");
    if (titolo === "") {
        avviso[1].innerHTML = "Completa questo campo";
        bloccoBottoneModifica();
    } else {
        avviso[1].innerHTML = "";
        attivaBottoneModifica();
    }
}

function controlloTramaModifica() {
    "use strict";
    var trama = document.getElementById("trama_modifica").value, avviso = document.getElementsByClassName("avviso_modifica");
    if (trama === "") {
        avviso[2].innerHTML = "Completa questo campo";
        bloccoBottoneModifica();
    } else {
        avviso[2].innerHTML = "";
        attivaBottoneModifica();
    }
}

function controlloCasaEditriceModifica() {
    "use strict";
    var casaEditrice = document.getElementById("casa_modifica").value, avviso = document.getElementsByClassName("avviso_modifica");
    if (casaEditrice === "") {
        avviso[3].innerHTML = "Completa questo campo";
        bloccoBottoneModifica();
    } else {
        avviso[3].innerHTML = "";
        attivaBottoneModifica();
    }
}

function controlloAutoriModifica() {
    "use strict";
    var autore = document.getElementById("autori_modifica").value, avviso = document.getElementsByClassName("avviso_modifica");
    if (autore === "") {
        avviso[4].innerHTML = "Completa questo campo";
        bloccoBottoneModifica();
    } else {
        avviso[4].innerHTML = "";
        attivaBottoneModifica();
    }
}
