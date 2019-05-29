<?php include ("inc/head.php");?>
  <div id="wrapper">

          <!-- Sidebar -->
          <?php include("inc/sidebar.php");?>

    <div id="page-content-wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                <div id="melding">
                  <div class="col-sm-offset-2 col-sm-10">
              <?php
            	print("<div class='table-responsive'><table class='table table-striped'>");
              print("<thead><tr><th>Ølstil</th></tr></thead><tbody><tr>");
            	  include("db-tilkobling.php");
            	  $sqlSetning="SELECT * FROM manos_beer_style ORDER BY beer_style";
            	  $sqlResultat=mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
            	  $antallRader=mysqli_num_rows($sqlResultat);

            	  print("<h3>Registrerte øl</h3>");
            	  for($r=1;$r<=$antallRader;$r++){
            	    $rad=mysqli_fetch_array($sqlResultat);
                  @$beer_style=$rad["beer_style"];
            	    print("<tr><td>$beer_style</td></tr>");
            	  }
            				print("</tr></tbody></table></div>");
            	?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!--page content wrapper-->
</div>
<?php include ("inc/footer.php");?>
