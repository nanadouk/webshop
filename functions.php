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
            array("name"=>"Pizza Margherita", "img"=>"assets/img/pizza1.jpg", "description"=>"mit Tomatensauce, Mozzarella und Oregano","price"=>12.00),
            array("name"=>"Pizza Funghi","description"=>"mit Tomatensauce, Mozzarella, Pilzen und Oregano","price"=>14.00),
            array("name"=>"Pizza Prosciutto","description"=>"mit Tomatensauce, Mozzarella, Schinken und Oregano","price"=>16.00)
        );
        foreach ($products as $product) {
            echo "<div class=\"item-wrapper\">";
            echo "<img class=\"item-img\" src=\"".$product['img']."\" />";
            echo "<div class=\"item-description-wrapper\">";

            echo "<p class=\"item-title\">".$product['name']."</p>";
            echo "<p class=\"item-description\">".$product['description']."</p></div>";
            add_param($url, "page", "Options");
            echo "<div class=\"item-btn-wrapper\"><a href=\"" . add_param($url, "product", $product['name']) . "\" class=\"button-price\">"
                . number_format($product['price'], 2, ",", ".") . " CHF | 
                        <i class=\"fa fa-plus\" aria-hidden=\"true\"></i></a></div>";
            echo "</div>";
        }
    }

    function get_url($language, $pageId){
        $url = $_SERVER["PHP_SELF"];
        add_param($url, "lang", $language);
        return add_param($url, "page", $pageId);
    }

    function send_email(){
        if (isset($_POST['info'])) {
            $client = $_POST['info'];
        }
        require('PHPMailer/vendor/autoload.php');
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 3;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.bfh.ch';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'user';                 // SMTP username
            $mail->Password = 'pw';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

          /*  $mail->SMTPOptions = array(       //with this code works but insecure
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );*/

            //Recipients
            $mail->setFrom('anna.doukmak@students.bfh.ch', 'Webshop');
            $mail->addAddress($client['email']);     // Add a recipient
            $mail->addAddress('anna.doukmak@students.bfh.ch');

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Order confirmation';
            $mail->Body    = '<p>Dear '.$client['titel'].'. '.$client['lname'].'</p>
                                <p>Thank you for your order!</p>';
            $mail->AltBody = 'Dear '.$client['titel'].'. '.$client['lname'].'. Thank you for your order!';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
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

    function authentication(){
        session_start();
        $users = ["bob"=>"123","alice"=>"456","eve"=>"789"];
        if(isset($_POST["login"])) {
            $login = $_POST["login"];
            if (isset($users[$login]) && $users[$login] == $_POST["pw"]) {
                $_SESSION["user"] = $login;
            }
        }
        if (!isset($_SESSION["user"])) {
            echo "<!DOCTYPE html>\n";
            echo "<html><head>/*...*/</head><body>";
            echo "<h3>Access Denied!</h3><p>Please login first.</p>";
            echo "<p>&raquo; <a href=\"login.php\">Login</a></p>";
            echo "</body></html>";
            exit;
        }
    }

    $language = get_param("lang", "en");
    $pageId = get_param("page", "Home");
    $time = time() + 60*60*24*30;
    setcookie("lang", $language, $time);
?>
