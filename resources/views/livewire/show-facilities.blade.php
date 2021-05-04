<div class="w-full">
  {{-- Search --}}
  <label class="flex justify-center mb-8">
    <input
      class="w-4/5 py-2 px-4 border rounded-md font-light focus:outline-none focus:shadow focus:border-gray-700 transition duration-150 ease-in-out"
      wire:model.debounce.500ms="query"
      type="text"
      placeholder="Suche ...">
  </label>

  {{-- Facilities --}}
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($facilities as $facility)
      <div class="relative bg-white opacity-80 p-4 rounded-sm shadow-md">
        {{-- Address --}}
        <div>
          <p>{{ $facility->facility_name }}</p>
          <p>{{ $facility->doctors }} ({{ $facility->expertise }})</p>
          <p>{{ $facility->street_address }}</p>
          <p>{{ $facility->post_code }} {{ $facility->district }}</p>
        </div>

        {{-- Appointment Booking --}}
        <div>
          <p>{{ $facility->appointment_phone }}</p>
          <p>{{ $facility->appointment_email }}</p>
          <p>{{ $facility->appointment_web }}</p>
        </div>

        {{-- Notes --}}
        @if($facility->notes)
{{--           {{ $facility->notes }} --}}
        @endif
      </div>
    @endforeach
  </div>
</div>
