<?php
    if( isset($_POST['info']) ) {
        $info = $_POST['info'];
    } // todo else
?>
<form action="<?php echo get_url($language, "Confirmation")?>" method="post">

    <h3>Personal data</h3>
    <p><label>First name:<abbr title="This field is mandatory">*</abbr></label>
    <input name="info[fname]" maxlength="20" required/></p>
    <p><label>Last name:<abbr title="This field is mandatory">*</abbr></label>
    <input name="info[lname]" maxlength="20" required/></p>
    <p><label>E-Mail:<abbr title="This field is mandatory">*</abbr></label>
    <input type="email" name="info[email]" maxlength="20" required/></p>
    <p><label>Phone:<abbr title="This field is mandatory">*</abbr></label>
    <input type="tel" name="info[tel]" pattern="[0-9]{10}" required /></p>

    <h3>Shipping address</h3>
    <p><label>Street:<abbr title="This field is mandatory">*</abbr></label>
    <input name="info[street]" maxlength="20" required/></p>
    <p><label>City:<abbr title="This field is mandatory">*</abbr></label>
    <input name="info[city]" maxlength="20" required/></p>
    <p><label>Country:</label>
    <input disabled="disabled" value="Switzerland" /></p>
    <br />
    <p><label>Comments (optional):</label>
    <textarea name="info[comment]" rows="5" cols="30" maxlength="150"></textarea></p>

    <input type="hidden" name="info[product]" value="<?php echo $info['product'] ?>" />
    <input type="hidden" name="info[size]" value="<?php echo $info['size'] ?>" />
    <input type="hidden" name="info[payment]" value="<?php echo $info['payment'] ?>" />

    <p><input type="submit" name="action" value="Send" />
        <input type="submit" name="action" value="Cancel" /></p>
</form>
