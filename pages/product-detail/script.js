window.onload = function(){

    buscaDadoProduto();

    document.forms.interesseForm.addEventListener("submit",(e) => {
        registrarInteresse(e);
    })
}

const buscaDadoProduto = async function () {

    let codigo = window.location.search.split("?cod=")[1];

    try {
        let response = await fetch(
            `buscaproduto.php?cod=${codigo}`
        )
        if(!response.ok) throw new Error(response.statusText);
        var data = await response.json();

        preencheDado(data);

    }catch (err) {
        console.error(err);
        return;
    }
}

const preencheDado = dados => {

    console.log(dados);
    let titleF = document.querySelector("#titleField");
    let descriptionF = document.querySelector("#descriptionField");
    let priceF = document.querySelector("#price");

    
    titleF.innerHTML = dados.titulo;
    descriptionF.innerHTML = dados.descricao;
    priceF.innerHTML = parseFloat(dados.preco).toLocaleString("pt-br",{style:'currency',currency: 'BRL'});

}

function activateModal() {
    document.querySelector(".modal").style.display = "block";
}

function closeModal() {
    document.querySelector(".modal").style.display ="none";
}

const registrarInteresse = async function (e) {
    e.preventDefault();

    let codigo = window.location.search.split("?cod=")[1];

    let formData = new FormData(document.forms.interesseForm);
    formData.append("cod", codigo);

    const options = {
        method: "POST",
        body: formData
    }
    let response = await fetch("registrainteresse.php",options);

    if(!response.ok) throw new Error(response.statusText);

    var data = await response.json();

    if(data.success) alert(data.detail);
    else alert("falha");
}
