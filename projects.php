<?php

require_once('project.php');

class Projects
{

  private $db = null;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function getProjects()
  {
    $dbrs = $this->db->query("SELECT * FROM projects ORDER BY name");
    while ($dbrsi = $dbrs->fetch_object()) {
      $response[] = $dbrsi;
    }
    return $response;
  }

  public function getProject($id)
  {
    if ($id) {
      $project = new project($this->db, $id);
      return $project->getValues();
    }
    return null;
  }

  public function addProject($datas)
  {
    $project = new project($this->db);
    $project->setValues($datas);
    $project->save();
    return $project->getId();
  }

  public function updateProject($id, $datas)
  {
    $project = new project($this->db, $id);
    $project->setValues($datas);
    $project->save();
    return $project->getValues();
  }

}

?>
