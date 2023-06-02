<?php

class DatabaseModel {
    public function checkDatabase($driver) {
        if (extension_loaded($driver)) {
            return true;
        } else {
            return false;
        }
    }
}