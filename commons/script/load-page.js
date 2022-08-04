export default function loadPage(pathToPages, page) {
    if (page == "") return;

    const container = document.getElementById("main__container");

    const xhr = new XMLHttpRequest();
    xhr.open("GET", pathToPages + page + "/index.html");
    xhr.onload = function () {
        if (xhr.status == 200) {
            container.innerHTML = xhr.responseText;
            document.title = page;
        }
    };
    xhr.onerror = function(error) {
        console.log("Errooo " + error);
    };
    xhr.send();
}