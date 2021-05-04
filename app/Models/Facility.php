<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Facility extends Model
{
  use Searchable;

  protected $fillable = [
    'district', 'post_code', 'street_address', 'facility_name', 'doctors', 'expertise', 'consultation_hours',
    'appointment_phone', 'appointment_email', 'appointment_web', 'notes', 'website'
  ];

  public function scopeOrdered(Builder $query): Builder
  {
    return $query->orderBy('district');
  }

  public function toSearchableArray(): array
  {
    return $this->only([
      'id', 'district', 'post_code', 'street_address', 'facility_name',
      'doctors', 'expertise', 'consultation_hours'
    ]);
  }
}
