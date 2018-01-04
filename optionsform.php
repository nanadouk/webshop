<?php
    require("autoloader.php");

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        if (!DB::create('localhost', 'root', 'project!2018)Web', 'terraemare')) {
            die("Unable to connect to database [".DB::getInstance()->connect_error."]");
        }
        $product = Product::getProductById($id);
        $categotyID = $product->getCategory();
        if ($categotyID == 1) {
            $options = Option::getOptionsByCategory($categotyID);
            echo "<div class='item-options'><p><label>Size:</label></p>";
            foreach ($options as $option) {
                $supp = $option->getSupplementary();
                $name = $option->getName();
                echo "<input type='radio' onclick='javascript:changeRadio($supp, $id)' name='product[size]' 
                    value='$name' required ";
                if ($supp == 0) echo "checked='checked' />$name<br/>";
                else echo "/>$name (+$supp CHF)<br/>";
            }

        }
        if ($categotyID == 2) {
            $options = Option::getOptionsByCategory($categotyID);
            echo "<div class='item-options'><p><label>Dressing:</label></p>";
            echo "<select name=product[dressing] required>";
            foreach ($options as $option) {
                $name = $option->getName();
                echo "<option value='$name'>$name</option>";
            }
            echo "</select>";
        }
        echo "</div><div class='options-footer'><div class='item-quantity'>
            <span onclick='javascript:minusOne(\"$id\")'><i class=\"fa fa-minus\" aria-hidden=\"true\"></i></span>
            <input type='text' id='quantity$id' name='product[quantity]' class='quantity' value='1'>
            <span onclick='javascript:plusOne(\"$id\")'><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></span></div>
            <button type='submit' class='button-price' id='total$id'><span>".$product->getPrice()." CHF | 
            </span><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></button></div>";

    }
