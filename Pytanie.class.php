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
    echo '<form method="post">';
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
}



//echo '<pre>';
//var_dump($p);
//$p->wyswietlPytanie();
?>
