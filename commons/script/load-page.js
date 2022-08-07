// Include here the function to start the page script and reference it in function createPage 
import startRegister from "../../pages/register/register.js";
import startLogin from "../../pages/login/script.js";

export default class Page {

    constructor(path, filename, pageTitle) {
        this.path = path;
        this.filename = filename;
        this.pageTitle = pageTitle;
    }

    loadScript = function () { }

    load() {
        const path = this.path
        if (path == "") return;

        const container = document.getElementById("main__container");
        const loadScript = this.loadScript
        const pageTitle = this.pageTitle

        const xhr = new XMLHttpRequest();
        xhr.open("GET", `${path}/${this.filename}`);
        xhr.onload = function () {
            if (xhr.status == 200) {
                container.innerHTML = xhr.responseText;
                document.title = pageTitle;
                loadScript();
            }
        };
        xhr.onerror = function (error) {
            console.log("Erro ao carregar a página " + error);
        };
        xhr.send();
    }

    static create(path, filename) {
        if (filename == null) {
            filename = "index.html"
        }

        var newPage = new Page("pages/" + path, filename, "");

        switch (path) {
            case "home":
            case "":
                {
                    newPage.path = "pages/home";
                    newPage.pageTitle = "Início";
                    break;
                }
            case "register":
                {
                    newPage.pageTitle = "Cadastro";
                    newPage.loadScript = startRegister;
                    break;
                }
            case "login":
                {
                    newPage.loadScript = startLogin
                    newPage.pageTitle = "Login";
                    break;
                }
            default:
                {
                    newPage.pageTitle = "404";
                    newPage.path = "404";
                    break;
                }
        }

        return newPage;
    }
}