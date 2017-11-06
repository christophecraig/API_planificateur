<?php
require_once("resources.php");
$db=new mysqli("localhost","root","","planificateur");


$resources=new resources($db);

$entity=$_GET["entity"];
$action=$_GET["action"];
if (!isset($_GET["params"]))
    $params=[];
else $params=json_decode($_GET["params"]);

// echo gettype(json_decode($_GET['params']));

// print(json_encode(call_user_func([${$entity},$action],$params)));

// $resourcesList=$resources->getResources();

// print(json_encode($resourcesList));

// foreach($resourcesList as $r) {
//     print(json_encode($resources->getResource($r->id)));
// }


//var_dump($resource->getValues());


// $resource->setValues([
//     "name"=>"TETART",
//     "firstname"=>"Florent",
//     "efficiency"=>100,
//     "available"=>true
// ]);
// $resource->save();
