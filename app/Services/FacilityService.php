<?php

namespace App\Services;

use App\Models\Facility;
use Facades\App\Repositories\FacilityRepository;
use Illuminate\Support\Collection;

class FacilityService
{
  private Collection $rows;

  public function refresh()
  {
    Facility::truncate();

    $facilities = $this->fetchRows()
      ->formatRows()
      ->fixSplittedRows();

    Facility::insert($facilities);
  }

  private function fetchRows(): self
  {
    $this->rows = FacilityRepository::fetchRows();

    return $this;
  }

  private function formatRows(): self
  {
    $keys = [
      'district', 'post_code', 'street_address', 'facility_name', 'doctors', 'expertise', 'consultation_hours',
      'appointment_phone', 'appointment_email', 'appointment_web', 'notes', 'website'
    ];

    $this->rows =  $this->rows->forget(0)
      // filter empty rows
      ->reject(fn ($row) => empty(array_filter($row)))
      // combine keys and values and sanitize values
      ->map(function ($row) use ($keys) {
        return array_map(
          fn ($a) => trim(str_replace(["\n", "\t"], '', $a)),
          array_combine($keys, $row)
        );
      });

    return $this;
  }

  private function fixSplittedRows(): array
  {
    $facilities = [];

    foreach ($this->rows as $row) {
      foreach ($row as $key => $value) {
        if (empty($value)) {
          continue;
        }

        if ($key == 'district') {
          $facilities[] = $row;
          break;
        }

        // at the value to the previous facility
        $index = count($facilities) - 1;
        $facilities[$index][$key] .= $value;
        break;
      }
    }

    return $facilities;
  }
}
