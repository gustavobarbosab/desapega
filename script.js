window.onload = function () {
    document.querySelectorAll(".menu__item").forEach((item) => {
        item.addEventListener("click", function () {
            const path = item.getAttribute("value");
            loadPage(path);
        });
    });

    function loadPage(path) {
        if (path == "") return;

        const container = document.getElementById("container");

        const xhr = new XMLHttpRequest();
        xhr.open("GET", "pages/" + path + "/index.html");
        // xhr.responseType = "document";
        xhr.onload = function () {
            if (xhr.status == 200) {
                container.innerHTML = xhr.responseText;
                // document.title = $path;
            }
        };
        xhr.onerror = function(error) {
            console.log("Errooo " + error);
        };
        xhr.send();
    }
}