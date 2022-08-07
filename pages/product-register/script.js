window.onload = function(){    
    
    let titulo = document.querySelector("#titulo");
    let descricao = document.querySelector("#descricao");
    let cep = document.querySelector("#cep");
    let bairro = document.querySelector("#bairro");
    let cidade = document.querySelector("#cidade");
    let estado = document.querySelector("#estado");
    let cod_categoria = document.querySelector("#cod_categoria");
    let cod_anunciante = document.querySelector("#cod_anunciante");
    let btn = document.querySelector("#btn");
    let form = document.querySelector("#form");
    let data = new FormData(form);
    let url = "/registraProduto.php";
    let method = "POST";

    btn.addEventListener("click", function(){
        let xhr = new XMLHttpRequest();
        xhr.open(method, url);
        xhr.onreadystatechange = function(){
            if(xhr.status == 200){
                let response = xhr.responseText;
                console.log(response);
            }
        }
        xhr.send(data);
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
}