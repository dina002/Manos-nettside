<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/kalender.js"></script>
    <script src="js/datepicker.js"> </script>
    <link href="css/datepicker.css" rel="stylesheet" >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manos Mikrobryggeri</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- Plugin CSS -->

    <!-- Theme CSS -->
    <link href="css/creative.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">

</head>
<body id="page-top">
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="index.php"><img src="img/logohvit.png" style="height:45px;margin-top:0 !important;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="page-scroll" href="index.php">HOME</a>
                </li>
                <li>
                    <a class="page-scroll" href="logginn.php">SEARCH</a>
                </li>
                <li>
                    <a class="page-scroll" href="logginn.php">BROWSE</a>
                </li>
                <li>
                  <?php
                  session_start();
                  @$innloggetbruker=$_SESSION["brukernavn"];
                  if(!$innloggetbruker){
                    print("<a class='page-scroll' href='logginn.php'>LOGG INN</a><br>");
                  }
                  else{
                    include("db-tilkobling.php");
                    @$user_id=$_SESSION["user_id"];
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
                        print("<li><a class='page-scroll' href='https://home.hbv.no/phptemp/146813/manos_profilbilde/$filnavn'>
                        <img class='circle' style='width:20px;'src='https://home.hbv.no/phptemp/146813/manos_profilbilde/$filnavn' target='_blank'></a></li>");
                        print("<li><a class='page-scroll' href='minside.php'>Min side $innloggetbruker</a></li>");
                      }
          		      }
                      }
                  ?>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>s
