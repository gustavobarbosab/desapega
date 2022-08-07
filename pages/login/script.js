export default function startLogin() {
    const form = document.querySelector("#form-login");
    form.onsubmit = function (e) {
        sendForm(form);
        e.preventDefault();
    }
}

function sendForm(form) {
    let formData = new FormData(form);
    hideError()

    const options = {
        method: "POST",
        body: formData
    }

    fetch("/pages/login/login.php", options)
        .then(response => {
            if (!response.ok) {
                throw new Error(response.status);
            }
            return response.json();
        })
        .then(response => {
            if (response.success) {
                window.location.replace('/pages/product-list/index.html');
            } else {
                showError()
                alert("Houve um erro, tente novamente!");
            }
        })
        .catch(error => {
            showError()
            console.error("Erro de rede: " + error);
        })
}

function hideError() {
    const error = document.querySelector("#loginFailMsg");
    error.style.display = "none"
}

function showError() {
    const error = document.querySelector("#loginFailMsg");
    error.style.display = "block"
}
