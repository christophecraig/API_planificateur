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
  }

  public function addSkill ($skillName) {
    var_dump(array($this->test, $skillName));
  }

}

 ?>
