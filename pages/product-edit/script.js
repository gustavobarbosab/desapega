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
            priceField.innerText = price_converted.toLocaleString("pt-br",{style:'currency',currency: 'BRL'});
            priceInput.value = "";
        }
    })

    document.forms.formedit.addEventListener("submit",getData());
}

function getData() {
    let title = document.querySelector(".productDetail h3");
    let price = document.querySelector("#price");
    let description = document.querySelector(".productDetail p");

    window.alert(title.innerText + " " + price.innerText + " " + description.innerText);
}

