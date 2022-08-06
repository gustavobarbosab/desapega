window.onload = function(){

    buscaDadoProduto();
}

const buscaDadoProduto = async function (codigo) {

    try {
        let response = await fetch(
            `buscaproduto.php?cod=${codigo}`
        )
        if(!response.ok) throw new Error(response.statusText);
        var data = await response.json();

        console.log(data);

    }catch (err) {
        console.error(e);
        return;
    }
}