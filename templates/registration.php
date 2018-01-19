<?php

    $client = isset($_POST['client']) ? $_POST['client'] : false;
    if ( $client ) {

        $formIsValid = false;
        $errors = array();

        if ($client['name'] == '' || !preg_match('/^([a-zA-Z]+\s?)*$/', $client['name'])) {
            $errors['name'] = 'Please enter a valid name!';
        }

        if (!filter_var($client['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid e-mail address!';
        }

        if ($client['pw'] == '' || !preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $client['pw'])) {
            $errors['pw'] = 'The password should contain minimum eight characters, at least one letter and one number!';
        }

        if (count($errors) == 0) {
            $formIsValid = true;
        }

        if ($formIsValid) {
            if (User::insert($client)) {
                $successsclass = "show";
                $formclass = "hide";
                $errclass = "hide";
            } else {
                $errclass = "show";
                $formclass = "hide";
                $successsclass = "hide";
            }
        }

    } else {
        $formclass = "show";
        $successsclass = "hide";
        $errclass = "hide";
    }

    echo "<h1>".t($pageId)."</h1>";
?>
<p class="<?php echo $formclass?> msg"><?php echo t("Please register and sign in to make your order!")?></p></br>
<form id="registration-form" action="" method="post" class="<?php echo  $formclass?>">
    <p>
        <label><?php echo t("Name")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input id="username" name="client[name]" maxlength="30" pattern="([a-zA-Z]+\s?)*" required/>
        <?php if (isset($errors['name'])) echo "<span>".$errors['name']."</span>"?>
    <p>
        <label><?php echo t("E-Mail")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input id="email" type="email" name="client[email]" maxlength="30"
               pattern="^[_A-Za-z0-9-\+]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9]+)*(\.[A-Za-z]{2,})$" required/>
        <?php if (isset($errors['email'])) echo "<span>".$errors['email']."</span>"?>
    </p>
    <p>
        <label><?php echo t("Password")?>:<abbr title="<?php echo t("This field is mandatory")?>">*</abbr></label>
        <input type="password" name="client[pw]" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required />
        <?php if (isset($errors['pw'])) echo "<span>".$errors['pw']."</span>"?>
    </p>
    <p>
        <input type='submit' class="button-price save" value="<?php echo t("Save")?>" />
    </p>
</form>

<p class="<?php echo $successsclass?>"><?php echo t("Your account has been saved!") ?></p>
<p class="<?php echo $errclass?>"><?php echo t("This email already exists. Your account could not be saved!")?></p>