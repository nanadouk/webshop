<?php
    if (isset($_POST['product']) && isset($_POST['client'])) {
        $product = $_POST['product'];
        $client = $_POST['client'];
        $action = $_POST['action'];
      //  if ( $action == 'Update') {
            // todo update_record($info, 'info') in DB;
      //  } else if ( $action == 'Cancel' ) {
            // todo cancel
    } // todo else
?>

<h1><?php echo $pageId ?></h1>
<p id="message-confirm">Thank you for your order, <?php echo $client['title'].". ".$client['lname']; ?></p>
<p id="message-cancel">Your order haas been canceled.</p>

<div id="dialog-confirm" title="Confirm your order">
    <p>Dear <?php echo $client['title'].". ".$client['lname']; ?></p>
    <p>Please check your order details and confirm the order.</p>
    <h4>Order details</h4>
    <?php
        $item = Product::getProductById($product['id']);
        echo "<p>".$item->getName()."</p>";
        echo "<p>Option: ".$product['option']."</p>";
        echo "<p>Delivery address: ".$client['street'].", ".$client['city']."</p>";
        echo "<p>Your tel.: ".$client['tel']."</p>";
        send_email();
    ?>
</div>

