<?php include ("inc/head.php");?>
  <div id="wrapper">

          <!-- Sidebar -->
          <?php include("inc/sidebar.php");?>

    <div id="page-content-wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                <div id="melding">
              <?php
            	print("<div class='table-responsive'><table class='table table-striped'>");
              print("<thead><tr>
              <th>Batch.nr</th>
              <th>Ølstil</th>
              <th>Beskrivelse</th>
              <th>Dato</th>
              <th>Antall liter</th>
              <th>OG</th>
              <th>FG</th>
              <th>Alc</th>
              <th>User</th>
              </tr></thead><tbody><tr>");
            	  include("db-tilkobling.php");
            	  $sqlSetning="SELECT * FROM manos_beer WHERE user_id='$user_id' ORDER BY batchnr";
            	  $sqlResultat=mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
            	  $antallRader=mysqli_num_rows($sqlResultat);

            	  print("<h3>Registrerte øl</h3>");
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
                  $alc=$og-$fg;
                  $alcert=$alc/7.5;
                  $alcertt=round($alcert, 2);
            	    print("<tr><td>$batchnr</td> <td>$beer_style</td> <td>$beskrivelse</td><td>$dato</td><td>$volum</td><td>$og</td><td>$fg</td><td>$alcertt%</td><td>$user_id</td></tr>");
            	  }
                $sqlS="SELECT SUM(volum) AS value_sum FROM manos_beer;";
                $result = mysqli_query($db, $sqlS);
                $row=mysqli_fetch_assoc($result);
                $sum=$row['value_sum'];
                print("<tr> <td>Antall liter totalt:</td><td></td><td>$sum</td></tr>");
                $kronerspart=$sum*32.64;
                $haddeKosta=$sum*50;
                $koster=$sum*17.34;
                print("<tr> <td>Antall kroner spart:</td><td></td><td>$kronerspart kr</td></tr>");
                print("<tr> <td>Mye ølet hadde kosta fra butikken:</td><td></td><td>$haddeKosta kr</td></tr>");
                print("<tr> <td>Mye ølet har kostet oss:</td><td></td><td>$koster kr</td></tr>");


            				print("</tr></tbody></table></div>");
            	?>
          </div>
        </div>
      </div>
    </div>
  </div><!--page content wrapper-->
</div>
<?php include ("inc/footer.php");?>
