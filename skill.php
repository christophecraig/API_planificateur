<?php

class Skill {
  private $id = 0;
  private $name = "";
  private $db = null;

  public function __construct ($db, $id = 0) {
    if ($id) {
      $this->id = $id;
      $this->getDbValues();
    }
    $this->db = $db;
  }

  public function addSkill ($skillName) {
    $this->db->query('INSERT INTO skills (name) VALUES ("'.$skillName.'")');
  }

  private function getDbValues() {
    $dbr = $this -> db -> query("SELECT * FROM skills WHERE id = ".$this -> id);
    if ($dbr) {
        $dbri = $dbr -> fetch_object();
        $this -> id = $dbri -> id;
        $this -> name = $dbri -> name;
    }
    //Requête pour aller chercher les compétences de la resource 
  }

}

?>
