<div id="shoppingcart">
    <div class="cart-wrapper">
        <div class="heading">
            <h4>Your Shopping Cart</h4>
        </div>
<?php

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = new Cart();
    }
    $cart = $_SESSION["cart"];

    if (isset($_POST["product"])) {
        $item = $_POST["product"];
        $cart->addItem($item['id'], $item['option'], $item['quantity']);
    }
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case "removeAll":
                if (isset($_POST['item']) && isset($_POST['option']) && isset($_POST['num'])) {
                    $item = (int)$_POST['item'];
                    $option = (int)$_POST['option'];
                    $num = (int)$_POST['num'];
                    $cart->removeItem($item, $option, $num);
                }
                break;
            case "remove":
                if (isset($_POST['item']) && isset($_POST['option'])) {
                    $item = (int)$_POST['item'];
                    $option = (int)$_POST['option'];
                    $cart->removeItem($item, $option, 1);
                }
                break;
            case "add":
                if (isset($_POST['item']) && isset($_POST['option'])) {
                $item = (int)$_POST['item'];
                $option = (int)$_POST['option'];
                $cart->addItem($item, $option, 1);
            }
                break;
        }
    }

    render_cart($cart, $language);

?>
    </div>
</div>