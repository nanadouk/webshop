<nav id="top-menu" class="row">
    <ul>
        <?php
          /*  $menuItems = array(
            "Home" => "index.php",
            "About" => "about.php",
            "Menu" => "menu.php",
            "Contact" => "contact.php");
            foreach ($menuItems as $key => $value) {
                echo "<li";
                if ($thisPage==$key)
                    echo " id=\"currentpage\"";
                echo "><a href=$value>$key</a></li>";
            }
            $menuItems = array("Home", "About", "Menu", "Contact");
            foreach ($menuItems as $item)
                echo "<li><a href=\"index.php?page=$item\">$item</a></li>";

            require("functions.php");*/
            navigation($language, $pageId);
        ?>
    </ul>
</nav>
