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
<p>Your order has been sent.</p>
<br/>
<h4>Order details</h4>
<?php
    echo "<p>".$info['product']."</p>";
    echo "<p>Size: ".$info['size']."</p>";
    echo "<p>Payment method: ".$info['payment']."</p>";
    echo "<p>Shipping address: ".$info['street'].", ".$info['city']."</p>";
    echo "<p>Your tel.: ".$info['tel']."</p>";
    send_email();
?>

