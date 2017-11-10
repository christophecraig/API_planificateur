<?php
// require_once("dataManipulation.php");
require_once("resource.php");

class resources {

    private $db = null;

    public function __construct($db) {
        $this -> db = $db;
    }

    public function getResources() {
        $dbrs = $this -> db -> query("SELECT * FROM resource ORDER BY name");
        $response = array();
        while ($dbrsi = $dbrs -> fetch_object()) {
            $response[] = $dbrsi;
        }
        return $response;
    }

    public function getResource($id) {
        if ($id) {
            $resource = new resource($this -> db, $id);
            return $resource -> getValues();
        }
        return NULL;
    }

    public function addResource($datas) {
        $resource = new resource($this -> db);
        $resource -> setValues($datas);
        $resource -> save();
        return $resource -> getId();
    }

    public function updateResource($id, $datas) {
        $resource = new resource($this -> db, $id);
        $resource -> setValues($datas);
        $resource -> save();
        return $resource -> getValues();
    }
}
