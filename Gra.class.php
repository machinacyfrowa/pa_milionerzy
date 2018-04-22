<?php
include 'BazaPytan.class.php';
class Gra
{
  private $numerPytania = 1; //kolejny 1-12
  private $stawki = Array(0,500,1000,
                          2000,5000,10000,
                          20000,40000,75000,
                          125000,250000,500000,
                          1000000);
  private $bazaPytan;
  private $obecnePytanie;
  function __construct()
  {
    $this->bazaPytan = new BazaPytan();
    $this->bazaPytan->wczytajPytania("pytania.txt");
    $this->nowePytanie();
  }
  function nowePytanie()
  {
    $this->obecnePytanie = $this->bazaPytan->losujPytanie();
  }
  function wyswietlPytanie()
  {
    echo '<h1>Pytanie za '.
      $this->stawki[$this->numerPytania].' złotych</h1>';
    $this->obecnePytanie->wyswietlPytanie();
  }
  function udzielOdpowiedzi($o)
  {
    if($this->obecnePytanie->sprawdzOdpowiedz($o))
    {
      //udzielono prawidłowej odpowiedzi
      echo "Udzielono poprawnej odpowiedzi";
      $this->numerPytania++;
      $this->nowePytanie();
    }
    else
    {
      //udzielono błędnej odpowiedzi
      echo "Udzielono błednej odpowiedzi";
      $this->numerPytania = 1;
      $this->bazaPytan->wczytajPytania("pytania.txt");
      $this->nowePytanie();
    }
  }
}
?>