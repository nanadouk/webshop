<?php
    if( isset($_POST['info']) ) {
        $info = $_POST['info'];
        $action = $_POST['action'];
      //  if ( $action == 'Update') {
            // todo update_record($info, 'info') in DB;
      //  } else if ( $action == 'Cancel' ) {
            // todo cancel
    } // todo else
?>

<h1><?php echo $pageId ?></h1>
<p id="message-confirm">Thank you for your order! <?php echo $info['title'].". ".$info['lname']; ?></p>
<p id="message-cancel">Your order haas been canceled.</p>

<div id="dialog-confirm" title="Confirm your order">
    <p>Dear <?php echo $info['title'].". ".$info['lname']; ?></p>
    <p>Please check your order details and confirm the order.</p>
    <h4>Order details</h4>
    <?php
        echo "<p>".$info['product']."</p>";
        echo "<p>Size: ".$info['size']."</p>";
        echo "<p>Payment method: ".$info['payment']."</p>";
        echo "<p>Delivery address: ".$info['street'].", ".$info['city']."</p>";
        echo "<p>Your tel.: ".$info['tel']."</p>";
    //send_email();
    ?>
</div>

