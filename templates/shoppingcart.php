<div id="shoppingcart">
    <div class="cart-wrapper">
        <div class="heading">
            <h4><?php echo t("Your Shopping Cart") ?></h4>
        </div>
        <div class='order-details'>
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
            case "send":
                if (isset($_POST['address']) && isset($_POST['tel']))
                    $order['address'] = $_POST['tel'].", ".$_POST['address'];
                $items = $cart->getItems();
                $order['userID'] = (int)$_SESSION['id'];
                foreach ($items as $item=>$value) {
                    $order['productID'] = (int)$item;
                    foreach ($value as $option => $num) {
                        $order['optionvalueID'] = (int)$option;
                        $order['quantity'] = (int)$num;
                        $order['date'] = date("d/m/Y H:i");
                        Order::insert($order);
                    }
                }
                send_email($_SESSION['user'], $_SESSION['email']);
                unset($_SESSION['cart']);
                break;
        }
    }

    render_cart($cart);

?>
        </div>
    </div>
</div>