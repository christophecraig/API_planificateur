<?php

class Customer
{
  private $id = 0;
  private $name = "";
  private $db = null;

  public function __construct($db, $id = 0)
  {
    $this->db = $db;    
    if ($id) {
      $this->id = $id;
      $this->getDbValues();
    }
  }

  public function addCustomer($customerName)
  {
    $this->db->query('INSERT INTO customers (name) VALUES ("' . $customerName . '")');
  }

  private function getDbValues()
  {
    $dbr = $this->db->query("SELECT * FROM customers WHERE id = " . $this->id);
    if ($dbr) {
      $dbri = $dbr->fetch_object();
      // var_dump($dbri);
      $this->id = $dbri->id;
      $this->name = $dbri->name;
    }
    //Requête pour aller chercher les compétences de la resource
  }

  public function getValues()
  {
      if ($this->name) {
          return [
              "id" => $this->id,
              "name" => $this->name,
              "email" => $this->email
          ];
      }
      return 'This resource does not exist';
  }

  public function getId()
  {
      return $this->id;
  }

  public function save()
  {
      //Attention vérifier les valeurs
      $this->db->query("REPLACE INTO resource (id,name,firstname,efficiency,available) VALUES (" . $this->id . ", '" .
          $this->db->escape_string($this->name) . "','" .
          $this->db->escape_string($this->email) . "')");
      if (!$this->id) $this->id = $this->db->insert_id;
  }

}

?>