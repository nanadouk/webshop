<?php

class Product {
    private $id;
    private $name;
    private $description;
    private $price;
    private $imgUrl;
    private $categoryID;

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
        return $this->categoryID;
    }

    public function setId($id) {
        $this->id =  $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description =  $description;
    }

    public function setPrice($price) {
        $this->price = (float) price;
    }

    public function setImg($imgUrl) {
        $this->imgUrl =  $imgUrl;
    }

    public function setCategory($categoryID){
        $this->categoryID =  $categoryID;
    }

    public function __toString(){
        return sprintf("%d, %s, %d", $this->id, $this->name, $this->price, $this->description);
    }

    static public function getProducts($orderBy="categoryID") {
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

    static public function getProductsByCategory($category){
        $category = (int) $category;
        $products = array();
        $res = DB::doQuery("SELECT * FROM product natural join category WHERE categoryName= $category");
        if ($res) {
            while ($product = $res->fetch_object(get_class())) {
                $products[] = $product;
            }
        }
        return $products;
    }

    static public function delete($id) {
        $id = (int) $id;
        $res = DB::doQuery("DELETE FROM product WHERE id = $id");
        return $res != null;
    }

    static public function insert($values) {
        if ( $stmt = DB::getInstance()->prepare("INSERT INTO product (name, price, description, categoryID, imgUrl) VALUES (?,?,?,?,?);")){
            if ($stmt->bind_param('sdsis', $values['name'], $values['price'], $values['description'],
                $values['categoryID'], $values['imgUrl'])) {
                if ($stmt->execute()) {
                    return true;
                }
            }
        }
        return false;
    }

    public function update($values) {
        $db = DB::getInstance();
        $this->name = $db->escape_string($values['name']);
        $this->description = $db->escape_string($values['description']);
        $this->price = (float)$values['price'];
        $this->categoryID = (int)$values['categoryID'];
        $this->imgUrl = $db->escape_string($values['imgUrl']);
    }

    public function save(){
        $sql = sprintf("UPDATE product SET name='%s', price=%d, description='%s',
            categoryID=%d, imgUrl='%s' WHERE id = %d;",$this->name, $this->price, $this->description,
            $this->categoryID, $this->imgUrl, $this->id);
        $res = DB::doQuery($sql);
        return $res != null;
    }
}
