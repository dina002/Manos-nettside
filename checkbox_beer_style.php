<?php
  include("db-tilkobling.php");

  $sqlSetning="SELECT * FROM manos_beer_style ORDER BY beer_style;";

  $sqlResultat=mysqli_query($db, $sqlSetning) or die("Synj, db not wurk");
  $antallRader=mysqli_num_rows($sqlResultat);

  for($r=1;$r<=$antallRader;$r++){
    $rad=mysqli_fetch_array($sqlResultat);
    $beer_style=$rad["beer_style"];
    print("<option value='$beer_style'>$beer_style</option>");
  }

?>
