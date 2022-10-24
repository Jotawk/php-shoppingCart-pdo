<?php

function showMessage() {
    if (isset($_SESSION["message"])) {
        $message = $_SESSION["message"];
        unset($_SESSION["message"]);
        return $message;
    }
}


