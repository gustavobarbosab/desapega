var produtos = [
    {
        "name":"notebook Slim",
        "preco":"4000,00",
    },
    {
        "name":"mouse",
        "preco":"50,00",
    },
    {
        "name":"teclado",
        "preco":"500,00",
    },
    {
        "name":"cadeira gamer super insana e colorida para toda a familia",
        "preco":"7000,00",
    },
    {
        "name":"mouse pad",
        "preco":"40,00",
    },
    {
        "name":"caderno",
        "preco":"407,00",
    },
    {
        "name":"gabinete",
        "preco":"2541,00",
    },
    {
        "name":"notebook Slim",
        "preco":"4000,00",
    },
    {
        "name":"mouse",
        "preco":"50,00",
    },
    {
        "name":"teclado",
        "preco":"500,00",
    },
    {
        "name":"cadeira gamer super insana e colorida para toda a familia",
        "preco":"7000,00",
    },
    {
        "name":"mouse pad",
        "preco":"40,00",
    },
    {
        "name":"caderno",
        "preco":"407,00",
    },
    {
        "name":"gabinete",
        "preco":"2541,00",
    },
]

const appendProducts = function (dados) {
    let content = document.querySelector(".content");
    let template = document.querySelector("#templateProduct");

    for(item of dados){

        let Card = template.innerHTML
            .replace("{{item.cod}}",item.codigo)
            .replace("{{item.name}}", item.titulo)
            .replace("{{item.preco}}", item.preco)
            .replace("{{item.description}}",item.descricao);

        content.insertAdjacentHTML("beforeend", Card);

    }
}

const searchProduct = async function(pchave1,pchave2,pchave3) {
    let totalcards = document.querySelectorAll(".card-desapega");
    let page = 0;
    try {
        let response = await fetch(
            `buscaprodutos.php?pag=${page}&pchave1=${pchave1}&pchave2=${pchave2}&pchave3=${pchave3}`
        )
        if(!response.ok) throw new Error(response.statusText);
        var data = await response.json();

        appendProducts(data);

    }catch (err) {
        console.error(e);
        return;
    }
    
}

window.onload = function(){

    searchProduct("","","");
}

window.onscroll = async function () {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        searchProduct("","","");
    }
  };