<div>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Fees') }}
    </h2>
  </x-slot>
  <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center mb-4">
        <input class="rounded-full py-2 px-4 bg-gray-100 text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500"
               placeholder="Search..."
               type="text"
               wire:model="search">
      </div>

      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-2 py-2">
        <div class="flex flex-col">
          <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
              <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light">
                  <thead class="border-b font-medium">
                    <tr>
                      <th class="px-6 py-4 text-center"
                          scope="col">Due</th>
                      <th class="px-6 py-4"
                          scope="col">Fee</th>
                      <th class="px-6 py-4"
                          scope="col">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($this->fees->sortBy('due_at') as $index => $fee)
                      <tr class="border-b">
                        <td class="py-2 px-1 text-center">{{ $fee->due_at->format('M Y') }}</td>
                        <td class="py-2 px-1">{{ str($fee->title)->title() }}</td>
                        <td class="py-2 px-1 font-bold text-end w-10">{{ $fee->amount }}</td>
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
        {{ $this->fees->links() }}
      </div>
    </div>
  </div>

</div>
