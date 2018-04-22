<?php
include 'Gra.class.php';
session_start();
if(isset($_SESSION['gra']))
{
  $gra = $_SESSION['gra'];
}
else {
  $gra = new Gra();
}
if(isset($_REQUEST['odpowiedz']))
    $gra->udzielOdpowiedzi($_REQUEST['odpowiedz']);
$gra->wyswietlPytanie();

// Zapisujemy zmiany do sesji
$_SESSION['gra'] = $gra;
echo '<pre>';
var_dump($_REQUEST);
var_dump($gra);
?>
