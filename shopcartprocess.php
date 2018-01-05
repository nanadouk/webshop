<?php
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = new Cart();
}
$cart = $_SESSION["cart"];

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
                    <td>".($tmpprice*$num)."</td><td><span class='delete' 
                    onclick='javascript:deleteAll({$product->getId()}, {$option->getId()}, $num)'>
                    <i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span></td></tr>";
        }
    }
    echo "<tr><td rowspan=\"3\"></td><td>$total</td></tr>";
    echo "</table></div>";

}