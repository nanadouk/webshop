<?php
    if (isset($_POST['client'])) {
        $client = $_POST['client'];
    }
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }

?>

<h1><?php echo t($pageId) ?></h1>
<p id="message-confirm"><?php echo t("Thank you for your order")?>, <?php echo $client['name']; ?>!</p>

<div id="order-info">
    <p><?php echo t("Dear")?> <span id='clientname'><?php echo $client['name']; ?></span></p>
    <p><?php echo t("Please check your order details and confirm the order")?>.</p>
    <?php
        order_details($cart->getItems());
    ?>
    <p><?php echo t("Delivery address")?>:
    <?php echo "<span>".$client['street'].", ".$client['zip'].", ".$client['city']."</span>"; ?></p>
    <p><?php echo t("Your tel.")?>: <?php echo $client['tel'];?></p>
    <p><?php echo t("Your email")?>: <span id='clientemail'><?php echo $client['email']; ?></span></p>
    <a class='button-price confirm'><?php echo t("Order and pay")?></a>
</div>

<div id="dialog-confirm" title="<?php echo t("Confirm your purchase")?>">
    <p><?php echo t("You are about to enter a binding contract of purchase")?>.</p>
</div>