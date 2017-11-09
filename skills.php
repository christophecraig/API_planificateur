<?php

require_once('skill.php');

class Skills {

  private $db = null;
  private $skills = [];

  public function __construct ($db) {
    $this -> db = $db;
  }

  public function getSkills () {
    $dbrs = $this -> db -> query("SELECT * FROM skills ORDER BY name");
    // foreach ($response as $key => $value) {
    //   array_push($this->skills, array(
    //     "id"  => $value[0],
    //     "name" => $value[1] // A voir pourquoi les données sont renvoyées sous cette forme
    //   ));
    // }
    while ($dbrsi = $dbrs -> fetch_object()) {
      $response[] = $dbrsi;
  }
    return $response;
  }

  public function getSkill($id) {
    if ($id) {
        $skill = new skill($this -> db, $id);
        return $skill -> getValues();
    }
    return null;
  }

  public function addSkill($datas) {
    $skill = new skill($this -> db);
    $skill -> setValues($datas);
    $skill -> save();
    return $skill -> getId();
  }

  public function updateSkill($id, $datas) {
      $skill = new skill($this -> db, $id);
      $skill -> setValues($datas);
      $skill -> save();
      return $skill -> getValues();
  }

}

 ?>
