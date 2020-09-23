/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

window.onscroll = function tornasu() {
    "use strict";
    var freccia = document.getElementById("freccia"), footer = document.getElementById("footer"), bottom;
    if (document.body.scrollTop > 200 || window.pageYOffset > 400) {
        if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - footer.clientHeight)) {
            if (window.innerWidth <= 600) {
                freccia.style.bottom = "14.5em";
            } else {
                freccia.style.bottom = "8em";
            }
            freccia.style.display = "block";
        } else {
            freccia.style.bottom = "0em";
            freccia.style.display = "block";
        }
    } else {
        freccia.style.display = "none";
    }
};

function schiaccia() {
    "use strict";
    window.scrollTo(0, 0);
}
