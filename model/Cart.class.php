<?php
class Cart {
// Holds the items: id => [option => num]
    private $items = [];

    public function addItem($item, $option, $num) {
        if (!isset($this->items[$item][$option])) {
            $this->items[$item][$option] = 0;
        }
        $this->items[$item][$option] += $num;
    }

    public function removeItem($item, $option, $num) {
        if (isset($this->items[$item][$option])) {
            $this->items[$item][$option] -= $num;
            if ($this->items[$item][$option] <= 0) {
                unset($this->items[$item][$option]);
            }
        }
    }

    public function getItems() {
        return $this->items;
    }

    public function isEmpty() {
        return count($this->items) == 0;
    }

    public function render() {
        if ($this->isEmpty()) {
            echo "<div class=\"cart empty\">[Empty Cart]</div>";
        } else {
            echo "<div class=\"cart\"><table>";
           // echo "<tr><th>Article-Id</th><th>#</th></tr>";
            foreach ($this->items as $item=>$value) {
                foreach ($value as $option=>$num) {
                    echo "<tr><td>$item</td><td>$option</td><td>$num</td></tr>";
                }
            }
            echo "</table></div>";
        }
    }
}
