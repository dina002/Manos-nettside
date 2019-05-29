<?php  /* sjekk */
/*
/*  Programmet inneholder en funksjon for å sjekke om brukernavn og passord er korrekt
*/

function sjekkBrukernavnPassord($brukernavn,$passord)
{
/*
/*  Hensikt
/*    Funksjonen sjekker om brukernavn og passord er korrekt
/*  Parametre
/*    $brukernavn = brukernavnet som skal sjekkes
/*    $passord = passordet som skal sjekkes
/*  Funksjonsverdi/Returverdi
/*    Funksjonen returnerer true hvis brukernavn og passord er korrekt
/*    Funksjonen returnerer false ellers
*/

  include("db-tilkobling.php");  /* tilkobling til database-server og valg av database utfųrt */

  $lovligBruker=true;

  $sqlSetning="SELECT * FROM manos_users WHERE brukernavn='$brukernavn';";
  $sqlResultat=mysqli_query($db, $sqlSetning);

  if (!$sqlResultat)  /* SQL-setningen ble ikke utfųrt med vellykket resultat */
    {
      $lovligBruker=false;
    }
  else
   {
      $rad=mysqli_fetch_array($sqlResultat);
      $lagretBrukernavn=$rad["brukernavn"];
      $lagretPassord=$rad["passord"];

      $kryptertPassord=password_hash($passord, PASSWORD_DEFAULT);

      if($brukernavn!=$lagretBrukernavn || !password_verify($passord, $lagretPassord))
        {
          $lovligBruker=false;
        }
    }
  return $lovligBruker;
}
?>
