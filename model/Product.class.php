<?php

class Product {
    private $id;
    private $name;
    private $description;
    private $price;
    private $imgUrl;
    private $category;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getImg() {
        return $this->imgUrl;
    }

    public function getCategory(){
        return $this->category;
    }

    public function __toString(){
        return sprintf("%d) %s %d %s", $this->id, $this->name, $this->price, $this->description, $this->category);
    }

    static public function getProducts($orderBy="id") {
        $orderByStr = '';
        if (in_array($orderBy, ['id', 'name', 'price', 'description', 'img', 'categoryID']) ) {
            $orderByStr = " ORDER BY $orderBy";
        }
        $products = array();
        $res = DB::doQuery("SELECT * FROM product$orderByStr");
        if ($res) {
            while ($product = $res->fetch_object(get_class())) {
                $products[] = $product;
            }
        }
        return $products;
    }

    static public function getProductById($id) {
        $id = (int) $id;
        $res = DB::doQuery("SELECT * FROM product WHERE id = $id");
        if ($res) {
            if ($product = $res->fetch_object(get_class())) {
                return $product;
            }
        }
        return null;
    }
}
