<?php

require_once('skill.php');

class Skills {

  private $db = null;
  private $skills;

  public function __construct ($db) {
    $this -> db = $db;
  }

  public function getSkills () {
    $this -> skills = $this -> db -> query("SELECT * FROM skills ORDER BY name") -> fetch_all();
    return $this -> skills;
  }

  public function getSkill($id) {
    if ($id) {
        $skill = new skill($this -> db, $id);
        return $skill -> getValues();
    }
    return null;
}

}

 ?>
