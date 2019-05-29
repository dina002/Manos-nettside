<?php
  include("db-tilkobling.php");

  $sqlSetning="SELECT * FROM manos_beer WHERE user_id='$user_id' ORDER BY batchnr;";

  $sqlResultat=mysqli_query($db, $sqlSetning) or die("Synj, db not wurk");
  $antallRader=mysqli_num_rows($sqlResultat);

  for($r=1;$r<=$antallRader;$r++){
    $rad=mysqli_fetch_array($sqlResultat);
    @$batchnr=$rad["batchnr"];
    @$beer_style=$rad["beer_style"];
    @$beskrivelse=$rad["beskrivelse"];
    @$dato=$rad["dato"];
    @$volum=$rad["volum"];
    @$og=$rad["og"];
    @$fg=$rad["fg"];
    @$user_id["user_id"];
    print("<option value='$batchnr;$beer_style;$beskrivelse;$dato;$volum;$og;$fg;$user_id'>$batchnr $beer_style</option>");
  }

?>
