<form action="<?php echo get_url($language, "Confirmation")?>" method="post">

    <h3><?php echo t("Personal data")?></h3>

    <p>
        <label><?php echo t("Name")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input name="client[name]" maxlength="20" required/>
    </p>

    <p>
        <label><?php echo t("E-Mail")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input type="email" name="client[email]" maxlength="30" required/>
    </p>
    <p>
        <label><?php echo t("Phone")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input type="tel" name="client[tel]" pattern="[0-9]{10}" required />
    </p>

    <h3><?php echo t("Delivery address")?></h3>
    <p>
        <label><?php echo t("Street")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input name="client[street]" maxlength="20" required/>
    </p>
    <p>
        <label><?php echo t("Zip code")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input type="text" name="client[zip]" maxlength="20" pattern="[1-9][0-9]{3}" required/>
    </p>
    <p>
        <label><?php echo t("City")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input name="client[city]" maxlength="20" required/>
    </p>
    <p>
        <label><?php echo t("Country")?>:</label>
        <input disabled="disabled" value="<?php echo t("Switzerland")?>" />
    </p>
    <br />
    <p>
        <label><?php echo t("Comments (optional)")?>:</label>
        <textarea name="client[comment]" rows="5" cols="30" maxlength="150"></textarea>
    </p>

    <p>
        <button type='submit' name="action" class="button-price next">
            <span><?php echo t("Next")?>  <i class="fa fa-angle-right" aria-hidden="true"></i></span>
        </button>
    </p>
</form>
