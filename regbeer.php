<?php include ("inc/head.php");?>
  <div id="wrapper">

          <!-- Sidebar -->
          <?php include("inc/sidebar.php");?>

    <div id="page-content-wrapper">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-lg-12">
                     <h1 class="page-header">Registrer øl</h1>


                       <form method="post" id="form" class="form-horizontal">

                         <div class="form-group">
                           <label for"batchnr" class="col-sm-2 control-label">Batch.nr</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" name="batchnr" id="batchnr" value="<?php if(isset($_POST["batchnr"])) echo $_POST["batchnr"]; ?>"/>  <br />
                           </div>
                         </div>

                         <div class="form-group">
                           <label for"beer_style" class="col-sm-2 control-label">Beer style</label>
                            <div class="col-sm-5">
                              <select name="beer_style" id="beer_style" >
                      					<?php include("checkbox_beer_style.php"); ?>
                      			 </select><br>
                            </div>
                          </div>

                       <div class="form-group">
                         <label for"beskrivelse" class="col-sm-2 control-label">Beskrivelse</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" name="beskrivelse" id="beskrivelse" value="<?php if(isset($_POST["beskrivelse"])) echo $_POST["beskrivelse"]; ?>" />  <br />
                          </div>
                        </div>

                       <div class="form-group">
                         <label for"volum" class="col-sm-2 control-label">Antall liter</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control"name="volum" id="volum" value="<?php if(isset($_POST["volum"])) echo $_POST["volum"]; ?> "/>  <br />
                          </div>
                        </div>

                        <div class="form-group">
                          <label for"og" class="col-sm-2 control-label">OG</label>
                           <div class="col-sm-5">
                             <input type="text" class="form-control" name="og" id="og" value="<?php if(isset($_POST["og"])) echo $_POST["og"]; ?>"/>  <br />
                          </div>
                        </div>

                        <div class="form-group">
                          <label for"fg" class="col-sm-2 control-label">FG</label>
                           <div class="col-sm-5">
                             <input type="text" class="form-control" name="fg" id="fg" value="<?php if(isset($_POST["fg"])) echo $_POST["fg"]; ?>"/>  <br />
                          </div>
                        </div>

                        <div class="form-group">
                          <label for"dato" class="col-sm-2 control-label">Dato</label>
                           <div class="col-sm-5">
                             <input type="text"  name="dato" id="dato" value="<?php if(isset($_POST["dato"])) echo $_POST["dato"]; ?>"/>  <br />
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
          	  @$batchnr=$_POST["batchnr"];
          	  @$beskrivelse=$_POST["beskrivelse"];
          		@$volum=$_POST["volum"];
              @$og=$_POST["og"];
              @$fg=$_POST["fg"];
              @$beer_style=$_POST["beer_style"];
              @$dato=$_POST["dato"];
              @$fortsett=$_POST["fortsett"];

              $del=explode(";", $beer_style);
              $beer_style=$del[0];

              if($fortsett){
              function validerBatchnr($batchnr){
          			$lovligBatchnr=true;

          			if(!$batchnr){
          				$lovligBatchnr=false;
          			}
          			else if(!is_numeric($batchnr)){
          				$lovligBatchnr=false;
          			}
          			return $lovligBatchnr;
          		}
              function validerVolum($volum){
          			$lovligVolum=true;

          			if(!$volum){
          				$lovligVolum=false;
          			}
          			else if(!is_numeric($volum)){
          				$lovligVolum=false;
          			}
          			return $lovligVolum;
          		}
              function validerOg($og){
          			$lovligOg=true;

          			if(!$og){
          				$lovligOg=false;
          			}
          			else if(!is_numeric($og)){
          				$lovligOg=false;
          			}
                else if(strlen($og)!=4){
                  $lovligOg=false;
                }
          			return $lovligOg;
          		}


          		$lovligBatchnr= validerBatchnr($batchnr);
              $lovligVolum= validerVolum($volum);
              $lovligOg= validerOg($og);

          	  if(!$batchnr||!$beskrivelse||!$dato){
          	    print("Synj, alle felt må fylles ut");

          	  }else if(!$lovligBatchnr){
          			print("Synj, du glæmt batchnr");
          		}
              elseif (!$lovligVolum) {
                print("Synj, antall liter er ikke fylt ut");
              }
              elseif (!$lovligOg) {
                print("Synj, OG ikke fyllt ut");
              }
          	  else{
          	    include("db-tilkobling.php");
          	      $sqlSetning="INSERT INTO manos_beer (batchnr, beer_style, beskrivelse, dato, volum, og, fg, user_id) VALUES('$batchnr', '$beer_style', '$beskrivelse', '$dato', '$volum', '$og', '$fg', '$user_id');";
          	      mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere til database $batchnr, $beer_style, $volum, $og, $fg, $dato, $user_id, $beskrivelse");
          	      print("Deily, øl e nå registrert");


          	  }
            }
          	?>
          </div>
          </div>
    </div><!--page content wrapper-->
</div>
<?php include ("inc/footer.php");?>
