<div>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('New Payment') }}
    </h2>
  </x-slot>

  <div>
    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
      <div class="rounded-lg bg-white py-8 px-6 shadow-lg">
        <div>
          <x-label
            for="houshold"
            value="{{ __('Household') }}"
          />
          <h4 class="text-lg font-bold">{{ $this->household }}</h4>
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
          <h4 class="text-lg font-bold">{{ $this->household->owner }}</h4>
        </div>
        <div class="mt-4">
          <x-label
            for="payment.item_id"
            value="{{ __('Item') }}"
          />
          <select
            class="rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            id="payment.item_id"
            name="payment.item_id"
            wire:model.defer="payment.item_id"
          >
            <option value="0">Select an item</option>
            @foreach ($this->items as $item)
              <option value="{{ $item->id }}">{{ $item->title }}</option>
            @endforeach
          </select>
          <x-input-error
            class="mt-2"
            for="payment.item_id"
          />
        </div>

        {{-- amount --}}
        <div class="mt-4">
          <x-label
            for="name"
            value="{{ __('Amount') }}"
          />
          <x-input
            autocomplete="Houdeshold"
            class="mt-1 block w-full"
            id="payment.amount"
            type="number"
            wire:model.defer="payment.amount"
          />
          <x-input-error
            class="mt-2"
            for="payment.amount"
          />
        </div>

      </div>

      <x-section-border class="my-2" />

      <div class="flex items-center justify-end">
        <x-button
          class="ml-4"
          wire:click="confirmPayment"
        >
          {{ __('Create') }}
        </x-button>
      </div>
    </div>
  </div>

  <x-dialog-modal wire:model="confirmingPayment">
    <x-slot name="title">
      {{ __('Confirm Payment') }}
    </x-slot>

    <x-slot name="content">
      <div>
        <x-label
          for="houshold"
          value="{{ __('Household') }}"
        />
        <h4 class="text-lg font-bold">{{ $this->household }}</h4>
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
        <h4 class="text-lg font-bold">{{ $this->household->owner }}</h4>
      </div>
      <div class="mt-4">
        <x-label
          for="owner"
          value="{{ __('Item') }}"
        />
        <h4 class="text-lg font-bold">{{ $this->item->title }}</h4>
      </div>
      <div class="mt-4">
        <x-label
          for="owner"
          value="{{ __('Amount') }}"
        />
        <h4 class="text-lg font-bold">{{ number_format($this->payment->amount, 2) }}</h4>
      </div>
    </x-slot>

    <x-slot name="footer">
      <x-secondary-button
      class="mr-4"
        wire:click="$set('confirmingPayment', false)"
        wire:loading.attr="disabled"
      >
        {{ __('Close') }}
      </x-secondary-button>
      <x-button
        wire:click="savePayment"
        wire:loading.attr="disabled"
      >
        {{ __('Save Payment') }}
      </x-button>
    </x-slot>
  </x-dialog-modal>

</div>
