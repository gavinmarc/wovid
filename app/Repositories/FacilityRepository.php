<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class FacilityRepository
{
  public function fetchRows(): Collection
  {
    File::cleanDirectory(
      storage_path('temp')
    );

    $url = config('services.kvberlin.url');
    $inputFilename = 'doctors-list.pdf';
    Storage::disk('temp')->put("$inputFilename", file_get_contents($url));

    $outputFilename = 'output.json';
    $this->executeCommand(
      Storage::disk('temp')->path($inputFilename),
      Storage::disk('temp')->path($outputFilename)
    );

    $filepaths = File::glob(
      Storage::disk('temp')->path('output*.json')
    );

    $rows = collect();
    foreach ($filepaths as $filepath) {
      $rows = $rows->concat(
        json_decode(file_get_contents($filepath), true)
      );
    }

    return $rows;
  }

  private function executeCommand(string $inputFile, string $outputFile)
  {
    $format = (string) Str::of($outputFile)->match('/\.([a-z]*)$/');

    $process = new Process([
      'camelot',
      '--pages', 'all',
      '--format', $format,
      '--output', $outputFile,
      'lattice',
      $inputFile
    ]);

    $process->run();

    if (!$process->isSuccessful()) {
      throw new ProcessFailedException($process);
    }
  }
}
