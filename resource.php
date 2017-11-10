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
        $dbr = $this -> db -> query("SELECT * FROM resource WHERE id = ".$this -> id);
        
        if ($dbr) {
            $dbri = $dbr -> fetch_object();
            $this -> id = $dbri -> id;
            $this -> name = $dbri -> name;
            $this -> firstname = $dbri -> firstname;
            $this -> alias = $dbri -> alias;
            $this -> efficiency = $dbri -> efficiency;
            $this -> available = $dbri -> available;
        }
        //Requête pour aller chercher les compétences de la resource 
        $dbrs = $this -> db -> query("SELECT efficiency.efficiency, skills.name FROM skills INNER JOIN efficiency WHERE efficiency.resource_id =". $this -> id); 
        $response = array();
        while ($dbrsi = $dbrs -> fetch_object()) {
            $this->skills[] = $dbrsi;
        }
        // Voir pourquoi on doit fetch_all à chaque fois
    }
    
    public function setValues($datas = null) {
        $usedAliases = $this -> db -> query("select alias from resource") -> fetch_all();
        foreach ($usedAliases as $aliasKey => $alias) {
            if (strtolower($datas["alias"]) === strtolower($alias[0])) {
                return 'Cet alias existe déjà !';
            }
        }

        foreach ($datas as $key => $val) {
            if ($key != "id") $this -> $key = $val;
        }
    }
    
    public function getValues() {
        return [
          "id" => $this -> id,
          "name" => $this -> name,
          "firstname" => $this -> firstname,
          "alias" => $this -> alias,
          "efficiency" => $this -> efficiency,
          "available" => $this -> available,
          "skills" => $this -> skills
        ];
    }
    
    public function getId() {
        return $this -> id;
    }
    
    public function save() {
        //Attention vérifier les valeurs
        $this -> db -> query("REPLACE INTO resource (id,name,firstname,efficiency,available) VALUES (".$this -> id.", '".
            $this -> db -> escape_string($this -> name)."','".
            $this -> db -> escape_string($this -> firstname)."',".
            $this -> db -> escape_string($this -> alias)."',".
            $this -> efficiency.",".
            $this -> available.")");
        if (!$this->id) $this -> id = $this -> db -> insert_id;
    }
}