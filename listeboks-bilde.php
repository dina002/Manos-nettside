<?php
  include("db-tilkobling.php");

  $sqlSetning="SELECT * FROM manos_profilbilde WHERE user_id='$user_id' ORDER BY bildenr;";

  $sqlResultat=mysqli_query($db, $sqlSetning) or die("Synj, db not wurk");
  $antallRader=mysqli_num_rows($sqlResultat);

  for($r=1;$r<=$antallRader;$r++){
    $rad=mysqli_fetch_array($sqlResultat);
    $bildenr=$rad["bildenr"];
    $dato=$rad["dato"];
    $filnavn=$rad["filnavn"];
    $user_id=$rad["user_id"];
    print("<option value='$bildenr;$dato;$filnavn;$user_id'>$bildenr $filnavn</option>");
  }

?>
