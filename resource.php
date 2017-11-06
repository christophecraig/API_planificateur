<?php
class resource  {
    private $id = 0;
    private $name = "";
    private $firstname = "";
    private $alias = "";
    private $efficiency = 0;
    private $available = true;
    private $skills = [];
    
    private $db = null;
    
    public function __construct($db,$id=0) {
        $this->db=$db;
        if ($id) {
            $this->id=$id;
            $this->getDbValues();
        }
    }
    
    private function getDbValues() {
        $dbr = $this -> db -> query("select * from resource where id=".$this->id);
        if ($dbr) {
            $dbri=$dbr->fetch_object();
            $this -> id = $dbri -> id;
            $this -> name = $dbri -> name;
            $this -> firstname = $dbri -> firstname;
            $this -> alias = $dbri -> alias;
            $this -> efficiency = $dbri -> efficiency;
            $this -> available = $dbri -> available;
        }
        //Requête pour aller chercher les compétences de la resource 
    }
    
    public function setValues($datas = null) {
        // if ($datas) {

        // }
        $existingAliases = $this -> db -> query("select alias from resource") -> fetch_all();
        foreach ($existingAliases as $aliasKey => $alias) {
            echo '<li>'.$alias[0].'</li>';
        }

        // foreach ($datas as $key => $val) {
        //     if ($key! = "id") $this -> $key = $val;
        // }
    }
    
    public function getValues() {
        return [
          "id" => $this -> id,
          "name" => $this -> name,
          "firstname" => $this -> firstname,
          "alias" => $this -> alias,
          "efficiency" => $this -> efficiency,
          "available" => $this -> available
        ];
    }
    
    public function getId() {
        return $this -> id;
    }
    
    public function save() {
        //Attention vérifier les valeurs
        $this -> db -> query("replace into resource (id,name,firstname,efficiency,available) values(".$this -> id.", '".
            $this -> db -> escape_string($this -> name)."','".
            $this -> db -> escape_string($this -> firstname)."',".
            $this -> db -> escape_string($this -> alias)."',".
            $this -> efficiency.",".
            $this -> available.")");
        if (!$this->id) $this->id=$this->db->insert_id;
    }
}