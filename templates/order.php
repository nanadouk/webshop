<?php
    echo "<h1>".t($pageId)."</h1>";
    if (isset($_SESSION['errors']))
        $errors = $_SESSION['errors'];
    if (isset($_SESSION['address']))
        $address = $_SESSION['address'];
?>

<form action="<?php echo get_url($language, "Confirmation")?>" method="post" name="clientform">

    <h3><?php echo t("Delivery address")?></h3>
    <p>
        <label><?php echo t("Phone")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input type="tel" name="address[tel]" pattern="[0-9]{10}" required
            <?php if (isset($address['tel'])) echo "value='".$address['tel']."'"?>
        />
        <?php if (isset($errors['tel'])) echo "<span>".$errors['tel']."</span>"?>
    </p>
    <p>
        <label><?php echo t("Street")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input name="address[street]" maxlength="20" pattern="([a-zA-Z0-9]+[\s\-]?)*" required
            <?php if (isset($address['street'])) echo "value='".$address['street']."'"?>
        />
        <?php if (isset($errors['street'])) echo "<span>".$errors['street']."</span>"?>
    </p>
    <p>
        <label><?php echo t("Zip code")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input type="text" name="address[zip]" maxlength="20" pattern="[1-9][0-9]{3}" required
            <?php if (isset($address['zip'])) echo "value='".$address['zip']."'"?>
        />
        <?php if (isset($errors['zip'])) echo "<span>".$errors['zip']."</span>"?>
    </p>
    <p>
        <label><?php echo t("City")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input name="address[city]" maxlength="20" pattern="([a-zA-Z]+\s?)*" required
            <?php if (isset($address['city'])) echo "value='".$address['city']."'"?>
        />
        <?php if (isset($errors['city'])) echo "<span>".$errors['city']."</span>"?>
    </p>
    <br />
    <p>
        <button type='submit' name="action" class="button-price next">
            <span><?php echo t("Next")?>  <i class="fa fa-angle-right" aria-hidden="true"></i></span>
        </button>
    </p>
</form>

<?php
    if (isset($_SESSION['errors']))
        unset($_SESSION['errors']);
    if (isset($_SESSION['address']))
        unset($_SESSION['address']);
?>
