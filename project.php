<?php

class Project
{
    private $id = 0;
  // à définir

    public function __construct($db, $id = 0)
    {
        $this->db = $db;
        if ($id) {
            $this->id = $id;
            $this->getDbValues();
        }
    }

    public function addProject($projectName)
    {
        $this->db->query('INSERT INTO projects (name) VALUES ("' . $projectName . '")');
    }

    private function getDbValues()
    {
        $dbr = $this->db->query("SELECT * FROM projects WHERE id = " . $this->id);
        if ($dbr) {
            $dbri = $dbr->fetch_object();
            $this->id = $dbri->id;
            $this->name = $dbri->name;
            $this->email = $dbri->email;
        }
    }

    public function getValues()
    {
        if ($this->name) {
            return [
                "id" => $this->id,
                "name" => $this->name
            ];
        }
        return 'This project does not exist';
    }

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {
      //Attention vérifier les valeurs
        $this->db->query("REPLACE INTO projects (id,name,firstname,efficiency,available) VALUES (" . $this->id . ", '" .
            $this->db->escape_string($this->name) . "')");
        if (!$this->id) $this->id = $this->db->insert_id;
    }

}

?>