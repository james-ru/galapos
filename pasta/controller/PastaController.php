<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/PastaDAO.php';

class PastaController extends Controller {

  private $pastaDAO;

  function __construct() {
    $this->pastaDAO = new PastaDAO();
  }

  public function index() {
    
    if (empty($_POST['prijs'])) {
      $errors['prijs'] = 'Please enter your prijs';
    }
    if (empty($_POST['persoon'])) {
      $errors['persoon'] = 'Please enter the persoon';
    }
    if (empty($_POST['aankoop'])) {
      $errors['aankoop'] = 'Please enter the aankoop';
    }


    if (!empty($_POST['action'])) {
      if ($_POST['action'] == 'insertAankoop') {
        $data = array(
          'prijs' => $_POST['prijs'],
          'persoon' => $_POST['persoon'],
          'aankoop' => $_POST['aankoop'],
          'date' => date('Y-m-d H:i:s'),
        );
      }
      
      $insertAankoopResult = $this->pastaDAO->insert($data);
      
      if (!$insertAankoopResult) {
        $errors = $this->pastaDAO->validate($data);
        $this->set('errors', $errors);
      }
    }

    $aankopen = $this->pastaDAO->selectAll();
    $this->set('aankopen', $aankopen);

    $totaalNastya = $this->pastaDAO->countByNastya();
    $this->set('totaalNastya', $totaalNastya);

    $totaalJames = $this->pastaDAO->countByJames();
    $this->set('totaalJames', $totaalJames);
  }
}
