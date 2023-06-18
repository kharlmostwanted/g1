<div>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Payment Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white py-4 px-6 shadow-xl sm:rounded-lg">
        <div>
          <x-label
            for="houshold"
            value="{{ __('Household') }}"
          />
          <h4 class="text-lg font-bold">{{ $this->payment->household }}</h4>
          <x-input-error
            class="mt-2"
            for="payment.household_id"
          />
        </div>
        <div class="mt-4">
          <x-label
            for="owner"
            value="{{ __('Owner') }}"
          />
          <h4 class="text-lg font-bold">{{ $this->payment->household->owner }}</h4>
        </div>
        <div class="mt-4">
          <x-label
            for="owner"
            value="{{ __('Item') }}"
          />
          <h4 class="text-lg font-bold">{{ $this->payment->item->title }}</h4>
        </div>
        <div class="mt-4">
          <x-label
            for="owner"
            value="{{ __('Amount') }}"
          />
          <h4 class="text-lg font-bold">{{ number_format($this->payment->amount, 2) }}</h4>
        </div>
      </div>
      <x-section-border class="my-2" />
      <div class="flex items-center justify-end">
        <a
          class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900"
          href="{{ route('households.index') }}"
        >Return</a>
      </div>
    </div>

  </div>
</div>
