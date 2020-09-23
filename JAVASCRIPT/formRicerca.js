/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

function bottoneRicerca() {
    "use strict";
    var ricerca = document.querySelector('[name="ricerca"]').value, bottone = document.querySelector('[title="bottonericerca"]');
    if (ricerca.length > 0) {
        bottone.disabled = false;
        bottone.style.cursor = "pointer";
    } else {
        bottone.disabled = true;
        bottone.style.cursor = "default";
    }
}
