window.onload = function(){

    buscaDadoProduto();
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