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
        $menuItems = array("Home", "About", "Menu", "Contact");
        $class = $pageId == "Home" ? " firstpage" : "";
        echo "<ul class='$class'>";
        foreach ($menuItems as $item){
            $url = $urlBase;
            add_param( $url, "page", $item);
            $class = $pageId == $item ? "active" : "inactive";
            echo "<li><a class=\"$class\" href=\"$url\">".t($item)."</a></li>";
        }
        echo "</ul>";
    }

    function content($pageId) {
        echo "<h1>".t($pageId)."</h1>";
        echo "<p>".t("content".$pageId)."</p>";
    }

    function languages($language, $pageId) {
        $languages = array("en","de");
        $urlBase = $_SERVER["PHP_SELF"];
        add_param($urlBase, "page", $pageId);
        foreach( $languages as $lang ) {
            $url = $urlBase;
            $class = $language == $lang ? "active" : "inactive";
            echo "<li><a class=\"$class\" href=\"".add_param($url,"lang", $lang)."\">".strtoupper($lang)."</a></li>";
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
            echo "<form action='' method='post' >
                    <input name='login' id='login' placeholder='username...'>
                    <input type='password' name='pw' id='pw' placeholder='password...'>
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
            echo "</table><table class='total'><tr><td>".t("Sub-total")."</td><td id='sub-amount'>".number_format($total, 2)." CHF</td></tr>
            <tr><td>".t("Delivery costs")."</td><td>".t("FREE")."</td></tr>
            <tr><td>".t("Total")."</td><td id='amount'>".number_format($total, 2)." CHF</td></tr></table>
            <a href=".get_url($language, "Clientform")." class='button-price order'>".t("Order")."</a>
            </div>";

        }
    }

    function order_details($items) {
        echo "<h4>".t("Order details")."</h4>";
        $total = 0;
        foreach($items as $item => $value) {
            $product = Product::getProductById($item);
            $productprice = $product->getPrice();
            foreach ($value as $option => $num) {
                $op = Option::getOptionById($option);
                $optionprice = $op->getSupplementary();
                $total += ($productprice + $optionprice) * $num;
                echo "<p>".t($product->getName()).", ".t($op->getName())." x $num</p>";
            }
        }
        echo "<p>".t("Total").": ".number_format($total, 2)." CHF</p></br>";
    }

    function send_email($name, $address, $items){
        require('PHPMailer/vendor/autoload.php');
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.bfh.ch';
            $mail->SMTPAuth = true;
            $mail->Username = 'douka1';
            $mail->Password = 'TalalNusCH14!';
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
            $mail->Body    = "<p>".t("Dear")." ".$name."</p><p>".t("Thank you for your order")."!!</p>".order_details($items);
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

    include "authentication.inc.php";
    include "configDB.php";

    $language = get_param("lang", "en");
    $pageId = get_param("page", "Home");

    $time = time() + 60*60*24*30;
    setcookie("lang", $language, $time);


