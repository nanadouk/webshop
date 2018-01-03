<?php
    include "functions.php";
    if (isset($_POST['item']) && isset($_POST['price'])) {
        $item = $_POST['item'];
        $price = $_POST['price'];
        $cat = explode(' ', $item)[0];
        $id = explode(' ', $item)[1];
        $pageId = "Clientform";
        $url = "index.php?lang=$language&page=$pageId";
        if ($cat == "Pizza") {
            echo "<form class='item-options-form' action='$url' method='post'>" .
                "<div class='item-options'>".
                "<span>Options</span>" .
                "<p><label>Size:</label></p>" .
                "<input type='radio' onclick='javascript:changeRadio(0, \"$id\")' name='info[size]' value='20' required checked='checked' />20 cm<br/>" .
                "<input type='radio' onclick='javascript:changeRadio(5, \"$id\")' name='info[size]' value='30' required />30 cm (+5 CHF)<br/>" .
                "<input type='radio' onclick='javascript:changeRadio(10, \"$id\")' name='info[size]' value='40' required />40 cm (+10 CHF)<br/></div>" .
                "<div class='options-footer'><div class='item-quantity'>" .
                "<span onclick='javascript:minusOne(\"$id\")'><i class=\"fa fa-minus\" aria-hidden=\"true\"></i></span>".
                "<input type='text' id='quantity$id' name='info[quantity]' class='quantity' value='1'>" .
                "<span onclick='javascript:plusOne(\"$id\")'><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></span></div>".
                "<input type='hidden' name='info[item]' value='$item'/>" .
                "<input type='hidden' name='info[price]' value='$price'/>" .
                "<div class='item-total'><input type='submit' class='button-price' id='total$id' value='$price CHF' /></div></div>" .
                "</form>";
        }
    }
