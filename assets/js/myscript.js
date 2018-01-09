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
        changeTotalBtn(id);
    }
}

function plusOne(id) {
    quantity++;
    document.getElementById("quantity" + id).value = quantity;
    changeTotalBtn(id);
}

function changeRadio(change, id) {
    if (change == 0){
        price = init;
    } else {
        price = init + change;
    }
    changeTotalBtn(id);
}

function changeTotalBtn(id) {
    total = quantity * parseFloat(price);
    document.getElementById("total"+id).firstChild.innerHTML=total.toFixed(2) + " CHF | ";
}

function removeAll(item, option, num, price) {
   $.post({
        url: window.location.href,
        data:"action=removeAll&item=" + item + "&option=" + option + "&num=" + num,
        success:function(html) {
            document.getElementById("item"+item+option).outerHTML= '';
            changeTotalDOM(num*price);
        }
    });
}

function removeItem(item, option, price){
    $.post({
        url: window.location.href,
        data:"action=remove&item=" + item + "&option=" + option,
        success:function(html) {
            element = document.getElementById("item"+item+option);
            num = parseInt(element.firstChild.innerHTML.split(' '));
            if (num == 1) {
                element.outerHTML= '';
            } else {
                element.firstChild.innerHTML = (num-1)+ " x ";
                tmpprice =  parseFloat(element.querySelector("td:nth-child(4)").innerHTML.split(' '));
                element.querySelector("td:nth-child(4)").innerHTML = (tmpprice-price).toFixed(2)+ " CHF";
            }
            changeTotalDOM(price);
        }
    });
}

function addItem(item, option, price){
    $.post({
        url: window.location.href,
        data:"action=add&item=" + item + "&option=" + option,
        success:function(html) {
            element = document.getElementById("item"+item+option);
            num = parseInt(element.firstChild.innerHTML.split(' '));
            element.firstChild.innerHTML = (num+1)+ " x ";
            tmpprice =  parseFloat(element.querySelector("td:nth-child(4)").innerHTML.split(' '));
            element.querySelector("td:nth-child(4)").innerHTML = (tmpprice+price).toFixed(2)+ " CHF";
            amount = parseFloat(document.getElementById("sub-amount").innerHTML.split(' '));
            document.getElementById("sub-amount").innerHTML = (amount+price).toFixed(2) + " CHF";
            document.getElementById("amount").innerHTML = (amount+price).toFixed(2)+ " CHF";
        }
    });
}

function changeTotalDOM(price) {
    amount = parseFloat(document.getElementById("sub-amount").innerHTML.split(' '));
    result = amount - price;
    document.getElementById("sub-amount").innerHTML = result.toFixed(2) + " CHF";
    document.getElementById("amount").innerHTML = result.toFixed(2) + " CHF";
}

function openMenu(){
        var menu = document.getElementById("top-menu");
        if (menu.className === "row") {
            menu.className += " responsive";
        } else {
            menu.className = "row";
        }
}

