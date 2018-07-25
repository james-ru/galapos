<?php

require_once __DIR__ . '/DAO.php';

class PastaDAO extends DAO {

  public function selectAll() {
    $sql = "SELECT * FROM `pasta_orders`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectById($id) {
    $sql = "SELECT * FROM `pasta_orders` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function countByNastya() {
    $sql = "SELECT SUM(prijs) FROM pasta_orders WHERE persoon = 'Nastya'";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function countByJames() {
    $sql = "SELECT SUM(prijs) FROM pasta_orders WHERE persoon = 'James'";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($data) {
    $errors = $this->validate($data);
    if (empty($errors)) {
      $sql = "INSERT INTO `pasta_orders` (`aankoop`, `prijs`, `date`, `persoon`) VALUES (:aankoop, :prijs, :date, :persoon)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':aankoop', $data['aankoop']);
      $stmt->bindValue(':prijs', $data['prijs']);
      $stmt->bindValue(':date', $data['date']);
      $stmt->bindValue(':persoon', $data['persoon']);
      
      if ($stmt->execute()) {
        $insertedId = $this->pdo->lastInsertId();
        return $this->selectById($insertedId);
      }
    }
    return false;
  }

  public function update($id, $data) {
    $errors = $this->validate($data);
    
    if (empty($errors)) {
      $sql = "UPDATE `pasta_orders` SET `aankoop` = :aankoop, `prijs` = :prijs, `date`= :date, `persoon` = :persoon WHERE `id` = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':aankoop', $data['aankoop']);
      $stmt->bindValue(':prijs', $data['prijs']);
      $stmt->bindValue(':date', $data['date']);
      $stmt->bindValue(':persoon', $data['persoon']);
      $stmt->bindValue(':id', $id);
      
      if ($stmt->execute()) {
        return $this->selectById($id);
      }
    }
    return false;
  }

  public function delete($id) {
    $sql = "DELETE FROM `pasta_orders` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }

  public function validate($data) {
    $errors = array();

    if (empty($data['aankoop'])) {
      $errors['aankoop'] = 'What did you buy?';
    }
    if (empty($data['prijs'])) {
      $errors['prijs'] = 'What is the price?';
    }
    if (empty($data['persoon'])) {
      $errors['persoon'] = 'Please enter the persoon';
    }
    return $errors;
  }
}
