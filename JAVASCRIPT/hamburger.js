/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

function hamburger() {
    "use strict";
    var menu = document.getElementById("menu"), i = 0, elementi = document.getElementsByClassName("hamburger"), numero = elementi.length;
    for (i; i !== numero; i = i + 1) {
        if (elementi[i].style.display === "none" || elementi[i].style.display === "") {
            menu.style.display = "block";
            elementi[i].style.display = "block";
        } else {
            menu.style.display = "none";
            elementi[i].style.display = "none";
        }
    }
}

function chiudiHam() {
    "use strict";
    var menu = document.getElementById("menu"), i = 0, elementi = document.getElementsByClassName("hamburger"), numero = elementi.length;
    if (window.innerWidth <= 600) {
        for (i; i !== numero; i = i + 1) {
            menu.style.display = "none";
            elementi[i].style.display = "none";
        }
    }
}

window.onresize = function () {
    "use strict";
    var menu = document.getElementById("menu"), i = 0, elementi = document.getElementsByClassName("hamburger"), numero = elementi.length;
    if (window.innerWidth <= 600) {
        for (i; i !== numero; i = i + 1) {
            menu.style.display = "none";
            elementi[i].style.display = "none";
        }
    } else {
        for (i; i !== numero; i = i + 1) {
            menu.style.display = "block";
            elementi[i].style.display = "block";
        }

    }
};
