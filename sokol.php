<?php include ("inc/head.php");?>
  <div id="wrapper">

          <!-- Sidebar -->
          <?php include("inc/sidebar.php");?>

    <div id="page-content-wrapper">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-lg-12">
                     <h1 class="page-header">Søk etter øl</h1>
                     <form method="post">
                       <div class="col-sm-5">
                         <label for="text">Tekststreng:</label>
                       <input type="text" id="tekst" name="tekst">
                       <input type="submit" id="fortsett" name="fortsett">
                       </div>
                     </form>
                   </div>
                 </div>
               </div>
          <div id="melding">
              <?php
              @$fortsett=$_POST["fortsett"];
              if($fortsett){
                $sokestreng=$_POST["tekst"];
                include("db-tilkobling.php");

                $sqlSetning="SELECT * FROM manos_beer WHERE
                brew_id LIKE '%$sokestreng%'
                OR batchnr LIKE '%$sokestreng%'
                OR beer_style LIKE '%$sokestreng%'
                OR beskrivelse LIKE '%$sokestreng%'
                OR dato LIKE '%$sokestreng%'
                OR volum LIKE '%$sokestreng%'
                OR og LIKE '%$sokestreng%'
                OR fg LIKE '%$sokestreng%';";

                $sqlResultat=mysqli_query($db, $sqlSetning) or die("Synj, itte mulig å hente");

                $antallRader=mysqli_num_rows($sqlResultat);

                if($antallRader==0){
                  print("<p style='color:red;'>Ingen treff i Øl-tabellen</p><br>");
                }
                else
                {
                  print("<p style='color:darkgreen;'>Treff i Øl-tabellen</p>");

                  print("<div class='table-responsive'><table class='table table-striped'>");
                  print("<thead><tr><th>Batch.nr</th>
                  <th>Brew ID</th>
                  <th>Batch Nr</th>
                  <th>Ølstil</th>
                  <th>Beskrivelse</th>
                  <th>Dato</th>
                  <th>Volum</th>
                  <th>OG</th>
                  <th>FG</th>
                  </tr></thead><tbody><tr>");
                  for($r=1;$r<=$antallRader;$r++){
                    $rad=mysqli_fetch_array($sqlResultat);
                    @$brew_id=$rad["brew_id"];
                    @$batchnr=$rad["batchnr"];
                    @$beer_style=$rad["beer_style"];
                    @$beskrivelse=$rad["beskrivelse"];
                    @$dato=$rad["dato"];
                    @$volum=$rad["volum"];
                    @$og=$rad["og"];
                    @$fg=$rad["fg"];
                    @$user_id=$rad["user_id"];

                    $tekst="<tr><td>$brew_id</td><td>$batchnr</td> <td>$beer_style</td><td>$beskrivelse</td><td>$dato</td><td>$volum</td><td>$og</td><td>$fg</td><td>$user_id</td></tr>";
                    $tekstlengde=strlen($tekst);
                    $sokestrenglengde=strlen($sokestreng);
                    $startpos=stripos($tekst, $sokestreng);

                    $hode=substr($tekst, 0, $startpos);
                    $sok=substr($tekst, $startpos, $sokestrenglengde);
                    $hale=substr($tekst, $startpos+$sokestrenglengde, $tekstlengde-$startpos-$sokestrenglengde);

                    print("$hode <strong>$sok</strong>$hale");

                  }
                  print("</tr></tbody></table></div>");
                  print("<br><br>");
                }
              }
              ?>

          </div>
    </div><!--page content wrapper-->
</div>
<?php include ("inc/footer.php");?>
