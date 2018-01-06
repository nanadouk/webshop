<div id="shoppingcart">
    <div id="heading">
        <h4>Your Shopping Cart</h4>
    </div>
<?php

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = new Cart();
    }
    $cart = $_SESSION["cart"];

    if (isset($_POST["product"])) {
        $item = $_POST["product"];

        /*if ( array_key_exists ( 'option' , $tmp )){
            $item['option'] = $tmp['option'];
        }*/
        $cart->addItem($item['id'], $item['option'], $item['quantity']);
    }

    if (isset($_POST['delete']) && isset($_POST['item']) && isset($_POST['option']) && isset($_POST['num'])){
        $cart->removeItem($_POST['item'], $_POST['option'], $_POST['num']);
    }

    if ($cart->isEmpty()) {
        echo "<div class=\"cart empty\">[Empty Cart]</div>";
    } else {
        echo "<div class=\"cart\"><table>";
       // echo "<tr><th>Article</th><th>#</th><th>Price</th><th>Total</th></tr>";
        $total = 0;
        foreach ($cart->getItems() as $item => $value) {
            $product = Product::getProductById($item);
            if ($product == null) continue;
            $price = $product->getPrice();
            foreach ($value as $option => $num) {
                $option = Option::getOptionById($option);
                $supplementary = $option->getSupplementary();
                $tmpprice = $price + $supplementary;
                $total += $tmpprice * $num;
                echo "<tr><td class='number'>$num x </td><td class='item'>{$product->getName()}<br/>
                    <span class='option'>{$option->getName()}</span></td>
                    <td><span class='edit-delete'></span><span class='edit-add'></span></td>
                    <td>".number_format($tmpprice*$num, 2)." CHF</td><td><span class='delete' 
                    onclick='javascript:deleteAll({$product->getId()}, {$option->getId()}, $num)'>
                    <i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span></td></tr>";
            }
        }
        echo "</table><table class='total'><tr><td>Sub-total</td><td>".number_format($total, 2)." CHF</td></tr>
            <tr><td>Delivery costs</td><td>FREE</td></tr>
            <tr><td>Total</td><td>".number_format($total, 2)." CHF</td></tr></table>
            <a href=".get_url($language, "Clientform")." class='button-price order'>Order</a>
            </div>";

    }

?>
</div>