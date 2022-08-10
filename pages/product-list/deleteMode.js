function modeDelete () {

    let cards = document.querySelectorAll(".card-desapega");

    for(let card of cards){
        card.style.boxShadow == "" ? card.style.boxShadow = " 0px 0px 10px #E89592" : card.style.boxShadow = "";
    }

    let buttons = document.querySelectorAll(".delButton");

    for(let btn of buttons){
        btn.style.visibility == "visible" ? btn.style.visibility = "hidden" : btn.style.visibility = "visible";
    }
    
}

async function deleteProduct(cod) {
    let response = await fetch(`deletaproduto.php?cod=${cod}`);

    if(!response.ok) 
        throw new Error(response.statusText);

    window.location.reload();
}