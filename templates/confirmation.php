<?php

    $address = isset($_POST['address']) ? $_POST['address'] : false;
    if ( $address ) {

        $formIsValid = false;
        $errors = array();

        if ($address['tel'] == '' || !preg_match('/^[0-9]{10}$/', $address['tel'])) {
            $errors['tel'] = 'Please enter a valid name!';
        }

        if ($address['street'] == '' || !preg_match('/^([a-zA-Z0-9]+[\s\-]?)*$/', $address['street'])) {
            $errors['street'] = 'Please enter a valid address!';
        }

        if ($address['zip'] == '' || !preg_match('/^[1-9][0-9]{3}$/', $address['zip'])) {
            $errors['zip'] = 'Please enter a valid zip!';
        }

        if ($address['city'] == '' || !preg_match('/^([a-zA-Z]+\s?)*$/', $address['city'])) {
            $errors['city'] = 'Please enter a valid city!';
        }

        if (count($errors) == 0) {
            $formIsValid = true;
        }

        if (!$formIsValid) {
            $_SESSION['errors'] = $errors;
            $_SESSION['address'] = $address;
            header("Location: index.php?page=Order");
        }
    }

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }

    if (isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }

?>

<h1><?php echo t($pageId) ?></h1>
<p id="message-confirm"><?php echo t("Thank you for your order")?>, <?php echo $user; ?>!</p>

<div id="order-info">
    <p><?php echo t("Dear")?> <span id='clientname'><?php echo $user ?></span></p>
    <p><?php echo t("Please check your order details and confirm the order")?>.</p>
    <?php
        order_details($cart->getItems());
    ?>
    <p><?php echo t("Delivery address")?>:
    <?php echo "<span id='address'>".$address['street'].", ".$address['zip'].", ".$address['city']."</span>"; ?></p>
    <p><?php echo t("Your tel.")?>: <span id="tel"><?php echo $address['tel'];?></span></p>
    <a class='button-price confirm'><?php echo t("Order and pay")?></a>
</div>

<div id="dialog-confirm" title="<?php echo t("Confirm your purchase")?>">
    <p><?php echo t("You are about to enter a binding contract of purchase")?>.</p>
</div>
