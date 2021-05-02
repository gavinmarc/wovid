<?php

namespace App\Services;

use App\Models\Facility;
use Facades\App\Repositories\FacilityRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Str;

class FacilityService
{
  private ?array $layouts = null;

  public function refresh()
  {
    Facility::truncate();

    $rows = FacilityRepository::fetch();

    foreach ($rows as $row) {
      $attributes = collect($row)
        ->map(fn ($item) => $this->flattenMatrix($item))
        ->groupBy('x')
        ->mapWithKeys(fn ($item) => $this->mergeGroup($item))
        ->toArray();

      $this->createFacility($attributes);
    }
  }

  private function createFacility(array $attributes)
  {
    $created = false;

    while (!$created) {
      try {
        Facility::create($attributes);
        $created = true;
      } catch (QueryException $e) {
        preg_match('/(`(\w*)`.){3}/', $e->getMessage(), $matches);
        $field = $matches[2];
        $attributes[$field] = utf8_encode($attributes[$field]);
      }
    }
  }

  private function flattenMatrix(array $items): array
  {
    return [
      'x' => (int) floor($items[0][4]),
      'y' => (int) floor($items[0][5]),
      'text' => $items[1]
    ];
  }

  private function mergeGroup(Collection $items): array
  {
    $key = $this->getAttributeKey($items->first()['x']);

    $value = (string) Str::of($items->pluck('text')->implode(''))
      ->replace("\n", '')
      ->trim();

    return [$key => $value];
  }

  private function getAttributeKey(int $x): string
  {
    if (!$this->layouts) {
      $this->layouts = config('table-layouts');
    }

    foreach ($this->layouts as $attribute => $positions) {
      if (in_array($x, $positions)) {
        return $attribute;
      }
    }

    return 'undefined';
  }
}
