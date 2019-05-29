<?php include ("inc/head.php");?>
    <div id="wrapper">
      <?php include("inc/sidebar.php");?>
        <div id="page-content-wrapper">
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-6 col-md-offset-2">
                         <article>
                       		<h1 class="page-header">Logg inn</h1>
                       		<form method="post" id="form" class="form-horizontal">
                       		  <input type="submit" name="loggutKnapp" value="Logg ut <?php print("$innloggetbruker"); ?>">
                       		</form>
                       	</article>
                        <?php
                        /* utlogging  */
                      /*
                      /*  Programmet logger ut en bruker fra applikasjonen
                      */@$loggut=$_POST["loggutKnapp"];
                      if($loggut){
                          session_start();
                          session_destroy();  /* sesjonen avsluttes */

                          print("<META HTTP-EQUIV='Refresh' CONTENT='0;URL=logginn.php'>");    /* redirigering tilbake til innloggings-siden (innlogging.php) */
                          //  header("Location: innlogging.php");
                    }
                      	?>
                       </div>
                     </div>
              </div>
        </div>
    </div>
<?php include ("inc/footer.php");?>
