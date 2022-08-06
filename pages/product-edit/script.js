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

    document.forms.formedit.addEventListener("submit",(e)=>{
        e.preventDefault();

        let codigo = window.location.search ? window.location.search.split('?')[1] : 1;
    
        prepareData(codigo);

        document.forms.formedit.submit();

    });
}

function prepareData(codigo) {
    let title = document.querySelector(".productDetail h3");
    let price = document.querySelector("#price");
    let description = document.querySelector(".productDetail p");

    document.querySelector("#titleInput").value = title.innerHTML;
    document.querySelector("#descriptionInput").value = description.innerHTML;
    document.querySelector("#priceInput").value = price.innerHTML;

    
 
}

const handleEdit = async function () {


}

