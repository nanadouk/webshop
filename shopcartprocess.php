<?php
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case "removeAll":
                if ( isset($_POST['item']) && isset($_POST['option']) ) {
                $item =(int) $_POST['item'];
                $option = (int) $_POST['option'];
            //    $_SESSION['cart']->removeItem($item, $);
            //    unset($cart[$item][$option]);
            //    echo 'success';
                    if (isset($_SESSION["cart"])) echo 'ok';
                    else echo 'not ok';
                }
                break;
        }
    }