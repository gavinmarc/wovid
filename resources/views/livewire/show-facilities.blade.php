<div>
  {{-- Search --}}
  <label>
    <input
      class="width-4/5 py-2 px-4 border rouded-full font-light focus:outline-none focus:shadow focus:border-blue-200 transition duration-150 ease-in-out"
      wire:model.debounce.500ms="query"
      type="text"
      placeholder="Suche ...">
  </label>

  {{-- Facilities --}}
  @foreach($facilities as $facility)
    <div>
      {{ $facility->district }}
    </div>
  @endforeach
</div>
