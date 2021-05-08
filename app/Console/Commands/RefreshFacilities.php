<?php

namespace App\Console\Commands;

use App\Models\Facility;
use Facades\App\Services\FacilityService;
use Illuminate\Console\Command;

class RefreshFacilities extends Command
{
  protected $signature = 'wovid:refresh-facilities';

  public function handle()
  {
    $this->call('scout:flush', ['model' => Facility::class]);

    FacilityService::refresh();

    $this->call('scout:import', ['model' => Facility::class]);
  }
}
