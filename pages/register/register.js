import Page from "../../commons/script/load-page.js"

function sendForm(form) {
    let formData = new FormData(form);
    hideError()

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
                alert(response.message);
                Page.create("home").load();
            } else {
                showError()
                alert("Houve um erro, tente novamente!");
            }
        })
        .catch(error => {
            showError()
            console.error("Erro de rede - requisição não finalizada: " + error);
        })
}

function hideError() {
    const error = document.querySelector("#registerFailMsg");
    error.style.display = "none"
}

function showError() {
    const error = document.querySelector("#registerFailMsg");
    error.style.display = "block"
}
 
export default function startRegister() {
    const form = document.querySelector("#form-register");
    form.onsubmit = function (e) {
      sendForm(form);
      e.preventDefault();
    }
  }