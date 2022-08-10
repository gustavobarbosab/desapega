const appendProducts = function (dados) {
    let content = document.querySelector("#main__container");
    let template = document.querySelector("#templateProduct");

    for(item of dados){

        let Card = template.innerHTML
            .replace("item__code_desapego",item.codProd)
            .replace("{{cod-item}}",item.codProd)
            .replace("{{item.name}}", item.titulo)
            .replace("{{item.preco}}", item.preco)
            .replace("{{item.description}}",item.descricao);

        content.insertAdjacentHTML("beforeend", Card);
    }
}

const searchProduct = async function(title) {
    let totalcards = document.querySelectorAll(".card-desapega").length;
    try {
        let response = await fetch(`buscaprodutos.php?offset=${totalcards}`)
        if (!response.ok) throw new Error(response.statusText);
        var data = await response.json();
        appendProducts(data);
    } catch (err) {
        console.error(err);
        return;
    }
    
}

window.onload = function(){
    window.onscroll = async function () {
        if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight-40)) {
            searchProduct(search.data);
        }
    };

    searchProduct();
}