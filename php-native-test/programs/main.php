<?php

class Main {
    private $countBageConcat = 0;

    public function printOutput($n) {
        $output = "";

        if ($n % 3 == 0 && $n % 5 == 0) {
            $output = "Bage Concat";
            $this->countBageConcat++;
        } elseif ($n % 3 == 0) {
            if ($this->countBageConcat >= 2) {
                $output = "Concat";
            } else {
                $output = "Bage";
            }
        } elseif ($n % 5 == 0) {
            if ($this->countBageConcat >= 2) {
                $output = "Bage";
            } else {
                $output = "Concat";
            }
        }

        return $output;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $count = $_POST['count'];
    $main = new Main();
    $bageConcatCount = 0;

    for ($i = 1; $i <= $count; $i++) {
        $output = $main->printOutput($i);

        if ($output == "Bage Concat") {
            $bageConcatCount++;

            if ($bageConcatCount >= 5) {
                break;
            }
        }

        echo $output . "<br>";
    }
}