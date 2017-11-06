<?php
  $db=new mysqli("localhost","root","","planificateur");
?>
  <?php
  $resource = $db->query('SELECT * FROM resource WHERE id = 3')->fetch_object();
  $skill = $db->query('SELECT * FROM skills WHERE id = 5')->fetch_object();
?>

  <pre><?php var_dump($resource);?></pre>

<h4>On cherche à calculer l'efficacité de <?php echo $resource->alias; ?> en <?php echo $skill->name; ?></h4>
<p>Elle est de : <?php echo $db->query('SELECT efficiency.efficiency FROM efficiency WHERE skill_id = '.$skill->id.' AND resource_id = '.$resource->id)->fetch_object()->efficiency; ?></p>
