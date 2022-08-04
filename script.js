import loadPage from "./commons/script/load-page.js"
import startRegister from "./pages/register/register.js"

const PAGES_PATH = "pages/"

window.onload = function () {
    loadPage(PAGES_PATH, "home") // TODO remover
    document.querySelectorAll(".menu__item").forEach((item) => {
        item.addEventListener("click", function () {
            const pageName = item.getAttribute("value");
            loadPage(PAGES_PATH, pageName);
            loadJavaScript(pageName)
        });
    });
}

function loadJavaScript(page) {
    var start = {}
    switch (page) {
        case 'register':
            start = startRegister
            break;
        default:
            console.log(`Sorry, we are out of ${expr}.`);
    }
    setTimeout(function () {
        start();
    }, 800);
}