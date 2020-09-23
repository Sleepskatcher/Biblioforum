/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

var contaCommenti = 5;

function nascondiBottone() {
    "use strict";
    if (!document.contains(document.getElementById("lista_commenti")) && document.contains(document.getElementById("mostra_altri"))) {
        document.getElementById("mostra_altri").style.display = "none";
    } else if (document.contains(document.getElementById("lista_commenti"))) {
        var commenti = document.getElementById("lista_commenti").children, numero = commenti.length, bottone = document.getElementById("mostra_altri");
        if (numero <= 5) {
            bottone.style.display = "none";
        } else {
            bottone.style.display = "block";
            bottone.disabled = false;
        }
    }
}

function avvisoBottoneClick() {
    "use strict";
    if (document.contains(document.getElementById("lista_commenti"))) {
        var commenti = document.getElementById("lista_commenti").children, numero = commenti.length, avviso = "Non ci sono recensioni da mostrare", bottone = document.getElementById("mostra_altri");
        if (contaCommenti >= numero) {
            bottone.innerHTML = avviso;
            bottone.title = avviso;
            bottone.disabled = true;
            bottone.style.cursor = "default";
        }
    } else {
        document.getElementById("mostra_altri").style.display = "none";
    }
}

function nascondi() {
    "use strict";
    if (document.contains(document.getElementById("lista_commenti"))) {
        var commenti = document.getElementById("lista_commenti").children, numero = commenti.length, x = 0;
        if (numero > 4) {
            for (x = 5; x !== numero; x = x + 1) {
                commenti[x].style.display = "none";
            }
        }
    } else {
        contaCommenti = 5;
    }
}

function mostra() {
    "use strict";
    if (document.contains(document.getElementById("lista_commenti"))) {
        var commenti = document.getElementById("lista_commenti").children, numero = commenti.length, x = contaCommenti;
        contaCommenti = contaCommenti + 5;
        if (contaCommenti > numero) {
            contaCommenti = numero;
        }
        if (numero > 4) {
            for (x; x !== contaCommenti; x = x + 1) {
                commenti[x].style.display = "block";
            }
        }
    } else {
        contaCommenti = 5;
    }
}
