<?php
    include "adminautoloader.php";
    include "adminauthentication.inc.php";
    include "../configDB.php";
    include "adminprocess.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="jquery.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="admin.css" />
    </head>
    <body>
        <p><a href="adminlogout.php">Logout</a></p>
        <h2>Edit product list</h2>
        <div class="form">
            <form action="" method="post">
                <p><label>Name: </label><input type="text" name="item[name]" maxlength="50" class="namefield" required/></p>
                <p><label>Description: </label><input type="text" name="item[description]" maxlength="100" class="descfield" required/></p>

                <p><label>Price: </label><input type="text" name="item[price]" class="pricefield" required/></p>
                <p><label>Image url: </label><input type="text" name="item[imgUrl]" maxlength="50" class="imgfield" required/></p>
                <p><label>Category: </label>
                    <select name="item[categoryID]" class="catfield" required>
                        <option value="" selected disabled hidden></option>
                        <?php
                            $categories = Category::getCategories();
                            foreach ($categories as $category){
                                echo "<option value='{$category->getId()}'>{$category->getName()}</option>";
                            }
                        ?>
                    </select>
                </p>
                <input type="hidden" name="item[id]" class="idfield">
                <input type="submit" name="action" value="Add" class="add"/>
                <input type="submit" name="action" value="Update" class="update" disabled/>
                <input type="submit" name="action" value="Delete" class="delete" disabled/>
                <input type="button" value="Clear" class="clear"/>
            </form>
        </div>
        <div class="list">
            <table>
                <tr><th>Id</th><th>Name</th><th>Description</th><th>Price</th><th>ImageUrl</th><th>Category</th>
                    <th>Category ID</th></tr>
                <?php
                    $products = Product::getProducts();
                    foreach ($products as $product){
                        echo "<tr class='item'>
                            <td class='id'>{$product->getId()}</td>
                            <td class='name'>{$product->getName()}</td>
                            <td class='description'>{$product->getDescription()}</td>
                            <td class='price'>{$product->getPrice()}</td>
                            <td class='imgurl'>{$product->getImg()}</td>";
                        $category = Category::getCategoryById($product->getCategory());
                        echo "<td class='categoryname'>{$category->getName()}</td>
                            <td class='categoryid'>{$product->getCategory()}</td>
                            </tr>";
                    }
                ?>
            </table>
        </div>
    </body>
</html>