/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

function bloccoBottoneRecensioneLibro() {
    "use strict";
    if (document.contains(document.getElementById("inserisci_recensione_libro"))) {
        document.getElementById("inserisci_recensione_libro").disabled = true;
        document.getElementById("inserisci_recensione_libro").style.cursor = "default";
    }
}

function inserisciRecensioneLibro() {
    "use strict";
    var recensione = document.getElementById("recensione_libro").value, avviso = document.getElementById("avviso_recensione");
    if (recensione.length < 30) {
        avviso.innerHTML = "Scrivi una recensione più lunga, devi avere almeno 30 caratteri!";
        bloccoBottoneRecensioneLibro();
    } else {
        avviso.innerHTML = "";
        document.getElementById("inserisci_recensione_libro").disabled = false;
        document.getElementById("inserisci_recensione_libro").style.cursor = "pointer";
    }
}

function bottoneResetRecensione() {
    "use strict";
    var avviso = document.getElementById("avviso_recensione");
    avviso.innerHTML = "";
}
