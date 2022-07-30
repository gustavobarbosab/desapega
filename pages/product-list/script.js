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

const appendProducts = function () {
    let content = document.querySelector(".content");
    let template = document.querySelector("#templateProduct");

    for(item of produtos){

        let Card = template.innerHTML
          .replace("{{item.name}}", item.name)
          .replace("{{item.preco}}", item.preco);

        content.insertAdjacentHTML("beforeend", Card);

    }
}


window.onload = function(){

    appendProducts();

}

window.onscroll = function () {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        
    }
  };