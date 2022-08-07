import Page from "./commons/script/load-page.js"
import "./pages/register/register.js"

window.onload = function () {
    const path = window.location.pathname.split("/")[1]
    var newPage = new Page(path,"index.html");
    switch (path) {
        case "":
            {
                newPage.load();
                loadJavaScript(path)
                break;
            }
        case "register":
            {
                newPage.load();
                loadJavaScript(path)
                break;
            }
        case "login":
            {
                newPage.load();
                break;
            }
        default:
            {
                newPage.path = "404";
                newPage.load();
                break;
            }    
    }


    document.querySelectorAll(".menu__item").forEach((item) => {
        item.addEventListener("click", function () {
            const path = item.getAttribute("path");
            const fileName = item.getAttribute("filename");
            let newPage = new Page(path, fileName);
            newPage.load();
            loadJavaScript(path);

            if (path.includes("home")) {
                window.history.pushState("", "", "/");
                return;
            }

            window.history.pushState("", "", path);
        });
    });

    function loadJavaScript(page) {
        // var start = {}
        // switch (page) {
        //     case 'register':
        //         start = startRegister;
        //         break;
        //     default:
        //         console.log(`Sorry, we are out of ${page}.`);
        // }
        // setTimeout(function () {
        //     start();
        // }, 800);
    }
}