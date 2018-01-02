<?php
    if (isset($_POST['item'])) {
        $item = $_POST['item'];
        $cat = explode(' ', $item)[0];
        if ($cat == "Pizza") {
            echo "<form class='item-options' action='clientform.php' method='post'>" .
                "<span class='options-icon'><i class=\"fa fa-chevron-up\" aria-hidden=\"true\"></i></span>".
                "<span>Options</span>" .
                "<p><label>Size:<abbr title='This field is mandatory'>*</abbr></label></p>" .
                "<input type='radio' name=\"info['size']\" value='20' required />20 cm<br/>" .
                "<input type='radio' name=\"info['size']\" value='30' required />30 cm (+5 CHF)<br/>" .
                "<input type='radio' name=\"info['size']\" value='40' required />40 cm (+10 CHF)<br/>" .
                "<input type='hidden' name=\"info['item']\" value='$item'/>" .
                "</form>";
        }
    }
