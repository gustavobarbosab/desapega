window.onload = function(){
    var priceInput = document.querySelector("#priceInput");
    var priceField = document.querySelector("#price");

    // Mostrar ao usuario campo para editar o valor do produto
    priceField.addEventListener("click",()=>{
        priceInput.style.display = "block"
    })

    // Função para pegar o valor digitado no input, caso tenha sido preenchido
    // adicionar no campo HTML o novo preço, esconder input e limpa-lo
    priceInput.addEventListener("blur",()=>{
        if(priceInput.value){
            priceInput.style.display = "none";
            let price_converted = parseFloat(priceInput.value)
            priceField.innerHTML = price_converted.toLocaleString("pt-br",{style:'currency',currency: 'BRL'});
        }
    })

    document.querySelector("#addressField").addEventListener("click",() => {
        document.querySelector(".footerForm").style.display = "block"
    });
    document.querySelector(".btn-close").addEventListener("click",() => {
        document.querySelector(".footerForm").style.display = "none"
    });

    document.forms.formedit.onsubmit = function (e) {e.preventDefault();}
    
    document.querySelector("button[type=submit]").addEventListener("click",()=>{

        let codigo = window.location.search.split("?cod=")[1];
    
        prepareData();

        let formData = new FormData(document.forms.formedit);
        formData.append("cod", codigo);
        
        submitData(formData);
    });

    buscaDadoProduto();

}

const submitData = async function (form) {

    const options = {
        method: "POST",
        body: form
    }
    let response = await fetch("editaproduto.php",options);

    if(!response.ok) throw new Error(response.statusText);

    let data = await response.json();

    if(data) {
        let isConfirmed = window.confirm(data.message);
        if(isConfirmed){
            window.location.href = "http://desapego.store/default-product-list";
        }
    }

}

function prepareData() {
    let title = document.querySelector("#titleField");
    let description = document.querySelector("#descriptionField");

    document.querySelector("#titleInput").value = title.innerHTML;
    document.querySelector("#descriptionInput").value = description.innerHTML;

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

    let titleF = document.querySelector("#titleField");
    let descriptionF = document.querySelector("#descriptionField");
    let priceF = document.querySelector("#price");
    let address = document.querySelector("#addressField");

    address.innerHTML = dados.cep + " " + dados.bairro + "," + dados.cidade + "-" + dados.estado;

    document.querySelector("#cep").value = dados.cep;
    document.querySelector("#bairro").value = dados.bairro;
    document.querySelector("#cidade").value = dados.cidade;
    document.querySelector("#estado").value = dados.estado;

    titleF.innerHTML = dados.titulo;
    descriptionF.innerHTML = dados.descricao;
    document.querySelector("#priceInput").value = dados.preco;
    priceF.innerHTML = parseFloat(dados.preco).toLocaleString("pt-br",{style:'currency',currency: 'BRL'});

}

