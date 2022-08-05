import loadPage from "../../commons/script/load-page.js"

const PAGES_PATH = "../../pages/"

function sendForm(form) {
    let formData = new FormData(form);

    const options = {
        method: "POST",
        body: formData
    }

    fetch("/pages/register/register.php", options)
        .then(response => {
            if (!response.ok) {
                throw new Error(response.status);
            }
            return response.json();
        })
        .then(response => {
            if (response.success) {
                alert("Cadastro feito com sucesso!")
                loadPage(PAGES_PATH,"home")
            } else {
                alert("Houve um erro, tente novamente!")
            }
        })
        .catch(error => {
            console.error("Erro de rede - requisição não finalizada: " + error);
        })
}

export default function startRegister() {
    const form = document.querySelector("#form-register");
    form.onsubmit = function (e) {
      sendForm(form);
      e.preventDefault();
    }
  }