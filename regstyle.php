<?php include ("inc/head.php");?>
  <div id="wrapper">

          <!-- Sidebar -->
          <?php include("inc/sidebar.php");?>

    <div id="page-content-wrapper">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-lg-12">
                     <h1 class="page-header">Registrer ølstil</h1>
                       <form method="post" id="form" class="form-horizontal">
                         <div class="form-group">
                           <label for"beer_style" class="col-sm-2 control-label">Beer style</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" name="beer_style" id="beer_style"/>  <br />
                           </div>
                         </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="knappFortsett" value="Fortsett" id="fortsett" name="fortsett" />
                            <input type="reset" class="knappNullstill" value="Nullstill" name="nullstill" id="nullstill" /> <br />
                          </div>
                        </div>
                     </form>
                   </div>
                 </div>
          </div>
          <div id="melding">
            <div class="col-sm-offset-2 col-sm-10">
            <?php
          	  @$fortsett=$_POST["fortsett"];
          	  @$beer_style=$_POST["beer_style"];
              if($fortsett){
            	  if(!$beer_style){
            	    print("Synj, ølstil må fylles ut");
                }
                else if(is_numeric($beer_style)){
                  print("Kan ikke inneholde tall");
                }
            	  else{
            	    include("db-tilkobling.php");
            	    $sqlSetning="SELECT * FROM manos_beer_style WHERE beer_style='$beer_style';";
            	    $sqlResultat=mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra database");
            	    $antallRader=mysqli_num_rows($sqlResultat);/*0=finnes ikke 1=finnes fra før*/

            	    if($antallRader!=0){
            	      print("Synj, ølstilen er allerede registrert");

            	    }
            	    else{
            	      $sqlSetning="INSERT INTO manos_beer_style VALUES('$beer_style');";
            	      mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere til database $beer_style");
            	      print("Deily, ølstil $beer_style er nå registrert");
            	    }

            	  }
            }
          	?>
          </div>
          </div>
    </div><!--page content wrapper-->
</div>
<?php include ("inc/footer.php");?>
