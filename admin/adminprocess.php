<?php
if (isset($_POST['action']) && isset($_POST['item'])){
    $action = $_POST['action'];
    $item = $_POST['item'];
    switch ($action) {
        case "Add":
            Product::insert($item);
            break;
        case "Update":
            $product = Product::getProductById($item['id']);
            $product->update($item);
            $product->save();
            break;
        case "Delete":
            Product::delete($item['id']);
            break;
    }
}

