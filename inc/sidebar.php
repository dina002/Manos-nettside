<div id="sidebar-wrapper">
  <ul class="sidebar-nav">
    <li class="sidebar-brand"><a href="loggut.php">Logg ut</a></li>
    <li class="sidebar-brand"><?php
    @session_start();
    @$innloggetbruker=$_SESSION["brukernavn"];
    @$user_id=$_SESSION["user_id"];
    @$fornavn=$_SESSION["fornavn"];
    @$etternavn=$_SESSION["etternavn"];
    @$email=$_SESSION["email"];
    @$bildenr=$_SESSION["bildenr"];

    if(!$innloggetbruker){
      print("<META HTTP-EQUIV='refresh' CONTENT='0;URL=logginn.php'>");

    }
    else{
            /*include("start.html");*/
            print("Bruker: $innloggetbruker");
          /*  include("slutt.html");*/
        }
    ?></li>
    <li><h3>Registrer</h3></li>
    <li><a href="regbeer.php">Registrer øl</a></li>
    <li><a href="regstyle.php">Registrer ølstil</a></li>

    <li><h3>Endre</h3></li>
    <li><a href="endreol.php">Endre øl</a></li>
    <li><h3>Slette</h3></li>
    <li><a href="slettol.php">Slette øl</a></li>
    <li><h3>Vis</h3></li>
    <li><a href="visol.php">Vis øl</a></li>
    <li><a href="visolstil.php">Vis ølstil</a></li>
    <li><h3>Søk</h3></li>
    <li><a href="sokol.php">Søk etter øl</a></li>
  </ul>
</div>
