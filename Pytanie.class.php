<?php
class Pytanie
{
  private $tresc;
  private $odpowiedzi = Array();
  private $prawidlowaOdpowiedz;

  function __construct($t, $o, $p)
  {
    $this->tresc = $t;
    $this->odpowiedzi = $o;
    $this->prawidlowaOdpowiedz = $p;
  }
  function wyswietlPytanie()
  {
    echo '<h1>'.$this->tresc.'</h1>';
    echo '<form action="index.php" method="post">';
    foreach ($this->odpowiedzi as $klucz => $wartosc) {
      echo '<input type="radio" name="odpowiedz"
              value="'.$klucz.'">'.$wartosc;
    }
    echo '<input type="submit">';
    echo '</form>';
  }
  function sprawdzOdpowiedz($o)
  {
    if($o == $this->prawidlowaOdpowiedz) return true;
    else return false;
  }
  function polNaPol()
  {
      $noweOdpowiedzi = Array();
      $noweOdpowiedzi[$this->prawidlowaOdpowiedz] =
                                $this->odpowiedzi[$this->prawidlowaOdpowiedz];
      unset($this->odpowiedzi[$this->prawidlowaOdpowiedz]);
      $indeks = array_rand($this->odpowiedzi);
      $noweOdpowiedzi[$indeks] = $this->odpowiedzi[$indeks];
      $this->odpowiedzi = $noweOdpowiedzi;
  }
}



//echo '<pre>';
//var_dump($p);
//$p->wyswietlPytanie();
?>
