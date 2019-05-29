<?php include ("inc/head.php");?>
  <div id="wrapper">

          <!-- Sidebar -->
          <?php include("inc/sidebar.php");?>

    <div id="page-content-wrapper">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-lg-12">
                     <h1 class="page-header">Endre øl</h1>
                       <div class="col-sm-5">
                         <form method="post">
                           <select class="form-control" name="endreOl">
                             <?php include("listeboks-ol.php"); ?>
                          </select>
                       <br><input class="knappFortsett" type="submit" name="finnOlKnapp" id="finnOlKnapp"><br><br>
                       </form>
                       </div>
                 </div>
          </div>
        </div>
            <div class="col-sm-offset-2 col-sm-10">
              <?php
              @$finnOlKnapp=$_POST["finnOlKnapp"];

              if($finnOlKnapp){
                $endreOl=$_POST["endreOl"];
                $sqlSetning="SELECT * FROM manos_beer WHERE batchnr='$endreOl';";
                $sqlResultat=mysqli_query($db, $sqlSetning) or die("Hei");
                $rad=mysqli_fetch_array($sqlResultat);
                @$batchnr=$rad["batchnr"];
                @$beer_style=$rad["beer_style"];
                @$beskrivelse=$rad["beskrivelse"];
                @$dato=$rad["dato"];
                @$volum=$rad["volum"];
                @$og=$rad["og"];
                @$fg=$rad["fg"];
                @$user_id["user_id"];

                print("<form method='post'>");
                print("<div class='row'><div class='col-lg-12'><div class='col-sm-5'><form method='post'>");
                print("Batchnr<input type='text' class='form-control' name='batchnr' id='batchnr' value='$batchnr' readonly><br>");
                print("Ølstil <select name='olstilen' id='olstilen' value='$beer_style'>");
                include("listeboks-olstil.php");
                print("<option value='$beer_style' selected='selected'>$beer_style</option>");
                print("</select><br>");
                print("Beskrivelse:<input type='text' class='form-control' name='beskrivelse' id='beskrivelse' value='$beskrivelse' ><br>");
                print("Antall liter<input type='text' class='form-control' name='volum' id='volum' value='$volum' ><br>");
                print("OG<input type='text' class='form-control' name='og' id='og' value='$og' ><br>");
                print("FG<input type='text' class='form-control' name='fg' id='fg' value='$fg' ><br>");
                print("Dato:<input type='text' class='form-control' name='dato' id='dato' value='$dato' ><br>");
                print("<input type='hidden' value='$user_id' name='user_id'");
                print("<input type='submit' class='knappFortsett' name='endreOlKnapp' id='endreOlKnapp'><br>");
                print("<input type='submit' class='knappFortsett' name='endreOlKnapp' id='endreOlKnapp'><br>");
                print("</div></div></div></div></div>");
                print("</form>");
              }

              @$endreOlKnapp=$_POST["endreOlKnapp"];

              if($endreOlKnapp){
                @$batchnr=$_POST["batchnr"];
                @$beer_style=$_POST["olstilen"];
                @$volum=$_POST["volum"];
                @$og=$_POST["og"];
                @$fg=$_POST["fg"];
                @$beskrivelse=$_POST["beskrivelse"];
                @$dato=$_POST["dato"];
                @$user_id=$_POST["user_id"];

                if(!$batchnr || !$beer_style || !$volum||!$og||!$fg||!$beskrivelse||!$dato||!$user_id){
                  print("Alle felt må fylles ut");
                }
                else{
                  $sqlSetning="UPDATE manos_beer SET beer_style='$beer_style', volum='$volum', og='$og', fg='$fg', dato='$dato', user_id='$user_id', beskrivelse='$beskrivelse' WHERE batchnr='$batchnr';";
                  mysqli_query($db, $sqlSetning) or die("ikke mulig å endre");
                  print("Øl endret");
                }

              }
              ?>
          </div>
    </div><!--page content wrapper-->
</div>
<?php include ("inc/footer.php");?>
