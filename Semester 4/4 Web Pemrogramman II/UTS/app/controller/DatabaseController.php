<?php

require_once 'app/model/DatabaseModel.php';

class DatabaseController {
    private $model;
    
    public function __construct() {
        $this->model = new DatabaseModel();
    }
    
    public function checkDatabaseAvailability() {
        $databases = array('mysql', 'pgsql', 'mongodb');
        $availability = array();
        
        foreach ($databases as $db) {
            $isAvailable = $this->model->checkDatabase($db);
            $availability[$db] = $isAvailable;
        }
        
        return $availability;
    }
}