<?php

class Skill {
  private $id = 0;
  private $name = "";
  private $db = null;
  private $test = "incroyable";

  public function __construct ($db, $id = 0) {
    if ($id) {
      $this->id = $id;
    }
    $this->db = $db;
  }

  public function addSkill ($skillName) {
    $this->db->query('INSERT INTO skills (name) VALUES ("'.$skillName.'")');
  }

}

?>
