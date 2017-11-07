<?php
// require_once("resource.php");
require_once("resources.php");
require_once("skills.php");
$db = new mysqli("localhost","root","","planificateur");
$resources = new resources($db);
echo '<pre>';
$detailedResource = $resources->getResource(3);
foreach ($detailedResource as $key => $value) {
    echo '</pre></li><li><strong>' . $key . '</strong><br><pre>';
    var_dump($value);
}

$skills = new Skills($db);

// $resources=new resources($db);
//
// $entity=$_GET["entity"];
// $action=$_GET["action"];
// if (!isset($_GET["params"]))
//     $params=[];
// else $params=json_decode($_GET["params"]);
//
// echo $params;
//
// // print(json_encode(call_user_func_array([${$entity},$action],$params)));
// $resources::addResource($params);

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
