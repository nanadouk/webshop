<?php
    if( isset($_POST['product']) ) {
        $product = $_POST['product'];
    } // todo else
?>
<form action="<?php echo get_url($language, "Confirmation")?>" method="post">

    <h3>Personal data</h3>
    <p>
        <fieldset>
            <legend>Title<abbr title="This field is mandatory">*</abbr></legend>
            <input type="radio" required name="client[title]" value="Mr"><label>Mr.</label>
            <input type="radio" required name="client[title]" value="Ms"><label>Ms.</label>
        </fieldset>
    </p>
    <p>
        <label>First name:<abbr title="This field is mandatory">*</abbr></label>
        <input name="client[fname]" maxlength="20" required/>
    </p>
    <p>
        <label>Last name:<abbr title="This field is mandatory">*</abbr></label>
        <input name="client[lname]" maxlength="20" required/>
    </p>
    <p>
        <label>E-Mail:<abbr title="This field is mandatory">*</abbr></label>
        <input type="email" name="client[email]" maxlength="30" required/>
    </p>
    <p>
        <label>Phone:<abbr title="This field is mandatory">*</abbr></label>
        <input type="tel" name="client[tel]" pattern="[0-9]{10}" required />
    </p>

    <h3>Delivery address</h3>
    <p>
        <label>Street:<abbr title="This field is mandatory">*</abbr></label>
        <input name="client[street]" maxlength="20" required/>
    </p>
    <p>
        <label>City:<abbr title="This field is mandatory">*</abbr></label>
        <input name="client[city]" maxlength="20" required/>
    </p>
    <p>
        <label>Country:</label>
        <input disabled="disabled" value="Switzerland" />
    </p>
    <br />
    <p>
        <label>Comments (optional):</label>
        <textarea name="client[comment]" rows="5" cols="30" maxlength="150"></textarea>
    </p>

    <input type="hidden" name="product[id]" value="<?php echo $product['id'] ?>" />
    <input type="hidden" name="product[size]" value="<?php echo $product['size'] ?>" />
    <input type="hidden" name="product[quantity]" value="<?php echo $product['quantity'] ?>" />


    <p>
        <input type="submit" name="action" value="Next" />
        <input type="submit" name="action" value="Cancel" />
    </p>
</form>
