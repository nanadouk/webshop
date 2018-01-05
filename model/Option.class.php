<?php

class Option{
    private $optionvalueID;
    private $optionID;
    private $optionvalueName;
    private $supplementary;

    public function getId() {
        return $this->optionvalueID;
    }

    public function getName() {
        return $this->optionvalueName;
    }

    public function getOptionID() {
        return $this->optionID;
    }

    public function getSupplementary() {
        return $this->supplementary;
    }

    public function __toString(){
        return sprintf("%d, %s, %d", $this->optionvalueID, $this->optionvalueName, $this->supplementary);
    }

    static public function getOptionsByCategory($categoryID, $orderBy="optionvalueID") {
        $orderByStr = '';
        if (in_array($orderBy, ['optionvalueID', 'optionvalueName', 'optionID', 'supplementary']) ) {
            $orderByStr = " ORDER BY $orderBy";
        }
        $options = array();
        $res = DB::doQuery("SELECT * FROM optionvalue natural join options natural join category WHERE categoryID = $categoryID $orderByStr");
        if ($res) {
            while ($optionvalue = $res->fetch_object(get_class())) {
                $options[] = $optionvalue;
            }
        }
        return $options;
    }

    static public function getOptionById($id) {
        $id = (int) $id;
        $res = DB::doQuery("SELECT * FROM optionvalue WHERE optionvalueID = $id");
        if ($res) {
            if ($option = $res->fetch_object(get_class())) {
                return $option;
            }
        }
        return null;
    }
}
