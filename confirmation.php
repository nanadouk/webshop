<?php
    if (isset($_POST['client'])) {
        $client = $_POST['client'];
    }
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
?>

<h1><?php echo $pageId ?></h1>
<p id="message-confirm">Thank you for your order, <?php echo $client['name']; ?>!</p>

<div id="order-info">
    <p>Dear <?php echo $client['name']; ?></p>
    <p>Please check your order details and confirm the order.</p>
    <p>Delivery address:
    <?php echo "<span>".$client['street'].", ".$client['zip'].", ".$client['city']."</span>"; ?></p>
    <p>Your tel.: <?php echo $client['tel'];?></p>
    <a class='button-price confirm'>Order and pay</a>
</div>

<div id="dialog-confirm" title="Confirm your purchase">
    <p>You are about to enter a binding contract of purchase.</p>
</div>