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
if(isset($_REQUEST['polnapol']))
    $gra->polNaPol();
if(isset($_REQUEST['publicznosc']))
    $gra->publicznosc();

$gra->wyswietlPytanie();


echo '<a href="index.php?polnapol">Pół na pół</a>';
echo '<a href="index.php?publicznosc">Pytanie do publiczności</a>';
// Zapisujemy zmiany do sesji
$_SESSION['gra'] = $gra;
echo '<pre>';
var_dump($_REQUEST);
var_dump($gra);
?>
