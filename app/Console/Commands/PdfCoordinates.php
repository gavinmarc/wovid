<?php

namespace App\Console\Commands;

use Facades\App\Repositories\FacilityRepository;
use Illuminate\Console\Command;

class PdfCoordinates extends Command
{
  protected $signature = 'wovid:pdf-coordinates';

  protected $description = 'Command description';

  public function handle()
  {
    $rows = FacilityRepository::fetch();

    $missingCoordinates = collect($rows)
      ->flatten(1)
      ->mapWithKeys(fn ($item) => [(int) floor($item[0][4]) => $item[1]])
      ->reject(fn ($value, $key) => $this->coordinateGrouped($key));

    $this->table(
      ['Coordinate', 'Value'],
      $missingCoordinates->map(fn ($value, $key) => [$key, $value])
    );
  }

  private function coordinateGrouped(int $key): bool
  {
    foreach (config('table-layouts') as $positions) {
      if (in_array($key, $positions)) {
        return true;
      }
    }

    return false;
  }
}
