const appendProducts = function (dados) {
    let container = document.querySelector(".contentDesapega");
    let template = document.querySelector("#templateProduct");

    dados.forEach(item => {
        let Card = template.innerHTML
            .replace("{{item.cod}}", item.codigo)
            .replace("{{item.name}}", item.titulo)
            .replace("{{item.preco}}", item.preco)
            .replace("{{item.description}}", item.descricao);

        container.insertAdjacentHTML("beforeend", Card);
    })
}

const searchProduct = async function (title) {
    let totalcards = document.querySelectorAll(".card-desapega").length;
    try {
        let response = await fetch(`pages/default-product-list/buscaprodutos.php?offset=${totalcards}&title=${title || ""}`)
        if (!response.ok) throw new Error(response.statusText);
        var data = await response.json();
        appendProducts(data);
    } catch (err) {
        console.error(err);
        return;
    }
}

export default function startDefaultList() {
    let search = document.getElementById("search__input")

    search.onkeydown = (evt) => {
        let titleToSearch = search.value;
        if (evt.key != "Enter") {
            return;
        }

        document.querySelectorAll(".card-desapega").forEach(e => e.remove());
        searchProduct(titleToSearch); 
    }

    window.onscroll = async function () {
        if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight-40)) {
            searchProduct(search.data);
        }
    };

    searchProduct();
}

