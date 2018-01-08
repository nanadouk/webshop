<?php

class Category {
    private $categoryID;
    private $categoryName;

    public function getId() {
        return $this->categoryID;
    }

    public function getName() {
        return $this->categoryName;
    }

     public function __toString(){
        return sprintf("%d, %s", $this->categoryID, $this->categoryName);
    }

    static public function getCategories($orderBy="categoryID") {
        $orderByStr = '';
        if (in_array($orderBy, ['categoryID', 'categoryName']) ) {
            $orderByStr = " ORDER BY $orderBy";
        }
        $categories = array();
        $res = DB::doQuery("SELECT * FROM category$orderByStr");
        if ($res) {
            while ($category = $res->fetch_object(get_class())) {
                $categories[] = $category;
            }
        }
        return $categories;
    }

    static public function getCategoryById($id) {
        $id = (int) $id;
        $res = DB::doQuery("SELECT * FROM category WHERE categoryID = $id");
        if ($res) {
            if ($category = $res->fetch_object(get_class())) {
                return $category;
            }
        }
        return null;
    }
}