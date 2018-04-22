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
  function publicznosc()
  {
    $procenty = Array();
    if(count($this->odpowiedzi) == 4)
    {
      //brak pol na pol
      for($i = 'a'; $i <= 'd'; $i++)
      {
        $procenty[$i] = rand(0,20);
      }
      $procenty[$this->prawidlowaOdpowiedz] = 0;
      $suma = array_sum($procenty);
      $procenty[$this->prawidlowaOdpowiedz] = 100 - $suma;
    }
    else
    {
      //użyto pół na pół
      $procenty = $this->odpowiedzi;
      foreach ($procenty as $indeks => &$odpowiedz) {
        if($indeks == $this->prawidlowaOdpowiedz)
          $odpowiedz = rand(40,80);
        else $odpowiedz = 0;
      }
      var_dump($procenty);
      $indeksBlednejOdpowiedzi = array_search(0, $procenty);
      $procenty[$indeksBlednejOdpowiedzi] = 100 - $procenty[$this->prawidlowaOdpowiedz];
    }
    echo "Publiczność podpowiada: <br>";
    foreach ($procenty as $indeks => $procent) {
      echo $indeks.": ".$procent."<br>";
    }
  }
}



//echo '<pre>';
//var_dump($p);
//$p->wyswietlPytanie();
?>
