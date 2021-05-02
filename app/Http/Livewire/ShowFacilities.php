<?php

namespace App\Http\Livewire;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowFacilities extends Component
{
  public Collection $facilities;

  public string $query = '';

  public function mount()
  {
    $this->resetFacilities();
  }

  public function render()
  {
    return view('livewire.show-facilities');
  }

  public function updatedQuery()
  {
    if (empty($this->query)) {
      $this->resetFacilities();
    } else {
      $this->facilities = Facility::search($this->query)->get();
    }
  }

  private function resetFacilities()
  {
    $this->facilities = Facility::ordered()->get();
  }
}
