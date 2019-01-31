<?php
  require 'init.php';
  $bdd = connectBdd();
  $counter = 0;

  $query = $bdd->prepare("SELECT Pseudo FROM member WHERE Pseudo LIKE :search");
  $query->execute(['search'=>$_GET['search'].'%']);
  while($result = $query->fetch()) {
    echo "<a onclick=\"add('".$result['Pseudo']."')\">".$result['Pseudo']."<br>";
    $counter++;
  }
  if($counter == 0) {
    echo "Aucun résultat pour cette recherche";
  }
?>
