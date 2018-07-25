<?php

require_once __DIR__ . '/../dao/ApiDAO.php';

class Order {
    private $apiDAO;

    function __construct() {
        $this->apiDAO = new ApiDAO();
    }

    function selectAll() {
        return $this->apiDAO->selectAll();
    }
}
?>