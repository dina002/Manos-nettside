<?php include ("inc/head.php");?>
  <div id="wrapper">

          <!-- Sidebar -->
          <?php include("inc/sidebar.php");?>

    <div id="page-content-wrapper">
	<div class="container-fluid">
			<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Min side</h1>
							<h2>Om deg</h2>
							<?php print("Fornavn: $fornavn<br>Etternavn: $etternavn<br>Epost: $email<br>Bildenr:$bildenr user_id:$user_id<br>");
              include("db-tilkobling.php");
              $sqlSetning="SELECT * FROM manos_profilbilde WHERE user_id='$user_id';";
    		      $sqlResultat=mysqli_query($db, $sqlSetning) or die("Ikke kontakt");
    		      $antallRader=mysqli_num_rows($sqlResultat);

    		      if($antallRader!=0){
                for($r=1;$r<=$antallRader;$r++){
                  $rad=mysqli_fetch_array($sqlResultat);
                  $user_id=$rad["user_id"];
                  $bildenr=$rad["bildenr"];
                  $filnavn=$rad["filnavn"];
                  $dato=$rad["dato"];

                  $sqlSetning1="SELECT * FROM manos_profilbilde WHERE bildenr='$bildenr';";
                  $sqlResultat1=mysqli_query($db, $sqlSetning1) or die("Hei");
                  $rad1=mysqli_fetch_array($sqlResultat1);
                  $filnavn=$rad1["filnavn"];
                  print("<a href='https://home.hbv.no/phptemp/146813/manos_profilbilde/$filnavn'><img class='circle' style='width:100px;'src='https://home.hbv.no/phptemp/146813/manos_profilbilde/$filnavn' target='_blank'></a>");
                }
    		      }
    		      else{
								print(" Ser ikke ut som du har registrert noe bilde");
							}
							?>
							<h2>Profilbilde</h2>
  					    <form method="post" id="form" class="form-horizontal boks" onsubmit="return validerRegistrerBilde()" enctype="multipart/form-data">
                  <label for"bildenr">Bildenr</label>
                  <input type="text" name="bildenr" id="bildenr" required/>  <br />
                  <label for"fil">Velg bilde</label><br>
    							<input type="file" id="fil" name="fil" class="fil" size="100" requirSed><br />
    							<input type="submit" class="knappFortsett" value="Registrer bilde" id="fortsett" name="fortsett" />
  							</form>

                <h2> Endre Bilde</h2>
                <form method="post" id="form2" class="form-horizontal boks" enctype="multipart/form-data">
                  <select name="endreBilde">
                    <?php include("listeboks-bilde.php"); ?>
                  </select>
                  <input type="submit" value="Endre bilde" name="finnBildeKnapp" id="finnBildeKnapp">
                </form>

		<?php
		@$registrerBildeknapp=$_POST["fortsett"];

		if($registrerBildeknapp){
      @$bildenr=$_POST["bildenr"];
		  $filnavn=$_FILES["fil"]["name"];
		  $filtype=$_FILES["fil"]["type"];
		  $filstorrelse=$_FILES["fil"]["size"];
		  $tmpnavn=$_FILES["fil"]["tmp_name"];
		  $nyttnavn="D:\\Sites\\home.hbv.no\\phptemp\\146813/manos_profilbilde/".$filnavn;

		  if(!$filnavn||!$bildenr){
		    print("Alle felt er ikke fyll ut <br> ");
				print("$filnavn");
		  }
		  else{
		    if($filtype !="image/gif" && $filtype != "image/jpeg" && $filtype!="image/png"){
		      print("Synj, dette var ikke et bilde");

		    }
		    else if($filstorrelse>5000000){
		      print("Synj, for stort bilde");

		    }else{

		      $sqlSetning="SELECT * FROM manos_profilbilde WHERE bildenr='$bildenr';";
		      $sqlResultat=mysqli_query($db, $sqlSetning) or die("Ikke kontakt");
		      $antallRader=mysqli_num_rows($sqlResultat);

		      if($antallRader!=0){
		        print("Bildet eksisterer fra før av");
		      }
		      else{ /*alt stemmer*/
						$dagensDato=date("Y-m-d");
		        move_uploaded_file($tmpnavn, $nyttnavn) or die("ikke mulig å laste opp");
		        $sqlSetning="INSERT INTO manos_profilbilde (bildenr, filnavn, dato, user_id) VALUES('$bildenr', '$filnavn', '$dagensDato', '$user_id');";
            $sqlSetning2="UPDATE manos_profilbilde SET bildenr='$bildenr';";
		        mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrer bilde til database");
            mysqli_query($db, $sqlSetning2) or die("Ikke mulig å registrer bilde til bruker");

		        print("<div class='registrert'><h4>Bilde registrert</h4><br>Bildenr: $bildenr <br>Opplastningsdato: $dagensDato<br>Filnavn: $filnavn <br></div>");
		      }
		    }
		  }
		}

    @$finnBildeKnapp=$_POST["finnBildeKnapp"];

    if($finnBildeKnapp){
      $endreBilde=$_POST["endreBilde"];
      $del=explode(";", $endreBilde);
      $bildenr=$del[0];
      $dato=$del[1];
      @$filnavn=$del[2];
      @$user_id=$del[3];



      $sqlSetning="SELECT * FROM manos_profilbilde WHERE bildenr='$bildenr';";
      $sqlResultat=mysqli_query($db, $sqlSetning) or die("Finner ikke bildet");
      $rad=mysqli_fetch_array($sqlResultat);
      $bildenr=$rad["bildenr"];
      $dato=$rad["dato"];
      $user_id=$rad["user_id"];
      $filnavn=$rad["filnavn"];

      print("<form method='post'>");
      print("Bildenr<input type='text' class='form-control boks' name='bildenr' id='bildenr' value='$bildenr'readonly><br>");
      print("Opplastningsdato: $dato<br>");
      print("Bilde: <a href='https://home.hbv.no/phptemp/146813/manos_profilbilde/$filnavn'><img style='width:50px;'src='https://home.hbv.no/phptemp/146813/manos_profilbilde/$filnavn' class='circle' target='_blank'></a><br>");
      print("<input type='file' id='fil2' name='fil2' class='fil' size='100' required><br />");
      print("<input type='submit' value='Endre bilde' name='endreKlasseKnapp' id='endreKlasseKnapp'><br>");
      print("</form>");
    }

    @$endreKlasseKnapp=$_POST["endreKlasseKnapp"];

    if($endreKlasseKnapp){
      $bildenr=$_POST["bildenr"];
      $filnavn=$_FILES["fil2"]["name"];
		  $filtype=$_FILES["fil2"]["type"];
		  $filstorrelse=$_FILES["fil2"]["size"];
		  $tmpnavn=$_FILES["fil2"]["tmp_name"];
		  $nyttnavn="D:\\Sites\\home.hbv.no\\phptemp\\146813/manos_profilbilde/".$filnavn;

		  if(!$filnavn||!$bildenr){
		    print("Alle felt er ikke fyll ut <br> ");
				print("$filnavn");
		  }
		  else{
		    if($filtype !="image/gif" && $filtype != "image/jpeg" && $filtype!="image/png"){
		      print("Synj, dette var ikke et bilde");

		    }
		    else if($filstorrelse>5000000){
		      print("Synj, for stort bilde");

		    }else{

						$dagensDato=date("Y-m-d");
		        move_uploaded_file($tmpnavn, $nyttnavn) or die("ikke mulig å laste opp");
		        $sqlSetning="INSERT INTO manos_profilbilde (bildenr, filnavn, dato, user_id) VALUES('$bildenr', '$filnavn', '$dagensDato', '$user_id');";
            $sqlSetning2="UPDATE manos_profilbilde SET bildenr='$bildenr';";
		        mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrer bilde til database");
            mysqli_query($db, $sqlSetning2) or die("Ikke mulig å registrer bilde til bruker");

		        print("<div class='registrert'><h4>Bilde registrert</h4><br>Bildenr: $bildenr <br>Opplastningsdato: $dagensDato<br>Filnavn: $filnavn <br></div>");

		    }
		  }

    }

		?>
  </div>
</div>
</div>
</div><!--page content wrapper-->
</div>
<?php include ("inc/footer.php");?>
