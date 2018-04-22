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
      //tworzymy tablicę wynikowe 2 odpowiedzi
      $noweOdpowiedzi = Array();
      //kopiujemy prawidlowa odpowiedz
      $noweOdpowiedzi[$this->prawidlowaOdpowiedz] =
                                $this->odpowiedzi[$this->prawidlowaOdpowiedz];
      //usuwamy prawidlowa odpowiedz z puli
      unset($this->odpowiedzi[$this->prawidlowaOdpowiedz]);
      //losujemy 1 bledna odpowiedz
      $indeks = array_rand($this->odpowiedzi);
      //kopiujemy ja do nowych
      $noweOdpowiedzi[$indeks] = $this->odpowiedzi[$indeks];
      //zamieniamy orginalne odpowiedzi z nowymi
      $this->odpowiedzi = $noweOdpowiedzi;
  }
  function publicznosc()
  {
    //tworzymy tablicę do przechowywania wyników w %
    $procenty = Array();
    //jeżeli są dostępne wszystkie 4 odpowiedzi
    if(count($this->odpowiedzi) == 4)
    {
      //brak pol na pol - liczymy dla wszstkich 4
      for($i = 'a'; $i <= 'd'; $i++)
      {
        //losowo do 20% dla wszystkich
        $procenty[$i] = rand(0,20);
      }
      //zerujemy prawidłową odpowiedz
      $procenty[$this->prawidlowaOdpowiedz] = 0;
      //liczymy sumę z pozostałych
      $suma = array_sum($procenty);
      //wstawiamy obliczoną resztę do poprawnej odpowiedzi
      $procenty[$this->prawidlowaOdpowiedz] = 100 - $suma;
    }
    else
    {
      //użyto pół na pół
      //kopiujemy tablice z odpowiedziami dla indeksów (a,b...)
      $procenty = $this->odpowiedzi;
      //dla każdej z pozycji (powinny być 2)
      foreach ($procenty as $indeks => &$odpowiedz) {
        //jeżeli to ta prawidłowa to ustaw wysoki %
        if($indeks == $this->prawidlowaOdpowiedz)
          $odpowiedz = rand(40,80);
        //dla nieprawidlowej ustaw 0
        else $odpowiedz = 0;
      }
      //znajdz indeks blednej odpowiedzi
      $indeksBlednejOdpowiedzi = array_search(0, $procenty);
      //ustaw wartość błędnej na 100 - poprawna
      $procenty[$indeksBlednejOdpowiedzi] = 100 - $procenty[$this->prawidlowaOdpowiedz];
    }
    //wyświetl wyniki
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
