<div>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Household Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white py-4 px-6 shadow-xl sm:rounded-lg">
        <div class="visible-print text-center">
          {!! QrCode::size(100)->generate(Request::url()) !!}
        </div>
        <div class="mt-4">
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
      </div>
      <div class="mt-8 overflow-hidden bg-white py-4 px-6 shadow-xl sm:rounded-lg">
        <h3>Transactions</h3>
        <table class="min-w-full text-left text-sm font-light">
          <thead class="border-b font-medium">
            <tr>
              <th
                class="px-6 py-4"
                scope="col"
              >#</th>
              <th
                class="px-6 py-4"
                scope="col"
              >Detail</th>
              <th
                class="px-6 py-4"
                scope="col"
              >Debit</th>
              <th
                class="px-6 py-4"
                scope="col"
              >Credit</th>
              <th
                class="px-6 py-4"
                scope="col"
              >Date</th>
              <th
                class="px-6 py-4"
                scope="col"
              >Balance</th>
            </tr>
          </thead>
          <tbody>
            @php
              $balance = 0;
            @endphp
            @foreach ($this->household->transactions->sortBy('date') as $index => $transaction)
              <tr class="border-b hover:bg-gray-200">
                <td class="text-start p-2">{{ $transaction['id'] }}</td>
                <td class="text-start">{{ $transaction['title'] }}</td>
                <td class="text-end">{{ $transaction['debit'] == 0 ? '-' : $transaction['debit'] }}</td>
                <td class="text-end">{{ $transaction['credit'] == 0 ? '-' : $transaction['credit'] }}</td>
                <td class="text-end">{{ $transaction['date']->format('m-d-Y') }}</td>
                <td class="text-end">{{ $balance += $transaction['debit'] - $transaction['credit'] }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @if (auth()->check())
        <x-section-border class="my-2" />
        <div class="flex items-center justify-end">
          <a
            class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900"
            href="{{ route('payments.create', ['household_id' => $this->household]) }}"
          >Add Payment</a>
        </div>
      @endif
    </div>

  </div>
</div>
