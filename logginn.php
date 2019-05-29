<?php include ("inc/head.php");?>
<?php
@session_start();
@$innloggetbruker=$_SESSION["brukernavn"];
if($innloggetbruker){
  print("<META HTTP-EQUIV='refresh' CONTENT='0;URL=home.php'>");
}
else{


?>
    <div id="wrapper">
        <div id="page-content-wrapper">
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-6 col-md-offset-2">
                         <article>
                       		<h1 class="page-header">Logg inn</h1>
                       		<form method="post" id="form" class="form-horizontal">
                       			<div class="form-group">
                       				<label for"fraflyplass" class="col-sm-2 control-label">Brukernavn</label><br><br>
                       				 <div class="col-sm-10">
                       					 <input type="text" class="form-control" name="brukernavn" id="brukernavn"  required/>
                       				 </div>
                       			</div>
                       			<div class="form-group">
                       				<label for"tilflyplass" class="col-sm-2 control-label">Passord</label><br><br>
                       					<div class="col-sm-10">
                       					 <input type="password" class="form-control"name="passord" id="passord" required/>
                       					</div>
                       			</div>
                       		  <input type="submit" class="btn-primary" name="logginnKnapp" value="Logg inn">
                       		  <input type="button" class="btn-primary" name="nullstill" id="nullstill" value="Registrer deg"> <br />
                       		</form>
                       		<br>Ny bruker ? <br />
                       		<a href="register.php">Registrer deg her</a> <br /> <br />

                       	</article>
                        <?php
                        include("db-tilkobling.php");
                      	    @$logginnKnapp=$_POST ["logginnKnapp"];
                      	    if ($logginnKnapp)
                      	        {
                      	            $brukernavn=$_POST["brukernavn"];
                      	            $passord=$_POST["passord"];

                      	            include("sjekk.php");

                      	            if (!sjekkBrukernavnPassord($brukernavn, $passord))  /* brukernavn og passord er ikke korrekt */
                      	                {
                      	                    print("Feil brukernavn/passord <br />");
                      	                }
                      	            else  /* brukernavn og passord er korrekt */
                      	                {
                                            $sqlSetningen="SELECT * FROM manos_users WHERE brukernavn='$brukernavn';";
                                            $sqlResultatet=mysqli_query($db, $sqlSetningen) or die("Kan ikke hente brukernavn");
                                            $raden=mysqli_fetch_array($sqlResultatet);
                                            $user_id=$raden["user_id"];
                                            $fornavn=$raden["fornavn"];
                                            $etternavn=$raden["etternavn"];
                                            $email=$raden["email"];
                                            $bildenr=$raden["bildenr"];
                                            @session_start();
                                            $_SESSION["brukernavn"]=$brukernavn;
                                            $_SESSION["user_id"]=$user_id;
                                            $_SESSION["fornavn"]=$fornavn;
                                            $_SESSION["etternavn"]=$etternavn;
                                            $_SESSION["email"]=$email;
                                            $_SESSION["bildenr"]=$bildenr;
                      	                    print("<META HTTP-EQUIV='refresh' CONTENT='0;URL=minside.php'>");
                      	            	}
                      	    	}
                            }
                      	?>
                       </div>
                     </div>
              </div>
        </div>
    </div>
<?php include ("inc/footer.php");?>
