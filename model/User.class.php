<?php

class User{
    private $userID;
    private $userName;
    private $email;
    private $pw;

    public function getId() {
        return $this->userID;
    }

    public function getName() {
        return $this->userName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->pw;
    }

    public function setId($id) {
        $this->userID =  $id;
    }

    public function setName($name) {
        $this->userName = $name;
    }

    public function setEmail($email) {
        $this->email =  $email;
    }

    public function setPassword($password) {
        $this->pw = $password;
    }

    public function __toString(){
        return sprintf("%d, %s, %s, %s", $this->userID, $this->userName, $this->email, $this->pw);
    }

    static public function getUsers($orderBy="userID") {
        $orderByStr = '';
        if (in_array($orderBy, ['userID', 'userName', 'email', 'pw']) ) {
            $orderByStr = " ORDER BY $orderBy";
        }
        $users = array();
        $res = DB::doQuery("SELECT * FROM user$orderByStr");
        if ($res) {
            while ($user = $res->fetch_object(get_class())) {
                $users[] = $user;
            }
        }
        return $users;
    }

    static public function getUserById($id) {
        $id = (int) $id;
        $res = DB::doQuery("SELECT * FROM user WHERE userID = $id");
        if ($res) {
            if ($user = $res->fetch_object(get_class())) {
                return $user;
            }
        }
        return null;
    }

    static public function delete($id) {
        $id = (int) $id;
        $res = DB::doQuery("DELETE FROM user WHERE userID = $id");
        return $res != null;
    }

    static public function insert($values) {
        if ( $stmt = DB::getInstance()->prepare("INSERT INTO user (userName, email, pw) VALUES (?,?,?);")){
            if ($stmt->bind_param('sss', $values['name'], $values['email'], $values['pw'])) {
                if ($stmt->execute()) {
                    return true;
                }
            }
        }
        return false;
    }

    public function update($values) {
        $db = DB::getInstance();
        $this->userName = $db->escape_string($values['userName']);
        $this->email = $db->escape_string($values['email']);
        $this->pw = $values['pw'];
    }

    public function save(){
        $sql = sprintf("UPDATE user SET userName='%s', email='%s', pw='%s' 
            WHERE userID = %d;",$this->userName, $this->email, $this->pw, $this->userID);
        $res = DB::doQuery($sql);
        return $res != null;
    }
}
