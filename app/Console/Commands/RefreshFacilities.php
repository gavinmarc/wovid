<?php

namespace App\Console\Commands;

use Facades\App\Services\FacilityService;
use Illuminate\Console\Command;

class RefreshFacilities extends Command
{
  protected $signature = 'wovid:refresh-facilities';

  public function handle()
  {
    FacilityService::refresh();
  }
}
