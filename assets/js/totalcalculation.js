var price;
var quantity;
var total;
var init;

function initPrice(p){
    price = p;
    init = p;
    quantity = 1;
}

function minusOne(id){
    if (quantity > 1) {
        quantity--;
        document.getElementById("quantity"+id).value = quantity;
        changeTotal(id);
    }
}

function plusOne(id) {
    quantity++;
    document.getElementById("quantity" + id).value = quantity;
    changeTotal(id);
}

function changeRadio(change, id) {
    if (change == 0){
        price = init;
    } else {
        price = init + change;
    }
    changeTotal(id);
}

function changeTotal(id) {
    total = quantity * parseFloat(price);
    document.getElementById("total"+id).firstChild.innerHTML=total.toFixed(2).replace(".", ",") + " CHF | ";
}