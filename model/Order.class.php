<?php

class Order{
    private $orderID;
    private $userID;
    private $productID;
    private $optionvalueID;
    private $quantity;
    private $address;
    private $date;

    public function getOrderID() {
        return $this->orderID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getProductID() {
        return $this->productID;
    }

    public function getOptionvalueID() {
        return $this->optionvalueID;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getDate() {
        return $this->date;
    }

    public function setOrderID($orderID) {
        $this->orderID =  $orderID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setProductID($productID) {
        $this->productID =  $productID;
    }

    public function setOptionvalueID($optionvalueID) {
        $this->optionvalueID = $optionvalueID;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function __toString(){
        return sprintf("%d, %d, %d, %d, %d, %s", $this->orderID, $this->userID, $this->productID, $this->optionvalueID,
            $this->quantity, $this->address);
    }

    static public function getOrders($orderBy="orderID") {
        $orderByStr = '';
        if (in_array($orderBy, ['orderID', 'userID', 'productID', 'optionvalueID', 'quantity', 'address', 'date']) ) {
            $orderByStr = " ORDER BY $orderBy";
        }
        $orders = array();
        $res = DB::doQuery("SELECT * FROM orders$orderByStr");
        if ($res) {
            while ($order = $res->fetch_object(get_class())) {
                $orders[] = $order;
            }
        }
        return $orders;
    }

    static public function getOrdersByUserID($userID, $orderBy="orderID") {
        $userID = (int) $userID;
        $orderByStr = '';
        if (in_array($orderBy, ['orderID', 'userID', 'productID', 'optionvalueID', 'quantity', 'address', 'date']) ) {
            $orderByStr = " ORDER BY $orderBy";
        }
        $orders = array();
        $res = DB::doQuery("SELECT * FROM orders WHERE userID = $userID$orderByStr");
        if ($res) {
            while ($order = $res->fetch_object(get_class())) {
                $orders[] = $order;
            }
        }
        return $orders;
    }

    static public function getOrderById($id) {
        $id = (int) $id;
        $res = DB::doQuery("SELECT * FROM orders WHERE orderID = $id");
        if ($res) {
            if ($order = $res->fetch_object(get_class())) {
                return $order;
            }
        }
        return null;
    }

    static public function delete($orderID) {
        $orderID = (int) $orderID;
        $res = DB::doQuery("DELETE FROM orders WHERE orderID = $orderID");
        return $res != null;
    }

    static public function insert($values) {
        if ( $stmt = DB::getInstance()->prepare("INSERT INTO orders (userID, productID, optionvalueID, quantity, address, date) 
            VALUES (?,?,?,?,?,?);")){
            if ($stmt->bind_param('iiiiss', $values['userID'], $values['productID'], $values['optionvalueID'],
                $values['quantity'], $values['address'], $values['date'])) {
                if ($stmt->execute()) {
                    return true;
                }
            }
        }
        return false;
    }

    public function update($values) {
        $db = DB::getInstance();
        $this->userID = $db->escape_string($values['userID']);
        $this->productID = $db->escape_string($values['productID']);
        $this->optionvalueID = $values['optionvalueID'];
        $this->quantity = $db->escape_string($values['quantity']);
        $this->address = $db->escape_string($values['address']);
        $this->date = $db->escape_string($values['date']);
    }

    public function save(){
        $sql = sprintf("UPDATE orders SET userID=%d, productID=%d, optionvalueID=%d, quantity=%d, address='%s', date='%s' 
            WHERE orderID = %d;", $this->userID, $this->productID, $this->optionvalueID, $this->quantity, $this->address,
            $this->date, $this->orderID);
        $res = DB::doQuery($sql);
        return $res != null;
    }
}