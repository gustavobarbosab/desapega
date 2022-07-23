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
]

window.onload = function(){

    let content = document.querySelector(".content");

    for(item of produtos){

        content.innerHTML += `
        <a href="" class="card-desapega">
            <div class="card-product">
                <img 
                    src="../../commons/images/placeholder_product.jpg" 
                    alt="imagemProduto" 
                    width="200"
                    height="160"
                >
                <div class="card-text">
                    <h1>${item.name}</h1>
                    <h2 id="price">R$ ${item.preco}</h2>
                </div>
            </div>
            <p class="card-description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis cum sit quam fugit, nulla animi laudantium totam ratione optio a tempora commodi obcaecati quibusdam labore assumenda dolor harum reiciendis eaque?
            </p>
        </a>
        `
    }

}