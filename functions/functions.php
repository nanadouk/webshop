<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function get_param($name, $default) {
        if (isset($_GET[$name]))
            return urldecode($_GET[$name]);
        else if ($name == 'lang' && isset($_COOKIE['lang']))
            return $_COOKIE['lang'];
        return $default;
    }

    function add_param(&$url, $name, $value) {
        $sep = strpos($url, "?") !== false ? "&" : "?";
        $url .= $sep . $name . "=" . urlencode($value);
        return $url;
    }

    function navigation($language, $pageId) {
        $urlBase = $_SERVER["PHP_SELF"];
        add_param( $urlBase, "lang", $language);
        $menu = simplexml_load_file("data/menu.xml");
        $class = $pageId == "Home" ? " firstpage" : "";
        echo "<ul class='$class'>";
        foreach ($menu->item as $item){
            $url = $urlBase;
            $title = $item->title;
            add_param( $url, "page", $title);
            $class = $pageId == $title ? "active" : "inactive";
            echo "<li><a class=\"$class\" href=\"$url\">".t("$title")."</a></li>";
        }
        echo "</ul>";
    }

    function content($pageId) {
        echo "<h1>".t($pageId)."</h1>";
        echo "<p>".t("content".$pageId)."</p>";
    }

    function languages($language, $pageId) {
        $languages = simplexml_load_file("data/lang.xml");
        $urlBase = $_SERVER["PHP_SELF"];
        add_param($urlBase, "page", $pageId);
        foreach( $languages->lang as $lang ) {
            $url = $urlBase;
            $class = $language == $lang->title ? "active" : "inactive";
            echo "<li><a class=\"$class\" href=\"".add_param($url,"lang", $lang->title)."\">".strtoupper($lang->title)."</a></li>";
        }
    }

    function products($pageId){
        echo "<h1>".t($pageId)."</h1>";
        $products = Product::getProducts();
        foreach ($products as $product) {
            echo "<form class='item-wrapper' action='' method='post'>";
            echo "<div class='item-upper-wrapper' onclick=\"javascript:initPrice(".$product->getPrice().")\">";
            echo "<img class='item-img' src=\"".$product->getImg()."\" />";
            echo "<div class='item-description-wrapper'>";

            echo "<p class='item-title'>".t($product->getName())."</p>";
            echo "<p class='item-description'>".t($product->getDescription())."</p></div>";
            echo "<div class='item-btn-wrapper'><a class='button-price'>"
                . number_format($product->getPrice(), 2) . " CHF | 
                        <i class='fa fa-angle-down' aria-hidden='true'></i></a></div>";
            echo "</div><div class='item-options-wrapper'></div>";
            echo "<input type='hidden' name='product[id]' value=".$product->getId()." />";
            echo "</form>";
        }
    }

    function get_url($language, $pageId){
        $url = $_SERVER["PHP_SELF"];
        add_param($url, "lang", $language);
        return add_param($url, "page", $pageId);
    }

    function login_info(){
        if (isset($_SESSION["user"])) {
            $logged_user = $_SESSION["user"];
            echo "<div id='logout-form'><span>".t("Logged in as")." $logged_user </span>
                        <button type='submit' id='login-button'><i class='fa fa-sign-out' aria-hidden='true'></i></button></div>";
        } else {
            echo "<form action='' method='post' id='login-form'>
                    <input name='login' id='login' placeholder='username...'>
                    <input type='password' name='pw' id='pw' placeholder='password...'>
                    <mark id='login-error'></mark>
                    <button type='submit' id='login-button'><i class='fa fa-sign-in' aria-hidden='true'></i></button>
                    </form>";
        }
    }

    function render_cart(&$cart, $language){
        if ($cart->isEmpty()) {
            echo "<div class=\"cart empty\">[".t("Empty cart")."]</div>";
        } else {
            echo "<div class=\"cart\"><table>";
            $total = 0;
            foreach ($cart->getItems() as $item => $value) {
                $product = Product::getProductById($item);
                if ($product == null) continue;
                $productId = $product->getId();
                $price = $product->getPrice();
                foreach ($value as $option => $num) {
                    $option = Option::getOptionById($option);
                    if ($option == null) continue;
                    $optionId = $option->getId();
                    $supplementary = $option->getSupplementary();
                    $tmpprice = $price + $supplementary;
                    $total += $tmpprice * $num;
                    echo "<tr id='item{$product->getId()}{$option->getId()}'><td class='number'>$num x </td>
                        <td class='item'>".t($product->getName())."<br/>
                        <span class='option'>".t($option->getName())."</span></td>
                        <td><span class='edit-delete' onclick='javascript:removeItem($productId, $optionId, $tmpprice)'></span>
                        <span class='edit-add' onclick='javascript:addItem($productId, $optionId, $tmpprice)'></span></td>
                        <td>".number_format($tmpprice*$num, 2)." CHF</td><td><span class='delete' 
                        onclick='javascript:removeAll($productId, $optionId, $num, $tmpprice)'>
                        <i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span></td></tr>";
                }
            }
            echo "</table>";
            if ($total != 0) {
                echo "<table class='total'><tr><td>" . t("Sub-total") . "</td><td id='sub-amount'>" . number_format($total, 2) . " CHF</td></tr>
            <tr><td>" . t("Delivery costs") . "</td><td>" . t("FREE") . "</td></tr>
            <tr><td>" . t("Total") . "</td><td id='amount'>" . number_format($total, 2) . " CHF</td></tr></table>
            <a href=" . get_url($language, "Clientform") . " class='button-price order'>" . t("Order") . "</a>";
            } else echo "[".t("Empty cart")."]</div>";

        }
    }

    function order_details($items) {
        global $str;
        echo "<h4>".t("Order details")."</h4>";
        $str = "<h4>".t("Order details")."</h4>";
        $total = 0;
        foreach($items as $item => $value) {
            $product = Product::getProductById($item);
            $productprice = $product->getPrice();
            foreach ($value as $option => $num) {
                $op = Option::getOptionById($option);
                $optionprice = $op->getSupplementary();
                $total += ($productprice + $optionprice) * $num;
                echo "<p>".t($product->getName()).", ".t($op->getName())." x $num</p>";
                $str .= "<p>".t($product->getName()).", ".t($op->getName())." x $num</p>";
            }
        }
        echo "<p>".t("Total").": ".number_format($total, 2)." CHF</p></br>";
        $str .= "<p>".t("Total").": ".number_format($total, 2)." CHF</p></br>";
    }

    function send_email($name, $address, $items){
        global $str;
        require('PHPMailer/vendor/autoload.php');
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.bfh.ch';
            $mail->SMTPAuth = true;
            $mail->Username = 'douka1';
            $mail->Password = 'TadCH18!)Bfh';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->setFrom('anna.doukmak@students.bfh.ch', 'Webshop');
            $mail->addAddress($address);
            $mail->addAddress('anna.doukmak@students.bfh.ch');

            $mail->isHTML(true);
            $mail->Subject = 'Order confirmation';
            $mail->Body    = "<p>".t("Dear")." ".$name."</p><p>".t("Thank you for your order")."!!</p>".$str;
            $mail->AltBody = t("Dear")." ".$name.", ".t("Thank you for your order")."!";
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    function t($key, $url='')
    {
        global $language;
        static $texts = NULL;
        if (is_null($texts)) {
            $lang_file = $url . 'lang/' . $language . '.txt';
            if (!file_exists($lang_file)) {
                $lang_file = $url . 'lang/' . 'en.txt';
            }
            $lang_file_content = file_get_contents($lang_file);
            $texts = json_decode($lang_file_content, true);
        }
        if (isset($texts[$key])) {
            return $texts[$key];
        } else {
            return "$key";
        }
    }

    include "configDB.php";

    $language = get_param("lang", "en");
    $pageId = get_param("page", "Home");

    $time = time() + 60*60*24*30;
    setcookie("lang", $language, $time);


