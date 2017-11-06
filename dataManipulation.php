<?php

    class dataManipulation {

        private $db = null;

        public function __construct ($db) {
            $this -> db = $db;
        }

        public function getValues($entity = null) {
            switch ($entity) {
                case "resources":
                
                break;
                case "resource":
                
                break;
                case "skills":
                
                break;
                case "skill":
                
                break;
                case "tasks":
                
                break;
                case "task":
                
                break;
                case "customer":
                
                break;
                case "customers":
                
                break;
            }
            
            if (!$entity) {
                return "An error occured, no entity was specified.";
            }
        }

        public function save() {

        }
    }
?>