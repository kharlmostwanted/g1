<div>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Households') }}
    </h2>
  </x-slot>
  <div class="py-12">

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="mb-4 flex items-center justify-between">
        <input
          class="rounded-full bg-gray-200 px-4 py-2 text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Search..."
          type="text"
          wire:model="search"
        >
        <div class="flex flex-row items-center">
          <x-label
            class="me-3"
            for="filter"
            value="{{ __('Filter') }}:"
          />
          <select
            class="rounded-full bg-gray-200 px-4 py-2 text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            id="filter"
            name="filter"
            wire:model.debounce.500ms="filter"
          >
            <option value="">All</option>
            <option value="updated">Updated Monthly Dues</option>
            <option value="outdated">Outdated Monthly Dues</option>
          </select>
        </div>
      </div>

      <div class="overflow-hidden bg-white px-2 py-2 shadow-xl sm:rounded-lg">
        <div class="flex flex-col">
          <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
              <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light border">
                  <thead class="border-b font-medium">
                    <tr>
                      <th
                        class="px-6 py-4"
                        scope="col"
                      >#</th>
                      <th
                        class="px-6 py-4"
                        scope="col"
                      >Block & Lot</th>
                      <th
                        class="px-6 py-4"
                        scope="col"
                      >Street</th>
                      <th
                        class="px-6 py-4"
                        scope="col"
                      >Owner</th>
                      <th
                        class="px-6 py-4"
                        scope="col"
                      >Good Standing</th>
                      <th
                        class="px-6 py-4"
                        scope="col"
                      >Total Payables</th>
                      <th
                        class="px-6 py-4"
                        scope="col"
                      >Total Payments</th>
                      <th
                        class="px-6 py-4"
                        scope="col"
                      >Balance</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($this->households as $index => $household)
                      <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100">
                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $index + 1 }}</td>
                        <td class="whitespace-nowrap px-6 py-4">
                          <a
                            class="underline hover:text-green-900"
                            href="{{ route('households.show', $household) }}"
                          >
                            {{ $household->title }}
                          </a>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">{{ $household->street }}</td>
                        <td class="whitespace-nowrap px-6 py-4">{{ $household->owner->name }}</td>
                        <td class="whitespace-nowrap px-6 py-4">
                          @if ($household->isGoodStanding)
                            <span class="inline-flex items-center rounded-full p-2 text-green-600">
                              Yes
                            </span>
                          @else
                            <span class="inline-flex items-center rounded-full p-2 text-red-600">
                              No
                            </span>
                          @endif
                        </td>
                        <td class="text-end">
                          {{ number_format($household->total_payables, 2) }}
                        </td>
                        <td class="text-end">
                          {{ number_format($household->total_payments, 2) }}
                        </td>
                        <td class="text-end">{{ number_format($household->total_payables-$household->total_payments, 2) }}</td>
                        <td class="p-2">
                          <a
                            class="font-bold text-green-600 hover:text-green-900"
                            href="{{ route('payments.create', [
                                'household_id' => $household->id,
                            ]) }}"
                          >Add
                            Payment</a>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="mt-8">
        {{ $this->households->links() }}
      </div>
    </div>
  </div>

</div>
