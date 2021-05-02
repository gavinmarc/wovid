<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;

class FacilityRepository
{
  private array $needles = [
    'Charlottenburg', 'Friedrichshain', 'Lichtenberg', 'Marzahn', 'Mitte', 'Neukölln',
    'Pankow', 'Reinickendorf', 'Spandau', 'Steglitz', 'Tempelhof', 'Treptow',
  ];

  public function fetch(): array
  {
    $url = config('services.kvberlin.url');
    $parser = (new Parser)->parseFile($url);

    $facilites = [];
    $index = -1;

    foreach ($parser->getPages() as $page) {
      foreach ($page->getDataTm() as $matrix) {
        if (Str::startsWith($matrix[1], $this->needles)) {
          $index++;
        }

        if ($index < 0 || preg_match('/Übersicht:.*|Seite \d von \d/', $matrix[1])) {
          continue;
        }

        $facilites[$index][] = $matrix;
      }
    }

    return $facilites;
  }
}
