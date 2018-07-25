<?php

require_once __DIR__ . '/DAO.php';

class ApiDAO extends DAO {

  public function selectAll() {
    $sql = "SELECT * FROM `pasta_orders`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
