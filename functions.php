<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    function get_param($name, $default) {
        if (isset($_GET[$name]))
            return urldecode($_GET[$name]);
        else
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
        foreach ($menuItems as $item){
            $url = $urlBase;
            add_param( $url, "page", $item);
            $class = $pageId == $item ? "active" : "inactive";
            echo "<li><a class=\"$class\" href=\"$url\">".t($item)."</a></li>";
        }
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

    function products($language, $pageId){
        echo "<h1>".t($pageId)."</h1>";
        $url = $_SERVER["PHP_SELF"];
        add_param($url, "lang", $language);
        $products = array(
            array("name"=>"Pizza 1","description"=>"Description pizza 1","price"=>25.00),
            array("name"=>"Pizza 2","description"=>"Description pizza 2","price"=>50.00),
            array("name"=>"Pizza 3","description"=>"Description pizza 3","price"=>75.00)
        );
        foreach ($products as $product) {
            foreach ($product as $value) {
                echo "<p>$value</p>";
            }
            add_param($url, "page", "Options");
            echo "<p><a href=\"".add_param($url, "product", $product['name'])."\">Buy now</a></p><br/>";
        }
    }

    function get_url($language, $pageId){
        $url = $_SERVER["PHP_SELF"];
        add_param($url, "lang", $language);
        return add_param($url, "page", $pageId);
    }

    function send_email(){
        require('PHPMailer/vendor/autoload.php');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.bfh.ch';
        $mail->SMTPAuth = true;
        $mail->Username = 'douka';
        $mail->Password = '.....';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->From = 'anna.doukmak@students.bfh.ch';
        $mail->FromName = 'Terra e Mare';
        $mail->addAddress('anna.doukmak@gmail.com', 'Doukmak');
        $mail->isHTML(true);
        $mail->Subject = 'Order';
        $mail->Body = 'Thank you for your order!';
        $mail->AltBody = 'Thank you for your order!';
        if(!$mail->send()) {
            echo 'Message could not be sent. -> ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    function t($key) {
        global $language;
        $texts = array(
            "Home" => array(
                "en"=>"Home",
                "de"=>"Home"
            ),
            "About" => array(
                "en" => "About",
                "de" => "Über uns"
            ),
            "Menu" => array(
                "en" => "Menu",
                "de" => "Speisekarte"
            ),
            "Contact" => array(
                "en" => "Contact",
                "de" => "Kontakt"
            ),
            "contentHome" => array(
                "en"=>"English. Home. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum.",
                "de"=>"German. Home. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum."
            ),
            "contentAbout" => array(
                "en"=>"English. About. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum.",
                "de"=>"German. About. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum."
            ),
            "contentContact" => array(
                "en"=>"English. Contact. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum.",
                "de"=>"German. Contact. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum."
            )
        );
        if (isset($texts[$key][$language])) {
            return $texts[$key][$language];
        } else {
            return "[$key]";
        }
    }

    $language = get_param("lang", "en");
    $pageId = get_param("page", "Home");
?>
