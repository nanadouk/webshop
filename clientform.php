<?php
    if( isset($_POST['info']) ) {
        $info = $_POST['info'];
    } // todo else
?>
<form action="<?php echo get_url($language, "Confirmation")?>" method="post">

    <h3>Personal data</h3>
    <p>
        <fieldset>
            <legend>Title<abbr title="This field is mandatory">*</abbr></legend>
            <input type="radio" required name="info[title]" value="Mr"><label>Mr.</label>
            <input type="radio" required name="info[title]" value="Ms"><label>Ms.</label>
        </fieldset>
    </p>
    <p>
        <label>First name:<abbr title="This field is mandatory">*</abbr></label>
        <input name="info[fname]" maxlength="20" required/>
    </p>
    <p>
        <label>Last name:<abbr title="This field is mandatory">*</abbr></label>
        <input name="info[lname]" maxlength="20" required/>
    </p>
    <p>
        <label>E-Mail:<abbr title="This field is mandatory">*</abbr></label>
        <input type="email" name="info[email]" maxlength="30" required/>
    </p>
    <p>
        <label>Phone:<abbr title="This field is mandatory">*</abbr></label>
        <input type="tel" name="info[tel]" pattern="[0-9]{10}" required />
    </p>

    <h3>Delivery address</h3>
    <p>
        <label>Street:<abbr title="This field is mandatory">*</abbr></label>
        <input name="info[street]" maxlength="20" required/>
    </p>
    <p>
        <label>City:<abbr title="This field is mandatory">*</abbr></label>
        <input name="info[city]" maxlength="20" required/>
    </p>
    <p>
        <label>Country:</label>
        <input disabled="disabled" value="Switzerland" />
    </p>
    <br />
    <p>
        <label>Comments (optional):</label>
        <textarea name="info[comment]" rows="5" cols="30" maxlength="150"></textarea>
    </p>

    <input type="hidden" name="info[product]" value="<?php echo $info['product'] ?>" />
    <input type="hidden" name="info[size]" value="<?php echo $info['size'] ?>" />
    <input type="hidden" name="info[payment]" value="<?php echo $info['payment'] ?>" />

    <p>
        <input type="submit" name="action" value="Next" />
        <input type="submit" name="action" value="Cancel" />
    </p>
</form>

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
    ?>
</div>