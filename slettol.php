<?php include ("inc/head.php");?>
  <div id="wrapper">

          <!-- Sidebar -->
          <?php include("inc/sidebar.php");?>

    <div id="page-content-wrapper">
      <form method="post" id="slettFagSkjema" name="slettFagSkjema" onsubmit="return bekreft()">
        <h3>Slett Øl</h3>
        <select id='batchnr' name='batchnr'>
          <?php include("listeboks-ol.php");?>

        </select><br><br>
        <input type="submit" value="Slett Øl" name="slettOlKnapp" id="slettOlKnapp">
      </form>
    <?php
    @$slettOlKnapp=$_POST["slettOlKnapp"];

    if($slettOlKnapp){
    @$batchnr=$_POST["batchnr"];

    $sqlSetning="DELETE FROM manos_beer WHERE batchnr='$batchnr' AND user_id=$user_id;";
    mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette fra database!!!");
    print("Følgende øl er slettet: $batchnr <br>");
    }
    ?>
    </div><!--page content wrapper-->
</div>
<?php include ("inc/footer.php");?>
