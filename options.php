<?php $product = get_param("product", 0); ?>
<form action="<?php echo get_url($language, "Clientform")?>" method="post">
    <h3>Additional options</h3>
    <p><label>Size:<abbr title="This field is mandatory">*</abbr></label></p>
    <input type="radio" name="info[size]" value="20" required />20 cm<br/>
    <input type="radio" name="info[size]" value="25" required/>25 cm<br/>
    <input type="radio" name="info[size]" value="30" required/>30 cm<br/>
    <br />

    <p><label>Payment method:<abbr title="This field is mandatory">*</abbr></label></p>
    <input type="radio" name="info[payment]" value="cash" required/>Cash<br/>
    <input type="radio" name="info[payment]" value="creditcard" required/>Creditcard<br/>

    <input type="hidden" name="info[product]" value="<?php echo $product ?>" />
    <p>
        <input type="submit" name="action" value="Next"/>
        <input type="submit" name="action" value="Cancel" />
    </p>
</form>