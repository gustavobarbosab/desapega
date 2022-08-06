export default class Page {
    constructor(path, filename) {
        this.path = path;
        this.filename = filename;
    }

    load() {
        const path = this.path
        if (path == "") return;

        const container = document.getElementById("main__container");

        const xhr = new XMLHttpRequest();
        xhr.open("GET", `/pages/${path}/${this.filename}`);
        xhr.onload = function () {
            if (xhr.status == 200) {
                container.innerHTML = xhr.responseText;
                document.title = path.toLocaleUpperCase();
            }
        };
        xhr.onerror = function (error) {
            console.log("Erro ao carregar a página " + error);
        };
        xhr.send();
    }
}