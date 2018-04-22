<?php
include 'Pytanie.class.php';
class BazaPytan
{
  private $listaPytan = Array();

  function dodajPytanie($p)
  {
    array_push($this->listaPytan, $p);
  }

  function wczytajPytania($nazwaPliku)
  {
    $plik = fopen($nazwaPliku, "r");
    $linie = Array();
    $dane = fgets($plik);
    while($dane != false) //dopóki nie koniec pliku
    {
      array_push($linie, $dane);
      $dane = fgets($plik);
    }
    foreach ($linie as $linia)
    {
      //$linia to całe pytanie jako string rozdzielony |
      $tablica = explode("|", $linia);
      $pytanie = new Pytanie($tablica[0],
                            Array('a' => $tablica[1],
                                  'b' => $tablica[2],
                                  'c' => $tablica[3],
                                  'd' => $tablica[4]),
                            $tablica[5]);
      $this->dodajPytanie($pytanie);
    }
    fclose($plik);
  }

  function losujPytanie()
  {
    $losowyIndeks = rand(0,
            count($this->listaPytan) - 1);

    $pytanie = clone $this->listaPytan[$losowyIndeks];
    array_splice($this->listaPytan, $losowyIndeks, 1);
    return $pytanie;
  }
} /*
$p = new Pytanie("Treść pytania",
                  Array('a' => 'Odpowiedz A',
                        'b' => 'Odpowiedz B',
                        'c' => 'Odpowiedz C',
                        'd' => 'Odpowiedz D'),
                'c');
$b = new BazaPytan();
$b->dodajPytanie($p);
echo '<pre>';
var_dump($b);
var_dump($b->losujPytanie());
var_dump($b);
*/
?>
