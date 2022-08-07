import Page from "./commons/script/load-page.js"

window.onload = function () {
    const path = window.location.pathname.split("/")[1]
    let newPage = Page.create(path);
    newPage.load();

    document.querySelectorAll(".menu__item").forEach((item) => {
        item.addEventListener("click", function () {
            const path = item.getAttribute("path");
            let newPage = Page.create(path);
            newPage.load();

            if (path.includes("home")) {
                window.history.pushState("", "", "/");
                return;
            }

            window.history.pushState("", "", path);
        });
    });
}