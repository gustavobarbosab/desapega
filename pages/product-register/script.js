window.onload = function(){ 
    let btn_registrar = document.querySelector("#btn_registrar");
    let btn_cancelar = document.querySelector("#btn_cancelar");
    btn_registrar.addEventListener("click", cadastrarProduto);
    btn_cancelar.addEventListener("click", cancelar);
    // Função para pegar o valor digitado no input, caso tenha sido preenchido
    // adicionar no campo HTML o novo preço, esconder input e limpa-lo    
}

function cadastrarProduto(form){
    let formData = new FormData(form);     
        
    let produto = {
        method: "POST",
        formData: formData    
    };

    let url = "/registraProduto.php";
    let method = "POST";
    
    let xhr = new XMLHttpRequest();


    xhr.open(method, url);
    xhr.onreadystatechange = function(){
        if(xhr.status == 200){
            let response = xhr.responseText;
            console.log(response);
        }
    } 
    xhr.send(produto);
}

function cancelar(){
    //recarregar a página
    window.location.reload();
}