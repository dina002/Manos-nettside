<?php include ("inc/head.php");?>
    <div id="wrapper">
        <div id="page-content-wrapper">
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-6 col-md-offset-2">
                         <article>

                         <h1 class="page-header">Registrer ny bruker</h1>
                         <form method="post" id="form" class="form-horizontal" onsubmit="return validerRegistrerBruker()">

                           <div class="form-group">
                             <label for"brukernavn" class="col-sm-2 control-label">Brukernavn</label>
                             <div class="col-sm-10">
                               <input type="text" class="form-control" name="brukernavn" id="brukernavn"  required/>  <br />
                             </div>
                           </div>

                           <div class="form-group">
                             <label for"passord" class="col-sm-2 control-label">Passord</label>
                             <div class="col-sm-10">
                               <input type="password" class="form-control"name="passord" id="passord" required/>  <br />
                             </div>
                           </div>

                           <div class="form-group">
                             <label for"passord2" class="col-sm-2 control-label">Passord</label>
                             <div class="col-sm-10">
                               <input type="password" class="form-control" name="passord2" id="passord2" required/>  <br />
                             </div>
                           </div>

                           <div class="form-group">
                             <label for"email" class="col-sm-2 control-label">Email</label>
                             <div class="col-sm-10">
                               <input type="text" class="form-control" name="email" id="email"  required/>  <br />
                             </div>
                           </div>

                           <div class="form-group">
                             <label for"fornavn" class="col-sm-2 control-label">Fornavn</label>
                             <div class="col-sm-10">
                               <input type="text" class="form-control" name="fornavn" id="fornavn"  required/>  <br />
                             </div>
                           </div>

                           <div class="form-group">
                             <label for"etternavn" class="col-sm-2 control-label">Etternavn</label>
                             <div class="col-sm-10">
                               <input type="text" class="form-control" name="etternavn" id="etternavn"  required/>  <br />
                             </div>
                           </div>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <input type="submit" name="registrerBrukerKnapp" value="Registrer ny bruker">
                              <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br />
                            </div>
                          </div>
                         </form>

                             </article>
                        <?php
                          @$registrerBrukerKnapp=$_POST ["registrerBrukerKnapp"];

                          if ($registrerBrukerKnapp)
                            {
                              include("db-tilkobling.php");
                              $brukernavn=$_POST ["brukernavn"];
                              $passord=$_POST["passord"];
                              $passord2=$_POST["passord2"];
                              $email=$_POST ["email"];
                              $fornavn=$_POST ["fornavn"];
                              $etternavn=$_POST ["etternavn"];  /* variable gitt verdier fra feltene i HTML-skjemaet */

                              if (!$brukernavn || !$passord || !$passord2 || !$email || !$fornavn || !$etternavn)  /* brukernavn og passord er ikke fylt ut */
                              {
                                print ("Fyll ut alle felt <br />");
                              }
                              else if($passord!=$passord2){
                                print("Passord er ikke like");
                              }
                              else if(strlen($passord)<8){
                                print("Passord må være 8 tegn eller lengre.");
                              }
                              else if(!preg_match('/[A-Å]+/', $passord)||!preg_match('/[a-å]+/', $passord)){
                                print("Passord må inneholde en stor og en liten bokstav");
                              }
                              else
                              {
                                $sqlSetning="SELECT * FROM manos_users WHERE brukernavn='$brukernavn';";
                                $sqlResultat=mysqli_query($db, $sqlSetning) or die("Kan ikke hente brukere");

                                if (mysqli_num_rows($sqlResultat)!=0)  /* brukernavnet er registrert fra før */
                                {
                                  print ("Brukernavnet:$brukernavn er registrert fra f&oslash;r <br />");
                                }
                                else
                                {
                                  $kryptertPassord=password_hash($passord, PASSWORD_DEFAULT);
                                  $sqlSetning="INSERT INTO manos_users (brukernavn, passord, email, fornavn, etternavn) VALUES ('$brukernavn', '$kryptertPassord', '$email', '$fornavn', '$etternavn');";
                                  mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere til databasen");
                                  print ("Bruker: $brukernavn er nå registrert<br>");
                                  print("<a href='logginn.php'>Logg inn</a>");                        }
                                }
                            }
                      	?>
                       </div>
                     </div>
              </div>
        </div>
    </div>
<?php include ("inc/footer.php");?>
